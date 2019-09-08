<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="">
    <title>Admin</title>
    <base href="{{asset('')}}"  >

    <!-- Bootstrap Core CSS -->
    <link href="admin_asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin_asset/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin_asset/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin_asset/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- DataTables CSS -->
    <link href="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- DataTables Responsive CSS -->
    <link href="admin_asset/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <script type="text/javascript" language="javascript" src="admin_asset/ckeditor/ckeditor.js" ></script>


</head>

<body>

    <div id="wrapper">

        @include('admin.layout.header')

        @yield('content')

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="admin_asset/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin_asset/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin_asset/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin_asset/dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="admin_asset/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
    <script src="admin_asset/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

    <script>
        $(document).ready(function(){

            $('#key_word').keyup(function(){
                var query = $(this).val();
                if(query != '')
                {
                    var _token = $('input[name="_token"]').val();
                    var id = $(".city").val();
                    $.ajax({
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        url:"{{ route('autocomplete.fetch') }}",
                        method:"POST",
                        data:{query:query, _token:_token , id:id},
                        success:function(data){
                           // alert(id);
                            $('#list_key_word').fadeIn();
                            $('#list_key_word').html(data);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){

            $("#selectlanguage").change(function(){
                var id = $(".city").val();
                var _token = $('input[name="_token"]').val();
               // alert(id);
                $.ajax({
                    url:"{{ route('auto.select') }}",
                    method:"POST",
                    data:{id:id, _token:_token},
                    success : function (data){
                        //$('#selectlanguage').html('<option value="">Select state first</option>');
                        //alert(data);
                    }
                });
            })
        })

    </script>

    <script>
        $('#edit-modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var Unmarker_name = button.data('Unmarker_name')
            var Name = button.data('Name')
            var Name2 = button.data('Name')
            var kuang = button.data('kuang')
            // alert(Unmarker_name)
            // var dataShop = button.data('dataShop');
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #Name').val(Name);
            modal.find('.modal-body #kuang').val(kuang);
            var _token = $('input[name="_token"]').val();
            {{--$.ajax({--}}
            {{--url:"{{'users/fetch'}}",--}}
            {{--type : "post",--}}
            {{--dataType:"text",--}}
            {{--// data:{query:query, _token:_token , id:id},--}}
            {{--data : {--}}
            {{--_token:_token , id:id--}}
            {{--},--}}
            {{--success : function (result){--}}
            {{--$('#result').html(result);--}}
            {{--}--}}
            {{--});--}}
        })
    </script>

    <script>
        $('#edit-typenew-modal').on('show.bs.modal', function (event) {
            // alert("dasd");
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var id2 = button.data('id2')

            var Name = button.data('Name')
            var Name2 = button.data('Name')
            var kuang = button.data('kuang')
            var TomTat = button.data('tomtat')
            var NoiDung = button.data('noidung')
            var idLoaitin = button.data('idloaitin')

            // var dataShop = button.data('dataShop');
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #id2').val(id2);
            modal.find('.modal-body #Name').val(Name);
            modal.find('.modal-body #kuang').val(kuang);
            modal.find('.modal-body #noidung').val(NoiDung);
            modal.find('.modal-body #tomtat').val(TomTat);
            // modal.find('.modal-body #idloaitin').val(idLoaiTin);

            $(event.currentTarget).find('.modal-body #idloaitin').val(idLoaitin);

            var _token = $('input[name="_token"]').val();

        })
    </script>

    @yield('script')
</body>

</html>
