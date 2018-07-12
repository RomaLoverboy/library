<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\helpers\HtmlPurifier;

?>

<?php

foreach($models as $var):?>

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
        
        [                                  
            'label' => 'Год публикации',
            'value' => $var->year_publishing,            
            'contentOptions' => ['class' => 'bg-red'],     
            'captionOptions' => ['tooltip' => 'Tooltip'],
        ],
                                       
    ],
]);


?>

<div class="form-group">
<?= Html::a('Взять книгу', ['id' => $var->id], ['name' => 'take', 'class'=>'btn btn-primary']) ?>
</div>

<?endforeach;?>