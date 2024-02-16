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

<!-- <script>
    // Add active class to the current button (highlight it)
    var header = document.getElementById("myDIV");
    var btns = document.getElementsByClassName("nav-item");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
</script> -->

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
        $('#category_item').validate({
            rules: {
                category: {
                    required: true
                },
                item_name: {
                    required: true
                },
                file: {
                    required: true
                },
            },
            messages: {
                category: {
                    required: "Please select a category"
                },
                item_name: {
                    required: "Please enter a item name"
                },
                file: {
                    required: "Please choose file"
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
        $('#exciting_offer').validate({
            rules: {
                offer_title: {
                    required: true
                },

                image: {
                    required: true
                },
            },
            messages: {
                offer_title: {
                    required: "Please enter a offer title"
                },

                image: {
                    required: "Please choose file"
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
                }
            });
        }

        // City Ajax Data
        $('#state').change(function() {
            var state = $(this).val();
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    state_id: state,
                    act: 'states'
                },
                dataType: 'json',
                success: function(stateRes) {
                    var optionHtml1 = '<option value="">--Select--</option>';
                    for (let index = 0; index < stateRes.length; index++) {
                        optionHtml1 += '<option value=' + stateRes[index]['id'] + '>' + stateRes[index]['city'] + '</option>';
                    }
                    $('#city').html(optionHtml1);

                }
            });
        });

        // Subcategory Ajax Data
        $('#category').change(function() {
            var category = $(this).val();
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

                }
            });
        });
    });
</script>