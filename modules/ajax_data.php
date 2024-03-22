<?php
require_once('../modules/database.php');


if ($_POST['act'] == 'city') {
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

if ($_POST['act'] == 'state') {
  $stateSql = "SELECT * FROM states";
  $stateQuery = mysqli_query($conn, $stateSql);
  $stateArr = array();
  if (mysqli_num_rows($stateQuery) > 0) {
    while ($stateRow = mysqli_fetch_assoc($stateQuery)) {
      array_push($stateArr, $stateRow);
    }
  }

  echo json_encode($stateArr);
}

if ($_POST['act'] == 'delete') {

  $deleteItemId = $_POST['deleteItemId'];
  $deleteTable = $_POST['deleteTable'];

  $deleteSql = "DELETE FROM $deleteTable WHERE id = $deleteItemId";
  if (mysqli_query($conn, $deleteSql)) {
    $status = 1;
  } else {
    $status = 0;
  }

  echo json_encode($status);
}

if ($_POST['act'] == 'Payout') {
  $client = $_POST['client'];
  $fromDate = $_POST['fromDate'];
  $toDate = $_POST['toDate'];

  $query = "SELECT *, SUM(transaction_amount) as amount, COUNT(*) as paymentsCnt FROM tbl_transactions WHERE transaction_to = '$client'
  AND (date(transaction_date) >= '$fromDate' AND date(transaction_date) <= '$toDate') AND status = 1";
  $result = mysqli_query($conn, $query);
  $payment = array();
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    array_push($payment, $row);
  }

  echo json_encode($payment);
}
