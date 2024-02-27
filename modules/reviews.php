<?php require_once('../modules/header.php');

$sql = "SELECT r.*,c.name as category,sc.sub_category_name,u.user_name FROM tbl_reviews r 
LEFT JOIN tbl_categories c ON r.cat_id = c.id
LEFT JOIN tbl_sub_categories sc ON r.sub_cat_id = sc.id
LEFT JOIN tbl_user u ON u.id = r.user_id ORDER BY r.id DESC";
$result = mysqli_query($conn, $sql);

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reviews</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reviews</li>
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
                    <h3 class="card-title">Reviews</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>User</th>
                                <th>Rating</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $sno = 1;
                                while ($row = mysqli_fetch_assoc($result)) {?>
                                    <tr>
                                        <td><?php echo $sno; ?></td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td><?php echo $row['sub_category_name']; ?></td>
                                        <td><?php echo $row['user_name']; ?></td>
                                        <td><?php echo $row['rating']; ?></td>
                                        <td><?php echo $row['created_on']; ?></td>

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