!DOCTYPE html
html lang=en
head
    meta charset=UTF-8
    meta name=viewport content=width=device-width, initial-scale=1.0
    title��������� �����������title
head
body
    h2����� ��������� �����������h2
    form action=proc.php method=POST
        label for=username��'� �����������labelbr
        input type=text id=username name=usernamebrbr
        
        label for=email���������� �����labelbr

        input type=email id=email name=emailbrbr
        
        label for=password������labelbr
        input type=password id=password name=passwordbrbr
        
        input type=submit value=��������������
    form
    h2����� ��� ������ ����������� �������� 4h2
    form action=search_user.php method=GET
        label for=attribute������� ������� ��� ������label
        select id=attribute name=attribute
            option value=username��'� �����������option
            option value=email���������� �����option
        selectbrbr

        label for=search_term������ ����� ��� ������label
        input type=text id=search_term name=search_termbrbr

        input type=submit value=������ �����������
    form
    h2����� ��� ������������ �����h2
    form action=upload.php method=post enctype=multipartform-data
        label for=file������� ���� ��� ������������labelbr
        input type=file id=file name=filebrbr
        input type=submit value=����������� ����
    form
body
html
˳����� ����  proc.php
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

            echo ��� ����������� ������ ���������.;
        } else {
            echo ������� �������� ����� ��� ������.;
        }
    } else {
        echo ���� �����, �������� �� ���� �����.;
    }
} else {
    echo ������� ��� �� ���� ��������� �� ��������� ������ POST.;
}


˳����� ����  search-user.php
php

if ($_SERVER[REQUEST_METHOD] == GET) {

    $attribute = $_GET[attribute];
    $search_term = $_GET[search_term];

    $file = fopen(users.txt, r);

    if ($file) {
         ����������� ����� ����� �����
        while (($line = fgets($file)) !== false) {

            $user_data = explode(, , $line);

             ��������
            if ($user_data[array_search($attribute, ['username', 'email'])] == $search_term) {
                 ���� �������� �����������, �������� ���� ���
                echo �������� �����������br;
                echo ��'� �����������  . $user_data[0] . br;
                echo ���������� �����  . $user_data[1] . br;
            
                echo hr;
            }
        }

        fclose($file);
    } else {
        echo ������� �������� ����� ��� �������.;
    }
} else {
    echo ������� ��� �� ���� ��������� �� ��������� ������ GET.;
}


˳����� ����  upload,phph
php

if ($_SERVER[REQUEST_METHOD] == POST) {

    if (isset($_FILES[file]) && $_FILES[file][error] == UPLOAD_ERR_OK) {
         ��������� ��������� ��� ������������ ����
        $file_name = $_FILES[file][name];
        $file_size = $_FILES[file][size];
        $file_type = $_FILES[file][type];
        $file_tmp_name = $_FILES[file][tmp_name];

         ��������� ���������� ��� ����
        echo ��'� ����� $file_namebr;
        echo ����� ����� $file_size ����br;
        echo ��� ����� $file_typebr;

         ��������� ����� ����� �� �����
        echo h3���� �����h3;
        echo pre;
        readfile($file_tmp_name);
        echo pre;
    } else {
        echo ������� ������������ �����.;
    }
} else {
    echo ������� ��� �� ���� ��������� �� ��������� ������ POST.;
}


