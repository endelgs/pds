<?php

/**
 * This is the model class for table "licitacoes".
 *
 * The followings are the available columns in table 'licitacoes':
 * @property integer $id_licitacao
 * @property string $protocolo
 * @property string $interessado
 * @property string $objeto
 * @property string $objeto_free
 * @property string $publicado_em
 * @property string $aviso
 * @property string $aviso_free
 * @property string $outros
 * @property string $all_data
 * @property integer $id_cidade
 */
class Licitacoes extends CActiveRecord {

  /**
   * Returns the static model of the specified AR class.
   * @param string $className active record class name.
   * @return Licitacoes the static model class
   */
  public static function model($className = __CLASS__) {
    return parent::model($className);
  }

  /**
   * @return string the associated database table name
   */
  public function tableName() {
    return 'licitacoes';
  }

  /**
   * @return array validation rules for model attributes.
   */
  public function rules() {

    // NOTE: you should only define rules for those attributes that
    // will receive user inputs.
    return array(
        array('objeto_free, aviso_free, all_data, id_cidade', 'required'),
        array('id_cidade', 'numerical', 'integerOnly' => true),
        array('protocolo', 'length', 'max' => 20),
        array('interessado', 'length', 'max' => 500),
        array('objeto, publicado_em, aviso', 'safe'),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array('id_licitacao, protocolo, interessado, objeto, objeto_free, publicado_em, aviso, aviso_free, all_data, id_cidade', 'safe', 'on' => 'search'),
    );
  }

  /**
   * @return array relational rules.
   */
  public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
    return array(
        'relCidade' => array(self::BELONGS_TO, 'Cidades', 'id_cidade'),
        'relModalidade' => array(self::HAS_ONE,'Modalidades','modalidade')
    );
  }

  public function afterFind() {
    parent::afterFind();

    list($data, $hora) = explode(" ", $this->publicado_em);
    list($ano, $mes, $dia) = explode("-", $data);
    list($hora, $min, $seg) = explode(":", $hora);

    $this->publicado_em = "$dia/$mes/$ano às $hora:$min";
    //$this->modalidade = (empty($this->modalidade))?' - ':$this->converteModalidades($this->modalidade);
  }

  /**
   * @return array customized attribute labels (name=>label)
   */
  public function attributeLabels() {
    return array(
        'id_licitacao' => 'Id Licitacao',
        'protocolo' => 'Protocolo',
        'interessado' => 'Interessado',
        'objeto' => 'Objeto',
        'objeto_free' => 'Objeto',
        'publicado_em' => 'Publicado Em',
        'aviso' => 'Aviso',
        'aviso_free' => 'Aviso',
        'outros' => 'Outros',
        'all_data' => 'All Data',
        'id_cidade' => 'Cidade',
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

    $criteria->compare('id_licitacao', $this->id_licitacao);
    $criteria->compare('protocolo', $this->protocolo, true);
    $criteria->compare('interessado', $this->interessado, true);
    $criteria->compare('objeto', $this->objeto, true);
    $criteria->compare('objeto_free', $this->objeto_free, true);
    $criteria->compare('publicado_em', $this->publicado_em, true);
    $criteria->compare('aviso', $this->aviso, true);
    $criteria->compare('aviso_free', $this->aviso_free, true);
    $criteria->compare('outros', $this->outros, true);
    $criteria->compare('all_data', $this->all_data, true);
    $criteria->compare('id_cidade', $this->id_cidade);
    $criteria->compare('modalidade', $this->modalidade);
    if ($this->cidade) {
      $criteria->together = true;
      $criteria->with = array('cidades');
      $criteria->compare('cidades.nome', $this->cidade, true);
    }
//    die("dada ".$this->cidade);
    if ($this->modalidade) {
      $criteria->together = true;
      $criteria->with = array('modalidades');
      $criteria->compare('modalidades.modalidade', $this->modalidade, true);
    }
    return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
            ));
  }
  
  public $cidade;
  public $modalidade;
}