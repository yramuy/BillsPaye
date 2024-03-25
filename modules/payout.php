<?php
require_once('../modules/header.php');

$query = "SELECT t.*,u.user_name,sc.sub_category_name,date(t.transaction_date) as tDate FROM tbl_transactions t
        LEFT JOIN tbl_user u ON t.transaction_by = u.id
        LEFT JOIN tbl_sub_categories sc ON t.transaction_to = sc.id
        ORDER BY t.id DESC";
$result = mysqli_query($conn, $query);

if (isset($_POST['btnPayout'])) {

  $subcategory = $_POST['subcategory'];
  $from_date = $_POST['from_date'];
  $to_date = $_POST['to_date'];
  $payment_cnt = $_POST['payment_cnt'];
  $total_cus_payable = $_POST['total_cus_payable'];
  $service_fees = $_POST['service_fees'];
  $sub_total = $_POST['sub_total'];
  $created_by = $_SESSION['user_id'];
  $created_on = date('Y-m-d');
  $status = 2;

  $tranQuery = "SELECT * FROM tbl_transactions WHERE transaction_to = '$subcategory'
  AND (date(transaction_date) >= '$from_date' AND date(transaction_date) <= '$to_date') AND status = 1";
  $sql = mysqli_query($conn, $tranQuery);

  if (mysqli_num_rows($sql) > 0) {
    while ($row = mysqli_fetch_assoc($sql)) {
      $id = $row['id'];
      $updateQuery = "UPDATE tbl_transactions SET status = '2' WHERE id = '$id'";
      $result = mysqli_query($conn, $updateQuery);
    }

    $output = array();
    $query = "INSERT INTO tbl_payouts(sub_cat_id,from_date,to_date,total_customer_payable,total_service_fees,payment_cnt,sub_total,created_by,created_on,status) VALUES(?,?,?,?,?,?,?,?,?,?)";
    if ($stmt = mysqli_prepare($conn, $query)) {
      mysqli_stmt_bind_param($stmt, "issssisisi", $subcategory, $from_date, $to_date, $total_cus_payable, $service_fees, $payment_cnt, $sub_total, $created_by, $created_on, $status);
      if (mysqli_stmt_execute($stmt)) {
        $output['$status'] = 1;
        $output['message'] = "Payout saved successfully";
      } else {
        $output['$status'] = 0;
        $output['message'] = "Payout save failed";
      }
    } else {
      $output['$status'] = 0;
      $output['message'] = "Failed to prepare payout query";
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
          <h1 class="m-0">Payout</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Payout</li>
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
          <h3 class="card-title">Payout</h3>
        </div>
        <!-- /.card-header -->
        <form class="form-horizontal" method="post" id="payout">
          <div class="card-body">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Business Category</label>
              <div class="col-sm-4">
                <select class="form-control" id="category" name="category">
                  <option value="">--Select--</option>
                </select>
              </div>
              <label for="inputEmail3" class="col-sm-2 col-form-label">Business Name</label>
              <div class="col-sm-4">
                <select class="form-control" id="subcategory" name="subcategory">
                  <option value="">--Select--</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">From Date</label>
              <div class="col-sm-4">
                <input type="date" class="form-control" id="from_date" name="from_date">

              </div>
              <label for="inputEmail3" class="col-sm-2 col-form-label">To Date</label>
              <div class="col-sm-4">
                <input type="date" class="form-control" id="to_date" name="to_date">

              </div>
            </div>
            <table id="example1" class="table table-bordered table-striped">
              <tbody>

                <tr>
                  <input type="hidden" class="form-control" id="payment_cnt" name="payment_cnt" value="">

                  <td style="font-weight:bold">Payments - <span id="payments"></span></td>
                  <td style="font-weight:bold">Status - <span style="color:darkgoldenrod;" id="payout_status"></span></td>
                </tr>
                <tr>
                  <td>Total Customer Payable</td>
                  <td>
                    <div class="input-group-prepend">
                      <span class="input-group-text">₹</span>
                      <input type="text" class="form-control" id="total_cus_payable" name="total_cus_payable" placeholder="Total Customer Payable" value="" style="width: 13em;" readonly>

                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Total Service Fees</td>
                  <td>
                    <div class="input-group-prepend">
                      <span class="input-group-text">₹</span>
                      <input type="number" class="form-control" id="service_fees" name="service_fees" placeholder="Enter Service Fees" value="" style="width: 13em;" required>

                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Subtotal</td>
                  <td>
                    <div class="input-group-prepend">
                      <span class="input-group-text">₹</span>
                      <input type="text" class="form-control" id="sub_total" name="sub_total" placeholder="Subtotal amount" value="" style="width: 13em;" readonly>
                    </div>
                  </td>
          </div>
          </tr>

          <tr>
            <td></td>
            <td>
              <button type="submit" class="btn btn-info" name="btnPayout">Save</button>
              <button type="button" class="btn btn-default" href="menus.php">Cancel</button>
            </td>
          </tr>
        </form>
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
