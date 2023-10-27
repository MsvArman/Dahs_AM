<?php

$name = "";

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>مرکز ارتباط با مشتریان | تاریخچه مکالمات</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="refresh" content="11">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/customcss.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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
            <h1>تاریخچه مکالمات</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">تاریخچه مکالمات</li>
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
                <h3 class="card-title">تاریخچه مکالمات</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm w-100">
                    {{-- <a href="{{ route('') }}"><button type="button" class="btn btn-success btn-sm mx-4">افزودن مکالمه</button></a> --}}
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
                    {{-- <th>شناسه</th> --}}
                    <th>نام و نام خانوادگی </th>
                    <th>کدملی مشتری</th>
                    <th>شماره مشتری</th>
                    <th>نام اپراتور</th>
                    <th>شماره اپراتور</th>
                    <th>تماس</th>
                    {{-- <th>وضعیت</th> --}}
                    <th>تاریخ تماس</th>
                    <th>اقدامات</th>

                  </tr>

                  @foreach ($users as $user)
                    <tr>
                      {{-- <td>{{$user->callid}}</td> --}}
                      <td>/</td>
                      <td>{{$user->NationalCode}}</td>
                      <td>{{$user->mobilecustomer}}</td>
                      <td>{{$user->mobileoperator}}</td>
                      <td>{{$user->mobileoperator}}</td>

                      <td>@if ($user->call == 'outcall')
                        <i class="bi bi-telephone-outbound text-danger"></i>
                      @else
                      <i class="bi bi-telephone-inbound text-success"></i>
                      @endif</td>
                      <td>{{ $user->startcall}}</td>
                      
                      <td>
                        <div class="d-flex">

                          <button onclick="PlayAudio()" class="btn btn-sm btn-primary text-light m-1 d-flex flex-row align-items-center justify-content-center text-center">

                            <i class="fa fa-play mx-2"></i>
                            <audio src="https://192.168.10.10/Api/DownloadRecording.php?file={{$user->voice}}" id="Audio"></audio>

                          </button>

                          <a href=""><button class="btn btn-sm btn-success text-light m-1 d-flex flex-row align-items-center justify-content-center text-center">
                            <i class="fa fa-phone mx-2"></i>
                            </button>
                          </a>

                          <a href="{{ route('pc') }}?NationalCode={{$user->NationalCode}}"><button class="btn btn-sm btn-warning text m-1 d-flex flex-column align-items-center justify-content-center text-center">  
                            <i class="fa fa-ellipsis-v mx-2"></i>
                            </button>
                          </a>

                          {{-- <a href="#"><button class="btn btn-sm btn-info text m-1 d-flex flex-column align-items-center justify-content-center text-center">  
                            <i class="fa fa-ticket" aria-hidden="true"></i>
                            </button>
                          </a> --}}

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
@include('main.caller')

  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->


<script>
  function PlayAudio() {
    document.getElementById("Audio").play();
  }
</script>

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
