<?php require_once('../modules/header.php');

// Edit Data
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    $offerQuery = "SELECT * FROM tbl_user WHERE id = $userId";
    $offerSql = mysqli_query($conn, $offerQuery);
    $clientRow = mysqli_fetch_assoc($offerSql);

    $name = explode(" ", $clientRow['user_name']);
    $fname = $name['0'];
    $lname = $name['1'];

    $psw = $clientRow['user_password'];
}

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
    $aadhar_image = $_FILES['aadhar_image']['name'];
    $certificate = $_FILES['certificate']['name'];
    $created_by = $_SESSION['user_id'];
    $created_on = date("Y-m-d H:i:s");
    $roleId = 3;
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $contact_person = $_POST['contact_person'];
    $category = $_POST['category'];
    $subcategory = $_POST['subcategory'];
    $pan = $_POST['pan'];
    $gst_number = $_POST['gst_number'];
    $account_number = $_POST['account_number'];
    $account_name = $_POST['account_name'];
    $ifsc_code = $_POST['ifsc_code'];
    $upi_id = $_POST['upi_id'];

    // if (isset($_GET['userId'])) {
    //     if (password_verify($user_password, $psw)) {
    //         echo "Password is correct";
    //     } else {
    //         echo "Password is incorrect";
    //     }
    // }

    $targetDir = "../uploads/"; // Specify the target directory where you want to store the uploaded files

    if ((isset($_GET['userId']) && $_FILES['image']['name'] != '') || (!isset($_GET['userId']) && $_FILES['image']['name'] != '')) {
        // Remove spaces
        $fileName1 = str_replace(' ', '', $image_name);
        $timeString = date("Y-m-d H:i:s");
        $timestamp = strtotime($timeString);
        $newFilename = $timestamp . "_" . $fileName1; // Appending timestamp to filename
    } else {
        $newFilename = $clientRow['image_name'];
    }

    if ((isset($_GET['userId']) && $_FILES['image']['name'] != '') || (!isset($_GET['userId']) && $_FILES['image']['name'] != '')) {
        $targetFile = $targetDir . basename($newFilename);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    }

    if ((isset($_GET['userId']) && $_FILES['image']['name'] != '') || (!isset($_GET['userId']) && $_FILES['image']['name'] != '')) {
        // Remove spaces
        $aadhar_imagefileName = str_replace(' ', '', $aadhar_image);
        $aadhar_imagetimeString = date("Y-m-d H:i:s");
        $aadhar_imagetimestamp = strtotime($aadhar_imagetimeString);
        $aadhar_imagenewFilename = $aadhar_imagetimestamp . "_" . $aadhar_imagefileName; // Appending timestamp to filename
    } else {
        $aadhar_imagenewFilename = $clientRow['aadhar_image'];
    }

    if ((isset($_GET['userId']) && $_FILES['aadhar_image']['name'] != '') || (!isset($_GET['userId']) && $_FILES['aadhar_image']['name'] != '')) {
        $targetFile1 = $targetDir . basename($aadhar_imagenewFilename);
        move_uploaded_file($_FILES["aadhar_image"]["tmp_name"], $targetFile1);
    }

    if ((isset($_GET['userId']) && $_FILES['certificate']['name'] != '') || (!isset($_GET['userId']) && $_FILES['certificate']['name'] != '')) {
        // Remove spaces
        $certificatefileName1 = str_replace(' ', '', $certificate);
        $certificatetimeString = date("Y-m-d H:i:s");
        $certificatetimestamp = strtotime($certificatetimeString);
        $certificatenewFilename = $certificatetimestamp . "_" . $certificatefileName1; // Appending timestamp to filename
    } else {
        $certificatenewFilename = $clientRow['certificate'];
    }

    if ((isset($_GET['userId']) && $_FILES['certificate']['name'] != '') || (!isset($_GET['userId']) && $_FILES['certificate']['name'] != '')) {
        $targetFile2 = $targetDir . basename($certificatenewFilename);
        move_uploaded_file($_FILES["certificate"]["tmp_name"], $targetFile2);
    }

    if (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
        $updatesql = "UPDATE tbl_user SET user_role_id='$roleId',user_name='$user_name',email='$email',mobile_number='$phone_number',state_id='$state',city_id='$city',pincode='$pincode',address='$client_address',gst_number='$gst_number',contact_person='$contact_person',cat_id='$category',sub_cat_id='$subcategory',pan='$pan',account_number='$account_number',account_name='$account_name',ifsc_code='$ifsc_code',upi_id='$upi_id',aadhar_image='$aadhar_imagenewFilename',certificate='$certificatenewFilename',image_name='$newFilename' WHERE id = $userId";
        if (mysqli_query($conn, $updatesql)) {
            $_SESSION['message'] = 'Client Updated successfully!';
            echo '<script>
            window.location.href = "clients.php";  
                   
        </script>';
        } else {
            $_SESSION['message'] = 'Client update failed!';
            echo '<script>
            window.location.href = "addClient.php?userId=' . $userId . '";  
                       
            </script>';
        }
    } else {
        $sql1 = "INSERT INTO tbl_user (user_role_id, user_name, email, mobile_number, user_password, state_id, city_id, pincode, address, gst_number, contact_person, cat_id, sub_cat_id, pan, account_number, account_name, ifsc_code, upi_id, aadhar_image, certificate, image_name, created_by, created_on) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        if ($stmt1 = mysqli_prepare($conn, $sql1)) {
            mysqli_stmt_bind_param($stmt1, "issisiiisssiisissssssis", $roleId, $user_name, $email, $phone_number, $hashPassword, $state, $city, $pincode, $client_address, $gst_number, $contact_person, $category, $subcategory, $pan, $account_number, $account_name, $ifsc_code, $upi_id, $aadhar_imagenewFilename, $certificatenewFilename, $newFilename, $created_by, $created_on);

            if (mysqli_stmt_execute($stmt1)) {
                $_SESSION['message'] = 'Client saved successfully!';
                // Redirect to another page
                echo '<script>
            window.location.href = "clients.php";                       
            </script>';
            } else {
                $_SESSION['message'] = 'Client save failed!';
                // Redirect to another page
                echo '<script>
            window.location.href = "addClient.php";                       
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
                <form class="form-horizontal" method="post" id="client" enctype="multipart/form-data">
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Client Name<em class="star">*</em></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo isset($_GET['userId']) ? $fname : ""; ?>">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo isset($_GET['userId']) ? $lname : ""; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Contact Person <em class="star">*</em></label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Contact Person" value="<?php echo isset($_GET['userId']) ? $clientRow['contact_person'] : ""; ?>">
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
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo isset($_GET['userId']) ? $clientRow['email'] : ""; ?>">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Phone Number <em class="star">*</em></label>

                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" value="<?php echo isset($_GET['userId']) ? $clientRow['mobile_number'] : ""; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Password <em class="star">*</em></label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo isset($_GET['userId']) ? $clientRow['password'] : ""; ?>">
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
                                <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="<?php echo isset($_GET['userId']) ? $clientRow['pincode'] : ""; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Address </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="client_address" name="client_address" row="4"><?php echo isset($_GET['userId']) ? $clientRow['address'] : ""; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Pan <em class="star">*</em></label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="pan" name="pan" placeholder="Pan Number" value="<?php echo isset($_GET['userId']) ? $clientRow['pan'] : ""; ?>">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">GST Number <em class="star">*</em></label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="gst_number" name="gst_number" placeholder="GST Number" value="<?php echo isset($_GET['userId']) ? $clientRow['gst_number'] : ""; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Account Number </label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Account Number" value="<?php echo isset($_GET['userId']) ? $clientRow['account_number'] : ""; ?>">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Account Name </label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Account Name" value="<?php echo isset($_GET['userId']) ? $clientRow['account_name'] : ""; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">IFSC Code </label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" placeholder="IFSC Code" value="<?php echo isset($_GET['userId']) ? $clientRow['ifsc_code'] : ""; ?>">
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">UPI ID <em class="star">*</em></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="upi_id" name="upi_id" placeholder="UPI ID" value="<?php echo isset($_GET['userId']) ? $clientRow['upi_id'] : ""; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Pan Document</label>
                            <div class="col-sm-4">
                                <input type="file" name="image" id="image" accept="image/*" multiple>
                            </div>
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Aadhar Document</label>
                            <div class="col-sm-4">
                                <input type="file" name="aadhar_image" id="aadhar_image" accept="image/*" multiple>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Certificate</label>
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