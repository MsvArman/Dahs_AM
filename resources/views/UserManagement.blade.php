<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>مرکز ارتباط با مشتریان | مدیریت کاربران</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="{{asset('dist/css/bootstrap-rtl.min.css')}}">
  <!-- template rtl version -->
  <link rel="stylesheet" href="{{asset('dist/css/custom-style.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/customcss.css')}}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


    {{-- header nav --}}
    @include('main.header')

    {{-- sidebar --}}
    @include('main.sidebar')
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>مدیریت کاربران</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">مدیریت کاربران</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              
              <div class="card-header">
                <a href="{{ route('createuser') }}"><button type="button" class="btn btn-warning btn-sm d-flex flex-row">
                  <i class="fa fa-plus mx-1"></i>
                  <p class="mb-0 ">افزودن کاربر</p>
                </button></a>

                <div class="card-tools">
                  <div class="input-group input-group-sm w-100">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>

                  </div>
                  
                </div>
                {{-- <button type="button" class="btn btn-success btn-sm">Success</button> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tr>
                    <th>نام و نام خانوادگی</th>
                    <th>سمت</th>
                    <th>شماره همراه</th>
                    <th>شماره ثابت</th>
                    <th>خط داخلی</th>
                    <th>اقدامات</th>

                  </tr>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{$user->name}}</td>
                      <td>{{$user->role}}</td>
                      <td>{{$user->mobile}}</td>
                      <td>{{$user->phone}}</td>
                      <td>{{$user->phone2}}</td>
                      <td>

                        <div class="d-flex">

                          <a href="{{ route('ur_show') }}?id={{$user->id}}"><button class="btn btn-sm btn-success text-light m-1 d-flex flex-row align-items-center justify-content-center text-center">
                            <i class="fa fa-edit mx-1"></i>
                            <p class="mb-0 ">ویرایش کاربر</p>
                          </button></a>
                          <a href="{{ route('dr') }}?id={{$user->id}}"><button class="btn btn-sm btn-danger text-light m-1 d-flex flex-row align-items-center justify-content-center text-center">
                            <i class="fa fa-trash mx-1"></i>
                            <p class="mb-0 ">حذف کاربر</p>
                          </button></a>

                        </div>

                      </td>
                    </tr>
                  @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    {{-- <strong>CopyLeft &copy; 2018 <a href="http://github.com/hesammousavi/">حسام موسوی</a>.</strong> --}}
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('main.caller')

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Slimscroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="../../dist/js/demo.js"></script> --}}
</body>
</html>
