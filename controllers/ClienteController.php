<?php

namespace app\controllers;

use Yii;
use app\models\Cliente;
use app\models\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => \app\models\General::permisosUsuario($this->module->id, $this->id),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliente model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cliente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cliente::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionListar($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new \yii\db\Query;
            $query->select('id, nombre AS text')
                ->from('cliente')
                ->where(['like', 'LOWER(nombre)', strtolower($q)])
                ->orderBy(['nombre'=>SORT_ASC])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => Cliente::findOne($id)->nombre];
        }
        return $out;
    }

    /**
     * Carga los datos de cliente en otras secciones, por ejemplo, al crear una nueva salida.
     * @return mixed
     */
    public function actionQuickView()
    {
        $idCliente = Yii::$app->request->post('idCliente');
        $model = $this->findModel($idCliente);
        return \yii\helpers\Json::encode(['contacto'=>$model->contacto, 'telefono'=>$model->telefono, 'email'=>$model->email]);
    }

    /**
     * Crea un cliente nuevo en otras secciones, por ejemplo, al crear una nueva salida.
     * @return mixed
     */
    public function actionQuickCreate()
    {
        $state = 'error';
        $error = '';
        $model = new Cliente();

        if ($model->load(Yii::$app->request->post(), 'nuevoCliente') && $model->save()) {
            $state = 'success';
        }
        elseif ($model->hasErrors()) {
            $arrayErrors = $model->getFirstErrors();
            $error = reset($arrayErrors); // get first element of array
        }

        $cliente['id'] = $model->id;
        $cliente['nombre'] = $model->nombre;
        $cliente['contacto'] = $model->contacto;
        $cliente['telefono'] = $model->telefono;
        $cliente['email'] = $model->email;

        return \yii\helpers\Json::encode(['state'=>$state, 'cliente'=>$cliente, 'error'=>$error]);
    }
}
