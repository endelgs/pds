<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id_usuario
 * @property string $nome_usuario
 * @property string $senha
 * @property string $email
 * @property string $tipo_usuario
 * @property string $nome
 * @property string $documento
 */
class Usuarios extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Usuarios the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return 'usuarios';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {
    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('email', 'email', 'message' => 'Digite um endereço de e-mail válido!'),
        array('email, tipo_usuario, nome, nome_usuario, documento,senha, confirmacao_senha', 'required'),
        array('nome_usuario', 'unique', 'message' => 'Este nome de usuário já existe em nosso banco de dados'),
        array('nome_usuario, senha, documento', 'length', 'max' => 50),
        array('email, nome', 'length', 'max' => 100),
        array('tipo_usuario', 'length', 'max' => 5),
        array('senha,nome_usuario', 'length', 'min' => 6),
        array('tipo_usuario', 'in', 'range' => array('comum', 'admin')),
        array('confirmacao_senha', 'compare', 'compareAttribute' => 'senha','message'=>'As senhas não são iguais'),

        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id_usuario, nome_usuario, senha, email, tipo_usuario, nome, documento', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
    );
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id_usuario' => 'Id Usuario',
        'nome_usuario' => 'Nome de Usuário',
        'senha' => 'Senha',
        'email' => 'Email',
        'tipo_usuario' => 'Tipo de Usuário',
        'nome' => 'Nome',
        'documento' => 'Documento',
        'confirmacao_senha' => 'Confirme sua senha'
    );
  }

  /**
   * Retrieves a list of models based on the current search/filter conditions.
   * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
   */
  public function search() {
    // Warning: Please modify the following code to remove attributes that
    // should not be searched.

    $criteria = new CDbCriteria;

    $criteria->compare('id_usuario', $this->id_usuario);
    $criteria->compare('nome_usuario', $this->nome_usuario, true);
    $criteria->compare('senha', $this->senha, true);
    $criteria->compare('email', $this->email, true);
    $criteria->compare('tipo_usuario', $this->tipo_usuario, true);
    $criteria->compare('nome', $this->nome, true);
    $criteria->compare('documento', $this->documento, true);

    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }
  public $confirmacao_senha;
  public $tipo_pessoa;
}