<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>11)); ?>

		<?php echo $form->textFieldRow($model,'firstname',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'lastname',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'fullname',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'dob',array('class'=>'span5')); ?>

			<?php echo $form->textFieldRow($model,'activkey',array('class'=>'span5','maxlength'=>500)); ?>

		<?php echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>1)); ?>

		<?php echo $form->textFieldRow($model,'lastvisit',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'created_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>11)); ?>

		<?php echo $form->textFieldRow($model,'updated_date',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
