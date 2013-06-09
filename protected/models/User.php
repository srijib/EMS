<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property string $id
 * @property string $firstname
 * @property string $lastname
 * @property string $fullname
 * @property string $email
 * @property integer $dob
 * @property string $password
 * @property string $activkey
 * @property string $status
 * @property integer $lastvisit
 * @property integer $created_date
 * @property string $type
 * @property integer $updated_date
 *
 * The followings are the available model relations:
 * @property ActivityLog[] $activityLogs
 * @property ActivityLog[] $activityLogs1
 * @property Authitem[] $authitems
 * @property Employee $employee
 */
class User extends CActiveRecord
{
    const NOACTIVE = 0;
    const ACTIVE = 1;
    const BANNED = 2;

    const ADMIN = 'admin';
    const MANAGER = 'manager';
    const LEADER = 'leader';
    const ACCOUNTANT = 'accountant';
    const HR = 'hr';
    const USER = 'user';

    public $user_role;
    public $working_age;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, fullname,user_role, email, dob', 'required', 'on'=>'create, edit'),
            array('password, activkey, status, created_date', 'required', 'on'=>'create'),
            array('status, updated_date', 'required', 'on'=>'edit'),
            array('email','unique', 'message' => '{attribute}:{value} already exists, please choose a different one.', 'on' => 'create, edit'),
			array('dob, lastvisit, created_date, updated_date', 'numerical', 'integerOnly'=>true),
            array('firstname, lastname', 'length', 'max'=>50),
			array('fullname, email', 'length', 'max'=>255),
            array('email','email','message' => '{attribute}: is not a valid email address.','on'=>'create, edit'),
			array('password, activkey', 'length', 'max'=>500),
            array('firstname,lastname,fullname', 'match', 'pattern' => '/^[a-zA-Z0-9 - . \' ,]/', 'message' => 'Please don\'t put invalid value', 'on' => 'create, edit'),
			array('status', 'length', 'max'=>1),
			array('type', 'length', 'max'=>1),
            array('dob','compare','compareAttribute'=>'working_age','operator'=>'<=',
                'allowEmpty'=>false , 'message'=>'Your birthday is incorrect or you are not in working age allowed','on'=>'create,edit'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, firstname, lastname, fullname, email, dob, password, activkey, status, lastvisit, user_role, created_date, type, updated_date', 'safe', 'on'=>'search'),
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
			'activityLogs' => array(self::HAS_MANY, 'ActivityLog', 'user_id'),
			'activityLogs1' => array(self::HAS_MANY, 'ActivityLog', 'action_id'),
            'role' => array(self::HAS_MANY, 'Authassignment', 'userid', 'together' => true),
			'employee' => array(self::HAS_ONE, 'Employee', 'id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'fullname' => 'Fullname',
			'email' => 'Working Email',
			'dob' => 'Date of Birth',
			'password' => 'Password',
			'activkey' => 'Activkey',
			'status' => 'Status',
			'lastvisit' => 'Lastvisit',
			'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
			'type' => 'Type',
            'user_role' => 'Roles',
		);
	}

