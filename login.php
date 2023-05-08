<?php
$users = ['user001' => 'abc123', 'user002' => 'def456'];

$username = $_POST['username'];
$password = $_POST['password'];

foreach ($users as $name => $pass) {
    if ($name == $username && $pass == $password) {
        $_SESSION['active_user'] = $username;
        echo "Logged in successfully.";
        break;
    } else {
        echo "Failed to log in.";
        break;
    }
}
