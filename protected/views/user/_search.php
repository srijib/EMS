<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php //echo $form->textFieldRow($model,'id',array('class'=>'span3','maxlength'=>11)); ?>

		<?php //echo $form->textFieldRow($model,'firstname',array('class'=>'span3','maxlength'=>255)); ?>

		<?php //echo $form->textFieldRow($model,'lastname',array('class'=>'span3','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'fullname',array('class'=>'span3','maxlength'=>255)); ?>

		<?php echo $form->textFieldRow($model,'email',array('class'=>'span3','maxlength'=>255)); ?>


		<?php //echo $form->textFieldRow($model,'dob',array('class'=>'span5')); ?>
        <?php echo $form->labelEx($model,'dob'); ?>
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

		<?php //echo $form->textFieldRow($model,'activkey',array('class'=>'span5','maxlength'=>500)); ?>

		<?php echo $form->textFieldRow($model,'status',array('class'=>'span3','maxlength'=>1)); ?>

		<?php //echo $form->textFieldRow($model,'lastvisit',array('class'=>'span3')); ?>

		<?php //echo $form->textFieldRow($model,'created_date',array('class'=>'span3')); ?>
        <?php echo $form->labelEx($model,'created_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model'=>$model,
            'attribute'=>'created_date',
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

        <?php //echo $form->textFieldRow($model,'type',array('class'=>'span3','maxlength'=>11)); ?>

		<?php //echo $form->textFieldRow($model,'updated_date',array('class'=>'span3')); ?>
        <?php echo $form->labelEx($model,'updated_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'model'=>$model,
            'attribute'=>'updated_date',
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

	<div class="form-actions">
		<?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type'=>'primary',
                'label'=>'Search',
            ));
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'reset',
                'label'=>'Reset',
                'htmlOptions'=>array('style'=>'margin-left: 10px;'),
            ));
        ?>
	</div>

<?php $this->endWidget(); ?>
