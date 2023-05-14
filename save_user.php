<?php
include('db_connect.php');
$id = $_POST['id'];
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$type = $_POST['type'];

if (!empty($password)) {
    $data = "name='" . $name . "',username='" . $username . "',password='" . md5($password) . "',type=" . $type;
} else {
    $data = "name='" . $name . "',username='" . $username . "',type=" . $type;
}

$chk = 0;
if (!empty($id)) {
    $chk = $conn->query("Select * from users where username = '$username' and id !=$id ")->num_rows;
} else {
    $chk = $conn->query("Select * from users where username = '$username'")->num_rows;
}

if ($chk > 0) {
    header("Location: index.php?page=users&msg='Username already exist'");
} else if (empty($id)) {
    //$id = 4;
    $save = $conn->query("INSERT INTO users (name,username,password,type) VALUES('$name','$username','" . md5($password) . "',$type)");
    header("Location: index.php?page=users&msg='Data successfully saved'");
} else {
    $save = $conn->query("UPDATE users set " . $data . " where id = " . $id);
    if ($save) {
        $_SESSION['login_name'] = $name;
        header("Location: index.php?page=users&msg='Data successfully saved'");
    } else {
        header("Location: index.php?page=users&msg='Error in Saving Data'");
    }
}

?>