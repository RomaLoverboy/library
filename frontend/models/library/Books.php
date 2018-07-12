<?php

namespace frontend\models\library;

use Yii;
use frontend\models\library\Books;
/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property string $author
 * @property string $genre
 * @property int $year_publishing
 *
 * @property Journal[] $journals
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author'], 'required'],
            [['year_publishing', 'status'], 'integer'],
            [['name', 'author', 'genre'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author' => 'Author',
            'genre' => 'Genre',
            'year_publishing' => 'Year Publishing',
			'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Journal::className(), ['id_book' => 'id']);
    }
	
	public function showAllBooks()
	{
		
		$books = Books::find()
		->where(['status' => 1])
		->all();
		return $books;
	}
	
	
}
