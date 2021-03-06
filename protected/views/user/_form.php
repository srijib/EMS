<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
  'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'firstname',array('class'=>'span3','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'lastname',array('class'=>'span3','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'fullname',array('class'=>'span3','maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span3','maxlength'=>255)); ?>

    <?php //echo $form->textFieldRow($employeemodel,'personal_email',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->dropDownListRow($model,'user_role', $roles,array('empty'=>"Please select role", 'class'=>'span3','maxlength'=>255)); ?>

    <?php if($model->isNewRecord):?>
    <?php echo $form->dropDownListRow($employeemodel,'department', $employeemodel->getDepartmentOption(),array('empty'=>"Please select Department", 'class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->dropDownListRow($employeemodel,'job_title', $employeemodel->getJobTitleOption(),array('empty'=>"Please select Job Title", 'class'=>'span3','maxlength'=>255)); ?>
    <?php else: ?>

    <?php echo $form->uneditableRow($employeemodel,'department',array('class'=>'span3','maxlength'=>255)); ?>

    <?php echo $form->uneditableRow($employeemodel,'job_title',array('class'=>'span3','maxlength'=>255)); ?>
    <?php endif?>
  <div class="group-control">
    <?php if($model->isNewRecord):?>
      <?php echo $form->labelEx($model,'dob', array('class'=> "control-label required")); ?>
    <div class="controls">
      <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'model'=>$model,
              'attribute'=>'dob',
              // additional javascript options for the date picker plugin
              'options'=>array(
                  'showAnim'=>'fold',
                  'dateFormat'=>'M-dd-yy',
                  'changeYear'=>'true',
                  'changeMonth'=>'true',
                  'yearRange'=>'c-100:c+100'
              ),
              'htmlOptions'=>array(
                  'style'=>'height:20px;',
                  'value' => '',
              ),
          ));
      ?>
      <?php echo $form->error($model,'dob'); ?>
    </div>
    <?php else: ?>
      <?php echo $form->labelEx($model,'dob', array('class'=> "control-label required")); ?>
    <div class="controls">
      <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
              'model'=>$model,
              'attribute'=>'dob',
              // additional javascript options for the date picker plugin
              'options'=>array(
                  'showAnim'=>'fold',
                  'dateFormat'=>'M-dd-yy',
                  'changeYear'=>'true',
                  'changeMonth'=>'true',
                  'yearRange'=>'c-100:c+100'
              ),
              'htmlOptions'=>array(
                  'style'=>'height:20px;',
                  'value' => date('M-d-Y',$model->dob),
              ),
          ));
          ?>
      <?php echo $form->error($model,'dob'); ?>
    </div>
    <?php endif; ?>
  </div>
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
