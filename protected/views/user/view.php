<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Create User','url'=>array('create')),
array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>
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

<h1>View User #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'firstname',
		'lastname',
		'fullname',
		'email',
		'dob',
		'password',
		'activkey',
		'status',
		'lastvisit',
		'created_date',
		'type',
		'updated_date',
),
)); ?>
