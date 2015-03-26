<head>
    <!-- подключение стилей -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
</head>


<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <!-- Поле вывода текста сообщений, никнейма и времени отправки сообщения -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="chat-output" class="panel panel-default">
                <table class="table table-striped">
                    <tr>
                        <td class="active">NickName</td>  <!-- Заголовок таблицы -->
                        <td class="active">Message</td>
                        <td class="active">Time</td>
                    </tr>
                    <tr>
                        <td class="active" id="user"></td>  <!-- вывод текста сообщений, никнейма и времени отправки сообщения -->
                        <td class="success" id="message"></td>
                        <td class="success" id="time"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <!-- Форма ввода текста сообщений и никнейма -->
    <form>
        <div class="form-group">
            <label>Nickname</label>
            <input type="text" class="form-control" id="user_input" placeholder="Ваше имя">
            <label>Messaage</label>
            <textarea class="form-control" rows="3" id="message_input" placeholder="Ваше сообщение"></textarea>
        </div>
        <button id="btn_send" type="button" class="btn btn-success">Отправить сообщение</button>
    </form>



</div>
