<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online store - Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="nav-bar">
        <h1><a href="index.php">Online store</a></h1>
        <form name="search">
            <label>Search something: <input type="text"></label>
            <input type="submit" value="Search">
        </form>
        <ul id="menu">
            <li><a href="login.php">Log in / Sign up</a></li>
            <li><a href="">Menu</a></li>
        </ul>
    </div>
    <div id="login-container">
        <div id="information-container">
            <h2>Log in</h2>
            <form>
                <label>User name: <input type="text" name="username"></label><br><br>
                <label>Password: <input type="text" name="password"></label><br><br>
                <input type="submit" value="Sign up"><br><br>
            </form>
        </div>
        <div id="additional-info-container">
            <p>Some text here.</p>
        </div>
    </div>
</body>
</html>