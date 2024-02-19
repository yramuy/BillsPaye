<?php require_once('../modules/header.php'); ?>

<?php require_once('../modules/database.php');

if (isset($_POST['btnClient'])) {

    $user_name = $_POST['first_name'] . ' ' . $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $client_address = $_POST['client_address'];
    $pincode = $_POST['pincode'];
    $gst_number = $_POST['gst_number'];
    $image_name = $_FILES['image']['name'];
    $created_by = $_SESSION['user_id'];
    $created_on = date("Y-m-d H:i:s");
    $roleId = 3;
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    // Remove brackets and their contents
    $fileName = preg_replace('/\([^)]*\)/', '', $image_name);
    // Remove spaces
    $fileName1 = str_replace(' ', '', $fileName);

    $timeString = date("Y-m-d H:i:s");
    $timestamp = strtotime($timeString);

    $newFilename = $timestamp . "_" . $fileName1; // Appending timestamp to filename

    // echo $newFilename;die; // Output: "2024-02-14-12-30-45_example.txt"

    $sql1 = "INSERT INTO tbl_user (user_role_id, user_name, email, mobile_number, user_password, state_id, city_id, pincode, address, gst_number, image_name, created_by, created_on) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";

    if ($stmt1 = mysqli_prepare($conn, $sql1)) {
        mysqli_stmt_bind_param($stmt1, "issisiiisssis", $roleId, $user_name, $email, $phone_number, $hashPassword, $state, $city, $pincode, $client_address, $gst_number, $newFilename, $created_by, $created_on);

        if (mysqli_stmt_execute($stmt1)) {

            if ($newFilename) {
                $targetDir = "../uploads/"; // Specify the target directory where you want to store the uploaded files
                $targetFile = $targetDir . basename($newFilename);
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
            }


            // Redirect to another page
            echo '<script>
            window.location.href = "clients.php";
            alert("Client saved successfully!");            
                       
            </script>';
            // header("Location: categoryList.php");
            // exit;
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
                    <h1 class="m-0">Add Client</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Client</li>
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
                    <h3 class="card-title">Add Client</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" id="exciting_offer" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Client Name<em class="star">*</em></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Contact Person <em class="star">*</em></label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact Person">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Business Category <em class="star">*</em></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="category" name="category">
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Business Name <em class="star">*</em></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="subcategory" name="subcategory">
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email <em class="star">*</em></label>

                            <div class="col-sm-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number <em class="star">*</em></label>

                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Password <em class="star">*</em></label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">State <em class="star">*</em></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="state" name="state">
                                    <option value="">--Select--</option>

                                </select>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">City <em class="star">*</em></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="city" name="city">
                                    <option value="">--Select--</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Pincode <em class="star">*</em></label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Address </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="client_address" name="client_address" row="4"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Pan <em class="star">*</em></label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="pan" name="pan" placeholder="Pan Number">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">GST Number <em class="star">*</em></label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="gst_number" name="gst_number" placeholder="GST Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">IFSC Code <em class="star">*</em></label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Account Number <em class="star">*</em></label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Account Name <em class="star">*</em></label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Pan Document<em class="star">*</em></label>
                            <div class="col-sm-4">
                                <input type="file" name="image" id="image" accept="image/*" multiple>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Aadhar Document<em class="star">*</em></label>
                            <div class="col-sm-4">
                                <input type="file" name="aadhar_image" id="aadhar_image" accept="image/*" multiple>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Certificate<em class="star">*</em></label>
                            <div class="col-sm-4">
                                <input type="file" name="certificate" id="certificate" accept="image/*" multiple>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info" name="btnClient">Save</button>
                        <a type="submit" class="btn btn-default" href="clients.php">Cancel</a>
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