<?php require_once('../modules/header.php');

$table_name = 'tbl_sub_categories';
$screen = 'categoryItems.php';

$sql = "SELECT ci.*,c.name as category FROM $table_name ci LEFT JOIN tbl_categories c ON ci.category_id = c.id ORDER BY ci.id DESC";
$result = mysqli_query($conn, $sql);


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Subcategories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Subcategories</li>
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
                    <h3 class="card-title">Subcategories</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a class="btn btn-primary float-right" href="addCategoryItem.php">Add Subcategory</a>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Address</th>
                                <th>Distance</th>
                                <th>Rating</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $sno = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Path to the image file
                                    $imagePath = "../uploads/" . $row['file_name']; // Update this with the actual path to your image file

                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $sno; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['category']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sub_category_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sub_cat_address']; ?>
                                        </td>

                                        <td>
                                            <?php echo $row['distance']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['rating']; ?>
                                        </td>

                                        <td><img src="<?php echo $imagePath; ?>" alt="" style="width: 100px; height: 50px"></td>
                                        <td>
                                            <a href="addCategoryItem.php?subCatId=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger" onClick="deleteItem('<?php echo $row['id']; ?>','<?php echo $table_name; ?>','<?php echo $screen;?>')"><i class="fas fa-trash"></i></a>
                                        </td>

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