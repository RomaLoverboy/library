<?php

namespace backend\models;

use Yii;
use backend\models\Books;
use backend\models\Users;
/**
 * This is the model class for table "journal".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_book
 * @property int $dateBegin
 * @property int $dateEnd
 *
 * @property Books $book
 * @property Users $user
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_book', 'dateBegin', 'dateEnd'], 'required'],
            [['id_user', 'id_book', 'dateBegin', 'dateEnd', 'status'], 'integer'],
            [['id_book'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['id_book' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Пользователь',
            'id_book' => 'Книга',
            'dateBegin' => 'Отдал книгу',
            'dateEnd' => 'Вернул книгу',
			'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'id_book']);
    }
    
	public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

    
	
    /**
     * @return \yii\db\ActiveQuery
     */
	
}