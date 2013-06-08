<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>11)); ?>

		<?php echo $form->textFieldRow($model,'job_title',array('class'=>'span5','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'degree',array('class'=>'span5','maxlength'=>19)); ?>

        <?php echo $form->textFieldRow($model,'degree_name',array('class'=>'span5','maxlength'=>19)); ?>

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

		<?php echo $form->textFieldRow($model,'department',array('class'=>'span5','maxlength'=>11)); ?>

		<?php echo $form->textFieldRow($model,'created_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'updated_date',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'personal_email',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
