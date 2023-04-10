<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <script src="accounts.js" async></script>

    <title>Kira Makan</title>

</head>

<body>

    <?php
    session_start();
    include '../includes/connection.inc.php';
    ?>

    <div class="row d-flex">

        <?php include 'sidebar.php'; ?>

        <div class="col-md-10 d-flex flex-row mt-4">
            <div class="col-md-4 m-4">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="row m-0 d-flex justify-content-center align-items-center">
                            <div class="col-12 d-flex justify-content-center align-items-center mb-3">
                                <h3 class="fw-bold">Add Menu Item</h3>
                            </div>
                            <div class="col-12 d-flex justify-content-center align-items-center mb-1">
                                <p class=" mb-3">Please enter item details</p>
                            </div>
                            <form action="../includes/admin/manageMenu.inc.php" method="post"
                                enctype="multipart/form-data" novalidate class="col-12 row g-4 m-0">
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <label for="resName">Restaurant Name</label>
                                        <select class="form-select" aria-label=".form-select-sm" id="resID"
                                            name="resID">
                                            <?php
                                            $sql = "SELECT * FROM restaurants";
                                            $result = mysqli_query($conn, $sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . $row["restaurantID"] . '">' . $row["restaurantName"] . '</option>
                                                    <input type="hidden" id="resName" name="resName" value="' . $row["restaurantName"] . '">';
                                                }
                                            } else {
                                                echo '<option value="0">No restaurants found</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="itemName" name="itemName"
                                            placeholder="Item Name" required autocomplete="off">
                                        <label for="itemName">Item Name</label>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <label for="category">Category</label>
                                        <select class="form-select" aria-label=".form-select-sm" id="category"
                                            name="category">
                                            <option value="Meals">Meals</option>
                                            <option value="Drinks">Drinks</option>
                                            <option value="Desserts">Desserts</option>
                                            <option value="Add-Ons">Add-Ons</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="itemDesc" name="itemDesc"
                                            placeholder="Item Description" required autocomplete="off">
                                        <label for="itemDesc">Item Description</label>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                                <div class="col-10 px-5">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="itemPrice" name="itemPrice"
                                            placeholder="Price" required autocomplete="off">
                                        <label for="itemPrice">Price</label>
                                    </div>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-1"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-12 d-flex justify-content-between my-2">
                            <label class="btn secondary-btn btn-b mx-auto px-3 d-block fs-5" for="itemImage">
                                Upload Image
                                <input type="file" id="itemImage" name="itemImage" accept="image/*" required
                                    style="display: none;">
                            </label>
                            <button type="submit" class="btn orange-btn btn-b mx-auto px-3 d-block fs-5"
                                name="addItemSubmit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>