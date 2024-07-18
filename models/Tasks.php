<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string|null $task_register_date
 * @property string $task_title
 * @property string $task_details
 * @property string $task_budget
 * @property string $task_limit_date
 * @property string|null $task_files
 * @property int $task_status_id
 * @property int|null $task_category_id
 * @property int|null $task_user_id
 * @property int|null $task_locale_id
 *
 * @property Categories $taskCategory
 * @property Cities $taskLocale
 * @property Statuses $taskStatus
 * @property Users $taskUser
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_register_date', 'task_limit_date'], 'safe'],
            [['task_title', 'task_details', 'task_budget', 'task_limit_date'], 'required'],
            [['task_status_id', 'task_category_id', 'task_user_id', 'task_locale_id'], 'integer'],
            [['task_title', 'task_budget'], 'string', 'max' => 128],
            [['task_details', 'task_files'], 'string', 'max' => 256],
            [['task_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['task_user_id' => 'id']],
            [['task_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::class, 'targetAttribute' => ['task_category_id' => 'id']],
            [['task_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::class, 'targetAttribute' => ['task_status_id' => 'id']],
            [['task_locale_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['task_locale_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_register_date' => 'Task Register Date',
            'task_title' => 'Task Title',
            'task_details' => 'Task Details',
            'task_budget' => 'Task Budget',
            'task_limit_date' => 'Task Limit Date',
            'task_files' => 'Task Files',
            'task_status_id' => 'Task Status ID',
            'task_category_id' => 'Task Category ID',
            'task_user_id' => 'Task User ID',
            'task_locale_id' => 'Task Locale ID',
        ];
    }

    /**
     * Gets query for [[TaskCategory]].
     *
     * @return \yii\db\ActiveQuery|CategoriesQuery
     */
    public function getTaskCategory()
    {
        return $this->hasOne(Categories::class, ['id' => 'task_category_id']);
    }

    /**
     * Gets query for [[TaskLocale]].
     *
     * @return \yii\db\ActiveQuery|CitiesQuery
     */
    public function getTaskLocale()
    {
        return $this->hasOne(Cities::class, ['id' => 'task_locale_id']);
    }

    /**
     * Gets query for [[TaskStatus]].
     *
     * @return \yii\db\ActiveQuery|StatusesQuery
     */
    public function getTaskStatus()
    {
        return $this->hasOne(Statuses::class, ['id' => 'task_status_id']);
    }

    /**
     * Gets query for [[TaskUser]].
     *
     * @return \yii\db\ActiveQuery|UsersQuery
     */
    public function getTaskUser()
    {
        return $this->hasOne(Users::class, ['id' => 'task_user_id']);
    }

    /**
     * {@inheritdoc}
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksQuery(get_called_class());
    }
}
