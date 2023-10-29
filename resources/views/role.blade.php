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

  <title>مدیریت سمت</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

  <link rel="stylesheet" href="{{asset('dist/css/customcss.css')}}">
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
            <h1 class="m-0 text-dark">صفحه مدیریت سمت ها</h1>
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
      <div class="container-fluid d-flex justify-content-center align-items-center my-auto h-100 w-100">
        <div class="card w-100">
          <div class="card-body d-flex flex-column align-items-center justify-content-center">
            <div class="card w-50 mx-2">
              <div class="card-header  border-0">
                <h3 class="card-title text-center">افزودن سمت</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body text-center" style="display: block;">
                <form action="{{ route('createrole') }}" method="post">
                  <div class="input-group">
                    <input type="text" name="role" placeholder="نام سمت را بنویسید ..." class="form-control">
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-success">ارسال</button>
                      </span>
                    </div>
                  @csrf
                </form>
              </div>
              {{-- <hr> --}}
              <div class="card-body " style="display: block;">
                <div class="form-group">
                  <label class="text-end">برای حذف سمت انخاب کنید</label>
                  <form action="{{ route('delrole') }}" method="post">
                    <select name="role" class="form-control">
                      @foreach ($roles as $role)
                      <option>{{ $role->role }}</option>
                      @endforeach
                    </select>
                    @csrf
                    <br>
                    <div class="text-center">
                      <button type="submit" class="btn btn-danger mx-auto px-4 py-2">حذف</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          


