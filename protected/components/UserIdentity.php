<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
  private $_id;
  //private $password;
  /**
   * Authenticates a user.
   * The example implementation makes sure if the username and password
   * are both 'demo'.
   * In practical applications, this should be changed to authenticate
   * against some persistent user identity storage (e.g. database).
   * @return boolean whether authentication succeeds.
   */
  public function authenticate() {
    $record = Usuarios::model()->findByAttributes(array('nome_usuario' => $this->username));

    if ($record === null)
      $this->errorCode = self::ERROR_USERNAME_INVALID;
    else if ($record->senha !== $this->password)
      $this->errorCode = self::ERROR_PASSWORD_INVALID;
    else {
      //print_r($record->id_usuario);die();
      $this->_id = $record->id_usuario;
      //$this->setState('title', $record->title);
      $this->errorCode = self::ERROR_NONE;
    }
    return !$this->errorCode;
  }
  public function getId(){
    return $this->_id;
  }
}