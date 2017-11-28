<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>index2</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row">
        <form action="/ex/params" enctype="multipart/form-data" method="post">
            <div>
                <label>Введите ваше имя</label>
                <div>
                    <input name="name" id="name" type="text" placeholder="Имя">
                </div>
            </div>
            <div>
                <label>Введите ваш E-mail</label>
                <div>
                    <input name=email id="e_mail" type="email" placeholder="E-mail">
                    <span id="valid"></span>
                </div>
            </div>
            <div class="p"><p>Впишите сюда свой текст</p></div>
            <textarea name="textarea" id="textarea" rows="10" placeholder="Текст"></textarea>
            <!-- Button to download pictures-->
            <input type="hidden" name="max_file_size" value="500000">
            <p>Загрузите ваши фотографии</p>
            <p><input type="file" id="the-file-input" name="userfile">
            <div class="control-group">
                <div class="controls">
                        <input type="checkbox" disabled> <b>Выполнено</b>
                </div>
            </div>
            <input type="submit" id="but_submit" class="btn btn-success" value="Опубликовать"></p>
            <a href="#" id="preview" class="btn btn-default" onclick="return false">Предпоказ</a>
        </form>
                        <!-- Showing preview info-->
        <form action="/ex/params" enctype="multipart/form-data" method="post" id="preview_info" style="display: none;">
            <p id="name_preview"><b></b></p>
            <p id="email_preview"><b></b></p>
            <p id="text_preview" ></p>
            <div class="picture_preview"></div>
            <input type="checkbox" disabled> Выполнено
            <div><a href="#" id="return" class="btn btn-default center-block" onclick="return false">Вернуться назад</a></div>
            <input type="submit" id="but_submit" class="btn btn-success" value="Опубликовать">
        </form>
    </div>
</div>
<script type="text/javascript" src="../../js/jquery-3.1.1.min.js"></script>
<script>
    // checking validation of e-mail
        $(document).ready(function () {
            $(document).ready(function(){
                var pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
                var mail = $('#e_mail');
                mail.blur(function(){
                    if(mail.val() != ''){
                        if(mail.val().search(pattern) == 0){
                            $('#valid').text('Подходит');
                            $('#preview').attr('disabled', false);
                            mail.removeClass('error').addClass('ok');
                        }else{
                            $('#valid').text('Не подходит');
                            $('#preview').attr('disabled', true);
                            mail.addClass('error');
                        }
                    }else{
                        $('#valid').text('Поле e-mail не должно быть пустым!');
                        mail.addClass('error');
                        $('#preview').attr('disabled', true);
                    }
                });
            });
        });
    // Image preview
        function renderImage(file) {
            // генерация нового объекта FileReader
            var reader = new FileReader();
            // подстановка изображения в атрибут src
            reader.onload = function(event) {
                the_url = event.target.result;
                $('.picture_preview').html("<img src='" + the_url + "' />");
            };
            // при считке файла, вызывается метод, описанный выше
            $("#preview").on("click",function () {
                $('div.row form').css('display','none');
                $('#preview_info').css('display','block');
                var inputNameVal = $('#name').val();
                $('p#name_preview').html(inputNameVal);
                var inputEmailVal = $('#e_mail').val();
                $('p#email_preview').html(inputEmailVal);
                var inputTextAreaVal = $('#textarea').val();
                $('p#text_preview').html(inputTextAreaVal);
                reader.readAsDataURL(file);
            });
            $('#return').on("click",function () {
                $('#preview_info').css('display','none');
                $('div.row form:first-child').css('display','block');
            });
        }
        // обработка элемента input
        $("#the-file-input").change(function() {
            console.log(this.files);
            // выбор первого изображения из FileList и передача в функцию
            renderImage(this.files[0])
        });
//        $('#').on('click' , function () {
//            var inputVal = $('input').val();
//            $('div:first-of-type p').html(inputVal);
//        });
    //    function funcBefore (){
    //        $("#information").html("Ожидание даных...");
    //    }
    //    function funcSuccess (data){
    //        $("#information").html(data);
    //    }
    //    $(document).ready(function () {
    //        $('button').on('click' , function () {
    //            var inputVal = $('input').val();
    //            $('div:first-of-type p').html(inputVal);
    //        });
    //
    //        $("#but_submit").on("click", function () {
    //            var admin = "Admin";
    //            $.ajax({
    //                url: "handler.php",
    //                type: "POST",
    //                data: ({name: admin, number: 5}),
    //                dataType: "html",
    //                beforeSend: funcBefore,
    //                success: funcSuccess
    //            });
    //        });
    //    });
</script>
</body>
</html>