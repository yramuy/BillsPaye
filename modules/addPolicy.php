<?php require_once('../modules/header.php');

// Edit Data
if (isset($_GET['recordId'])) {
  $postId = $_GET['recordId'];
  $postQuery = "SELECT * FROM tbl_terms_conditions WHERE id = $postId";
  $postSql = mysqli_query($conn, $postQuery);
  $row = mysqli_fetch_assoc($postSql);
}

if (isset($_POST['btnPolicy'])) {

  $policy_title = $_POST['policy_title'];
  $policy_content = $_POST['policy_content'];
  $image_name = $_FILES['image']['name'];

  if ((isset($_GET['recordId']) && $_FILES['image']['name'] != '') || (!isset($_GET['recordId']) && $_FILES['image']['name'] != '')) {
    // Remove brackets and their contents
    $fileName = preg_replace('/\([^)]*\)/', '', $image_name);
    // Remove spaces
    $fileName1 = str_replace(' ', '', $fileName);
    $timeString = date("Y-m-d H:i:s");
    $timestamp = strtotime($timeString);
    $newFilename = $timestamp . "_" . $fileName1; // Appending timestamp to filename
  } else {
    $newFilename = $row['document'];
  }

  if ((isset($_GET['recordId']) && $_FILES['image']['name'] != '') || (!isset($_GET['recordId']) && $_FILES['image']['name'] != '')) {
    $targetDir = "../uploads/"; // Specify the target directory where you want to store the uploaded files
    $targetFile = $targetDir . basename($newFilename);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
  }

  if (isset($_GET['recordId'])) {
    $recordId = $_GET['recordId'];
    $updatesql = "UPDATE tbl_terms_conditions SET policy_title='$policy_title',policy_content='$policy_content',document='$newFilename' WHERE id = $recordId";
    if (mysqli_query($conn, $updatesql)) {
      $_SESSION['message'] = 'Policy Updated successfully!';
      echo '<script>
            window.location.href = "policy_list.php";

        </script>';
    } else {
      $_SESSION['message'] = 'Policy update failed!';
      echo '<script>
            window.location.href = "addPolicy.php?recordId=' . $recordId . '";

            </script>';
    }
  } else {
    $sql1 = "INSERT INTO tbl_terms_conditions (policy_title, policy_content, document) VALUES(?,?,?)";
    if ($stmt1 = mysqli_prepare($conn, $sql1)) {
      mysqli_stmt_bind_param($stmt1, "sss", $policy_title, $policy_content, $newFilename);

      if (mysqli_stmt_execute($stmt1)) {
        $_SESSION['message'] = 'Policy saved successfully!';
        // Redirect to another page
        echo '<script>
            window.location.href = "policy_list.php";
            </script>';
      } else {
        $_SESSION['message'] = 'Policy save failed!';
        // Redirect to another page
        echo '<script>
            window.location.href = "addPolicy.php";
            </script>';
      }
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
          <h1 class="m-0">Add Policy</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Policy</li>
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
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Add Policy</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="post" id="exciting_offer" enctype="multipart/form-data">
          <div class="card-body">


            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Title <em class="star">*</em></label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="policy_title" name="policy_title" placeholder="Policy Title" value="<?php echo isset($_GET['recordId']) ? $row['policy_title'] : ""; ?>" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Content</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="policy_content" name="policy_content" row="4"><?php echo isset($_GET['recordId']) ? $row['policy_content'] : ""; ?></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Document</label>
              <div class="col-sm-10">
                <input type="file" name="image" id="image">
                <?php if (isset($_GET['recordId'])) {
                  $targetDir = "../uploads/" . $row['document'];
                ?>
                  <p class="mb-2"></p>
                  <a href="<?php echo $targetDir; ?>"><?php echo $row['document']; ?></a>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-info" name="btnPolicy">Save</button>
            <a type="submit" class="btn btn-default" href="policy_list.php">Cancel</a>
          </div>
          <!-- /.card-footer -->
        </form>
      </div>
      <!-- /.card -->
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?php require_once('../modules/footer.php'); ?>
