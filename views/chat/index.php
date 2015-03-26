<head>
    <!-- подключение стилей -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
</head>

<!--Подключаем Jquery и файл с нашем Java-скриптом-->

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="ajax.js"></script>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chats';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-index">

    <h1>CHAT</h1>


    <!-- Поле вывода текста сообщений, никнейма и времени отправки сообщения -->
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div id="chat-output" class="panel panel-default">
                <table class="table table-striped">
                    <tr>
                        <td class="active"><strong>NickName</strong></td>  <!-- Заголовок таблицы -->
                        <td class="active"><strong>Message</strong></td>
                        <td class="active"><strong>Time</strong></td>
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

    <br>
    <!-- Форма ввода текста сообщений и никнейма -->
    <div class="row">
         <div class="col-md-8 col-md-offset-2">
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
    </div>



</div>
