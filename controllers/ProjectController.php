<?php

namespace app\controllers;

use app\helpers\LanguageHelper;
use app\models\Project;
use app\models\ProjectSearch;
use yii\bootstrap5\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;


/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $model = new Project(); //reset model
        }

        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Set pagination size
        $dataProvider->pagination->pageSize = 8; // Number of items per page

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->renderAjax('_view', [
            'model' => $model,
        ]);

    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    $model->status = Project::ACTIVE_STATUS;
                    $model->added_by = 1;
                    $model->added_date = date('Y-m-d H:i:s');
                    $model->save();

                    $message = Yii::t('project', 'Project Created Successfully');
                    return $this->asJson([
                        'success' => true,
                        'data' => $message,
                    ]);
                } else {
                    return $this->asJson([
                        'success' => false,
                        'data' => ActiveForm::validate($model),
                    ]);
                }
            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {
                    $model->save();
                    $message = Yii::t('project', 'Project Updated Successfully');
                    return $this->asJson([
                        'success' => true,
                        'data' => $message,
                    ]);
                } else {
                    return $this->asJson([
                        'success' => false,
                        'data' => ActiveForm::validate($model),
                    ]);
                }
            }
        }

        return $this->renderAjax('_form', [
            'model' => $model,
        ]);

    }


    /**
     * Deletes an existing Project model.
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
                $model->delete();
                $message = Yii::t('project', 'Project Deleted Successfully');
                return $this->asJson([
                    'success' => true,
                    'data' => $message,
                ]);
            }
        }else{
            $message = Yii::t('project', 'Project does not exist');

            return $this->asJson([
                'success' => false,
                'data' => $message,
            ]);
        }

    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSwitchStatus($id)
    {
        $model = $this->findModel($id);
        if ($model !== null) {
            if (Yii::$app->request->isPost) {
                if ($model->switchStatus()) {
                    $status = $model->status == Project::ACTIVE_STATUS ? 'Activated' : 'Deactivated';
                    $message = Yii::t('project', 'Project '.$status.' Successfully');
                    return $this->asJson([
                        'success' => true,
                        'data' => $message,
                    ]);
                }
            }
        }

        $message = Yii::t('project', 'Project does not exist');

        return $this->asJson([
            'success' => false,
            'data' => $message,
        ]);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

}
