<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this item?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
      </div>
    </div>
  </div>
</div>



<footer class="main-footer">
  <strong>Copyright &copy; 2014-2021 <a href="https://billspayeadmin.in/">BillsPayeAdmin.in</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <!-- <b>Version</b> 3.2.0 -->
  </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- jquery-validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</body>



</html>

<script>
  // Automatically close the alert after 3 seconds
  window.setTimeout(function() {
    document.getElementById('autoCloseAlert').remove();
  }, 3000);

  $('#foodTypeDiv').hide();

  var deleteItemId;
  var deleteTable;
  var currentScreen;

  function deleteItem(id, table, screen) {
    // alert('Id : '+id+' Table : '+table);
    deleteItemId = id;
    deleteTable = table;
    currentScreen = screen;
    $('#confirmDeleteModal').modal('show');
  }

  var ajaxUrl1 = '<?php echo '../modules/ajax_data.php'; ?>';

  // $('#autoCloseAlert1').hide();

  $('#confirmDeleteBtn').click(function() {
    console.log('deleteItemId :', deleteItemId);
    // Here you can send an AJAX request to delete the item with the ID deleteItemId
    $.ajax({
      url: ajaxUrl1,
      type: 'POST',
      data: {
        act: 'delete',
        deleteItemId: deleteItemId,
        deleteTable: deleteTable
      },
      dataType: 'json',
      success: function(response) {

        window.location.href = currentScreen;
        $('#confirmDeleteModal').modal('hide');

        if (response == 1) {

          // $('#msg').html("Deleted Successfully");
          alert("Deleted Successfully");
        } else {
          // $('#msg').html("Deleted failed");
          alert("Delete failed");
        }

      }
    });

  });
</script>

