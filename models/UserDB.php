<?php

namespace app\models;

use Yii;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $fisrt_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property int $status 2=active | 3=inactive 
 * @property string $password
 * @property string $photo
 * @property int $permission admin=2 | user=3
 * @property string $added_date
 * @property int $gender 2=male | 3=female
 * @property string $birthday
 * @property string $last_update
 *
 * @property Comments[] $comments
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 */
class UserDB extends \yii\db\ActiveRecord
{
    const ACTIVE_STATUS = 2;
    const INACTIVE_STATUS = 3;

    const STATUS = [
        self::ACTIVE_STATUS => 'Active',
        self::INACTIVE_STATUS => 'Inactive'
    ];

    const ADMIN_PERMISSION = 2;
    const USER_PERMISSION = 3;

    const PERMISSION = [
        self::ADMIN_PERMISSION => 'Admin',
        self::USER_PERMISSION => 'User'
    ];

    const MALE_GENDER = 2;
    const FEMALE_GENDER = 3;

    const GENDER = [
        self::MALE_GENDER => 'Male',
        self::FEMALE_GENDER => 'Female'
    ];

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $full_name;

    public function attributes()
    {
        // add full_name to the list of attributes
        return array_merge(parent::attributes(), ['full_name']);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['username', 'fisrt_name', 'last_name', 'email', 'password', 'photo', 'permission', 'gender', 'birthday'];
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'fisrt_name', 'last_name', 'email', 'permission', 'gender', 'birthday'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fisrt_name', 'last_name', 'username', 'email', 'permission', 'gender', 'birthday'], 'required'],
            [['fisrt_name', 'last_name', 'username', 'email', 'permission', 'gender', 'birthday'],'filter','filter'=>[HtmlPurifier::class, 'process']],
            [['status', 'permission', 'gender'], 'integer'],
            [['added_date', 'last_update', 'status', 'password'], 'safe'],
            [['fisrt_name', 'last_name', 'email', 'photo'], 'string', 'max' => 50],
            [['username'], 'string', 'max' => 35],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['password'], 'required', 'on' => [self::SCENARIO_CREATE]],
            [['password'], 'string', 'min' => 8,'max' => 60],
            [['birthday'], 'date', 'format' => 'php:Y-m-d'],
            [['photo'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
            [['added_date','last_update'], 'date', 'format' => 'php:Y-m-d H:i:s'],
            [['photo'], 'required', 'on' => [self::SCENARIO_CREATE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'fisrt_name' => Yii::t('user', 'First Name'),
            'last_name' => Yii::t('user', 'Last Name'),
            'full_name' => Yii::t('user', 'Name'),
            'username' => Yii::t('user', 'Username'),
            'email' => Yii::t('user', 'Email'),
            'status' => Yii::t('user', 'Status'),
            'password' => Yii::t('user', 'Password'),
            'photo' => Yii::t('user', 'Photo'),
            'permission' => Yii::t('user', 'Permission'),
            'added_date' => Yii::t('user', 'Added Date'),
            'gender' => Yii::t('user', 'Gender'),
            'birthday' => Yii::t('user', 'Birthday'),
            'last_update' => Yii::t('user', 'Last Update'),
        ];
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::class, ['added_by' => 'id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::class, ['added_by' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['added_by' => 'id']);
    }


    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Tasks::class, ['operator_id' => 'id']);
    }

    public function switchStatus()
    {
        $this->status = $this->status == UserDB::ACTIVE_STATUS ? UserDB::INACTIVE_STATUS : UserDB::ACTIVE_STATUS ;
        return $this->save();
    }
}
