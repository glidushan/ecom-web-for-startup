<?php

session_start();

require_once "database.php";

$pageTitle = "Registration";

if (isset($_POST["inputUsername"]) && isset($_POST["inputPassword"]) && isset($_POST["inputType"])
    && isset($_POST["inputFirstname"]) && isset($_POST["inputLastname"]) && isset($_POST["inputStoreName"])) {
    $username = $_POST["inputUsername"];
    $password = $_POST["inputPassword"];
    $firstName = $_POST["inputFirstname"];
    $lastName = $_POST["inputLastname"];
    $type = $_POST["inputType"];
    $storeName = $_POST["inputStoreName"];

    if (strval($type) === 'owner') {
        $ownerSQL = "INSERT INTO `Owners` (username, password, firstname, lastname, owner_flag, store_name) 
        VALUES ('$username', '$password', '$firstName', '$lastName', TRUE, '$storeName')";
        $getOwner = "SELECT id FROM `Owners` WHERE username= '$username'";

        if (mysqli_query($conn, $ownerSQL)) {
            $result = mysqli_query($conn, $getOwner);
            while($row = mysqli_fetch_assoc($result)) {
                $ownerID = $row["id"];
                $storeSQL = "INSERT INTO `Stores` (store_name, owner_id) VALUES ('$storeName', '$ownerID')";
                mysqli_query($conn, $storeSQL);
            }
        } else {
            echo "Error: " . $ownerSQL . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        session_unset();
        session_destroy();
        header("Location: login.php");

    } elseif (strval($type) === 'customer') {
        $userSQL = "INSERT INTO `Users` (username, password, firstname, lastname, user_flag) 
        VALUES ('$username', '$password', '$firstName', '$lastName', TRUE)";

        if (mysqli_query($conn, $userSQL)) {

        } else {
            echo "Error: " . $userSQL . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
        session_unset();
        session_destroy();
        header("Location: login.php");
    }

}

function customPageHeader()
{
    ?>
    <link rel="stylesheet" href="../stylesheets/registration.css">

    <script>
        $(document).ready(function() {
            $("#inputType").change(function() {
               if($(this).val() === 'customer') {
                   $("#inputStoreName").prop('hidden',true);
               }
                if($(this).val() === 'owner') {
                    $("#inputStoreName").prop('hidden',false);
                }
            });
        });
    </script>
    </head>
<?php }

include_once('header.php');

?>


<body class="text-center">

<form class="form-registration" method="post" action="">
    <img class="mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72"
         height="72">

    <label for="inputFirstname" class="sr-only">Username</label>
    <input type="text" id="inputFirstname" name="inputFirstname" class="form-control" placeholder="First Name" required>

    <label for="inputLastname" class="sr-only">Username</label>
    <input type="text" id="inputLastname" name="inputLastname" class="form-control" placeholder="Last Name" required>

    <label for="inputUsername" class="sr-only">Username</label>
    <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required>

    <label for="inputPassword" class="sr-only">Username</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>

    <label for="inputType" class="sr-only">Type</label>
    <select id="inputType" name="inputType" class="form-control" required">
        <option value="owner">Owner</option>
        <option value="customer" selected>Customer</option>
    </select>

    <label for="inputStoreName" class="sr-only">Store Name</label>
    <input type="text" id="inputStoreName" name="inputStoreName" class="form-control" placeholder="Store Name" value="test" required hidden>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <!--    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>-->
</form>

</body>
</html>

<?php

include_once('footer.php');

?>

