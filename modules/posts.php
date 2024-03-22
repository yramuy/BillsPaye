<?php require_once('../modules/header.php');

$table_name = 'tbl_posts';
$screen = 'posts.php';

$user_role_id = $_SESSION['user_role_id'];
$cat_id = $_SESSION['cat_id'];
$sub_cat_id = $_SESSION['sub_cat_id'];

$sql = "SELECT p.*,c.name as category,sc.sub_category_name as subcategory FROM $table_name p
LEFT JOIN tbl_categories c ON p.cat_id = c.id
LEFT JOIN tbl_sub_categories sc ON p.sub_cat_id = sc.id ";
if($user_role_id == 3) {
  $sql .= "WHERE p.cat_id = '$cat_id' AND p.sub_cat_id = '$sub_cat_id' ";
}
$sql .= "ORDER BY p.id DESC";
$result = mysqli_query($conn, $sql);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Posts</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Posts</li>
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
          <h3 class="card-title">Posts</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <a class="btn btn-primary float-right" href="addPost.php">Add Post</a>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>SNo</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Post Title</th>
                <th>Post Description</th>
                <th>Image</th>
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
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['subcategory']; ?></td>
                    <td><?php echo $row['post_title']; ?></td>
                    <td><?php echo $row['post_description']; ?></td>
                    <td><img src="<?php echo $imagePath; ?>" alt="" style="width: 100px; height: 50px"></td>
                    <td>
                      <a href="addPost.php?recordId=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
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
