<?php

/**
 * UserChangePassword class.
 * UserChangePassword is the data structure for keeping
 * user change password form data. It is used by the 'changepassword' action of 'UserController'.
 */
class UserChangePassword extends User
{

    public $oldPassword;
    public $password;
    public $verifyPassword;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('oldPassword, password, verifyPassword', 'required','on'=>'changepassword'),
            array('password, verifyPassword', 'length', 'max'=>128),
            array('password', 'match', 'pattern' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}$/', 'message' =>'Passwords are 6-16 characters with uppercase letters, lowercase letters and at least one number.', 'on'=>'changepassword'),
            array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => "Retype Password is incorrect."),
            array('oldPassword', 'verifyOldPassword'),
		);
	}


	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
            'oldPassword'=>"Old Password",
            'password'=>"Password",
            'verifyPassword'=>"Retype Password",
		);
	}

    /**
     * Verify Old Password
     */
    public function verifyOldPassword($attribute)
    {
        $id = app()->user->id;
        $user = User::model()->findByPk($id);
        if ($user->password != encrypt($this->$attribute))
            $this->addError($attribute, "Old Password is incorrect.");
    }

}