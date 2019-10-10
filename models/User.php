<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $personal_code
 * @property int $phone
 * @property bool $active
 * @property bool $dead
 * @property string $lang
 * @property Loan[] $loans
 */
class User extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'personal_code', 'phone'], 'required'],
            [['first_name', 'last_name', 'lang'], 'string'],
            [['email'], 'email'],
            [['personal_code', 'phone'], 'default', 'value' => null],
            [['personal_code', 'phone'], 'integer'],
            [['personal_code'], 'validatePersonalCode'],
            [['active', 'dead'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'personal_code' => 'Personal Code',
            'phone' => 'Phone',
            'active' => 'Active',
            'dead' => 'Dead',
            'lang' => 'Lang',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getLoans()
    {
        return $this->hasMany(Loan::class, ['user_id' => 'id'])->inverseOf('user');
    }

    /**
     * @return false|int|void
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @todo Soft Delete would be better
     */
    public function delete()
    {
        foreach ($this->loans as $loan) {
            $loan->delete();
        }

        return parent::delete();
    }

    /**
     * @inheritdoc
     */
    public function validatePersonalCode($attribute, $params)
    {
        try {
            \Yii::$app->personalCodeParser->parseBirthDate($this->$attribute);
        } catch (\Throwable $throwable) {
            $this->addError($attribute, $throwable->getMessage());
        }
    }
}
