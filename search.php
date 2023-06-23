<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online store - Search</title>
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
    <div id="found-items">
        <?php
        $db_connection = mysqli_connect($_SESSION['db_hostname'], $_SESSION['db_username'], $_SESSION['db_password']);
        mysqli_select_db($db_connection, "online_store");

        $search_query = "SELECT * FROM article WHERE title LIKE '%{$_POST['searched_phrase']}%'";
        $search_result = mysqli_query($db_connection, $search_query);
        $search = mysqli_fetch_row($search_result);

        echo "<h2>Searched for: {$_POST['searched_phrase']}</h2>";
        echo "<table>";
        echo "<tr><td>ID</td><td>Title</td><td>Price</td><td>Available count</td><td>Description</td>";
        for ($i = 0; $i < sizeof($search); $i++) {
            echo "<tr>";
            foreach ($search as $item) {
                echo "<td>$item</td>";
            }
            echo "</tr>";

            $search = mysqli_fetch_row($search_result);
        }
        echo "</table><br>";

        mysqli_close($db_connection);
        ?>
    </div>
    <div id="additional-info"> <!-- * -->
        <a href="">About</a>
        <a href="">Customer service</a>
    </div>
</body>
</html>