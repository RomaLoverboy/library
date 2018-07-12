<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\models\Journal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\JournalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Journals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Journal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.surname',
            'book.name',
            //'status',
			
			[
			
			'attribute' => 'dateBegin',
			'format' =>  ['date', 'HH:mm dd.MM.Y'],
			'options' => ['width' => '200'],
			/* 'value'     => function () {
                
                if ($model->dateBegin == "3:0 01.01.1970") {
                    return ''; 
              //or: return Html::encode($model->some_attribute)
                } else {
					return $model->dateBegin;
				}
			} */
			],
			
			[
			'attribute' => 'dateEnd',
			'format' =>  ['date', 'HH:mm dd.MM.Y'],
			'options' => ['width' => '200'],
/* 
            'value'     => function ($date) {
                //03:00 01.01.1970
                if (date("H:i d.m.Y", $model->dateEnd) === NULL) {
                    return '';
                }
			} */
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
