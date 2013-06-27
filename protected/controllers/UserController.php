<?php

class UserController extends Controller
{
  /**
   * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
   * using two-column layout. See 'protected/views/layouts/column2.php'.
   */
  //public $layout='//layouts/column2';

  /**
   * @return array action filters
   */
  public function filters()
  {
    return array(
      'accessControl', // perform access control for CRUD operations
    );
  }

  /**
   * Specifies the access control rules.
   * This method is used by the 'accessControl' filter.
   * @return array access control rules
   */
  public function accessRules()
  {
    return array(
      array('allow',  // allow all users to perform 'index' and 'view' actions
        'actions'=>array('Changepassword'),
        'roles'=>array('user'),
      ),
      array('allow',  // allow all users to perform 'index' and 'view' actions
        'actions'=>array('index','view','update'),
        'roles'=>array('leader'),
      ),
      array('allow', // allow authenticated user to perform 'create' and 'update' actions
        'actions'=>array('create'),
        'roles'=>array('leader'),
      ),
      array('allow', // allow admin user to perform 'admin' and 'delete' actions
        'actions'=>array('admin'),
        'roles'=>array('leader'),
      ),
      array('deny',  // deny all users
        'roles'=>array(),
      ),
    );
  }

  /*
   *  init CSS and Javascript file
   */
  public function init(){
    app()->clientScript->registerCssFile(app()->request->baseUrl .'/css/user.css');
    parent::init();
  }

  /**
   * Displays a particular model.
   * @param integer $id the ID of the model to be displayed
   */
  public function actionView($id)
  {
    $model = $this->loadModel($id);
    $modelEmployee = $this->loadEmployeeModel($id);
    $dob = get_date($model->dob, null);
    $lastVisit = get_date($model->lastvisit, null);
    $createdDate = get_date($model->created_date, null);
    $updatedDate = get_date($model->updated_date, null);
    $model->setAttribute('dob', $dob);
    $model->setAttribute('lastvisit', $lastVisit);
    $model->setAttribute('created_date', $createdDate);
    $model->setAttribute('updated_date', $updatedDate);

    $this->render('view',array('model'=>$this->loadModel($id), 'employee' => $modelEmployee));
  }

  /**
   * Creates a new model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   */
  public function actionCreate()
  {
    if(!app()->user->checkAccess('createUser')) {

      if(!app()->user->checkAccess('manageUser')){
        app()->user->setFlash('error', 'You are not authorized to create a new user !');
        app()->request->redirect(app()->createUrl('/'));
      }
      else {
        app()->user->setFlash('error', 'You are not authorized to create a new user !');
        app()->request->redirect(app()->createUrl('/User/Admin'));
      }

    }
    elseif(app()->user->checkAccess('createUser')) {

      $model=new User('create');
      $employeemodel=new Employee('create');
      $roles = $model->getRoleOptions();
      $pass = $model->autoGeneralPass();

      if(app()->user->checkAccess('admin') && app()->user->type == 0){
        unset($roles[USER::ADMIN]);
      }
      elseif(app()->user->checkAccess('manager') && app()->user->type == 0){
        unset($roles[USER::ADMIN]);
        unset($roles[USER::MANAGER]);
      }
      elseif(app()->user->checkAccess('leader') && app()->user->type == 0){
        unset($roles[USER::ADMIN]);
        unset($roles[USER::MANAGER]);
        unset($roles[USER::LEADER]);
      }

      // Uncomment the following line if AJAX validation is needed
      $this->performAjaxValidation(array($model,$employeemodel));

      if(isset($_POST['User']))
      {
        $model->attributes = Clean($_POST['User']);
        $model->email = textlower($_POST['User']['email']);
        $model->password = $pass;
        $model->activkey = encrypt(microtime().$model->password);
        $model->dob = $model->setUserDob($_POST['User']['dob']);
        $model->created_date = gettime();

        // validate BOTH $model and $employeemodel
        $model->validate();
        $employeemodel->validate();
        // End validate

        if($model->save()){
          $employeemodel->attributes = Clean($_POST['Employee']);
          $employeemodel->id = $model->id;
          /*if(isset($_POST['Employee']['personal_email'])) {
              $employeemodel->personal_email = textlower($employeemodel->personal_email);
          }*/
          if(isset($_POST['Employee']['department'])) {
            $employeemodel->setDepartment($_POST['Employee']['department']);
          }
          $employeemodel->created_date = $model->created_date;
          if($employeemodel->save()) {
            $this->associateUserToRole($_POST['User']['user_role'], $model->id);
            $activation_url = $this->createAbsoluteUrl('/activation/Index',array("activkey" => $model->activkey, "email" => $model->email));
            MailTransport::sendMail(
              app()->params['noreplyEmail'],
              $model->email,
              'Welcome to EMS',
              CController::renderPartial('emailwelcome',array('activation_url'=>$activation_url,'email'=>$model->email,'password'=>$pass),true,false)
            );
            app()->user->setFlash('success', 'You create a new user successful !');
            $this->redirect(array('view','id'=>$model->id));
          }
        }
      }
    }
    $this->render('create',array(
      'model'=>$model,
      'employeemodel'=>$employeemodel,
      'roles'=>$roles,
    ));

  }

