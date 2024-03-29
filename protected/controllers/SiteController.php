<?php

class SiteController extends Controller {
  public function init(){
          parent::init();
          if ($this->isMobile()){
            $this->layout = 'mobile';
          }
        }
  /**
   * Declares class-based actions.
   */
  public function actions() {
    return array(
        // captcha action renders the CAPTCHA image displayed on the contact page
        'captcha' => array(
            'class' => 'CCaptchaAction',
            'backColor' => 0xFFFFFF,
        ),
        // page action renders "static" pages stored under 'protected/views/site/pages'
        // They can be accessed via: index.php?r=site/page&view=FileName
        'page' => array(
            'class' => 'CViewAction',
        ),
    );
  }

  /**
   * This is the default 'index' action that is invoked
   * when an action is not explicitly requested by users.
   */
  public function actionIndex() {
    // renders the view file 'protected/views/site/index.php'
    // using the default layout 'protected/views/layouts/main.php'
    if ($this->isMobile()){
      $this->layout = 'mobile';
      $this->render('mobileindex');
    }
    else
      $this->render('index');
  }

  public function actionEsqueci() {
    $model = new Usuarios;
    /*
    // uncomment the following code to enable ajax-based validation
    if(isset($_POST['ajax']) && $_POST['ajax']==='usuarios-esqueci-form'){
      echo CActiveForm::validate($model);
      Yii::app()->end();
      }
*/
    $reenvioOK = false;
    $first = true;
    if (isset($_POST['Usuarios'])) {
      $_POST['Usuarios']['senha'] = 'senha';
      $_POST['Usuarios']['nome_usuario'] = 'nome';
      $model->attributes = $_POST['Usuarios'];
      if ($model->validate()) {
        // form inputs are valid, do something here
        $usuario = $model->findByAttributes(array('email'=>$_POST['Usuarios']['email']));
        if(!$usuario){
          $reenvioOK = false;
        }else{
          $to = $usuario->attributes['nome_usuario']." <".$usuario->attributes['email'].">";
          $message = "Você solicitou reenvio de senha!
            Sua senha é ".$usuario->attributes['senha']."
            
            Obrigado por utilizar o QuickLic!";
          mail($to,"QuickLic - Reenvio de senha",$message);
          $reenvioOK = true;
        }
      }
      $first = false;
    }
    $this->render('esqueci', array('model' => $model,'reenvioOK'=>$reenvioOK,'first'=>$first));
  }

  /**
   * This is the action to handle external exceptions.
   */
  public function actionError() {
    if ($error = Yii::app()->errorHandler->error) {
      if (Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', $error);
    }
  }

  /**
   * Displays the contact page
   */
  public function actionContact() {
    $model = new ContactForm;
    if (isset($_POST['ContactForm'])) {
      $model->attributes = $_POST['ContactForm'];
      if ($model->validate()) {
        $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
        $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
        $headers = "From: $name <{$model->email}>\r\n" .
                "Reply-To: {$model->email}\r\n" .
                "MIME-Version: 1.0\r\n" .
                "Content-type: text/plain; charset=UTF-8";

        mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
        Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
        $this->refresh();
      }
    }
    $this->render('contact', array('model' => $model));
  }

  /**
   * Displays the login page
   */
  public function actionLogin() {
    $model = new LoginForm;

    // if it is ajax validation request
    if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
      echo CActiveForm::validate($model);
      Yii::app()->end();
    }

    // collect user input data
    if (isset($_POST['LoginForm'])) {
      $model->attributes = $_POST['LoginForm'];
      // validate user input and redirect to the previous page if valid
      if ($model->validate() && $model->login())
        $this->redirect(Yii::app()->user->returnUrl);
    }
    // display the login form
    $this->render('login', array('model' => $model));
  }

  /**
   * Logs out the current user and redirect to homepage.
   */
  public function actionLogout() {
    Yii::app()->user->logout();
    Yii::app()->user->returnUrl = "";
    $this->redirect(Yii::app()->homeUrl);
  }
  public function isMobile(){
    return(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'android') || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipad') || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone'));
  }
}