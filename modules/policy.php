<?php require_once('../modules/header.php');

// Edit Data
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $postQuery = "SELECT * FROM tbl_terms_conditions WHERE id = $id";
  $postSql = mysqli_query($conn, $postQuery);
  $row = mysqli_fetch_assoc($postSql);
}

?>


<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <!-- /.card -->
      <!-- Horizontal Form -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title"><?php echo $row['policy_title']; ?></h3>
        </div>
        <!-- /.card-header -->
        
          <div class="card-body">
            <?php echo $row['policy_content'] != "" ? $row['policy_content'] : "No Content"; ?>           
            
          </div>
          
      </div>
      <!-- /.card -->
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php require_once('../modules/footer.php'); ?>
