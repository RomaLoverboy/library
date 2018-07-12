<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\models\library\Users;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $surname;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => '\frontend\models\library\Users', 'message' => 'This username has already been taken.'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['surname', 'trim'],
            ['surname', 'required'],
            ['surname', 'string', 'max' => 255],
            ['surname', 'unique', 'targetClass' => '\frontend\models\library\Users', 'message' => 'This email address has already been taken.'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Users();
        $user->name = $this->name;
        $user->surname = $this->surname;
        $user->ip_adress = '213122';
        $user->auth_key = 0;
        
        return $user->save() ? $user : null;
    }
}
