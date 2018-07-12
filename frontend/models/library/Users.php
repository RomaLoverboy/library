<?php

namespace frontend\models\library;

use Yii;
use frontend\models\library\Users;
use frontend\models\library\Journal;
use frontend\models\library\Books;
/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property int $ip_adress
 *
 * @property Journal[] $journals
 */
class Users extends \yii\db\ActiveRecord
{
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
            [['name', 'surname'], 'required'],
            [['ip_adress', 'auth_key'], 'integer'],
            [['name', 'surname'], 'string', 'max' => 255],
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
            'surname' => 'Surname',
            'ip_adress' => 'Ip Adress',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJournals()
    {
        return $this->hasMany(Books::className(), ['id' => 'id_book'])
		->viaTable('journal', ['id_user' => 'id'],
		function ($query) {
                    $query->andWhere(['status' => 1]);
		});
		
    }
	
	public function getUsername($ip)
	{
		$Username = Users::find()
		->where(['ip_adress' => $ip])
		->all();
		
		return $Username;

	}
	
	
}
