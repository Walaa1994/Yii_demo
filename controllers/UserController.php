<?php

namespace app\controllers;

use app\helpers\LanguageHelper;
use app\models\UserDB;
use app\models\UserDBSearch;
use app\components\EmailJob;
use Yii;
use yii\base\Security;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for UserDB model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'switch-status' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                    'denyCallback' => function () {
                        return Yii::$app->response->redirect(['site/login']);
                    },
                ],
            ]
        );
    }

    public function beforeAction($action)
    {
        LanguageHelper::changeLanguage();
        return parent::beforeAction($action);
    }

    /**
     * Lists all UserDB models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserDBSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserDB model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserDB model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new UserDB();
        $model->scenario = UserDB::SCENARIO_CREATE;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Hash Password
                $model->password = $this->hashPassword($model->password);

                // Set status to active
                $model->status = UserDB::ACTIVE_STATUS;

                // Save Photo
                $photo = UploadedFile::getInstance($model, 'photo');
                $model->photo = $this->savePhoto($photo);

                // Assign now datetime to added_date & last_update
                $currentDateTime = date('Y-m-d H:i:s');
                $model->added_date = $currentDateTime;
                $model->last_update = $currentDateTime;

                if($model->save()){
                    // Enqueue the email job
                    Yii::$app->queue->push(new EmailJob([
                        'to' => $model->email,
                        'subject' => 'Welcome to Our Team',
                        'template' => 'welcome-mail',
                        'name' => $model->fisrt_name,
                        'body' => 'We are delighted to have you as a new member of our team. Thank you for joining us!'
                    ]));

                    // Set flash message
                    Yii::$app->session->setFlash('success', Yii::t('user', 'User Added Successfully'));

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserDB model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = UserDB::SCENARIO_UPDATE;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())){
                $photo = UploadedFile::getInstance($model, 'photo');
                if ($photo !== null) {
                    // Delete the previous image file if it exists
                    if (!empty($model->photo)) {
                        $this->deletePhoto($model->photo);
                    }

                    // Save the new image file
                    $model->photo = $this->savePhoto($photo);

                }

                if(!empty($this->request->post('UserDB')['password'])){
                    // Hash Password
                    $model->password = $this->hashPassword($this->request->post('password'));
                }
            }

            if ($model->save()) {
                // Set flash message
                Yii::$app->session->setFlash('success', Yii::t('user', 'User Updated Successfully'));

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserDB model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model !== null) {
            if (Yii::$app->request->isPost) {
                if (!empty($model->photo)) {
                    $this->deletePhoto($model->photo);
                }
                $model->delete();
                $message = Yii::t('user', 'User Deleted Successfully');
                return $this->asJson([
                    'success' => true,
                    'data' => $message,
                ]);
            }
        }

        $message = Yii::t('user', 'User does not exist');

        return $this->asJson([
            'success' => false,
            'data' => $message,
        ]);

    }

    public function actionSwitchStatus($id)
    {
        $model = $this->findModel($id);

        if ($model !== null) {
            if (Yii::$app->request->isPost) {
                if ($model->switchStatus()) {
                    $status = $model->status == UserDB::ACTIVE_STATUS ? 'Activated' : 'Deactivated';
                    $message = Yii::t('user', 'User '.$status.' Successfully');
                    return $this->asJson([
                        'success' => true,
                        'data' => $message,
                    ]);
                }
            }
        }

        $message = Yii::t('user', 'User does not exist');

        return $this->asJson([
            'success' => false,
            'data' => $message,
        ]);
    }

    /**
     * Finds the UserDB model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return UserDB the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserDB::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Hash the password
     */
    protected function hashPassword($password)
    {
        $security = new Security();
        $hashedPassword = $security->generatePasswordHash($password);
        return $hashedPassword;
    }

    /**
     * save the photo
     */
    protected function savePhoto($photo)
    {
        $extension = $photo->getExtension();
        $randomHash = Yii::$app->security->generateRandomString(8); // Generate a random string of length 8
        $photoName = 'user_' . $randomHash . '.' . $extension;
        $photo->saveAs(Yii::getAlias('@webroot/img/users/' . $photoName));
        return $photoName;
    }

    /**
     * delete the photo
     */
    protected function deletePhoto($photo)
    {
        $photoPath = Yii::getAlias('@webroot/img/users/' . $photo);
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }

}
