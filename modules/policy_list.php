<?php require_once('../modules/header.php');

$table_name = 'tbl_terms_conditions';
$screen = 'policy_list.php';

$sql = "SELECT * FROM $table_name";
$result = mysqli_query($conn, $sql);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Policy List</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Policy List</li>
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
          <h3 class="card-title">Policy List</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <a class="btn btn-primary float-right" href="addPolicy.php">Add Policy</a>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SNo</th>
                <th>Policy Title</th>
                <!-- <th>Policy Content</th> -->
                <th>Document Name</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
            <?php
              if (mysqli_num_rows($result) > 0) {
                $sno = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                  // Path to the image file
                  $targetDir = "../uploads/" . $row['document']; // Update this with the actual path to your image file
              ?>
                  <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $row['policy_title']; ?></td>
                    <!-- <td><?php //echo $row['policy_content']; ?></td> -->
                    <td><a href="<?php echo $targetDir; ?>"><?php echo $row['document']; ?></a></td>
                    <td>
                      <a href="addPolicy.php?recordId=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
                      <a href="javascript:void(0)" class="btn btn-danger" onClick="deleteItem('<?php echo $row['id']; ?>','<?php echo $table_name; ?>','<?php echo $screen; ?>')"><i class="fas fa-trash"></i></a>
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
