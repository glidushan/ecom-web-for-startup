<?php

session_start();

require_once "database.php";

$pageTitle = "Thank You";

function customPageHeader()
{
    ?>
    <link rel="stylesheet" href="../stylesheets/checkout.css">
    </head>
<?php }

include_once('header.php');

$cartSize = count($_SESSION['cart']);
$items = $_SESSION['cart'];
$total = 0;

?>

<body>

<h1 style="text-align: center; margin-top: 20%;">Thank you for your purchase</h1>

</body>
