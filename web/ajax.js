
/*
Функция отправки AJAX запроса на сохранение и последующий вывод сообщения и никнейма
 */
    $('body').on("click","#btn_send",function save_massage()  //активизация запроса при клике по кнопке с id=btn_send
        {
            if(validateEmpty('user_input','message_input')) { //на заполнение текста введенного в поле ввода никнейма и сообщения
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
                            $('#user').append($("<p>" + data[i].user + "</p>"));
                            $('#message').append($("<p>" + data[i].message + "</p>"));
                            $('#time').append($("<p>" + data[i].created_at + "</p>"));
                        }
                    }
                });
            }
        }
    );

/*
 Функция загрузки и обновления сообщений
 */

    function load_messages()
    {
        $.ajax({
            metod: "POST",
            url:  "index.php?r=chat/updatechat",        //url action контроллера, куда отправляется AJAX запрос
            Datatype:"json",                            //тип данных возвращаемых на AJAX запрос
            // Выводим то что вернул PHP
            success: function(data)                     //в случае успешного AJAX запроса
            {
                $('#user').empty();         //удаляется то что находится в поле вывода
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

/*
 Функция проверки на заполнение полей,
 в качестве аргументов передаются ID элементов которые должны заполняться
 */

function validateEmpty() {
    var n = validateEmpty.arguments.length; //количество переданной функции аргументов, а значит и полей для проверки
    var args = validateEmpty.arguments;     //поля для проверки
    /*
    элементы переданные функции заводятся в цикл, в котором они последовательно проверяются на заполнение,
    если хотя бы одно из полей, чьи ID были переданы функции, осталось не заполнено, функция возращает false,
    выводит сообение о необходимости заполнения поля, и выставляет курсор в незаполненное поле
     */
    for(var i=0;i<n;i++) {
        if(document.getElementById(args[i]).value != "") {
        }
        else {
            document.getElementById(args[i]).focus();
            alert('Заполните обязательное поле!');
            return false;
        }
    }
    return true;
}

//При загрузке страницы подгружаем сообщения
load_messages();
//Ставим цикл на каждые 10 секунды
setInterval(load_messages,10000);