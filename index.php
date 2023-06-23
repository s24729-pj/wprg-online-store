<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online store</title>
    <link rel="stylesheet" href="style.css">
    <?php
    session_start();

    // !!!
    $_SESSION['db_hostname'] = "";
    $_SESSION['db_username'] = "";
    $_SESSION['db_password'] = "";
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
    <div id="main-content">
<!--        <div id="categories">-->
<!--            <h2>Categories</h2>-->
<!--            <ul id="categories-menu">-->
<!--                <li><a href="category1.php">Category 1</a></li>-->
<!--                <li><a href="category2.php">Category 2</a></li>-->
<!--                <li><a href="category3.php">Category 3</a></li>-->
<!--                <li><a href="category4.php">Category 4</a></li>-->
<!--                <li><a href="category5.php">Category 5</a></li>-->
<!--            </ul>-->
<!--        </div>-->
        <div id="recently-viewed-products">
            <h2>Recently viewed products</h2>
            <?php
            $db_connection = mysqli_connect($_SESSION['db_hostname'], $_SESSION['db_username'], $_SESSION['db_password']);
            mysqli_select_db($db_connection, "online_store");

            $recents_query = "SELECT * FROM article LIMIT 5";
            $recents_result = mysqli_query($db_connection, $recents_query);
            $recents = mysqli_fetch_row($recents_result);

            echo "<table>";
            echo "<tr><td>ID</td><td>Title</td><td>Price</td><td>Available count</td><td>Description</td>";
            for ($i = 0; $i < 5; $i++) {
                echo "<tr>";
                foreach ($recents as $item) {
                    echo "<td>$item</td>";
                }
                echo "<td><form action=\"buy.php\" method=\"POST\">";
                echo "<input type=\"number\" name=\"count\"><input type=\"hidden\" name=\"article-id\" value=\"$recents[0]\"><input type=\"submit\" value=\"Buy\">";
                echo "</form></td></tr>";

                $recents = mysqli_fetch_row($recents_result);
            }
            echo "</table><br>";

            mysqli_close($db_connection);
            ?>
        </div>
    </div>
    <div id="additional-info">
        <a href="">About</a>
        <a href="">Customer service</a>
    </div>
</body>
</html>