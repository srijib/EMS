<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'employee-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'job_title',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'degree',array('class'=>'span5','maxlength'=>19)); ?>

	<?php echo $form->textFieldRow($model,'background',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'telephone',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'mobile',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'homeaddress',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textAreaRow($model,'education',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'skill',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'experience',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'notes',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'avatar',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'cv',array('class'=>'span5','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'department_id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php echo $form->textFieldRow($model,'created_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'updated_date',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'personal_email',array('class'=>'span5','maxlength'=>255)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'primary',
    'label'=>$model->isNewRecord ? 'Create' : 'Save',
));

    if($model->isNewRecord){
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'reset',
            'htmlOptions'=>array('style'=>'margin-left: 10px;'),
            'label'=>'Reset',
        ));
    } else {
        $this->widget('bootstrap.widgets.TbButton', array(
            //'buttonType'=>'link',
            'label'=>'Cancel',
            'htmlOptions'=>array('style'=>'margin-left: 10px;'),
            'url'=>'../../User/Admin',
        ));
    }
    ?>
</div>

<?php $this->endWidget(); ?>
