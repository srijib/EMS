<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Create User','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('user-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Manage Users</h1>

<p>
	You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
		&lt;&gt;</b>
	or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button btn'));
$this->widget('bootstrap.widgets.TbButton',array(
    'label' => 'Advanced Search',
    'htmlOptions'=>array('Class'=>'search-button btn'),
    'size' => 'large'
));
$this->widget('bootstrap.widgets.TbButton', array(
    //'buttonType'=>'link',
    'label'=>'Create User',
    'htmlOptions'=>array('Class'=>'btn', 'style'=>'float: right;'),
    'url'=>'../../User/Create',
));
?>

<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<p>
  <?php
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'×', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
            'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
            'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'),
        ),
    ));

    if(app()->user->hasFlash('error')){
        echo app()->user->getFlash('error');
    } elseif(app()->user->hasFlash('warning')){
        echo app()->user->getFlash('warning');
    } elseif(app()->user->hasFlash('info')){
        echo app()->user->getFlash('info');
    } elseif(app()->user->hasFlash('success')){
        echo app()->user->getFlash('success');
    }
  ?>
</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'user-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
            //'firstname',
            //'lastname',
            'fullname',
            'email',
            array('name' => 'user_role',
                'value' => '($data->getRoleName())?$data->getRoleName(): "-"',
                'filter' => false,
                'htmlOptions'=>array('align'=>'center'),

            ),
            'dob',
            /*
            'password',
            'activkey',
            'status',
            'lastvisit',
            'created_date',
            'type',
            'updated_date',
            */
    array(
    'class'=>'bootstrap.widgets.TbButtonColumn',
    ),
    ),
)); ?>
