<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online store - Summary</title>
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
    <div id="summary">
        <h2>Summary</h2>
        <?php
        $db_connection = mysqli_connect($_SESSION['db_hostname'], $_SESSION['db_username'], $_SESSION['db_password']);
        mysqli_select_db($db_connection, "online_store");

        if ($_POST['is-confirmed'] == 1) {
            echo "Your order is ready.";

            $article_id_query = "SELECT * FROM article WHERE id='{$_POST['article-id']}'";
            $article_result = mysqli_query($db_connection, $article_id_query);
            $article = mysqli_fetch_row($article_result);
        } else {
            //        echo "<table><tr><td>{$_POST['article-id']}</td><td>{$_POST['count']}</td></tr></table>";

            $article_id_query = "SELECT * FROM article WHERE id='{$_POST['article-id']}'";
            $article_result = mysqli_query($db_connection, $article_id_query);
            $article = mysqli_fetch_row($article_result);

            echo "<table>";
            echo "<tr><td>ID</td><td>Title</td><td>Price</td><td>Available count</td><td>Description</td></tr>";

            foreach ($article as $item) echo "<td>$item</td>";

            echo "<form action=\"buy.php\" method=\"POST\">";
            echo "<input type=\"hidden\" name=\"is-confirmed\" value=\"1\"><input type=\"submit\" value=\"Confirm\">";
            echo "</form>";

            mysqli_close($db_connection);
        }
        ?>
    </div>
    <div id="additional-info">
        <a href="">About</a>
        <a href="">Customer service</a>
    </div>
</body>
</html>