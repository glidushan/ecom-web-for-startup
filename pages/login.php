<?php
session_start();

require_once "database.php";

$pageTitle = "Login";

if(isset($_POST["inputUsername"]) && isset($_POST["inputPassword"]) && isset($_POST["inputType"])) {
    $username = $_POST["inputUsername"];
    $password = $_POST["inputPassword"];
    $type = $_POST["inputType"];

    if(strval($type) === 'admin') {
        $adminSQL = "SELECT * FROM `Admins` WHERE username = '$username' AND password = '$password'";
        $results = mysqli_query($conn, $adminSQL);
        if(mysqli_num_rows($results) > 0) {
            $_SESSION["user_type"] = strval($type);
            $_SESSION["username"] = $username;
//            header("Location: anotherDirectory/anotherFile.php");
        }
    } elseif(strval($type) === 'owner') {
        $ownerSQL = "SELECT * FROM `Owners` WHERE username = '$username' AND password = '$password'";
        $results = mysqli_query($conn, $ownerSQL);
        if(mysqli_num_rows($results) > 0) {
            $_SESSION["user_type"] = strval($type);
            $_SESSION["username"] = $username;
            while($row = mysqli_fetch_assoc($results)){
                $_SESSION["owner_id"] = $row["id"];
                header("Location: shop.php?" . $row["id"]);
            }
        }
    } elseif(strval($type) === 'customer') {
        $userSQL = "SELECT * FROM `Users` WHERE username = '$username' AND password = '$password'";
        $results = mysqli_query($conn, $userSQL);
        if(mysqli_num_rows($results) > 0) {
            $_SESSION["user_type"] = strval($type);
            $_SESSION["username"] = $username;
            header("Location: item_list.php");
        }
    }

}


function customPageHeader()
{
    ?>
    <link rel="stylesheet" href="../stylesheets/login.css">
    </head>
<?php }

include_once('header.php');

?>

<body class="text-center">

<form class="form-signin" method="post" action="">
    <img class="mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72"
         height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputUsername" class="sr-only">Username</label>
    <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
    <label for="inputType" class="sr-only"></label>
    <select id="inputType" name="inputType" class="form-control" required>
        <option value="admin" selected>Admin</option>
        <option value="owner">Owner</option>
        <option value="customer">Customer</option>
    </select>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <button class="btn btn-lg btn-primary btn-block"><a style="color: inherit" href="registration.php">Register</a></button>
<!--    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>-->
</form>

</body>
</html>

<?php

include_once('footer.php');

?>





