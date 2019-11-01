<?php

session_start();

require_once "database.php";

$pageTitle = "Item List";

function customPageHeader()
{
    ?>
    <link rel="stylesheet" href="../stylesheets/item_list.css">
    </head>
<?php }

include_once('header.php');
//
//$_SESSION['cart'] = array();

$getAllProductsSQL = "SELECT * FROM `Items`";
$results = mysqli_query($conn, $getAllProductsSQL);

if (empty($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_GET["item_id"]) && isset($_GET["quantity"])) {
    $id = $_GET["item_id"];
    $quantity = $_GET["quantity"];
    $_SESSION['cart'][$id] = $quantity;
//    print_r($_SESSION['cart']);


}


?>

<body>
<table class="table" style="max-width: 1800px; text-align: center; margin-left: 40px; margin-top: 40px">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity Needed</th>
        <th scope="col">Item Description</th>
    </tr>
    </thead>
    <tbody>
    <tr> <?php
        if (mysqli_num_rows($results) > 0) {
        while ($row = mysqli_fetch_assoc($results)) {
        ?>
        <form method="get" action="">
            <th scope='row'><?php echo $row["item_name"]; ?></th>
            <td><img src="<?php echo $row["item_image_location"]; ?>" height="42" width="42"></td>
            <td><?php echo "RS. " . $row["item_price"]; ?></td>
            <input type="hidden" id="item_id" name="item_id" value="<?php echo $row["id"]; ?>">
            <td>
                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                <input id="quantity" name="quantity" type="number" min="1" required>
            </td>
            <td><?php echo $row["item_description"]; ?></td>
            <td>
                <button type="submit" class="btn btn-danger">Add to cart</a></button>
            </td>
        </form>
    </tr>
    <?php
    }
    }
    ?>
    <tr>
        <th></th>
        <td></td>
        <td></td>
        <td></td>
        <td><?php
            if (!empty($_SESSION['cart'])) {
                echo "<b>" . count($_SESSION['cart']) . " Item/s added to the cart</b>";
                ?>
        </td>
        <td>
            <button class='btn btn-info' id='checkout' name='checkout' type='button'><a href='checkout.php'
                                                                                        style=' color: #FFFFFF; text-decoration: none;'>Checkout</a>
            </button>
            <?php } ?>
        </td>
    </tr>


    </tbody>
</table>
</body>

<?php

include_once('footer.php');

?>
