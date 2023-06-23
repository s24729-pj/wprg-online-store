<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online store - Login</title>
    <link rel="stylesheet" href="style.css">
    <?php
    session_start();
    ?>
</head>
<body>
    <div id="nav-bar">
        <h1><a href="index.php">Online store</a></h1>
        <form name="search" method="POST" action="search.php">
            <label>Search something: <input type="text" name="searched_phrase"></label>
            <input type="submit" value="Search">
        </form>
        <ul id="menu">
            <li>
                <?php // *
                if (isset($_SESSION['logged_user_id'])) {
                    echo "<a href=\"account.php\">Logged as: {$_SESSION['logged_user_id']}</a>";
                } else {
                    echo "<a href=\"login.php\">Log in / Sign up *</a></li>";
                }
                ?>
            </li>
            <li><a href="">Menu</a></li>
        </ul>
    </div>
    <div id="information-container">
        <h2>Log in</h2>
        <form action="login.php" method="post">
            <label>E-mail address: <input type="text" name="email"></label><br><br>
            <label>Password: <input type="text" name="password"></label><br><br>
            <input type="submit" value="Log in"><br><br>
        </form>
        <a href="register.php">Don't have an account? Sign up.</a>
    </div>
    <?php
    echo "<br>";

    $db_connection = mysqli_connect($_SESSION['db_hostname'], $_SESSION['db_username'], $_SESSION['db_password']);
    mysqli_select_db($db_connection, "online_store");

    $account_id_query = "SELECT id FROM account WHERE email='{$_POST['email']}' AND password='{$_POST['password']}'";
    $account_id_result = mysqli_query($db_connection, $account_id_query);
    $account_id = mysqli_fetch_row($account_id_result);

    foreach ($account_id as $item) $_SESSION['logged_user_id'] = $item;

    mysqli_close($db_connection);

    echo "Currently logged as: {$_SESSION['logged_user_id']}<br>";

    echo "<br><a href=\"index.php\">Go to homepage</a><br><br>";
    ?>
    <div id="additional-info">
        <a href="">About</a>
        <a href="">Customer service</a>
    </div>
</body>
</html>