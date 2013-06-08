<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    const ERROR_EMAIL_INVALID=3;
    const ERROR_STATUS_NOTACTIV=4;
    const ERROR_STATUS_BAN=5;

    /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
        $user = User::model()->findByAttributes(array('email'=>$this->username));

        if($user===null)
        {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else if($user->password !== encrypt($this->password)) {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        } else if ($user->status == 0){
            $this->errorCode=self::ERROR_STATUS_NOTACTIV;
        } else if ($user->status == 2) {
            $this->errorCode=self::ERROR_STATUS_BAN;
        } else {
            $this->_id = $user->id;
            $this->setState('role', $user->getRoleOfUser($this->_id));
            $this->setState('type',$user->getUserType());
            if($user->type == 0) {
                $this->setState('department', $user->getEmployeeDepartment($this->_id));
            }
            $this->setState('FistLastName', $user->getFistLastName());
            $this->errorCode=self::ERROR_NONE;
        }

        return !$this->errorCode;
	}

    /**
     * @return integer the ID of the user record
     */
    public function getId()
    {
        return $this->_id;
    }

}