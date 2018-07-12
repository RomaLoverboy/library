<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\helpers\HtmlPurifier;

?>

<?php

foreach($mybooks->journals as $var):?>

<?php

echo DetailView::widget([
    'model' => $var,
    'attributes' => [                                
        [                                  
            'label' => 'Название',
            'value' => $var->name,            
            'contentOptions' => ['class' => 'bg-red'],     
            'captionOptions' => ['tooltip' => 'Tooltip'],
        ],
		
		[                                  
            'label' => 'Автор',
            'value' => $var->author,            
            'contentOptions' => ['class' => 'bg-red'],     
            'captionOptions' => ['tooltip' => 'Tooltip'],
        ],
		
		[                                  
            'label' => 'Жанр',
            'value' => $var->genre,            
            'contentOptions' => ['class' => 'bg-red'],     
            'captionOptions' => ['tooltip' => 'Tooltip'],
        ],
                                       
    ],
]);


?>

<?= Html::a('Вернуть книгу', ['id' => $var->id], ['name' => 'take', 'class'=>'btn btn-primary']) ?>
<br/>
<br/>
<?endforeach;?>
