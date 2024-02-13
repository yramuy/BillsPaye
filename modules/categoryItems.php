<?php require_once('../modules/header.php'); ?>

<?php

require_once('../modules/database.php');

$sql = "SELECT ci.*,c.name as category FROM tbl_category_items ci LEFT JOIN tbl_categories c ON ci.category_id = c.id";
$result = mysqli_query($conn, $sql);


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category Items</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Category Items</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Category Items</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a class="btn btn-primary float-right" href="addCategoryItem.php">Add Category Item</a>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Category</th>
                                <th>Item Name</th>
                                <th>Image Name</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $sno = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Path to the image file
                                    $imagePath = "../uploads/".$row['file_name']; // Update this with the actual path to your image file
                            
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $sno; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['category']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['item_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['file_name']; ?>
                                        </td>
                                        <td><img src="<?php echo $imagePath; ?>" alt="" style="width: 100px; height: 50px"></td>

                                    </tr>
                                    <?php $sno++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php require_once('../modules/footer.php'); ?>