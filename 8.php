!DOCTYPE html
html lang=en
head
    meta charset=UTF-8
    meta name=viewport content=width=device-width, initial-scale=1.0
    titleРеєстрація користувачаtitle
head
body
    h2Форма реєстрації користувачаh2
    form action=proc.php method=POST
        label for=usernameІм'я користувачаlabelbr
        input type=text id=username name=usernamebrbr
        
        label for=emailЕлектронна поштаlabelbr

        input type=email id=email name=emailbrbr
        
        label for=passwordПарольlabelbr
        input type=password id=password name=passwordbrbr
        
        input type=submit value=Зареєструватися
    form
    h2Форма для пошуку користувача задвання 4h2
    form action=search_user.php method=GET
        label for=attributeВиберіть атрибут для пошукуlabel
        select id=attribute name=attribute
            option value=usernameІм'я користувачаoption
            option value=emailЕлектронна поштаoption
        selectbrbr

        label for=search_termВведіть текст для пошукуlabel
        input type=text id=search_term name=search_termbrbr

        input type=submit value=Знайти користувача
    form
    h2Форма для завантаження файлуh2
    form action=upload.php method=post enctype=multipartform-data
        label for=fileВиберіть файл для завантаженняlabelbr
        input type=file id=file name=filebrbr
        input type=submit value=Завантажити файл
    form
body
html
Лістинг коду  proc.php
php

if ($_SERVER[REQUEST_METHOD] == POST) {

    $username = $_POST[username];
    $email = $_POST[email];
    $password = $_POST[password];

    if (!empty($username) && !empty($email) && !empty($password)) {
 
        $user_data = implode(, , array($username, $email, $password)) . n;

        
        $file = fopen(users.txt, a);

        if ($file) {
       
            fwrite($file, $user_data);

          
            fclose($file);

            echo Дані користувача успішно збережено.;
        } else {
            echo Помилка відкриття файлу для запису.;
        }
    } else {
        echo Будь ласка, заповніть усі поля форми.;
    }
} else {
    echo Помилка дані не були відправлені за допомогою методу POST.;
}


Лістинг коду  search-user.php
php

if ($_SERVER[REQUEST_METHOD] == GET) {

    $attribute = $_GET[attribute];
    $search_term = $_GET[search_term];

    $file = fopen(users.txt, r);

    if ($file) {
         Проходження через рядки файлу
        while (($line = fgets($file)) !== false) {

            $user_data = explode(, , $line);

             Перевірка
            if ($user_data[array_search($attribute, ['username', 'email'])] == $search_term) {
                 Якщо знайдено користувача, виводимо його дані
                echo Знайдено користувачаbr;
                echo Ім'я користувача  . $user_data[0] . br;
                echo Електронна пошта  . $user_data[1] . br;
            
                echo hr;
            }
        }

        fclose($file);
    } else {
        echo Помилка відкриття файлу для читання.;
    }
} else {
    echo Помилка дані не були відправлені за допомогою методу GET.;
}


Лістинг коду  upload,phph
php

if ($_SERVER[REQUEST_METHOD] == POST) {

    if (isset($_FILES[file]) && $_FILES[file][error] == UPLOAD_ERR_OK) {
         Отримання відомостей про завантажений файл
        $file_name = $_FILES[file][name];
        $file_size = $_FILES[file][size];
        $file_type = $_FILES[file][type];
        $file_tmp_name = $_FILES[file][tmp_name];

         Виведення інформації про файл
        echo Ім'я файлу $file_namebr;
        echo Розмір файлу $file_size байтbr;
        echo Тип файлу $file_typebr;

         Виведення вмісту файлу на екран
        echo h3Вміст файлуh3;
        echo pre;
        readfile($file_tmp_name);
        echo pre;
    } else {
        echo Помилка завантаження файлу.;
    }
} else {
    echo Помилка дані не були відправлені за допомогою методу POST.;
}


