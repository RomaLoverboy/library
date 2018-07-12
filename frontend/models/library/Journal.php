<?php

namespace frontend\models\library;

use Yii;
use frontend\models\library\Journal;
use frontend\models\library\Books;
use frontend\models\library\Users;
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
            'id_user' => 'Id User',
            'id_book' => 'Id Book',
            'dateBegin' => 'Date Begin',
            'dateEnd' => 'Date End',
			'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasMany(Books::className(), ['id' => 'id_book'])
		->viaTable('journal', ['id_user' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

	public function updateStatus($id_book, $istatus)
	{
		$status = Books::findOne($id_book);
		$status->status = $istatus;
		return $status->update();
			
	}
	
	public function idUser($id)
	{
		return Users::findOne($id);
	}
	
	public function FindPositionJournal($id_user, $id_book)
	{
		$id = $this->find()
        ->select(['id'])
		->where(['id_user' => $id_user])
		->andWhere(['id_book' => $id_book])
		->andWhere(['status' => 1])
        ->scalar();
	    
		return $this->findOne($id);
	}

	public function returnBook($id_book, $id)
	{		
	    $id_user = $this->idUser($id)->id;
		
		$id_journal = $this->FindPositionJournal($id_user, $id_book);
	    
		$return = $this->findOne($id_journal);
		$return->dateEnd = time();
		$return->status = 0;
		$this->updateStatus($id_book, 1);
		
		return $return->update();
	}
	
	public function takeBook($id_book, $id)
	{
			
		$this->id_user = $this->idUser($id)->id;
		$this->id_book = $id_book;
		$this->dateBegin = time();
		$this->dateEnd = 0000000000;

		$this->updateStatus($id_book, 0);
		return $this->save();
			
		}

	}
