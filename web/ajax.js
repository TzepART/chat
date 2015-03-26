
/*
Функция отправки AJAX запроса на сохранение и последующий вывод сообщения и никнейма
 */
$('body').on("click","#btn_send",function save_massage()  //активизация запроса при клике по кнопке с id=btn_send
    {
            var user = $("#user_input").val();       //передача переменной user текста введенного в поле ввода никнейма
            var message = $("#message_input").val(); //передача переменной message текста введенного в поле ввода сообщения
            $.ajax({
                metod: "POST",
                url: "index.php?r=chat/save",       //url action контроллера, куда отправляется AJAX запрос
                Datatype: "json",                   //тип данных возвращаемых на AJAX запрос
                data: {                             //данные отправляемые AJAX запросом
                    user: user,
                    message: message
                },
                success: function (data) {          //в случае успешного AJAX запроса
                    $('#user_input').val('');       //удаляется то что находится в поле ввода никнейма
                    $('#message_input').val('');    //удаляется то что находится в поле ввода сообщения
                    $('#user').empty();             //удаляется то что находится в поле вывода
                    $('#message').empty();
                    $('#time').empty();
                    /*
                    данные, в формате json, пришедших в ответ на запрос, вводятся в цикл для вывода
                    в полях с соответствующими ID
                     */
                    for (var i = 0; i < data.length; i++) {
                        $('#user').append($("<p>"+ data[i].user +"</p>"));
                        $('#message').append($("<p>" + data[i].message+"</p>"));
                        $('#time').append($("<p>"+ data[i].created_at +"</p>"));
                    }
                }
            });
    }
);