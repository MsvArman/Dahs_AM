<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>پنل مدیریت</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="{{asset('')}}dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="{{asset('')}}dist/css/custom-style.css">

  <style>
    body{
    direction: rtl;
    width: 100%;
    height:100% !important;
    min-height: 100% !important;
    margin: 0;
    display: grid;
    grid-template-rows: auto 1fr auto;
    }
    main{
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    }

     #dialer_table {
            width: 100%;
            font-size: 1.5em;
            
        }

        #dialer_table tr td {
            text-align: center;
            height: 50px;
            width: 33%;
        }

        #dialer_table #dialer_input_td {
            border-bottom: 1px solid #fafafa;
        }

        #dialer_table #dialer_input_td input {
            width: 100%;
            border: none;
            font-size: 1.6em;
        }

        /* Remove arrows from type number input : Chrome, Safari, Edge, Opera */
        #dialer_table #dialer_input_td input::-webkit-outer-spin-button,
        #dialer_table #dialer_input_td input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Remove arrows from type number input : Firefox */
        #dialer_table #dialer_input_td input[type=number] {
            -moz-appearance: textfield;
        }

        #dialer_table #dialer_input_td input::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #cccccc;
            opacity: 1; /* Firefox */
        }

        #dialer_table #dialer_input_td input:-ms-input-placeholder { /* Internet Explorer 10-11 */
            color: #cccccc;
        }

        #dialer_table #dialer_input_td input::-ms-input-placeholder { /* Microsoft Edge */
            color: #cccccc;
        }

        #dialer_table #dialer_call_btn_td {
            color: #ffffff;
            background-color: green;
            border: none;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
            padding: 5px 32px;
            text-align: center;
            display: inline-block;
            margin: 10px 2px 4px 2px;
            transition: all 300ms ease;
            -moz-transition: all 300ms ease;
            --webkit-transition: all 300ms ease;
        }

        #dialer_table #dialer_call_btn_td:hover {
            background-color: #009d00;
        }

        #dialer_table .dialer_num_tr td {
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
            -khtml-user-select: none; /* Konqueror HTML */
            -moz-user-select: none; /* Old versions of Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
        }

        #dialer_table .dialer_num_tr td:nth-child(1) {
            border-right: 1px solid #fafafa;
        }

        #dialer_table .dialer_num_tr td:nth-child(3) {
            border-left: 1px solid #fafafa;
        }

        #dialer_table .dialer_num_tr:nth-child(1) td,
        #dialer_table .dialer_num_tr:nth-child(2) td,
        #dialer_table .dialer_num_tr:nth-child(3) td,
        #dialer_table .dialer_num_tr:nth-child(4) td {
            border-bottom: 1px solid #fafafa;
        }

        #dialer_table .dialer_num_tr .dialer_num {
            color: #0B559F;
            cursor: pointer;
        }

        #dialer_table .dialer_num_tr .dialer_num:hover {
            background-color: #fafafa;
        }

        #dialer_table .dialer_num_tr:nth-child(0) td {
            border-top: 1px solid #fafafa;
        }

        #dialer_table .dialer_del_td img {
            cursor: pointer;
            
            
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">صفحه سریع</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">خانه</a></li>
              <li class="breadcrumb-item active">صفحه سریع</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <main class="content z-1">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title mb-2 text-bold">عنوان کارت</h5>

                <p class="card-text">
                  لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                </p>

                <a href="#" class="card-link">لینک کارت</a>
                <a href="#" class="card-link mr-2">لینک صفحه</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title mb-2 text-bold">عنوان کارت</h5>

                <p class="card-text">
                  لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                </p>
                <a href="#" class="card-link">لینک کارت</a>
                <a href="#" class="card-link mr-2">لینک صفحه</a>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">ویژه</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title mb-2 text-bold">عنوان کارت ویژه</h6>

                <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است </p>
                <a href="#" class="btn btn-primary">برو به صفحه ایکس</a>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="m-0">ویژه</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title mb-2 text-bold">عنوان کارت ویژه</h6>

                <p class="card-text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                <a href="#" class="btn btn-primary">برو به صفحه ایکس</a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      

    </main>
    <div class="modal fade " style="z-index: 9999" id="dialer_modal" tabindex="-1" aria-labelledby="dialer_modal_label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialer_modal_label">شماره گیری کنید</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="dialer_table">
                        <tr>
                            <td id="dialer_input_td" colspan="3"><input type="number" placeholder=""></td>
                        </tr>
                        <tr class="dialer_num_tr">
                            <td class="dialer_num" onclick="dialerClick('dial', 1)">1</td>
                            <td class="dialer_num" onclick="dialerClick('dial', 2)">2</td>
                            <td class="dialer_num" onclick="dialerClick('dial', 3)">3</td>
                        </tr>
                        <tr class="dialer_num_tr">
                            <td class="dialer_num" onclick="dialerClick('dial', 4)">4</td>
                            <td class="dialer_num" onclick="dialerClick('dial', 5)">5</td>
                            <td class="dialer_num" onclick="dialerClick('dial', 6)">6</td>
                        </tr>
                        <tr class="dialer_num_tr">
                            <td class="dialer_num" onclick="dialerClick('dial', 7)">7</td>
                            <td class="dialer_num" onclick="dialerClick('dial', 8)">8</td>
                            <td class="dialer_num" onclick="dialerClick('dial', 9)">9</td>
                        </tr>
                        <tr class="dialer_num_tr">
                            <td class="dialer_del_td">
                                <img alt="clear" onclick="dialerClick('clear', 'clear')" src="data:image/svg+xml;base64,PHN2ZyBhcmlhLWhpZGRlbj0idHJ1ZSIgZm9jdXNhYmxlPSJmYWxzZSIgZGF0YS1wcmVmaXg9ImZhcyIgZGF0YS1pY29uPSJlcmFzZXIiIHJvbGU9ImltZyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgY2xhc3M9InN2Zy1pbmxpbmUtLWZhIGZhLWVyYXNlciBmYS13LTE2IGZhLTd4Ij48cGF0aCBmaWxsPSIjYjFiMWIxIiBkPSJNNDk3Ljk0MSAyNzMuOTQxYzE4Ljc0NS0xOC43NDUgMTguNzQ1LTQ5LjEzNyAwLTY3Ljg4MmwtMTYwLTE2MGMtMTguNzQ1LTE4Ljc0NS00OS4xMzYtMTguNzQ2LTY3Ljg4MyAwbC0yNTYgMjU2Yy0xOC43NDUgMTguNzQ1LTE4Ljc0NSA0OS4xMzcgMCA2Ny44ODJsOTYgOTZBNDguMDA0IDQ4LjAwNCAwIDAgMCAxNDQgNDgwaDM1NmM2LjYyNyAwIDEyLTUuMzczIDEyLTEydi00MGMwLTYuNjI3LTUuMzczLTEyLTEyLTEySDM1NS44ODNsMTQyLjA1OC0xNDIuMDU5em0tMzAyLjYyNy02Mi42MjdsMTM3LjM3MyAxMzcuMzczTDI2NS4zNzMgNDE2SDE1MC42MjhsLTgwLTgwIDEyNC42ODYtMTI0LjY4NnoiIGNsYXNzPSIiPjwvcGF0aD48L3N2Zz4=" width="22px" title="Clear" />
                            </td>
                            <td class="dialer_num" onclick="dialerClick('dial', 0)">0</td>
                            <td class="dialer_del_td">
                                <img alt="delete" onclick="dialerClick('delete', 'delete')" src="data:image/svg+xml;base64,PHN2ZyBhcmlhLWhpZGRlbj0idHJ1ZSIgZm9jdXNhYmxlPSJmYWxzZSIgZGF0YS1wcmVmaXg9ImZhciIgZGF0YS1pY29uPSJiYWNrc3BhY2UiIHJvbGU9ImltZyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgNjQwIDUxMiIgY2xhc3M9InN2Zy1pbmxpbmUtLWZhIGZhLWJhY2tzcGFjZSBmYS13LTIwIGZhLTd4Ij48cGF0aCBmaWxsPSIjREMxQTU5IiBkPSJNNDY5LjY1IDE4MS42NWwtMTEuMzEtMTEuMzFjLTYuMjUtNi4yNS0xNi4zOC02LjI1LTIyLjYzIDBMMzg0IDIyMi4wNmwtNTEuNzItNTEuNzJjLTYuMjUtNi4yNS0xNi4zOC02LjI1LTIyLjYzIDBsLTExLjMxIDExLjMxYy02LjI1IDYuMjUtNi4yNSAxNi4zOCAwIDIyLjYzTDM1MC4wNiAyNTZsLTUxLjcyIDUxLjcyYy02LjI1IDYuMjUtNi4yNSAxNi4zOCAwIDIyLjYzbDExLjMxIDExLjMxYzYuMjUgNi4yNSAxNi4zOCA2LjI1IDIyLjYzIDBMMzg0IDI4OS45NGw1MS43MiA1MS43MmM2LjI1IDYuMjUgMTYuMzggNi4yNSAyMi42MyAwbDExLjMxLTExLjMxYzYuMjUtNi4yNSA2LjI1LTE2LjM4IDAtMjIuNjNMNDE3Ljk0IDI1Nmw1MS43Mi01MS43MmM2LjI0LTYuMjUgNi4yNC0xNi4zOC0uMDEtMjIuNjN6TTU3NiA2NEgyMDUuMjZDMTg4LjI4IDY0IDE3MiA3MC43NCAxNjAgODIuNzRMOS4zNyAyMzMuMzdjLTEyLjUgMTIuNS0xMi41IDMyLjc2IDAgNDUuMjVMMTYwIDQyOS4yNWMxMiAxMiAyOC4yOCAxOC43NSA0NS4yNSAxOC43NUg1NzZjMzUuMzUgMCA2NC0yOC42NSA2NC02NFYxMjhjMC0zNS4zNS0yOC42NS02NC02NC02NHptMTYgMzIwYzAgOC44Mi03LjE4IDE2LTE2IDE2SDIwNS4yNmMtNC4yNyAwLTguMjktMS42Ni0xMS4zMS00LjY5TDU0LjYzIDI1NmwxMzkuMzEtMTM5LjMxYzMuMDItMy4wMiA3LjA0LTQuNjkgMTEuMzEtNC42OUg1NzZjOC44MiAwIDE2IDcuMTggMTYgMTZ2MjU2eiIgY2xhc3M9IiI+PC9wYXRoPjwvc3ZnPg==" width="25px" title="Delete" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"><a href="#" type="button" id="dialer_call_btn_td">تماس</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
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
<div type="button" class="btn btn-primary text-light" style="position: fixed;left:.7% ; bottom: 4%" data-toggle="modal" data-target="#dialer_modal">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
      </svg>
</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

<script>
    function dialerClick(type, value) {
       let input = $('#dialer_input_td input');
       let input_val = $('#dialer_input_td input').val();
       if (type == 'dial') {
           input.val(input_val + value);
       } else if (type == 'delete') {
           input.val(input_val.substring(0, input_val.length - 1));
       } else if (type == 'clear') {
           input.val("");
       }
   }
</script>
</body>
</html>
