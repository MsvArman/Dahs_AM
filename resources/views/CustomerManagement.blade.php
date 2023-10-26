<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>مرکز ارتباط با مشتریان | مدیریت مشتریان</title>
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

    <style>
        * {
            direction: rtl;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('sweetalert::alert')


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
                            <h1>مدیریت مشتریان</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="#">خانه</a></li>
                                <li class="breadcrumb-item active">مدیریت مشتریان</li>
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
                                    <a href="{{ route('createcustomer') }}"><button type="button"
                                            class="btn btn-warning btn-sm d-flex flex-row">
                                            <i class="fa fa-plus mx-1"></i>
                                            <p class="mb-0 ">افزودن مشتری</p>
                                        </button></a>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm w-100">
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="جستجو">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default"><i
                                                        class="fa fa-search"></i></button>
                                            </div>

                                        </div>

                                    </div>
                                    {{-- <button type="button" class="btn btn-success btn-sm">Success</button> --}}
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>کدملی</th>
                                            <th>نام و نام خانوادگی</th>
                                            <th>شماره همراه</th>
                                            <th>شماره ثابت</th>
                                            <th>ایمیل</th>
                                            <th>سرمایه گذاری در</th>
                                            <th>میزان سرمایه</th>
                                            <th>اقدامات</th>

                                        </tr>

                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->NationalCode }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->number }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->Investingin }}</td>
                                                <td>{{ $user->Amountofcapital }}</td>
                                                <td>

                                                    <div class="d-flex">

                                                        <a href="{{ route('pc') }}?NationalCode={{$user->NationalCode}}"><button
                                                                class="btn btn-sm btn-success text-light m-1 d-flex flex-row align-items-center justify-content-center text-center">
                                                                <i class="fa fa-edit mx-1"></i>
                                                                <p class="mb-0 ">ویرایش مشتری</p>
                                                            </button></a>
                                                        <a href="{{ route('dcr') }}?id={{ $user->id }}"><button
                                                                class="btn btn-sm btn-danger text-light m-1 d-flex flex-row align-items-center justify-content-center text-center">
                                                                <i class="fa fa-trash mx-1"></i>
                                                                <p class="mb-0 ">حذف مشتری</p>
                                                            </button></a>
                                                        <!--             START OF THE BOOTSTRAP BTN              -->
                                                        <!--             START OF THE BOOTSTRAP BTN              -->
                                                        <button type="button"
                                                            class="btn btn-sm bg-primary my-1 ms-0 ms-md-2 text-light rounded-2"
                                                            style="padding-top: 6px; padding-bottom: 0;"
                                                            data-toggle="tooltip" data-placement="bottom"
                                                            title="ارسال پیام" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal"
                                                            data-bs-whatever="@getbootstrap">
                                                            <svg width="16" height="16" viewBox="0 0 16 16"
                                                                fill="currentColor">
                                                                <path
                                                                    d="M15.9642 0.68571C16.0385 0.500001 15.995 0.287892 15.8536 0.146461C15.7121 0.00502989 15.5 -0.0385071 15.3143 0.0357762L0.767199 5.85462L0.765743 5.8552L0.314312 6.03578C0.140137 6.10545 0.0196145 6.26675 0.00217278 6.45353C-0.0152689 6.64031 0.0733055 6.82113 0.231569 6.92185L0.641189 7.18251L0.643086 7.18372L5.63783 10.3622L8.81629 15.3569L8.81781 15.3593L9.07818 15.7685C9.17889 15.9267 9.35972 16.0153 9.5465 15.9978C9.73327 15.9804 9.89458 15.8599 9.96424 15.6857L15.9642 0.68571ZM14.1311 2.57603L6.63717 10.0699L6.42184 9.73158C6.38255 9.66984 6.33019 9.61747 6.26845 9.57818L5.93006 9.36284L13.4239 1.86896L14.6025 1.39754L14.1311 2.57603Z" />
                                                            </svg>
                                                        </button>
                                                        <!--             END OF THE BOOTSTRAP BTN              -->
                                                        <form class="" action="{{ route('submit_message') }}"
                                                            method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{ $user->id }}"
                                                                name="customer_id">
                                                            <div class="modal fade" dir="ltr" id="exampleModal"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div
                                                                    class="modal-dialog modal-lg modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div
                                                                            class="modal-header flex-row-reverse justify-content-between w-100 text-dark">
                                                                            <h5 class="modal-title fs-5 fw-bold w-100"
                                                                                id="exampleModalLabel">
                                                                                ارسال
                                                                                پیام</h5>
                                                                            {{-- <button class="btn-close text-start"
                                                                            type="button" data-bs-dismiss="modal"
                                                                            aria-label="Close"></button> --}}
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="text-dark ">
                                                                                <label
                                                                                    class="col-form-label w-100 text-end m-2"
                                                                                    for="recipient-name">موضوع</label>
                                                                                <input
                                                                                    class="form-control w-100 text-end"
                                                                                    name="title" type="text"
                                                                                    id="recipient-name">
                                                                            </div>
                                                                            <div class="text-dark">
                                                                                <label
                                                                                    class="col-form-label w-100 text-end m-2 "
                                                                                    for="message-text">متن
                                                                                    پیام</label>
                                                                                <textarea class="form-control w-100 text-end" id="message-text" style="min-height: 30vh;" name="text"></textarea>
                                                                            </div>
                                                                            <div class="d-flex w-100 m-2">
                                                                                <div
                                                                                    class="form-check form-switch mx-auto">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox" role="switch"
                                                                                        name="send_to_email"
                                                                                        id="popupswitch2" checked>
                                                                                    <label
                                                                                        class="form-check-label mx-2 text-dark"
                                                                                        for="popupswitch2">ارسال به
                                                                                        ایمیل
                                                                                    </label>
                                                                                </div>
                                                                                <div
                                                                                    class="form-check form-switch mx-auto">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox" role="switch"
                                                                                        name="send_to_phone_number"
                                                                                        id="popupswitch1" checked>
                                                                                    <label
                                                                                        class="form-check-label mx-2 text-dark"
                                                                                        for="popupswitch1">ارسال به
                                                                                        شماره
                                                                                        همراه
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="modal-footer flex-column text-dark">
                                                                            <div>
                                                                                <button
                                                                                    class="btn btn-secondary rounded-4 mx-2"
                                                                                    type="button"
                                                                                    data-bs-dismiss="modal">بستن
                                                                                </button>
                                                                                <button
                                                                                    class="btn btn-info rounded-4 mx-2"
                                                                                    type="submit"
                                                                                    type="button">ارسال
                                                                                    پیام</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!--             END OF THE BOOTSTRAP MODAL              -->

                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach
                                        {{--
                  <tr>
                    <td>01234567890</td>
                    <td>تست تست</td>
                    <td>09123456789</td>
                    <td>02112345678</td>
                    <td>test@test.test</td>
                    <td>سبد</td>
                    <td>ریال1,000,000</td>
                    <td>
                      <div class="btn-group">
                        <a href="#"><button type="button" class="btn btn-warning">ویرایش مشتری</button></a>
                        <a href="#"><button type="button" class="btn btn-danger">حذف مشتری</button></a>
                      </div>
                    </td>
                  </tr> --}}

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

</body>

</html>
