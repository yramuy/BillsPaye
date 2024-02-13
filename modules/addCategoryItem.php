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
                    <h1 class="m-0">Category Item</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Category Item</li>
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
                    <h3 class="card-title">Add Category Item</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="category_item" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Category <em
                                    class="star">*</em></label>
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
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Item Name <em
                                    class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="item_name" name="item_name"
                                    placeholder="Category Item">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Image<em
                                    class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="file" name="file" id="file">
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