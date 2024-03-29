<?php require_once('../modules/header.php');

$sql = "SELECT u.*,c.name as category,sc.sub_category_name,s.name as state,ci.city FROM tbl_user u 
LEFT JOIN tbl_categories c ON u.cat_id = c.id
LEFT JOIN tbl_sub_categories sc ON u.sub_cat_id = sc.id
LEFT JOIN states s ON u.state_id = s.id
LEFT JOIN cities ci ON u.city_id = ci.id WHERE u.user_role_id = 2 ORDER BY u.id DESC";
$result = mysqli_query($conn, $sql);

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
            <!-- <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Category List</h3>
                </div>               
                
            </div> -->
            <!-- /.card -->

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- <a class="btn btn-primary float-right" href="addClient.php">Add Client</a> -->
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $sno = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Path to the image file
                                    $imagePath = "../uploads/" . $row['image_name']; // Update this with the actual path to your image file
                            ?>
                                    <tr>
                                        <td><?php echo $sno; ?></td>
                                        <td><?php echo $row['user_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['mobile_number']; ?></td>
                                        <td><?php echo $row['state']; ?></td>
                                        <td><?php echo $row['city']; ?></td>
                                        <td><?php echo $row['address']; ?></td>

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