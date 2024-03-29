<?php require_once('../modules/header.php');
$catTable = 'tbl_categories';
$sql = "SELECT * FROM $catTable";
$result = mysqli_query($conn, $sql);
$screen = 'categoryList.php';

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Category List</li>
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

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Category List</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <a class="btn btn-primary float-right" href="category.php">Add Category</a>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SNo</th>
                                <th>Category Id</th>
                                <th>Category Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                $sno = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <tr>
                                        <td>
                                            <?php echo $sno; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td>
                                            <a href="category.php?id=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-danger" onClick="deleteItem('<?php echo $row['id']; ?>','<?php echo $catTable; ?>','<?php echo $screen;?>')"><i class="fas fa-trash"></i></a>
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