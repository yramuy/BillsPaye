<?php

require_once('../modules/database.php');

$cateSql = "SELECT * FROM tbl_categories";
$result = mysqli_query($conn, $cateSql);

if (isset($_POST['btnItem'])) {

    $category = $_POST['category'];
    $item_name = $_POST['item_name'];
    $image_type = $_FILES['file']['type'];
    $image_name = $_FILES['file']['name'];

    $sql1 = "INSERT INTO tbl_category_items (category_id, item_name, file_name, file_type) VALUES(?,?,?,?)";

    if ($stmt1 = mysqli_prepare($conn, $sql1)) {
        mysqli_stmt_bind_param($stmt1, "isss", $category, $item_name, $image_name, $image_type);



        if (mysqli_stmt_execute($stmt1)) {

            if ($image_name) {
                $targetDir = "../uploads/"; // Specify the target directory where you want to store the uploaded files
                $targetFile = $targetDir . basename($_FILES["file"]["name"]);
                move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
            }


            // Redirect to another page
            echo '<script>
            window.location.href = "categoryItems.php";
            alert("Category Item saved successfully!");            
                       
            </script>';
            // header("Location: categoryList.php");
            // exit;
        }
    }
}

?>
<?php require_once('../modules/header.php'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subcategory</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Subcategory</li>
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
                    <h3 class="card-title">Add Subcategory</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="category_item" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Category <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="category" name="category">
                                    <option value="">--Select--</option>
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['name']; ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Subcategory <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Subcategory">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">State <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="state" name="state">
                                    <option value="">--Select--</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">City <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <select class="form-control" id="city" name="city">
                                    <option value="">--Select--</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Address <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="address" name="address" row="4" placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Distance <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="distance" name="distance" placeholder="Distance">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Rating</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="rating" name="rating" placeholder="Rating">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Description <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" row="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Image<em class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="file" name="file" id="file" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info" name="btnItem">Save</button>
                        <a type="submit" class="btn btn-default" href="categoryItems.php">Cancel</a>
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
