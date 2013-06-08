<?php

/**
 * This is the model class for table "vacation".
 *
 * The followings are the available columns in table 'vacation':
 * @property string $id
 * @property integer $start_date
 * @property integer $end_date
 * @property string $total_date
 * @property integer $type
 * @property string $reason
 * @property string $user_id
 * @property string $approve_id
 * @property integer $created_date
 * @property integer $status
 * @property integer $updated_date
 *
 * The followings are the available model relations:
 * @property Employee $user
 * @property Employee $approve
 */
class Vacation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vacation the static model class
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
		return 'vacation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('start_date, end_date, total_date, type, reason, user_id', 'required'),
			array('start_date, end_date, type, created_date, status, updated_date', 'numerical', 'integerOnly'=>true),
			array('total_date', 'length', 'max'=>4),
			array('reason', 'length', 'max'=>2000),
			array('user_id, approve_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, start_date, end_date, total_date, type, reason, user_id, approve_id, created_date, status, updated_date', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Employee', 'user_id'),
			'approve' => array(self::BELONGS_TO, 'Employee', 'approve_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'total_date' => 'Total Date',
			'type' => 'Type',
			'reason' => 'Reason',
			'user_id' => 'User',
			'approve_id' => 'Approve',
			'created_date' => 'Created Date',
			'status' => 'Status',
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
		$criteria->compare('start_date',$this->start_date);
		$criteria->compare('end_date',$this->end_date);
		$criteria->compare('total_date',$this->total_date,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('approve_id',$this->approve_id,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('status',$this->status);
		$criteria->compare('updated_date',$this->updated_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}