<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>
<div class = "create_user">
  <h1>Create User</h1>
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
  <?php echo $this->renderPartial(
      '_form', array(
          'model'=>$model,
          'employeemodel'=>$employeemodel,
          'roles'=>$roles,
      ));
  ?>
</div>