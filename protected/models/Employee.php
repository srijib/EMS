<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property string $id
 * @property string $job_title
 * @property string $degree
 * @property string $background
 * @property string $telephone
 * @property string $mobile
 * @property string $homeaddress
 * @property string $education
 * @property string $skill
 * @property string $experience
 * @property string $notes
 * @property string $personal_email
 * @property string $avatar
 * @property string $cv
 * @property string $department_id
 * @property integer $created_date
 * @property integer $updated_date
 *
 * The followings are the available model relations:
 * @property Contract[] $contracts
 * @property Contract[] $contracts1
 * @property Contract[] $contracts2
 * @property User $id0
 * @property Department $department
 * @property EmployeeVacation[] $employeeVacations
 * @property Message[] $messages
 * @property Message[] $messages1
 * @property Salary[] $salaries
 * @property Vacation[] $vacations
 * @property Vacation[] $vacations1
 */
class Employee extends CActiveRecord
{
    const ADMIN = 'Admin';
    const MANAGEMENT = 'Management';
    const SOFTWARE = 'Software';
    const HR = 'HR';

    const ASSOCIATES = 'Associates';
    const DIPLOMA = 'Diploma/Certificate';
    const BACHELORS = 'Bachelors';
    const MASTER = 'Masters';
    const DOCTORATE = 'Doctorate';
    const NA     = 'N/A';

