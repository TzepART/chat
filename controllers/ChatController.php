<?php

namespace app\controllers;

use Yii;
use app\models\Chat;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Chat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Chat::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    /*
     * action для сохранения набранного сообщения и никнейма
     */
    public function actionSave($user,$message) //функция принимает два переданных запросом аргумента(сообщения и никнейма)
    {
        $model = new Chat(); //создается новый объект, наследованный от модели Chat
        $model->user = $user; //свойству user присваивается значение входного аргумента $user
        $model->message = $message; //свойству message присваивается значение входного аргумента $message
        $model->created_at = date("Y-m-d H:i:s"); //свойству created_at присваивается значение текущей даты и времени

        if($model->save()){//отправляется запрос на сохранение в БД, если сохранение успешно
            $mess ='success';
            return $mess; //возвращается сообщение об успешном сохранении
        }else{
            return ChatController::actionIndex(); //если нет, то вызывается действие Index
        }

    }


    /*
  * action для обновления поля вывода сообщения и никнейма и отправки ответа в виде JSON,
  * содержащего обновленную ленту сообщений
  */

    public function actionUpdatechat()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;    //производится выборка из таблицы с сообщениями и сохраняется в JSON формате
        $data = Chat::find()
            ->asArray()
            ->orderBy('id DESC')       //здесь мы производим сортировку в обратном порядке, чтобы отображались последние сообщения
            ->limit(100)            //тут мы просто ограничиваем число сообщений последними 100(хотя можно и бех этого)
            ->all();
        /*
           * делаем проверку на некорректные сообщения и никнеймы для предотвращения XSS атак
           * для этого данные полученные из БД мы заводим в цикл,
           * в котором функция "filter_var" экранирует нежелательные символы
           */
        
        foreach ($data as &$row) {
            $row['user'] = filter_var($row['user'], FILTER_SANITIZE_SPECIAL_CHARS);
            $row['message'] = filter_var($row['message'], FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $data;
    }





    /**
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