  /**
   * Updates a particular model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id the ID of the model to be updated
   */
  public function actionUpdate($id)
  {
    if(!app()->user->checkAccess('editUser')) {

      if(!app()->user->checkAccess('manageUser')){
        app()->user->setFlash('error', 'You are requesting to update user info that you are not authorized !');
        app()->request->redirect(app()->createUrl('/'));
      }
      else {
        app()->user->setFlash('error', 'You are requesting to update user info that you are not authorized !');
        app()->request->redirect(app()->createUrl('/User/Admin'));
      }

    }

    $model=$this->loadModel($id);
    $employeemodel=$this->loadEmployeeModel($id);
    $model->user_role = $model->getRoleValue();

    if(app()->user->checkAccess('manager')){

      if($model->user_role == 'admin' || ($model->user_role == 'manager' && $id != app()->user->id)){

        app()->user->setFlash('error', 'You are not authorized to update This user info !');
        if(!app()->user->checkAccess('managerUser')){
          app()->request->redirect(app()->createUrl('/'));
        }
        else {
          app()->request->redirect(app()->createUrl('/User/Admin'));
        }
      }
    }
    $roles = $model->getRoleOptions();
    if(app()->user->checkAccess('admin') && app()->user->type == 0){
      unset($roles[USER::ADMIN]);
    }
    elseif(app()->user->checkAccess('manager') && app()->user->type == 0){
      unset($roles[USER::ADMIN]);
      unset($roles[USER::MANAGER]);
    }
    elseif(app()->user->checkAccess('leader') && app()->user->type == 0){
      unset($roles[USER::ADMIN]);
      unset($roles[USER::MANAGER]);
      unset($roles[USER::LEADER]);
    }
    // Uncomment the following line if AJAX validation is needed
    $this->performAjaxValidation($model);

    if(isset($_POST['User']))
    {
      $model->setScenario('edit');
      $model->attributes=$_POST['User'];
      $model->dob = $model->setUserDob($_POST['User']['dob']);
      $model->updated_date = gettime();
      if($model->validate() && $model->save()) {
        $this->deleteAllAssociateUserToRole($model->id);
        $this->associateUserToRole($_POST['User']['user_role'], $model->id);
        $this->redirect(array('view','id'=>$model->id));
      }

    }

    $this->render('update',array(
      'model'=>$model,
      'employeemodel'=>$employeemodel,
      'roles'=>$roles
    ));
  }

