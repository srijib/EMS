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
<?php $this->widget('bootstrap.widgets.TbTabs', array(
    'id' => 'mytabs',
    'type' => 'tabs',
    'tabs' => array(
      array('id' => 'tab1', 'label' => 'Active', 'content' => $this->renderPartial('list', array('model' => $model), true), 'active' => true),
      array('id' => 'tab2', 'label' => 'Non Active', 'content' => 'loading ....'),
      array('id' => 'tab3', 'label' => 'Band', 'content' => 'loading ....'),
    ),
    'events'=>array('shown'=>'js:loadContent')
  )
);?>

