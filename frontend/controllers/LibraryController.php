<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\library\Users;
use frontend\models\library\Books;
use frontend\models\library\Journal;
use yii\data\ActiveDataProvider;

class LibraryController extends Controller
{
	
	public function behaviors()
    {
        return [
		    'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'my-books', 'show-books', 'find-book'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
			
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
					'roles' => ['@'],
                ],
				
            ],
			
        ];
    }
	
	public function actionIndex()
	{
	
        return $this->render('index');
	
	}
	
	public function actionMyBooks()
	{
		$journal = Yii::createObject(Journal::className());
		
		$id_user = Yii::$app->user->getId();
		
		$id = $journal->idUser($id_user)->id;
		
		$mybooks = Users::findOne($id);
		
		$id_book = Yii::$app->request->get('id');
		
		if($id_book !== NULL){
			
			$journal->returnBook($id_book, $id);
			$this->redirect('/library/show-books');
		}
		
		//Yii::$app->response->format=\yii\web\response::FORMAT_JSON;
		return $this->render('mybooks', ['mybooks' => $mybooks]);
		
	}
	public function actionShowBooks()
	{
	    
		$models = new Books();
		$journal = new Journal();
		
		$id_book = Yii::$app->request->get('id');
		
		$id = Yii::$app->user->getId();
		
		$models = $models->showAllBooks();
		
		if(Yii::$app->request->get('id') !== NULL){
			
			$journal->takeBook($id_book, $id);
			$this->redirect('/library/show-books');
		}
		return $this->render('show', ['models' => $models]);
	}
	

}















?>