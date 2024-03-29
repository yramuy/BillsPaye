<?php require_once('../modules/header.php'); 

$table_name = 'tbl_user';
$screen = 'clients.php';

$sql = "SELECT u.*,c.name as category,sc.sub_category_name,s.name as state,ci.city FROM $table_name u 
LEFT JOIN tbl_categories c ON u.cat_id = c.id
LEFT JOIN tbl_sub_categories sc ON u.sub_cat_id = sc.id
LEFT JOIN states s ON u.state_id = s.id
LEFT JOIN cities ci ON u.city_id = ci.id WHERE u.user_role_id = 3 ORDER BY u.id DESC";
$result = mysqli_query($conn, $sql);

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Clients</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Clients</li>
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
                    <h3 class="card-title">Clients</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a class="btn btn-primary float-right" href="addClient.php">Add Client</a>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Client Name</th>
                                <!-- <th>Email</th> -->
                                <!-- <th>Mobile Number</th> -->
                                <!-- <th>City</th> -->
                                <th>Address</th>
                                <th>Business Category</th>
                                <th>Business Name</th>
                                <th>Actions</th>
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
                                        <!-- <td><?php //echo $row['email']; ?></td> -->
                                        <!-- <td><?php //echo $row['mobile_number']; ?></td> -->
                                        <!-- <td><?php //echo $row['city']; ?></td> -->
                                        <td><?php echo $row['address']; ?></td>
                                        <td><?php echo $row['category']; ?></td>
                                        <td><?php echo $row['sub_category_name']; ?></td>
                                        <td>
                                            <a href="addClient.php?userId=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
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