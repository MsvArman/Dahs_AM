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

                @if ($user)
                    
                @else
                  <button type="button" class="btn btn-block btn-warning btn-sm">مشتری مورد نظر ثبت نشده است.</button>
                @endif

              </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('ucr') }}" method="post" role="form">
              <div class="card-body">

                <div class="form-group">
                  <label for="NationalCode">کدملی</label>
                  {{-- @if ($user) @else  @endif --}}
                  <input type="number" class="form-control text-center " name="NationalCode" id="NationalCode" placeholder="کدملی را وارد کنید" value="{{ $user ? $user->NationalCode : $NationalCode}}">
                </div>

                <div class="form-group">
                  <label for="name">نام و نام خانوادگی</label>
                  <input type="text" class="form-control text-center" name="name" id="name" placeholder="نام و نام خانوادگی را وارد کنید" value="{{ $user ? $user->name : "" }}">
                </div>

                <div class="form-group">
                  <label for="phone">شماره همراه</label>
                  <input type="number" class="form-control text-center" name="phone" id="phone" placeholder="شماره همراه را وارد کنید" value="{{$user ? $user->phone : ""}}">
              </div>

                <div class="form-group">
                  <label for="number">شماره ثابت</label>
                  <input type="number" class="form-control text-center" name="number" id="number" placeholder="شماره ثابت را وارد کنید" value="{{$user ? $user->number : ""}}">
              </div>

                <div class="form-group">
                  <label for="email">ایمیل</label>
                  <input type="email" class="form-control text-center" name="email" id="email" placeholder="ایمیل را وارد کنید" value="{{$user ? $user->email : ""}}">
              </div>

                <div class="form-group">
                    <label for="Investingin">سرمایه گذاری در</label>
                    <select name="Investingin" id="Investingin" class="form-control text-center">
                      <option>صندوق</option>
  
                    </select>
                </div>

                <div class="form-group">
                  <label for="Amountofcapital">میزان سرمایه</label>
                  <input type="text" class="form-control" name="Amountofcapital" id="Amountofcapital" placeholder="میزان سرمایه گذاری را وارد کنید" value="{{$user ? $user->Amountofcapital :"" }}">
              </div>

              </div>
              <!-- /.card-body -->
              @csrf
 
              <!-- Equivalent to... -->
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              {{-- <input type="hidden" name="id" value="{{ $user->id }}" /> #چکککک --}} 
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">بروزرسانی مشتری</button>
              </div>
            </form>
            
          </div>

          <div class="card col-12 col-md-7 mx-3">
            <div class="card-body card-widget" style="height: 60%">
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
                          <th>تاریخ تماس</th>
                          <th>اقدامات</th>
      
                        </tr>
      
                        @foreach ($calls as $call)
                          <tr>
                            <td>{{$call->callid}}</td>
                            <td>{{$call->mobilecustomer}}</td>
                            <td>{{$call->mobileoperator}}</td>
                            <td>{{ $call->endcall . $call->startcall}}</td>
                            <td>
                              <div class="d-flex">
                                <button onclick="PlayAudio()" class="btn btn-sm btn-primary text-light m-1 d-flex flex-row align-items-center justify-content-center text-center">

                                    <i class="fa fa-play mx-2"></i>
                                    <audio src="https://192.168.10.10/Api/DownloadRecording.php?file=/var/spool/asterisk/monitor/2023/10/24/out-09981498389-unknown-20231024-084908-1698151742.656.wav" id="Audio"></audio>
                                    {{-- play --}}
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

            <div class="col-md-12 ">
              <!-- Box Comment -->
              <div class="card card-widget">
                <div class="card-header">
                  <div class="user-block">
                    
                    <b><a href="#">تیکت</a></b>
                    {{-- <span class="description">تست</span> --}}
                  </div>
                  <!-- /.user-block -->
                  <div class="card-tools">

                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>

                  </div>
                  <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
  
                  <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                      <span class="direct-chat-name float-left"></span>
                      <span class="direct-chat-timestamp float-right"></span>
                    </div>


                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="Message User Image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را</div>
                      <!-- /.direct-chat-text -->
                    </div>

                    <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="{{asset('dist/img/AdminLTELogo.png')}}" alt="Message User Image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را</div>
                      <!-- /.direct-chat-text -->
                    </div>

                  </div>

                </div>
                
                <!-- /.card-footer -->
                <div class="card-footer" style="display: block;">
                  <form action="#" method="post">


                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="نتیجه کارشناسی خود را در کادر ورودی ثبت کنید">
                      <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat" >ثبت</button>
                      </span>
                    </div>

                  </form>
                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
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
