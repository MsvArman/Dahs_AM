<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>مرکز ارتباط با مشتریان | پروفایل مشتری</title>
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
            <h1>پروفایل مشتری</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">پروفایل مشتری</li>
            </ol>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid row d-flex justify-content-center text-center">
        <div class="card card-primary col-12 col-md-4 p-0">
            <div class="card-header">
              <h3 class="card-title">پروفایل مشتری
                {{-- if not find --}}
                {{-- <button type="button" class="btn btn-block btn-warning btn-sm">مشتری مورد نظر ثبت نشده است.</button> --}}

              </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('ucr') }}" method="post" role="form">
              <div class="card-body">

                <div class="form-group">
                  <label for="NationalCode">کدملی</label>
                  <input type="number" class="form-control text-center" name="NationalCode" id="NationalCode" placeholder="کدملی را وارد کنید" value="{{$user[0]->NationalCode}}">
                </div>

                <div class="form-group">
                  <label for="name">نام و نام خانوادگی</label>
                  <input type="text" class="form-control text-center" name="name" id="name" placeholder="نام و نام خانوادگی را وارد کنید" value="{{$user[0]->name}}">
                </div>

                <div class="form-group">
                  <label for="phone">شماره همراه</label>
                  <input type="number" class="form-control text-center" name="phone" id="phone" placeholder="شماره همراه را وارد کنید" value="{{$user[0]->phone}}">
              </div>

                <div class="form-group">
                  <label for="number">شماره ثابت</label>
                  <input type="number" class="form-control text-center" name="number" id="number" placeholder="شماره ثابت را وارد کنید" value="{{$user[0]->number}}">
              </div>

                <div class="form-group">
                  <label for="email">ایمیل</label>
                  <input type="email" class="form-control text-center" name="email" id="email" placeholder="ایمیل را وارد کنید" value="{{$user[0]->email}}">
              </div>

                <div class="form-group">
                    <label for="Investingin">سرمایه گذاری در</label>
                    <select name="Investingin" id="Investingin" class="form-control text-center">
                      <option>صندوق</option>
  
                    </select>
                </div>

                <div class="form-group">
                  <label for="Amountofcapital">میزان سرمایه</label>
                  <input type="text" class="form-control" name="Amountofcapital" id="Amountofcapital" placeholder="میزان سرمایه گذاری را وارد کنید" value="{{$user[0]->Amountofcapital}}">
              </div>

              </div>
              <!-- /.card-body -->
              @csrf
 
              <!-- Equivalent to... -->
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              {{-- <input type="hidden" name="id" value="{{ $call->id }}" /> --}}
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">بروزرسانی مشتری</button>
              </div>
            </form>
            
          </div>

          <div class="card col-12 col-md-7 mx-3">
            <div class="card-body w-100 " style="height: 500px">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    
                    <div class="card-header">
                      <h3 class="card-title">تاریخچه مکالمات</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                      <table class="table table-hover">
                        <tr>
                          <th>شناسه</th>
                          <th>شماره مشتری</th>
                          <th>شماره اپراتور</th>
                          <th>تماس</th>
                          <th>وضعیت</th>
                          <th>تاریخ تماس</th>
                          <th>تاریخ پایان</th>
                          <th>اقدامات</th>
      
                        </tr>
      
                        @foreach ($calls as $call)
                          <tr>
                            <td>{{$call->callid}}</td>
                            <td>{{$call->mobilecustomer}}</td>
                            <td>{{$call->mobileoperator}}</td>
                            <td>{{$call->call}}</td>
                            <td>{{$call->status}}</td>
                            <td>{{$call->startcall}}</td>
                            <td>{{$call->endcall}}</td>

                            <td>
                              <div class="d-flex">
                                <button class="btn btn-sm btn-success text-light m-1 d-flex flex-row align-items-center justify-content-center text-center">
                                  <i class="fa fa-play mx-2"></i>
                                  <p class="mb-0 ">پخش صوت</p>
                              </button>

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
            </div>
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
<script src="../../dist/js/demo.js"></script>
</body>
</html>
