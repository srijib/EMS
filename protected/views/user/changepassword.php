<?php
/* @var $this UserChangePasswordController */
/* @var $model UserChangePassword */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

    <?php echo $form->passwordFieldRow($model,'oldPassword',array('class'=>'span3')); ?>

    <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span3','maxlength'=>128)); ?>

    <?php echo $form->passwordFieldRow($model,'verifyPassword',array('class'=>'span3','maxlength'=>128)); ?>


	<div class="form-actions">
		<?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Submit',
        ));

        $this->widget('bootstrap.widgets.TbButton', array(
            //'buttonType'=>'reset',
            'label'=>'Cancel',
            'htmlOptions'=>array('style'=>'margin-left: 10px;'),
            'url'=>'../../Site/Index',
        ));
        ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->