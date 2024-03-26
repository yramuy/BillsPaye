<?php
require_once('../modules/header.php');

$query = "SELECT t.*,u.user_name,sc.sub_category_name,date(t.transaction_date) as tDate FROM tbl_transactions t
        LEFT JOIN tbl_user u ON t.transaction_by = u.id
        LEFT JOIN tbl_sub_categories sc ON t.transaction_to = sc.id
        ORDER BY t.id DESC";
$result = mysqli_query($conn, $query);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Payout History</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Payout History</li>
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
          <h3 class="card-title">Payout History</h3>
        </div>
        <!-- /.card-header -->
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
            <thead>
              <tr>
                <th>SNo</th>
                <th>Client Name</th>
                <th>From date</th>
                <th>To Date</th>
                <th>Customer Payable</th>
                <th>Service Charges</th>
                <th>Subtotal</th>
                <th>Paid On</th>
                <th>Status</th>
                <th>Annexure</th>
                <th>Tax Invoce</th>
              </tr>
            </thead>
            <tbody id="payout_body"></tbody>
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
