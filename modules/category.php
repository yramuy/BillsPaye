<?php require_once('../modules/header.php');

// Edit Data
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tbl_categories WHERE id = $id";
    $sql = mysqli_query($conn, $query);
    $catRow = mysqli_fetch_assoc($sql);
}

// save category
if (isset($_POST['btnCategory'])) {

    $category = $_POST['category'];

    // Update Category
    if (isset($_GET['id'])) {
        $catId = $_GET['id'];
        $updatesql ="UPDATE tbl_categories SET name='$category' WHERE id = $catId";
        if (mysqli_query($conn, $updatesql)) {
            $_SESSION['message'] = 'Category Updated successfully!';
            echo '<script>
            window.location.href = "categoryList.php";  
                   
        </script>';
        } else {
            $_SESSION['message'] = 'Category update failed!';
            echo '<script>
            window.location.href = "category.php?id='.$catId.'";  
                       
            </script>';
        }
    } else {
        // Insert Category
        $sql = "INSERT INTO tbl_categories (name) VALUES(?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $category);

            if (mysqli_stmt_execute($stmt)) {
                // Redirect to another page
                $_SESSION['message'] = 'Category saved successfully!';
                echo '<script>
                window.location.href = "categoryList.php";  
                       
            </script>';
            } else {
                $_SESSION['message'] = 'Category save failed!';
                echo '<script>
                window.location.href = "category.php";  
                       
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
                    <h3 class="card-title"><?php echo isset($_GET['id']) ? "Edit" : "Add"; ?> Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="category_form">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Name <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="category" name="category" value="<?php echo isset($_GET['id']) ? $catRow['name'] : ""; ?>" placeholder="Category">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info" name="btnCategory"><?php echo isset($_GET['id']) ? "Update" : "Save"; ?></button>
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