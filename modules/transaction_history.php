<?php require_once('../modules/header.php');

$user_role_id = $_SESSION['user_role_id'];
$sub_cat_id = $_SESSION['sub_cat_id'];

$query = "SELECT t.*,u.user_name,sc.sub_category_name,date(t.transaction_date) as tDate FROM tbl_transactions t
        LEFT JOIN tbl_user u ON t.transaction_by = u.id
        LEFT JOIN tbl_sub_categories sc ON t.transaction_to = sc.id ";
if ($user_role_id == 3) {
  $query .= "WHERE t.transaction_to = '$sub_cat_id' ";
}
$query .= "ORDER BY t.id DESC";
$result = mysqli_query($conn, $query);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Transaction History</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Transaction History</li>
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
          <h3 class="card-title">Transaction History</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SNo</th>
                <th>Transaction ID</th>
                <th>Transaction By</th>
                <th>Transaction To</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($result) > 0) {
                $sno = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                  if ($row['status'] == 1) {
                    $status = 'Settelment Pending';
                    $color = 'color:darkgoldenrod; font-weight: bold;';
                  } else if ($row['status'] == 2) {
                    $status = 'Settelment Completed';
                    $color = 'color:#0eff0e; font-weight: bold;';
                  } else {
                    $status = '';
                  }

              ?>
                  <tr>
                    <td><?php echo $sno; ?></td>
                    <td><?php echo $row['transaction_id']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['sub_category_name']; ?></td>
                    <td><?php echo $row['transaction_amount']; ?></td>
                    <td><?php echo $row['tDate']; ?></td>
                    <td style="<?php echo $color; ?>"><?php echo $status; ?></td>


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
