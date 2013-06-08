<?php

/**
 * This is the model class for table "contract".
 *
 * The followings are the available columns in table 'contract':
 * @property string $id
 * @property integer $contract_start_date
 * @property integer $contract_length
 * @property integer $contract_end_date
 * @property integer $contract_stop_date
 * @property string $contract_stop_reason
 * @property string $type
 * @property string $employee_id
 * @property string $crreated_id
 * @property string $updated_id
 * @property string $contract_status
 * @property integer $created_date
 * @property integer $updated_date
 *
 * The followings are the available model relations:
 * @property Employee $employee
 * @property Employee $crreated
 * @property Employee $updated
 * @property ContractSalary[] $contractSalaries
 */
class Contract extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Contract the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contract';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contract_start_date, contract_length, contract_end_date, type, employee_id, crreated_id', 'required'),
			array('contract_start_date, contract_length, contract_end_date, contract_stop_date, created_date, updated_date', 'numerical', 'integerOnly'=>true),
			array('contract_stop_reason', 'length', 'max'=>1000),
			array('type', 'length', 'max'=>23),
			array('employee_id, crreated_id, updated_id, contract_status', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contract_start_date, contract_length, contract_end_date, contract_stop_date, contract_stop_reason, type, employee_id, crreated_id, updated_id, contract_status, created_date, updated_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'employee' => array(self::BELONGS_TO, 'Employee', 'employee_id'),
			'crreated' => array(self::BELONGS_TO, 'Employee', 'crreated_id'),
			'updated' => array(self::BELONGS_TO, 'Employee', 'updated_id'),
			'contractSalaries' => array(self::HAS_MANY, 'ContractSalary', 'contract_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'contract_start_date' => 'Contract Start Date',
			'contract_length' => 'Contract Length',
			'contract_end_date' => 'Contract End Date',
			'contract_stop_date' => 'Contract Stop Date',
			'contract_stop_reason' => 'Contract Stop Reason',
			'type' => 'Type',
			'employee_id' => 'Employee',
			'crreated_id' => 'Crreated',
			'updated_id' => 'Updated',
			'contract_status' => 'Contract Status',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('contract_start_date',$this->contract_start_date);
		$criteria->compare('contract_length',$this->contract_length);
		$criteria->compare('contract_end_date',$this->contract_end_date);
		$criteria->compare('contract_stop_date',$this->contract_stop_date);
		$criteria->compare('contract_stop_reason',$this->contract_stop_reason,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('employee_id',$this->employee_id,true);
		$criteria->compare('crreated_id',$this->crreated_id,true);
		$criteria->compare('updated_id',$this->updated_id,true);
		$criteria->compare('contract_status',$this->contract_status,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('updated_date',$this->updated_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}