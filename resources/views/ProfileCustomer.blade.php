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
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-rtl.min.css') }}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{ asset('dist/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/customcss.css') }}">


    <style>
        .direct-chat-text.answer:after,
        .direct-chat-text.answer:before {
            border-left-color: #ff9900 !important;
        }

        .direct-chat-text.voice:after,
        .direct-chat-text.voice:before {
            border-right-color: #007bff !important;

        }

        .direct-chat-text.voice,
        .direct-chat-text.voice {
            background-color: #007bff !important;
            width: fit-content;
            float: left;
            padding-top: 7px;
            padding-bottom: 0px;
            margin-left: 10px;
        }

        .direct-chat-text.answer,
        .direct-chat-text.answer {
            background-color: #ff9900 !important;
            color: white;
            width: fit-content;
            max-width: 50%;
            text-align: right;
            margin-right: 10px;
        }


        body {
            direction: rtl;
            width: 100%;
            height: 100% !important;
            min-height: 100% !important;
            margin: 0;
            display: grid;
            grid-template-rows: auto 1fr auto;
        }

        main {
            display: flex;
            flex-direction: row;
            flex-grow: 1;
        }
    </style>

</head>

<body class="hold-transition sidebar-mini ">
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
                <main class="container-fluid row d-flex justify-content-center text-center">
                    <div class="card card-primary col-12 col-md-4 p-0">
                        <div class="card-header">
                            <h3 class="card-title">پروفایل مشتری

                                @if ($user)
                                @else
                                    <button type="button" class="btn btn-block btn-warning btn-sm">مشتری مورد نظر ثبت
                                        نشده است.</button>
                                @endif

                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ $user ? route('ucr') : route('ccr') }}" method="post" role="form">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="NationalCode">کدملی</label>
                                    {{-- @if ($user) @else  @endif --}}
                                    <input type="number" class="form-control text-center " name="NationalCode"
                                        id="NationalCode" placeholder="کدملی را وارد کنید"
                                        value="{{ $user ? $user->NationalCode : $NationalCode }}">
                                    <input type="hidden" name="last_ntional_code"
                                        value="{{ $user ? $user->NationalCode : $NationalCode }}">
                                </div>

                                <div class="form-group">
                                    <label for="name">نام و نام خانوادگی</label>
                                    <input type="text" class="form-control text-center" name="name" id="name"
                                        placeholder="نام و نام خانوادگی را وارد کنید"
                                        value="{{ $user ? $user->name : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="phone">شماره همراه</label>
                                    <input type="number" class="form-control text-center" name="phone" id="phone"
                                        placeholder="شماره همراه را وارد کنید" value="{{ $user ? $user->phone : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="number">شماره ثابت</label>
                                    <input type="number" class="form-control text-center" name="number" id="number"
                                        placeholder="شماره ثابت را وارد کنید" value="{{ $user ? $user->number : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="email">ایمیل</label>
                                    <input type="email" class="form-control text-center" name="email" id="email"
                                        placeholder="ایمیل را وارد کنید" value="{{ $user ? $user->email : '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="Investingin">سرمایه گذاری در</label>
                                    <select name="Investingin" id="Investingin" class="form-control text-center">
                                        <option>صندوق</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="Amountofcapital">میزان سرمایه</label>
                                    <input type="text" class="form-control" name="Amountofcapital"
                                        id="Amountofcapital" placeholder="میزان سرمایه گذاری را وارد کنید"
                                        value="{{ $user ? $user->Amountofcapital : '' }}">
                                </div>

                            </div>
                            <!-- /.card-body -->
                            @csrf

                            <!-- Equivalent to... -->
                            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}
                            @if ($user)
                                <input type="hidden" name="id" value="{{ $user->id }}" />
                            @endif

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">بروزرسانی مشتری</button>
                            </div>
                        </form>

                    </div>

                    <div class=" col-12 col-md-7 mx-4">

                        {{-- <div class="card bg-primary-gradient">
                            <div class="card-header">
                                <h3 class="card-title">رویدادها</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                محتوای باکس
                            </div>
                            <!-- /.card-body -->
                        </div> --}}

                        <div>
                            <!-- Box Comment -->
                            <div class="card card-widget">
                                <div class="card-header">
                                    <div class="user-block">

                                        <b><a href="#">تیکت</a></b>
                                        {{-- <span class="description">تست</span> --}}
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="card-tools">

                                        <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                        </button>

                                    </div>
                                    <!-- /.card-tools -->
                                </div>

                                <!-- /.card-footer -->
                                <div class="card-footer" style="display: block;">
                                    <form action="{{ route('addTicket') }}" method="post">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="text"
                                                placeholder="نتیجه کارشناسی خود را در کادر ورودی ثبت کنید">
                                            @if (isset($end))
                                                <input type="hidden" name="id" value="{{ $end }}" />
                                            @endif
                                            <input type="hidden" name="NationalCode"
                                                value="{{ $user ? $user->NationalCode : '' }}">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-info btn-flat">ثبت</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-footer -->

                                
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">

                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name float-left"></span>
                                            <span class="direct-chat-timestamp float-right"></span>
                                        </div>

                                        @foreach ($tickets as $ticket)
                                            @if ($ticket->voice == null)
                                                <!-- Message to the right -->
                                                <div class="direct-chat-msg right mb-4">
                                                    <div class="direct-chat-info clearfix">
                                                        <span
                                                            class="direct-chat-name float-right">{{ $ticket->operator_name }}</span>
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <img class="direct-chat-img"
                                                        src="{{ asset('dist/img/AdminLTELogo.png') }}"
                                                        alt="message user image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="d-flex align-items-end">
                                                        <div class="direct-chat-text answer border-0">
                                                            {{ $ticket->comment }}
                                                        </div>
                                                        <div style="font-size: 13px; color: #bbb; margin-right: 10px;">
                                                            {{ verta(intval($ticket->time) + 12600) }}
                                                        </div>
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>
                                                <!-- /.direct-chat-msg -->
                                            @else
                                                <div class="direct-chat-msg mb-4">
                                                    <div class="direct-chat-info clearfix">
                                                        <span
                                                            class="direct-chat-name float-left">{{ $user ? $user->name : '' }}</span>

                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <img class="direct-chat-img"
                                                        src="{{ asset('dist/img/AdminLTELogo.png') }}"
                                                        alt="Message User Image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="d-flex align-items-end flex-row-reverse float-left">
                                                        <div class="direct-chat-text voice">
                                                            <audio controls>
                                                                <source src="https://{{ $ticket->voice }}"
                                                                    type="audio/wav" />
                                                            </audio>
                                                        </div>
                                                        <div style="font-size: 13px; color: #bbb; margin-left: 10px;">
                                                            {{ verta(intval($ticket->time) + 12600) }}
                                                        </div>
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>
                                            @endif
                                            {{-- @if ($call->comment)
                                                <div class="direct-chat-msg right">
                                                    <div class="direct-chat-info clearfix">
                                                    </div>
                                                    <!-- /.direct-chat-info -->
                                                    <img class="direct-chat-img"
                                                        src="{{ asset('dist/img/AdminLTELogo.png') }}"
                                                        alt="Message User Image">
                                                    <!-- /.direct-chat-img -->
                                                    <div class="direct-chat-text">
                                                        {{ $call->comment }}
                                                    </div>
                                                    <!-- /.direct-chat-text -->
                                                </div>
                                            @endif --}}
                                        @endforeach



                                    </div>

                                </div>


                            </div>
                            <!-- /.card -->
                        </div>


                    </div>
                </main><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer fixed-bottom z-1">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                {{-- Anything you want --}}
            </div>
            <!-- Default to the left -->
            {{-- <strong>CopyLeft &copy; 2018 <a href="">ArmanMsv</a>.</strong> --}}
        </footer>

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