{{--           
            <div class="card w-50 mx-2">
              <div class="card-header border-0">
                <h3 class="card-title text-start text-danger">حذف سمت</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body " style="display: block;">
                <div class="form-group">
                  <label class="text-end">انتخاب کنید</label>
                  <form action="{{ route('delrole') }}" method="post">
                    <select name="role" class="form-control">
                      @foreach ($roles as $role)
                      <option>{{ $role->role }}</option>
                      @endforeach
                    </select>
                    @csrf
                    <br>
                    <button type="submit" class="btn btn-danger mx-auto px-4 py-2">حذف</button>
                  </form>
                </div>
              </div>
              <!-- /.card-body -->
            </div> --}}
            <!-- /.card -->
          </div>


        </div>

      </div><!-- /.container-fluid -->
      

    </main>
    {{-- <div class="modal fade " style="z-index: 9999" id="dialer_modal" tabindex="-1" aria-labelledby="dialer_modal_label" aria-hidden="true">
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
                      <form action="{{ route('caller')}}" method="post">
                        <tr>
                            <td id="dialer_input_td" colspan="3"><input name="number" type="number" placeholder=""></td>
                        </tr>
                        <tr class="dialer_num_tr">
                          <td class="dialer_num" onclick="dialerClick('dial', 3)">3</td>
                          <td class="dialer_num" onclick="dialerClick('dial', 2)">2</td>
                          <td class="dialer_num" onclick="dialerClick('dial', 1)">1</td>
                        </tr>
                        <tr class="dialer_num_tr">
                          <td class="dialer_num" onclick="dialerClick('dial', 6)">6</td>
                          <td class="dialer_num" onclick="dialerClick('dial', 5)">5</td>
                          <td class="dialer_num" onclick="dialerClick('dial', 4)">4</td>
                        </tr>
                        <tr class="dialer_num_tr">
                          <td class="dialer_num" onclick="dialerClick('dial', 9)">9</td>
                          <td class="dialer_num" onclick="dialerClick('dial', 8)">8</td>
                          <td class="dialer_num" onclick="dialerClick('dial', 7)">7</td>
                        </tr>
                        <tr class="dialer_num_tr">
                          <td class="dialer_del_td">
                            <img alt="delete" onclick="dialerClick('delete', 'delete')" src="data:image/svg+xml;base64,PHN2ZyBhcmlhLWhpZGRlbj0idHJ1ZSIgZm9jdXNhYmxlPSJmYWxzZSIgZGF0YS1wcmVmaXg9ImZhciIgZGF0YS1pY29uPSJiYWNrc3BhY2UiIHJvbGU9ImltZyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgNjQwIDUxMiIgY2xhc3M9InN2Zy1pbmxpbmUtLWZhIGZhLWJhY2tzcGFjZSBmYS13LTIwIGZhLTd4Ij48cGF0aCBmaWxsPSIjREMxQTU5IiBkPSJNNDY5LjY1IDE4MS42NWwtMTEuMzEtMTEuMzFjLTYuMjUtNi4yNS0xNi4zOC02LjI1LTIyLjYzIDBMMzg0IDIyMi4wNmwtNTEuNzItNTEuNzJjLTYuMjUtNi4yNS0xNi4zOC02LjI1LTIyLjYzIDBsLTExLjMxIDExLjMxYy02LjI1IDYuMjUtNi4yNSAxNi4zOCAwIDIyLjYzTDM1MC4wNiAyNTZsLTUxLjcyIDUxLjcyYy02LjI1IDYuMjUtNi4yNSAxNi4zOCAwIDIyLjYzbDExLjMxIDExLjMxYzYuMjUgNi4yNSAxNi4zOCA2LjI1IDIyLjYzIDBMMzg0IDI4OS45NGw1MS43MiA1MS43MmM2LjI1IDYuMjUgMTYuMzggNi4yNSAyMi42MyAwbDExLjMxLTExLjMxYzYuMjUtNi4yNSA2LjI1LTE2LjM4IDAtMjIuNjNMNDE3Ljk0IDI1Nmw1MS43Mi01MS43MmM2LjI0LTYuMjUgNi4yNC0xNi4zOC0uMDEtMjIuNjN6TTU3NiA2NEgyMDUuMjZDMTg4LjI4IDY0IDE3MiA3MC43NCAxNjAgODIuNzRMOS4zNyAyMzMuMzdjLTEyLjUgMTIuNS0xMi41IDMyLjc2IDAgNDUuMjVMMTYwIDQyOS4yNWMxMiAxMiAyOC4yOCAxOC43NSA0NS4yNSAxOC43NUg1NzZjMzUuMzUgMCA2NC0yOC42NSA2NC02NFYxMjhjMC0zNS4zNS0yOC42NS02NC02NC02NHptMTYgMzIwYzAgOC44Mi03LjE4IDE2LTE2IDE2SDIwNS4yNmMtNC4yNyAwLTguMjktMS42Ni0xMS4zMS00LjY5TDU0LjYzIDI1NmwxMzkuMzEtMTM5LjMxYzMuMDItMy4wMiA3LjA0LTQuNjkgMTEuMzEtNC42OUg1NzZjOC44MiAwIDE2IDcuMTggMTYgMTZ2MjU2eiIgY2xhc3M9IiI+PC9wYXRoPjwvc3ZnPg==" width="25px" title="Delete" />
                          </td>
                          <td class="dialer_num" onclick="dialerClick('dial', 0)">0</td>
                          <td class="dialer_del_td">
                              <img alt="clear" onclick="dialerClick('clear', 'clear')" src="data:image/svg+xml;base64,PHN2ZyBhcmlhLWhpZGRlbj0idHJ1ZSIgZm9jdXNhYmxlPSJmYWxzZSIgZGF0YS1wcmVmaXg9ImZhcyIgZGF0YS1pY29uPSJlcmFzZXIiIHJvbGU9ImltZyIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2aWV3Qm94PSIwIDAgNTEyIDUxMiIgY2xhc3M9InN2Zy1pbmxpbmUtLWZhIGZhLWVyYXNlciBmYS13LTE2IGZhLTd4Ij48cGF0aCBmaWxsPSIjYjFiMWIxIiBkPSJNNDk3Ljk0MSAyNzMuOTQxYzE4Ljc0NS0xOC43NDUgMTguNzQ1LTQ5LjEzNyAwLTY3Ljg4MmwtMTYwLTE2MGMtMTguNzQ1LTE4Ljc0NS00OS4xMzYtMTguNzQ2LTY3Ljg4MyAwbC0yNTYgMjU2Yy0xOC43NDUgMTguNzQ1LTE4Ljc0NSA0OS4xMzcgMCA2Ny44ODJsOTYgOTZBNDguMDA0IDQ4LjAwNCAwIDAgMCAxNDQgNDgwaDM1NmM2LjYyNyAwIDEyLTUuMzczIDEyLTEydi00MGMwLTYuNjI3LTUuMzczLTEyLTEyLTEySDM1NS44ODNsMTQyLjA1OC0xNDIuMDU5em0tMzAyLjYyNy02Mi42MjdsMTM3LjM3MyAxMzcuMzczTDI2NS4zNzMgNDE2SDE1MC42MjhsLTgwLTgwIDEyNC42ODYtMTI0LjY4NnoiIGNsYXNzPSIiPjwvcGF0aD48L3N2Zz4=" width="22px" title="Clear" />
                          </td>
                        </tr>
                        <tr>
                            <td colspan="3"><button type="submit" id="dialer_call_btn_td">تماس</button></td>
                        </tr>
                        @csrf
                        <input type="hidden" name="ext" value="{{ auth()->user()->mobile }}" />
                      </form>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
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
{{-- <div type="button" class="btn btn-primary text-light" style="position: fixed;left:.7% ; bottom: 4%" data-toggle="modal" data-target="#dialer_modal">
    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
      </svg>
</div> --}}
<!-- REQUIRED SCRIPTS -->
@include('main.caller')
<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>

{{-- <script>
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
</script> --}}
</body>
</html>
