<?php

/**
 * This is the model class for table "contract_salary".
 *
 * The followings are the available columns in table 'contract_salary':
 * @property string $id
 * @property integer $contract_start_date
 * @property integer $contract_end_date
 * @property string $contract_id
 * @property string $gross_salary
 * @property string $net_salary
 * @property string $petrol_allowance
 * @property string $lunch_allowance
 * @property string $other_allowance
 *
 * The followings are the available model relations:
 * @property Contract $contract
 */
class ContractSalary extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ContractSalary the static model class
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
		return 'contract_salary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contract_id, gross_salary, net_salary', 'required'),
			array('contract_start_date, contract_end_date', 'numerical', 'integerOnly'=>true),
			array('contract_id', 'length', 'max'=>11),
			array('gross_salary, net_salary, petrol_allowance, lunch_allowance, other_allowance', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, contract_start_date, contract_end_date, contract_id, gross_salary, net_salary, petrol_allowance, lunch_allowance, other_allowance', 'safe', 'on'=>'search'),
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
			'contract' => array(self::BELONGS_TO, 'Contract', 'contract_id'),
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
			'contract_end_date' => 'Contract End Date',
			'contract_id' => 'Contract',
			'gross_salary' => 'Gross Salary',
			'net_salary' => 'Net Salary',
			'petrol_allowance' => 'Petrol Allowance',
			'lunch_allowance' => 'Lunch Allowance',
			'other_allowance' => 'Other Allowance',
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
		$criteria->compare('contract_end_date',$this->contract_end_date);
		$criteria->compare('contract_id',$this->contract_id,true);
		$criteria->compare('gross_salary',$this->gross_salary,true);
		$criteria->compare('net_salary',$this->net_salary,true);
		$criteria->compare('petrol_allowance',$this->petrol_allowance,true);
		$criteria->compare('lunch_allowance',$this->lunch_allowance,true);
		$criteria->compare('other_allowance',$this->other_allowance,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}