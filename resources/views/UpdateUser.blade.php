<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>مرکز ارتباط با مشتریان | ویرایش کاربر</title>
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
            <h1>ویرایش کاربر</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">ویرایش کاربر</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">ویرایش کاربر</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('ucr') }}" method="post" role="form">
              <div class="card-body">
                <div class="form-group">
                  <label for="name">نام و نام خانوادگی</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="نام و نام خانوادگی را وارد کنید" value="{{$user->name}}">
                </div>

                <div class="form-group">
                  <label >سمت</label>
                  <select name="role" id="role" class="form-control">
                    <option>اپراتور</option>
                    <option>کاربر</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="email">ایمیل</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل را وارد کنید" value="{{$user->email}}">
              </div>

                <div class="form-group">
                    <label for="mobile">شماره همراه</label>
                    <input type="number" class="form-control" name="mobile" id="mobile" placeholder="شماره همراه را وارد کنید" value="{{$user->mobile}}">
                </div>

                <div class="form-group">
                    <label for="phone">شماره ثابت</label>
                    <input type="number" class="form-control" name="phone" id="phone" placeholder="شماره ثابت را وارد کنید" value="{{$user->phone}}">
                </div>

                <div class="form-group">
                    <label for="phone2">خط داخلی</label>
                    <input type="number" class="form-control" name="phone2" id="phone2" placeholder="خط داخلی را وارد کنید" value="{{$user->phone2}}">
                </div>

                {{-- <div class="form-group">
                  <label for="Password">رمزعبور</label>
                  <input type="password" class="form-control" name="Password" id="Password" placeholder="پسورد را وارد کنید">
                </div> --}}

              </div>
              <!-- /.card-body -->
              @csrf
 
              <!-- Equivalent to... -->
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <input type="hidden" name="id" value="{{ $user->id }}" />
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">بروزرسانی کاربر</button>
              </div>
            </form>
          </div>
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
