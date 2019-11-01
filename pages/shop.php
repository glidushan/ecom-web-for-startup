<?php

session_start();

require_once "database.php";

$pageTitle = "Store";

function customPageHeader()
{
    ?>
    <link rel="stylesheet" href="../stylesheets/shop.css">
    </head>
<?php }

include_once('header.php');

$owner_id = $_SESSION["owner_id"];

$storeID = 0;

$storeIdSQL = "SELECT id FROM `Stores` WHERE owner_id='$owner_id'";
$results = mysqli_query($conn, $storeIdSQL);
if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_assoc($results)) {
        $storeID = $row["id"];
    }
}

$getItemsSQL = "SELECT * FROM `Items` WHERE store_id='$storeID'";
$itemResults = mysqli_query($conn, $getItemsSQL);

if(isset($_POST["inputItemName"]) && isset($_POST["inputItemCount"]) && isset($_POST["inputItemImageURL"]) && isset($_POST["inputDescription"])) {
    $name = $_POST["inputItemName"];
    $count= $_POST["inputItemCount"];
    $price = $_POST["inputItemPrice"];
    $URL = $_POST["inputItemImageURL"];
    $description = $_POST["inputDescription"];

    $insertItemSQL = "INSERT INTO `Items` (store_id, item_name, item_count, item_price, item_image_location, item_description) VALUES ('$storeID', '$name', '$count', '$price', '$URL', '$description')";

    mysqli_query($conn, $insertItemSQL);

    header("refresh: 0;");
}

if(isset($_GET["itemID"])) {
    $itemID = $_GET["itemID"];
    $deleteSQL = "DELETE FROM `Items` WHERE id='$itemID'";
    mysqli_query($conn, $deleteSQL);
//    unset($_GET["itemID"]);
    header("Location: shop.php");

}

?>

<body>

<form action="" method="post" class="container shop">
    <div class="form-group row">
        <label for="inputItemName" class="col-sm-2 col-form-label">Item Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputItemName" name="inputItemName" placeholder="Anchor" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputItemCount" class="col-sm-2 col-form-label">Item Count</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="inputItemCount" name="inputItemCount" placeholder="20" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputItemPrice" class="col-sm-2 col-form-label">Item Price</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="inputItemPrice" name="inputItemPrice" placeholder="500" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputItemImageURL" class="col-sm-2 col-form-label">Image URL</label>
        <div class="col-sm-10">
            <input type="url" class="form-control" id="inputItemImageURL" name="inputItemImageURL"
                   placeholder="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputDescription" class="col-sm-2 col-form-label">Item Description</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="inputDescription" name="inputDescription" placeholder="Fresh Milk" required>
        </div>
    </div>
    <div class="form-group row">
        <button type="submit" class="btn btn-primary mb-2">Add</button>
    </div>
</form>

<table class="table container" >
    <thead class="thead-dark">
    <tr>
        <th scope="col">Item Name</th>
        <th scope="col">Item Price</th>
        <th scope="col">Item Count</th>
        <th scope="col">Image</th>
        <th scope="col">Item Description</th>
    </tr>
    </thead>
    <tbody>
    <tr<?php
    if (mysqli_num_rows($itemResults) > 0) {
    while ($row = mysqli_fetch_assoc($itemResults)) {
        ?>
        ><th scope='row'><?php echo $row["item_name"]; ?></th>
        <td><?php echo "RS. " . $row["item_price"]; ?></td>
        <td><?php echo $row["item_count"]; ?></td>
        <td><img src="<?php echo $row["item_image_location"]; ?>" height="42" width="42"></td>
        <td><?php echo $row["item_description"]; ?></td>
        <td><button type="button" class="btn btn-danger"><a style="color: inherit" href='shop.php?itemID=<?php echo $row["id"]; ?>'>Remove</a></button></td>
    </tr>
    <?php
    }
    }
    ?>


    </tbody>
</table>


</body>
