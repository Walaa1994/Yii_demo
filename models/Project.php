<?php

namespace app\models;

use Yii;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $title
 * @property string $projetc_descrption
 * @property int $status 2=active | 3=inactive
 * @property int $added_by
 * @property string $added_date
 *
 * @property Tasks[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{
    const ACTIVE_STATUS = 2;
    const INACTIVE_STATUS = 3;

    const STATUS = [
        self::ACTIVE_STATUS => 'Active',
        self::INACTIVE_STATUS => 'Inactive'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'projetc_descrption'], 'required'],
            [['title','projetc_descrption'],'filter','filter'=>[HtmlPurifier::class, 'process']],
            [['status', 'added_by'], 'integer'],
            [['status', 'added_by', 'added_date'], 'safe'],
            [['title'], 'unique'],
            [['title'], 'string', 'max' => 150],
            [['projetc_descrption'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('project', 'ID'),
            'title' => Yii::t('project', 'Title'),
            'projetc_descrption' => Yii::t('project', 'Description'),
            'status' => Yii::t('project', 'Status'),
            'added_by' => Yii::t('project', 'Added By'),
            'added_date' => Yii::t('project', 'Added Date'),
        ];
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::class, ['project_id' => 'id']);
    }

    /**
     * Gets the user associated with the project.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserDB::class, ['id' => 'added_by']);
    }

    public function switchStatus()
    {
        $this->status = $this->status == Project::ACTIVE_STATUS ? Project::INACTIVE_STATUS : Project::ACTIVE_STATUS ;
        return $this->save();
    }
}
