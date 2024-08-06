<?php
include_once 'config.php';
include_once 'assets/controller/semej.php';
//signup method
function signup($data){
    $username = validate($data['username']);
    $email = validate($data['email']);
    $password = validate($data['password']);
    $passwordConfirm = validate($data['passwordcnfirm']);

    if($password !== $passwordConfirm){
        \Academy01\Semej\Semej::set('Error','Error',"تکرار رمز عبور درست نیست.");
        header('Location: index.php');die;
//        echo "Password did not match";
            }
    if (checkUsername($username)){
        \Academy01\Semej\Semej::set('Error','Error',"Username already exists.");
        header('Location: index.php'); die;
    }

    if (checkEmail($email)){
        \Academy01\Semej\Semej::set('Error','Error',"Email already exists.");
        header('Location: index.php');die;
    }

    $password =sha1($password.SALT);

    $dbs = dbsConnection();
    $sql = "INSERT INTO users_tbl(username, email, password) VALUES('$username', '$email', '$password')";

    if (mysqli_query($dbs, $sql)){
        \Academy01\Semej\Semej::set('OK','OK', "Don!");
        header('Location: index.php');die;
    }else{
        \Academy01\Semej\Semej::set('Error','Error',"Signup Failed. ");
        header('Location: index.php');die;
    }
}

//login method

function login($data){
    $email = validate($data['email']);
    $password = validate($data['password']);

    if (!checkEmail($email)){
        \Academy01\Semej\Semej::set('Error','Error',"Invalid Password or Username.");
        header('Location: index.php');die;
    }

    $dbs = dbsConnection();
    $sql = "SELECT password,username FROM users_tbl WHERE email='$email'";

    $result = mysqli_query($dbs, $sql);
    $row = mysqli_fetch_assoc($result);

    $pass = sha1($password.SALT);

    if ($pass != $row['password']){
        \Academy01\Semej\Semej::set('Error','Error',"Invalid Password or Username.");
        header('Location: index.php');die;
    }

    $_SESSION['username'] = $row['username'];
    $_SESSION['token'] = md5($row['username'].SALT);

    header('Location: dashbord/index.php');die;

}

// validate data
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function dbsConnection(){
    $server= DB_SERVER;
    $username= DB_USER;
    $password= DB_PASS;
    $dbName= DB_NAME;

    $connection= mysqli_connect($server, $username, $password, $dbName);
    if (!$connection) {
        die('DBS Connection failed!');
    }
    return $connection;
}

//check username exist
function checkUsername($username){
    $username = validate($username);
    $dbs = dbsConnection();
    $sql = "SELECT id FROM users_tbl WHERE username='$username'";
    $result = mysqli_query($dbs, $sql);

    if (mysqli_num_rows($result) > 0) {
        return true;
    }else{
        return false;
    }
}

function checkEmail($email){
    $email = validate($email);
    $dbs = dbsConnection();
    $sql = "SELECT id FROM users_tbl WHERE email='$email'";
    $result = mysqli_query($dbs, $sql);

    if (mysqli_num_rows($result) > 0) {
        return true;

    }else{
        return false;
    }
}


//logout method.

function logout(){
    session_unset();
    session_destroy();
    header('Location: ../index.php');die;
}