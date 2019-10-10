<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "loan".
 *
 * @property int $id
 * @property int $user_id
 * @property User $user
 * @property string $amount
 * @property string $interest
 * @property int $duration
 * @property string $start_date
 * @property string $end_date
 * @property int $campaign
 * @property bool $status
 */
class Loan extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'interest', 'duration', 'start_date', 'end_date', 'campaign'], 'required'],
            [['user_id', 'duration', 'campaign'], 'default', 'value' => null],
            [['user_id', 'duration', 'campaign'], 'integer'],
            [['amount', 'interest'], 'number'],
            [['start_date', 'end_date'], 'safe'],
            [['status'], 'boolean'],
            [['user_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],
            [['user_id'], 'validateAge'],
            [['start_date', 'end_date'], 'match', 'pattern' => '#^\d{4}[-/ ]\d{2}[-/ ]\d{2}(\s+\d{2}:\d{2}:\d{2})?$#'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'amount' => 'Amount',
            'interest' => 'Interest',
            'duration' => 'Duration',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'campaign' => 'Campaign',
            'status' => 'Status',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function validateAge($attribute, $params)
    {
        if (\Yii::$app->personalCodeParser->checkIsUnderage($this->user->personal_code)) {
            $this->addError($attribute, 'Sorry, Loans are not available to underage users!');
        }
    }
}
