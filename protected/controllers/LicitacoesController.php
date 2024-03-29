<?php

class LicitacoesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        
        public function init(){
          parent::init();
          if ($this->isMobile())
            $this->layout = 'mobile';
        }
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('search','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','buscaAvancada'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('buscaAvancada','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Licitacoes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Licitacoes']))
		{
			$model->attributes=$_POST['Licitacoes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_licitacao));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Licitacoes']))
		{
			$model->attributes=$_POST['Licitacoes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_licitacao));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionSearch()
	{
          if(isset($_GET['query'])){
            //$model = Licitacoes::model()->findAll('MATCH(objeto_free,aviso_free) AGAINST(:value IN NATURAL LANGUAGE MODE)',array('value' => $_GET['query']));
            //$model = Licitacoes::model()->findAll('MATCH(objeto_free,aviso_free) AGAINST(:value IN NATURAL LANGUAGE MODE)',array('value' => $_GET['query']));
            
            $criteria = new CDbCriteria();
            $criteria->condition = 'MATCH(objeto_free,aviso_free) AGAINST(:value)';
            $criteria->params = array('value' => $_GET['query']);
            
            $count = Licitacoes::model()->count($criteria);
            $pages = new CPagination($count);

            // results per page
            $pages->pageSize = 5;
            $pages->applyLimit($criteria);
            $model = Licitacoes::model()->findAll($criteria);
            
            if ($this->isMobile())
              $this->layout = 'mobile';
            
            $this->render('search',array(
              'dataProvider'=>$model,
                'pages'=> $pages
            ));
          }else{
            $this->redirect(array('site/index'));
          }
	}
        public function actionAdvanced()
	{
          if(isset($_GET['query'])){
            $model = Licitacoes::model()->findAll('all_data like :value',array('value' => '%'.$_GET['query'].'%'));
            $this->render('search',array(
              'dataProvider'=>$model,
            ));
          }else{
            $this->redirect(array('site/index'));
          }
	}

	/**
	 * Manages all models.
	 */
	public function actionBuscaAvancada()
	{
		$model=new Licitacoes('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Licitacoes']))
			$model->attributes=$_GET['Licitacoes'];

		$this->render('buscaAvancada',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Licitacoes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='licitacoes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        private function isMobile(){
    return(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'android') || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipad') || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone'));
  }
}