  /**
   * Deletes a particular model.
   * If deletion is successful, the browser will be redirected to the 'admin' page.
   * @param integer $id the ID of the model to be deleted
   */
  public function actionDelete($id)
  {
    if(Yii::app()->request->isPostRequest)
    {
      // we only allow deletion via POST request
      $this->loadModel($id)->delete();

      // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
      if(!isset($_GET['ajax']))
        $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }
    else
      throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
  }

  /**
   * Lists all models.
   */
  public function actionIndex()
  {
    /*$dataProvider=new CActiveDataProvider('User');
    $this->render('index',array(
    'dataProvider'=>$dataProvider,
    ));*/
    if(app()->user->checkAccess('manageUser')){
      app()->request->redirect(app()->createUrl('/User/Admin'));
    } else {
      app()->user->setFlash('error', 'You are requesting to manage user info that you are not authorized!');
      app()->request->redirect(app()->createUrl('/'));
    }

  }

  /**
   * Manages all models.
   */
  public function actionAdmin()
  {
    if(!app()->user->checkAccess('manageUser')){
      app()->user->setFlash('error', 'You are requesting to manage user info that you are not authorized!');
      app()->request->redirect(app()->createUrl('/'));
    }

    $model = new User('search');
    $model->unsetAttributes();  // clear any default values
    if(isset($_GET['User'])){
      //var_dump($_GET['User']);die;
      $model->attributes=$_GET['User'];
    }


    $this->render('admin',array(
      'model'=>$model,
    ));
  }
  /*
* User can change password
*/
  public function actionChangepassword()
  {
    $model=new UserChangePassword('changepassword');

    if(app()->user->id){
      // uncomment the following code to enable ajax-based validation

      if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
      {
        echo CActiveForm::validate($model);
        Yii::app()->end();
      }


      if(isset($_POST['UserChangePassword']))
      {
        $model->attributes=$_POST['UserChangePassword'];
        if($model->validate())
        {
          $new_password = User::model()->findbyPk(app()->user->id);
          $new_password->password = encrypt($model->password);
          $new_password->activkey = encrypt(microtime().$model->password);
          $new_password->save();
          app()->user->setFlash('success',"Your password is changed.");
          $this->redirect(app()->createUrl('/'));
        }
      }
      $this->render('changepassword',array('model'=>$model));

    }
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadModel($id)
  {
    $model=User::model()->findByPk($id);
    if($model===null)
      throw new CHttpException(404,'The requested page does not exist.');
    return $model;
  }

  /**
   * Returns the data model based on the primary key given in the GET variable.
   * If the data model is not found, an HTTP exception will be raised.
   * @param integer the ID of the model to be loaded
   */
  public function loadEmployeeModel($id)
  {
    $employeemodel=Employee::model()->findByPk($id);
    if($employeemodel===null)
      throw new CHttpException(404,'The requested page does not exist.');
    return $employeemodel;
  }


  /**
   * Performs the AJAX validation.
   * @param CModel the model to be validated
   */
  protected function performAjaxValidation($model)
  {
    if(isset($_POST['ajax']) && $_POST['ajax']==='user-form'){
      echo CActiveForm::validate($model);
      app()->end();
    }
  }

  /**
   * creates an association between the user and the user's role
   */
  public function associateUserToRole($role, $Id)
  {
    $sql = "INSERT INTO AuthAssignment (itemname, userid, bizrule, data) VALUES (:role, :userId, '', 'N;')";
    $command = app()->db->createCommand($sql);
    $command->bindValue(":role", $role, PDO::PARAM_STR);
    $command->bindValue(":userId", $Id, PDO::PARAM_INT);
    return $command->execute();
  }

  /**
   * delete all association between the user and role
   */
  public function deleteAllAssociateUserToRole($Id)
  {
    $sql = "DELETE FROM AuthAssignment WHERE userid =:userId";
    $command = app()->db->createCommand($sql);
    $command->bindValue(":userId", $Id, PDO::PARAM_INT);
    return $command->execute();
  }

}
