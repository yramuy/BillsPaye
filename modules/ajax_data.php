<?php
require_once('../modules/database.php');


if ($_POST['act'] == 'states') {
    $state_id = $_POST['state_id'];

    $citySql = "SELECT * FROM cities WHERE state_id = $state_id";
    $cityQry = mysqli_query($conn, $citySql);

    $cityArr = array();
    if (mysqli_num_rows($cityQry) > 0) {
        while ($row = mysqli_fetch_assoc($cityQry)) {
            array_push($cityArr, $row);
        }
    }

    echo json_encode($cityArr);
}

if ($_POST['act'] == 'subcategory') {
    $category = $_POST['category'];

    $subCatSql = "SELECT * FROM tbl_sub_categories WHERE category_id = $category";
    $subCatQry = mysqli_query($conn, $subCatSql);

    $subCatArr = array();
    if (mysqli_num_rows($subCatQry) > 0) {
        while ($subCatrow = mysqli_fetch_assoc($subCatQry)) {
            array_push($subCatArr, $subCatrow);
        }
    }

    echo json_encode($subCatArr);
}

if ($_POST['act'] == 'category') {

    $cateSql = "SELECT * FROM tbl_categories";
    $catQry = mysqli_query($conn, $cateSql);
    $catArr = array();
    if (mysqli_num_rows($catQry) > 0) {
        while ($catRow = mysqli_fetch_assoc($catQry)) {
            array_push($catArr, $catRow);
        }
    }

    echo json_encode($catArr);
}
