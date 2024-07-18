<?php
class ErrorHandler
{
    function __constuctor()
    {
    }
    function success_alert($alert_code)
    {
        switch ($alert_code) {
            case 400:
                echo "<!>success";
                return;
        }
    }
    function test($code)
    {
        echo '<!> Hii there';
        return;
    }
}

class user extends ErrorHandler
{

    function login($log)
    {
        $u_name = $log['userid'];
        $u_pass = $log['password'];

        // $sql = "SELECT * FROM user where email ='$u_name' OR username = '$u_name'";
        $sql = "SELECT * FROM user where username ='$u_name'";

        $result = mysqli_query($GLOBALS['con'], $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($u_pass, $row['password'])) {
                $_SESSION['uid'] = $row['id'];
                $_SESSION['username'] = $row['username'];
            }

            header('location:index.php?page=home');
            exit();
        }
    }

    function register($data)
    {



        if (empty($data['name']) || empty($data['email']) || empty($data['password']) || empty($data['username'])) {
            return false;
        }
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        // echo 1;
        $sql = "insert into user(username,name,email,password) values('$data[username]','$data[name]','$data[email]','$password')";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            $_SESSION['flash']['info'] = 'Registration Successful..!';
            return true;
        } else {
            return false;
        }
    }
}

class Products extends ErrorHandler
{

    function getAll()
    {
        $sql = "SELECT * FROM product";

        $rows = [];
        $result = mysqli_query($GLOBALS['con'], $sql);
        if (mysqli_num_rows($result) > 0) {
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }

        return $rows;
    }

    function save($data)
    {
        // $sql = "Create table product    (
        //     id int(11) NOT NULL AUTO_INCREMENT,
        //     name varchar(30) NOT NULL,
        //     prize int(11) NOT NULL,
        //     created_by  varchar(30) NOT NULL,
        //     PRIMARY KEY (id)
        // ) "

        if (empty($data['name']) || empty($data['prize']) || empty($_SESSION['uid'])) {
            return false;
        }
        $sql = "insert into product(name,prize,created_by) values('$data[name]','$data[prize]','$_SESSION[uid]')";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            $_SESSION['flash']['info'] = 'product added Successful..!';
            return true;
        } else {
            return false;
        }
    }

    function update($data){

        if ( empty($data['id']) || empty($data['name']) || empty($data['prize']) || empty($_SESSION['uid'])) {
            return false;
        }
        $sql = "update product set name = '$data[name]',prize = '$data[prize]' where id = '$data[id]'";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            $_SESSION['flash']['info'] = 'product updated Successful..!';
            return true;
        } else {
            return false;
        }

    }
    function delete($data){

        if ( empty($data['id'])) {
            return false;
        }
        $sql = "delete from product where id = '$data[id]'";

        if (mysqli_query($GLOBALS['con'], $sql)) {
            $_SESSION['flash']['info'] = 'product deleted Successful..!';
            return true;
        } else {
            return false;
        }
    }

    function getById($data)
    {

        if (empty($data['id'])) {
            return [];
        }
        $sql = "select * from product where id = '$data[id]'";
        $rows = [];
        $result = mysqli_query($GLOBALS['con'], $sql);
        if (mysqli_num_rows($result) > 0) {
            $rows = mysqli_fetch_assoc($result);
        }

        return $rows;
    }
}