    /*
     * When create a new user
     * auto set value for updated date  based on created date
     */
    public function behaviors(){
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_date',
                'updateAttribute' => 'updated_date',
                'setUpdateOnCreate' => true,
            )
        );
    }

    /*
     *   Validate wroking age
     */
    public function beforeValidate()
    {
        $c_year = date("Y")-18;
        $c_age = date("m")."-".date("d")."-".$c_year;
        $this->working_age = CDateTimeParser::parse($c_age,'MM-dd-yyyy');
        //print_r($this->working_age); exit;
        return parent::beforeValidate();
    }

    /**
     * perform one-way encryption on the password before we store it in the database
     */
    protected function afterValidate() {
        parent::afterValidate();
        if (in_array($this->getScenario(), array('create'))) {
            $this->password = encrypt($this->password);

        }
    }

    /*
     *  Auto General Password
     */
    public function autoGeneralPass() {
        $length = 10;
        $chars = array_merge(range(0,9), range('a','z'), range('A','Z'));
        shuffle($chars);
        $password = implode(array_slice($chars, 0, $length));
        return $password;
    }

    /**
     * Sends a message in an extremly simple but less extensive way.
     *
     * @param mixed from address, string or array of the form $address => $name
     * @param mixed to address, string or array of the form $address => $name
     * @param string subject
     * @param string body
     *
    public function sendWelcomeEmail($from, $to, $subject='Welcome Email', $body) {
        Yii::import('ext.yii-mail.YiiMailMessage');
        $message = new YiiMailMessage;
        $message->setSubject($subject);
        $message->setFrom($from);
        $message->setTo($to);
        $message->setBody($body, 'text/html');
        app()->mail->send($message);
    }*/

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria(array(
            'with'=>array('role'),
            'condition' => 't.type=0 AND t.status=1'
        ));
        //$criteria->addCondition(array('t.status'=>1));

		//$criteria->compare('id',$this->id,true);
		//$criteria->compare('firstname',$this->firstname,true);
		//$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('dob',$this->dob);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_date',$this->created_date);
		//$criteria->compare('updated_date',$this->updated_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /*
     * Get Employee Department
     * return [Employee Department]
     */
    public function getEmployeeDepartment($id) {
        $employee = Employee::model()->findByPk($id);
        return $employee['department'];
    }

    /*
     *  Get User Fist Name
     *  return [FistName]
     */
    public function getFistName() {
        return $this->firstname;
    }

    /*
     *  Get User Last Name
     *  return [LastName]
     */
    public function getLastName() {
        return $this->lastname;
    }

    /*
     *  Get User Full Name
     *  return [FullName]
     */
    public function getFullName() {
        return $this->fullname;
    }

    /*
     *  Get User Fist Last Name
     *  return [FistName LastName]
     */
    public function getFistLastName() {
        return "$this->firstname $this->lastname";
    }

    /*
     * Get User Type
     * return [user type]
     */
    public function getUserType() {
        return $this->type;
    }

    /**
     * get roles options
     * return List roles
     */
    public function getRoleOptions() {
        return array(
            self::ADMIN => 'Administrator',
            self::MANAGER => 'Manager',
            self::LEADER => 'Leader',
            self::ACCOUNTANT => 'Accountant',
            self::HR => 'Human Resource',
            self::USER => 'User',
        );
    }

    /*
     * get role name by role value
     */

    public function getRoleText($roleValue) {
        $roleOptions = $this->getRoleOptions();
        return isset($roleOptions[$roleValue]) ? $roleOptions[$roleValue] : "unknown role ({$roleValue})";
    }

    /*
     * get role of user
     */

    public function getRoleName() {
        foreach ($this->role as $r) {
            return $this->getRoleText($r->itemname);
        }
        return "";
    }

    /*
     * get role of user when edit user
     *
     */

    public function getRoleValue() {
        foreach ($this->role as $r) {
            return $r->itemname;
        }
        return "";
    }

    /*
     * get role of user when user login
     * return user[itemname]
     */

    public function getRoleOfUser($id) {
        $role = Authassignment::model()->find(array(
            'select' => 'itemname, userid',
            'condition' => 'userid =:userId',
            'params' => array(':userId' => $id),
        ));
        return $role->itemname;
    }

    /*
     *  get role of The specific user  (based on user_id)
     * return user[itemname]
     */
    public function getUserRole($id) {
        $role = Authassignment::model()->find(array(
            'select' => 'itemname, userid',
            'condition' => 'userid =:userId',
            'params' => array(':userId' => $id),
        ));
        return $role->itemname;
    }

    /*
     * Set User's Date of Birth
     */
    public function setUserDob($dob){
        $bd = CDateTimeParser::parse($dob, 'MMM-dd-yyyy');
        return $this->dob=$bd;
    }

    public function getUserDob () {
        return date("M-d-Y",$this->dob);
    }
}