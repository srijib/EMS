<?php $this->widget('bootstrap.widgets.TbGridView',array(
  'id'=>'user-grid',
  'dataProvider'=>$model->search(),
  'filter'=>$model,
    'columns'=>array(
      array('name' => 'firstname',
            'header' => 'Full Name',
            'value' => '$data->getFistLastName()'
        ),
      array('name' => 'email',
            'header' => 'Email',
        ),
      array('name' => 'user_role',
            'header' => 'Role',
            'value' => '($data->getRoleName())?$data->getRoleName(): "-"',

      ),
      array('name' => 'dob',
            'header' => 'Birthday',
            'value'=> 'get_date($data->dob, null);',

        ),
      array('name' => 'created_date',
            'header' => 'Created Date',
            'value'=> 'get_date($data->created_date, null);',

        ),
  array(
  'class'=>'bootstrap.widgets.TbButtonColumn',
  ),
),
)); ?>