    const HR_Executive = 'HR Executive';
    const Jr_Developer = 'Jr Developer';
    const Developer_I = 'Developer I';
    const Developer_II = 'Developer II';
    const Developer_III = 'Developer III';
    const Senior_Developer = 'Senior Developer';
    const Jr_Tester = 'Jr Tester';
    const Test_Engineer_I = 'Test Engineer I';
    const Test_Engineer_II = 'Test Engineer II';
    const Test_Engineer_III = 'Test Engineer III';
    const Senior_Test_Engineer = 'Senior Test Engineer';
    const Business_Analyst = 'Business Analyst';
    const Jr_Designer = 'Jr Designer';
    const Designer = 'Designer';
    const Senior_Designer = 'Senior Designer';
    const Artist_2D = '2D Artist';
    const Artist_3D = '3D Artist';
    const Admin_staff = 'Admin Staff';
    const Receptionist = 'Receptionist';
    const Account_Manager = 'Account Manager';
    const Chief_Accountant = 'Chief Accountant';
    const Project_Manager = 'Project Manager';
    const Operation_Manager = 'Operation Manager';
    const Managing_Director = 'Managing Director';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Employee the static model class
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
		return 'employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, job_title, department', 'required','on'=>'create, edit'),
			array('created_date, updated_date', 'numerical', 'integerOnly'=>true),
			array('id, telephone, mobile', 'length', 'max'=>11),
			array('degree, degree_name, job_title, background, homeaddress, avatar, cv, personal_email, department', 'length', 'max'=>255),
			array('education, skill, experience, notes', 'safe'),
            array('personal_email','email','message' => '{attribute}: is not a valid email address.','on'=>'create, edit'),
            array('personal_email','unique', 'message' => '{attribute}:{value} already exists, please choose a different one.', 'on' => 'create, edit'),
            array('avatar', 'file', 'types'=>'jpg, gif, png', 'maxSize'=>1024*500, 'tooLarge'=>'The file was larger than 500KB. Please upload a smaller file.', 'allowEmpty'=>true),
            array('cv', 'file', 'types'=>'doc, pdf, docx', 'maxSize'=>1024*1024*2, 'tooLarge'=>'The file was larger than 2MB. Please upload a smaller file.', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, job_title, degree, degree_name, background, telephone, mobile, homeaddress, education, skill, experience, notes, avatar, cv, department, created_date, updated_date', 'safe', 'on'=>'search'),
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
			'contracts' => array(self::HAS_MANY, 'Contract', 'employee_id'),
			'contracts1' => array(self::HAS_MANY, 'Contract', 'crreated_id'),
			'contracts2' => array(self::HAS_MANY, 'Contract', 'updated_id'),
			'id0' => array(self::BELONGS_TO, 'User', 'id'),
			'employeeVacations' => array(self::HAS_MANY, 'EmployeeVacation', 'employee_id'),
			'messages' => array(self::HAS_MANY, 'Message', 'mod_user_id'),
			'messages1' => array(self::HAS_MANY, 'Message', 'mod_sender_id'),
			'salaries' => array(self::HAS_MANY, 'Salary', 'employee_id'),
			'vacations' => array(self::HAS_MANY, 'Vacation', 'user_id'),
			'vacations1' => array(self::HAS_MANY, 'Vacation', 'approve_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'personal_email' => 'Personal Email',
			'job_title' => 'Job Title',
			'degree' => 'Degree',
            'degree_name' => 'Degree Name',
			'background' => 'Background',
			'telephone' => 'Telephone',
			'mobile' => 'Mobile',
			'homeaddress' => 'Homeaddress',
			'education' => 'Education',
			'skill' => 'Skill',
			'experience' => 'Experience',
			'notes' => 'Notes',
			'avatar' => 'Avatar',
			'cv' => 'Cv',
			'department' => 'Department Name',
			'created_date' => 'Created Date',
			'updated_date' => 'Updated Date',
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
		$criteria->compare('job_title',$this->job_title,true);
		$criteria->compare('degree',$this->degree,true);
        $criteria->compare('degree',$this->degree_name,true);
		$criteria->compare('background',$this->background,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('homeaddress',$this->homeaddress,true);
		$criteria->compare('education',$this->education,true);
		$criteria->compare('skill',$this->skill,true);
		$criteria->compare('experience',$this->experience,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('cv',$this->cv,true);
		$criteria->compare('department_id',$this->department,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('updated_date',$this->updated_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * get Job title options
     * return List Job title
     */
    public function getJobTitleOption() {
        return array(
            self::HR_Executive => 'HR Executive',
            self::Jr_Developer => 'Jr Developer',
            self::Developer_I => 'Developer I',
            self::Developer_II => 'Developer II',
            self::Developer_III => 'Developer III',
            self::Senior_Developer => 'Senior Developer',
            self::Jr_Tester => 'Jr Tester',
            self::Test_Engineer_I => 'Test Engineer I',
            self::Test_Engineer_II => 'Test Engineer II',
            self::Test_Engineer_III => 'Test Engineer III',
            self::Senior_Test_Engineer => 'Senior Test Engineer',
            self::Business_Analyst => 'Business Analyst',
            self::Jr_Designer => 'Jr Designer',
            self::Designer => 'Designer',
            self::Senior_Designer => 'Senior Designer',
            self::Artist_2D => '2D Artist',
            self::Artist_3D => '3D Artist',
            self::Admin_staff => 'Admin Staff',
            self::Receptionist => 'Receptionist',
            self::Account_Manager => 'Account Manager',
            self::Chief_Accountant => 'Chief Accountant ',
            self::Project_Manager => 'Project Manager',
            self::Operation_Manager => 'Operation Manager',
            self::Managing_Director => 'Managing Director',
        );
    }

    public function getJobTitleName($title) {
        $jobTitle = $this->getJobTitleOption();
        return isset($jobTitle[$title]) ?  $jobTitle[$title] : "unknown job title ({$title})";
    }

    public function setJobTitle($job_title){
        return $this->job_title = $this->getJobTitleName($job_title);
    }

    public function getJobTitle(){
        return $this->job_title;
    }

    public function getDepartmentOption() {
        return array(
            self::ADMIN => 'Admin',
            self::HR => 'HR',
            self::MANAGEMENT => 'Management',
            self::SOFTWARE => 'Software',
        );
    }

    public function getDepartmentName($ali) {
        $jobFunctions = $this->getDepartmentOption();
        return isset($jobFunctions[$ali]) ?  $jobFunctions[$ali] : "unknown job function ({$ali})";
    }

    public function setDepartment($depart){
        return $this->department = $this->getDepartmentName($depart);
    }
    public function getDepartment(){
        return $this->department;
    }


}