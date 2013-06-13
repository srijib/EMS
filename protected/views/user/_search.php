<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
  'type'=>'horizontal',
	'method'=>'get',
)); ?>
  <div class="search_name">
    <div class="rowChild">
      <label for="fullname">Fullname</label>
    </div>
    <div class="rowChild">
      <?php  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model'=> $model,
        'attribute' => 'fullname',
        'source'=> User::model()->getFullNameActive(),
        // additional javascript options for the autocomplete plugin
        'options'=>array(
          'minLength'=>'2',
        ),
        'htmlOptions'=>array(
          'style'=>'height:20px;',
        ),
      ));
      ?>
    </div>
  </div>

  <div class="search_name">
    <div class="rowChild">
      <label for="fullname">Email</label>
    </div>
    <div class="rowChild">
      <?php  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model'=>$model,
        'attribute' => 'email',
        'source'=> User::model()->getEmailActive(),
        // additional javascript options for the autocomplete plugin
        'options'=>array(
          'minLength'=>'2',
        ),
        'htmlOptions'=>array(
          'style'=>'height:20px;',
        ),
      ));
      ?>
    </div>
  </div>
  <div class="search_name buttons">
    <div class="rowChild">
      <label> Created Date</label>
    </div>
    <div class="rowChild">
      <?php
      // Date range search inputs
      $attribute = 'created_date';
      for ($i = 0; $i <= 1; $i++)
      {
  echo ($i == 0 ? Yii::t('main', '') : Yii::t('main', 'To:'));
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
          'id'=>CHtml::activeId($model, $attribute.'_'.$i),
          'model'=>$model,
          'attribute'=>$attribute,
          'options'=>array(
            'showAnim'=>'fold',
            'dateFormat'=>'M-dd-yy',
            'changeYear'=>'true',
            'changeMonth'=>'true',
            'yearRange'=>'c-100:c+100'
          ),
          'htmlOptions'=>array('style'=>'width: 100px;'),
        ));
      }
      ?>
    </div>
  </div>

  <div class="search_name buttons">
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