<script>
  $(function() {
    // $.validator.setDefaults({
    //     submitHandler: function () {
    //         alert("Category successful saved!");
    //     }
    // });
    $('#category_form').validate({
      rules: {
        category: {
          required: true
        },
      },
      messages: {
        category: {
          required: "Please enter a category"
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function() {
    // $.validator.setDefaults({
    //     submitHandler: function () {
    //         alert("Category successful saved!");
    //     }
    // });

    $.validator.addMethod("foodTypeValidate", function(value, element) {
      var temp = true;
      if ($('input[type="checkbox"]:checked').length === 0) {
        temp = false;
        event.preventDefault();
      }

      return temp;
    });

    $('#category_item').validate({
      rules: {
        category: {
          required: true
        },
        sub_category_name: {
          required: true
        },
        state: {
          required: true
        },
        city: {
          required: true
        },
        address: {
          required: true
        },
        distance: {
          required: true
        },
        description: {
          required: true
        },
        item_name: {
          required: true
        },
        // file: {
        //     required: true
        // },
      },
      messages: {
        category: {
          required: "Please select a category"
        },
        item_name: {
          required: "Please enter a item name"
        },
        // file: {
        //     required: "Please choose file"
        // },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
  $(function() {
    // $.validator.setDefaults({
    //     submitHandler: function () {
    //         alert("Category successful saved!");
    //     }
    // });
    $('#exciting_offer').validate({
      rules: {
        offer_title: {
          required: true
        },
        category: {
          required: true
        },
        subcategory: {
          required: true
        },
        offer: {
          required: true
        },
        description: {
          required: true
        },
        menu_title: {
          required: true
        },
        post_title: {
          required: true
        }

        // image: {
        //     required: true
        // },
      },
      messages: {
        offer_title: {
          required: "Please enter a offer title"
        }

        // image: {
        //     required: "Please choose file"
        // },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  $(function() {
    // $.validator.setDefaults({
    //     submitHandler: function () {
    //         alert("Category successful saved!");
    //     }
    // });
    $('#client').validate({
      rules: {
        first_name: {
          required: true
        },
        last_name: {
          required: true
        },
        contact_person: {
          required: true
        },
        category: {
          required: true
        },
        subcategory: {
          required: true
        },
        email: {
          required: true,
          email: true
        },
        phone_number: {
          required: true,
          number: true
        },
        password: {
          required: true
        },
        state: {
          required: true
        },
        city: {
          required: true
        },
        pincode: {
          required: true
        },
        client_address: {
          required: true
        },
        pan: {
          required: true
        },
        gst_number: {
          required: true
        },
        upi_id: {
          required: true
        },

      },

      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
<script>
  $(function() {

    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(function() {

    var ajaxUrl = '<?php echo '../modules/ajax_data.php'; ?>';
    var subCatUrl = '<?php echo '../modules/sub_categotry_ajax.php'; ?>';
    var catId = '<?php echo isset($_GET['subCatId']) ? $edit_row['category_id'] : ''; ?>';
    var stateId = '<?php echo isset($_GET['subCatId']) ? $edit_row['state_id'] : ''; ?>';
    var cityId = '<?php echo isset($_GET['subCatId']) ? $edit_row['city_id'] : ''; ?>';
    var rowCatId = '<?php echo isset($_GET['recordId']) ? $row['cat_id'] : ''; ?>';
    var rowSubCatId = '<?php echo isset($_GET['recordId']) ? $row['sub_cat_id'] : ''; ?>';
    var subId = '<?php echo isset($_GET['subCatId']) ? $edit_row['id'] : ''; ?>';

    var ustateId = '<?php echo isset($_GET['userId']) ? $clientRow['state_id'] : ''; ?>';
    var ucityId = '<?php echo isset($_GET['userId']) ? $clientRow['city_id'] : ''; ?>';
    var urowCatId = '<?php echo isset($_GET['userId']) ? $clientRow['cat_id'] : ''; ?>';
    var urowSubCatId = '<?php echo isset($_GET['userId']) ? $clientRow['sub_cat_id'] : ''; ?>';
    var user_role_id = '<?php echo $_SESSION['user_role_id']; ?>';
    var sub_cat_id = '<?php echo $_SESSION['sub_cat_id']; ?>';
    var cat_id = '<?php echo $_SESSION['cat_id']; ?>';

    // Categories
    getCategories();

    function getCategories() {

      $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {
          act: 'category'
        },
        dataType: 'json',
        success: function(catRes) {
          var optionHtml = '<option value="">--Select--</option>';
          for (let index2 = 0; index2 < catRes.length; index2++) {
            optionHtml += '<option value=' + catRes[index2]['id'] + '>' + catRes[index2]['name'] + '</option>';
          }
          $('#category').html(optionHtml);

          if (catId != '') {
            $('#category').val(catId);
          }

          if (rowCatId != '') {
            $('#category').val(rowCatId);
            updateSubcategories(rowCatId)
          }

          if (urowCatId != '') {
            $('#category').val(urowCatId);
            updateSubcategories(urowCatId)
          }

          if (user_role_id == 3 && cat_id != '') {
            $('#category').val(cat_id);
            updateSubcategories(cat_id)
          }

          if (catId == 1) {
            $('#foodTypeDiv').show();
          } else {
            $('#foodTypeDiv').hide();
          }
        }
      });
    }

    //States dropdown
    GetStates();

    function GetStates() {
      $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {
          act: 'state'
        },
        dataType: 'json',
        success: function(stateRes) {
          var optionHtml2 = '<option value="">--Select--</option>';
          for (let index = 0; index < stateRes.length; index++) {
            optionHtml2 += '<option value=' + stateRes[index]['id'] + '>' + stateRes[index]['name'] + '</option>';
          }
          $('#state').html(optionHtml2);

          if (stateId != '') {
            $('#state').val(stateId);
            updateCities(stateId);
          }
          if (ustateId != '') {
            $('#state').val(ustateId);
            updateCities(ustateId);
          }
        }
      });
    }

    // City Ajax Data
    $('#state').change(function() {
      var state = $(this).val();
      updateCities(state);
    });

    function updateCities(state) {
      $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {
          state_id: state,
          act: 'city'
        },
        dataType: 'json',
        success: function(cityRes) {
          var optionHtml1 = '<option value="">--Select--</option>';
          for (let index = 0; index < cityRes.length; index++) {
            optionHtml1 += '<option value=' + cityRes[index]['id'] + '>' + cityRes[index]['city'] + '</option>';
          }
          $('#city').html(optionHtml1);

          if (cityId != '') {
            $('#city').val(cityId);
          }
          if (ucityId != '') {
            $('#city').val(ucityId);
          }

        }
      });
    }

    // Subcategory Ajax Data
    $('#category').change(function() {
      var category = $(this).val();
      updateSubcategories(category);

      if (category == 1) {
        $('#foodTypeDiv').show();
      } else {
        $('#foodTypeDiv').hide();
      }
    });

    function updateSubcategories(category) {

      $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {
          category: category,
          act: 'subcategory'
        },
        dataType: 'json',
        success: function(subcatRes) {
          var optionHtml2 = '<option value="">--Select--</option>';
          for (let index2 = 0; index2 < subcatRes.length; index2++) {
            optionHtml2 += '<option value=' + subcatRes[index2]['id'] + '>' + subcatRes[index2]['sub_category_name'] + '</option>';
          }
          $('#subcategory').html(optionHtml2);

          if (rowSubCatId != '') {
            $('#subcategory').val(rowSubCatId);
          }
          if (urowSubCatId != '') {
            $('#subcategory').val(urowSubCatId);
          }
          if (user_role_id == 3 && sub_cat_id != '') {
            $('#subcategory').val(sub_cat_id);
          }

        }
      });
    }

    $('#subcategory').change(function() {
      updatePayments();
      GetPayoutHistory();
    });
    $('#from_date').change(function() {
      updatePayments();
      GetPayoutHistory();
    });
    $('#to_date').change(function() {
      updatePayments();
      GetPayoutHistory();
    });

    function updatePayments() {
      var subCatVal = $('#subcategory').val();
      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();
      $('#service_fees').val('');
      $('#sub_total').val('');

      if (subCatVal != "" && (from_date != "" && to_date != "")) {
        $.ajax({
          url: ajaxUrl,
          type: "POST",
          data: {
            client: subCatVal,
            fromDate: from_date,
            toDate: to_date,
            act: 'Payout'
          },
          dataType: 'json',
          success: function(response) {
            console.log(response)
            if (response[0]['amount'] != null) {
              $('#total_cus_payable').val(formatRupees(response[0]['amount']) + '.00');
              $('#payments').text(response[0]['paymentsCnt']);
              $('#payment_cnt').val(response[0]['paymentsCnt']);
              if (response[0]['status'] == 1) {
                $('#payout_status').text('Pending');
              }
            } else {
              $('#total_cus_payable').val('00' + '.00');
              $('#payments').text('0');
              $('#payment_cnt').val(0);
              $('#payout_status').text('No Payments');
            }


          }
        });
      }
    }

    $('#service_fees').change(function() {
      var total_cus_payable = $('#total_cus_payable').val();
      var service_fees = $('#service_fees').val();


      let num1 = parseFloat(total_cus_payable.replace(/,/g, ''));
      let num2 = parseFloat(service_fees.replace(/,/g, ''));

      if (num2 > num1) {
        alert("Total service fees should not exceed Total customer payable");
        $('#service_fees').val('');
        $('#sub_total').val('');
        return false;
      }
      let result = num1 - num2;
      $('#sub_total').val(formatRupees(result) + '.00');

    });

    function formatRupees(amount) {
      // Convert number to string and split into array of whole and decimal parts
      let parts = amount.toString().split(".");
      // Add commas to whole part
      parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      // Combine whole and decimal parts with rupee symbol
      return parts.join(".");
    }

    if (user_role_id == 3) {
      GetPayoutHistory();
    }

    function GetPayoutHistory() {
      if (user_role_id == 3) {
        var subCatVal = sub_cat_id;
        $('#category').attr('disabled','disabled');
        $('#subcategory').attr('disabled','disabled');
      } else {
        var subCatVal = $('#subcategory').val();
        $('#category').removeAttr('disabled');
        $('#subcategory').removeAttr('disabled');
      }

      var from_date = $('#from_date').val();
      var to_date = $('#to_date').val();

      $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {
          client: subCatVal,
          fromDate: from_date,
          toDate: to_date,
          act: 'Payout_History'
        },
        dataType: 'json',
        success: function(response) {
          $('#payout_body').html('');
          var sno = 1;
          var status = "";
          for (let i = 0; i < response.length; i++) {
            if (response[i]['status'] == 2) {
              status = 'Paid';
            }
            $('#payout_body').append('<tr><td>' + sno + '</td><td>' + response[i]['client'] + '</td><td>' + response[i]['from_date'] + '</td><td>' + response[i]['to_date'] + '</td><td>' + response[i]['total_customer_payable'] + '</td><td>' + response[i]['total_service_fees'] + '</td><td>' + response[i]['sub_total'] + '</td><td>' + response[i]['created_on'] + '</td><td style="color:#0eff0e; font-weight: bold;">' + status + '</td></tr>');
            sno++;
          }
        }

      });
    }
  });
</script>
