<?php require_once('../modules/header.php'); ?>

<?php

require_once('../modules/database.php');

if (isset($_POST['btnCategory'])) {
    $category = $_POST['category'];

    $sql = "INSERT INTO tbl_categories (name) VALUES(?)";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $category);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect to another page
            echo '<script>
            window.location.href = "categoryList.php";
            alert("Category saved successfully!");            
                       
            </script>';
            // header("Location: categoryList.php");
            // exit;
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
                    <h1 class="m-0">Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
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
                    <h3 class="card-title">Add Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="category_form">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name <em
                                    class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="category" name="category"
                                    placeholder="Category">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info" name="btnCategory">Save</button>
                        <a type="submit" class="btn btn-default" href="categoryList.php">Cancel</a>
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