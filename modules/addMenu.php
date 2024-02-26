<?php require_once('../modules/header.php');

// Edit Data
if (isset($_GET['recordId'])) {
    $menuId = $_GET['recordId'];
    $menuQuery = "SELECT * FROM tbl_menus WHERE id = $menuId";
    $menuSql = mysqli_query($conn, $menuQuery);
    $row = mysqli_fetch_assoc($menuSql);
}



if (isset($_POST['btnMenu'])) {

    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $menu_name = $_POST['menu_title'];
    $description = $_POST['description'];
    $image_name = $_FILES['image']['name'];
    $created_by = $_SESSION['user_id'];
    $created_on = date("Y-m-d H:i:s");
    // Remove brackets and their contents
    $fileName = preg_replace('/\([^)]*\)/', '', $image_name);
    // Remove spaces
    $fileName1 = str_replace(' ', '', $fileName);
    $timeString = date("Y-m-d H:i:s");
    $timestamp = strtotime($timeString);
    $newFilename = $timestamp . "_" . $fileName1; // Appending timestamp to filename

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
        $updatesql = "UPDATE tbl_menus SET cat_id='$category',sub_cat_id='$subcategory',menu_name='$menu_name',menu_description='$description',image_name='$newFilename' WHERE id = $recordId";
        if (mysqli_query($conn, $updatesql)) {
            $_SESSION['message'] = 'Menu Updated successfully!';
            echo '<script>
            window.location.href = "menus.php";  
                   
        </script>';
        } else {
            $_SESSION['message'] = 'Menu update failed!';
            echo '<script>
            window.location.href = "addMenu.php?recordId=' . $recordId . '";  
                       
            </script>';
        }
    } else {
        $sql1 = "INSERT INTO tbl_menus (cat_id, sub_cat_id, menu_name, menu_description, image_name, created_by, created_on) VALUES(?,?,?,?,?,?,?)";
        if ($stmt1 = mysqli_prepare($conn, $sql1)) {
            mysqli_stmt_bind_param($stmt1, "iisssis", $category, $subcategory, $menu_name, $description, $newFilename, $created_by, $created_on);

            if (mysqli_stmt_execute($stmt1)) {
                $_SESSION['message'] = 'Menu saved successfully!';
                // Redirect to another page
                echo '<script>
            window.location.href = "menus.php";        
            </script>';
            } else {
                $_SESSION['message'] = 'Menu save failed!';
                // Redirect to another page
                echo '<script>
            window.location.href = "addMenu.php";        
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
                    <h1 class="m-0">Add Menu</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Menu</li>
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
                    <h3 class="card-title">Add Menu</h3>
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
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Menu Title <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="menu_title" name="menu_title" placeholder="Menu Title" value="<?php echo isset($_GET['recordId']) ? $row['menu_name'] : ""; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Description <em class="star">*</em></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" name="description" row="4"><?php echo isset($_GET['recordId']) ? $row['menu_description'] : ""; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Menu Image<em class="star">*</em></label>
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
                        <button type="submit" class="btn btn-info" name="btnMenu">Save</button>
                        <a type="submit" class="btn btn-default" href="menus.php">Cancel</a>
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