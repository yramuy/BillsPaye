<?php require_once('../modules/header.php');

// Edit Data
if (isset($_GET['recordId'])) {
    $offerId = $_GET['recordId'];
    $offerQuery = "SELECT * FROM tbl_offers WHERE id = $offerId";
    $offerSql = mysqli_query($conn, $offerQuery);
    $row = mysqli_fetch_assoc($offerSql);
}

if (isset($_POST['btnExcitingOffer'])) {

    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $offer_title = $_POST['offer_title'];
    $offer = $_POST['offer'];
    $description = $_POST['description'];
    $image_name = $_FILES['image']['name'];
    $created_by = $_SESSION['user_id'];
    $created_on = date("Y-m-d H:i:s");


    if ((isset($_GET['recordId']) && $_FILES['image']['name'] != '') || (!isset($_GET['recordId']) && $_FILES['image']['name'] != '')) {
        // Remove brackets and their contents
        $fileName = preg_replace('/\([^)]*\)/', '', $image_name);
        // Remove spaces
        $fileName1 = str_replace(' ', '', $fileName);
        $timeString = date("Y-m-d H:i:s");
        $timestamp = strtotime($timeString);
        $newFilename = $timestamp . "_" . $fileName1; // Appending timestamp to filename
    } else {
        $newFilename = $row['image_name'];
    }

    if ((isset($_GET['recordId']) && $_FILES['image']['name'] != '') || (!isset($_GET['recordId']) && $_FILES['image']['name'] != '')) {
        $targetDir = "../uploads/"; // Specify the target directory where you want to store the uploaded files
        $targetFile = $targetDir . basename($newFilename);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    }

    if (isset($_GET['recordId'])) {
        $recordId = $_GET['recordId'];
        $updatesql = "UPDATE tbl_offers SET cat_id='$category',sub_cat_id='$subcategory',offer_title='$offer_title',offer='$offer',offer_description='$description',image_name='$newFilename' WHERE id = $recordId";
        if (mysqli_query($conn, $updatesql)) {
            $_SESSION['message'] = 'Offer Updated successfully!';
            echo '<script>
            window.location.href = "mostExcitingOffers.php";  
                   
        </script>';
        } else {
            $_SESSION['message'] = 'Offer update failed!';
            echo '<script>
            window.location.href = "addExcitingOffers.php?recordId=' . $recordId . '";  
                       
            </script>';
        }
    } else {
        $sql1 = "INSERT INTO tbl_offers (cat_id, sub_cat_id, offer_title, offer, offer_description, image_name, created_by, created_on) VALUES(?,?,?,?,?,?,?,?)";
        if ($stmt1 = mysqli_prepare($conn, $sql1)) {
            mysqli_stmt_bind_param($stmt1, "iissssis", $category, $subcategory, $offer_title, $offer, $description, $newFilename, $created_by, $created_on);

            if (mysqli_stmt_execute($stmt1)) {

                $_SESSION['message'] = 'Offer saved successfully!';
                // Redirect to another page
                echo '<script>
            window.location.href = "mostExcitingOffers.php";       
            </script>';
            } else {
                $_SESSION['message'] = 'Offer save failed!';
                // Redirect to another page
                echo '<script>
            window.location.href = "addExcitingOffers.php";       
            </script>';
            }
        }
    }
}

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Offer</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Offers</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <!-- /.card -->
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add Offer</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="exciting_offer" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Category <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="category" name="category">
                                    <option value="">--Select--</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Subcategory <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="subcategory" name="subcategory">
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Offer Title <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="offer_title" name="offer_title" placeholder="Offer Title" value="<?php echo isset($_GET['recordId']) ? $row['offer_title'] : ""; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Offer(%)<em class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="offer" name="offer" placeholder="Offer" value="<?php echo isset($_GET['recordId']) ? $row['offer'] : ""; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Description <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" row="4"><?php echo isset($_GET['recordId']) ? $row['offer_description'] : ""; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Offer Image<em class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="file" name="image" id="image" accept="image/*" multiple <?php echo isset($_GET['recordId']) ? "" : 'required'; ?>>
                                <?php if (isset($_GET['recordId'])) {
                                    $targetDir = "../uploads/" . $row['image_name'];
                                ?>
                                    <p class="mb-2"></p>
                                    <img src="<?php echo $targetDir; ?>" alt="Image" width="200px" height="150px">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info" name="btnExcitingOffer">Save</button>
                        <a type="submit" class="btn btn-default" href="mostExcitingOffers.php">Cancel</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php require_once('../modules/footer.php'); ?>