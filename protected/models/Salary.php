<?php

/**
 * This is the model class for table "salary".
 *
 * The followings are the available columns in table 'salary':
 * @property string $id
 * @property string $employee_id
 * @property string $net_salary
 * @property string $gross_salary
 * @property string $month
 * @property string $year
 * @property string $petrol_allowance
 * @property string $lunch_allowance
 * @property string $other_allowance
 * @property string $price
 *
 * The followings are the available model relations:
 * @property Employee $employee
 */
class Salary extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Salary the static model class
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
		return 'salary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee_id, month, year', 'length', 'max'=>11),
			array('net_salary, gross_salary, petrol_allowance, lunch_allowance, other_allowance, price', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, employee_id, net_salary, gross_salary, month, year, petrol_allowance, lunch_allowance, other_allowance, price', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'employee_id' => 'Employee',
			'net_salary' => 'Net Salary',
			'gross_salary' => 'Gross Salary',
			'month' => 'Month',
			'year' => 'Year',
			'petrol_allowance' => 'Petrol Allowance',
			'lunch_allowance' => 'Lunch Allowance',
			'other_allowance' => 'Other Allowance',
			'price' => 'Price',
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
		$criteria->compare('employee_id',$this->employee_id,true);
		$criteria->compare('net_salary',$this->net_salary,true);
		$criteria->compare('gross_salary',$this->gross_salary,true);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('petrol_allowance',$this->petrol_allowance,true);
		$criteria->compare('lunch_allowance',$this->lunch_allowance,true);
		$criteria->compare('other_allowance',$this->other_allowance,true);
		$criteria->compare('price',$this->price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}