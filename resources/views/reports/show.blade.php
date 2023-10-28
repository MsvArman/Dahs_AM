<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>گزارش گیری</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('select/css/jquery.multiselect.css') }}">
    <link rel="stylesheet" href="{{ asset('select/css/style.css') }}">


    <style>
        .customer button {
            box-shadow: none;
            border: 1px solid #d8d8d8 !important;
            border-radius: 8px;
            margin-top: -1px;
        }

        .highcharts-title {
            margin-bottom: 20px;
            margin-top: 20px;
        }

        * {
            font-family: Vazir;
        }

        #container {
            height: 400px;
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">


        {{-- header nav --}}
        @include('main.header')

        {{-- sidebar --}}
        @include('main.sidebar')
    </div>
    <!-- ./wrapper -->


    <div class="col-md-10 float-left my-5 mx-3 d-flex">

        <div class="form-group col-4 my-2 w-100 px-2">
            <label for="timeReport" style="margin-bottom: 10px;">زمان</label>
            <select id="timeReport" class="form-select" aria-label="Default select example">
                <option value="all" selected>همه</option>
                <option value="today">امروز</option>
                <option value="weekly">هفتگی</option>
                <option value="monthly">ماهانه</option>
                <option value="yearly">سالانه</option>
            </select>
        </div>


        <div class="form-group col-4 my-2 w-100 px-2" id="time_Report_div" style="z-index: 999">
            <label for="customers" style="margin-bottom: 10px;">مشتریان</label>
            <select id="customers" class="form-select" aria-label="Default select example">
                <option value="all" selected>همه</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->NationalCode }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="form-group my-2 w-100 px-2" style="z-index: 999">
            <label for="customer" style="margin-bottom: 10px;">مشتریان</label>
            <select id="customer" name="customers[]"
            multiple
            class="3col active form-control text-start">
                <option value="all">همه</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->NationalCode }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div> --}}

        <button id="get_report" style="height: 40px; margin-top: 40px;" onclick="return false"
            class="btn btn-primary col-4">گزارش گیری</button>



    </div>

    <div class="m-md-3 col-md-10 float-left card">
        <div class="text-center fw-bold fs-5 my-3">اطلاعات تماس</div>
        <div id="container" class="p-4"></div>
    </div>


    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>



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

    <script src="{{ asset('axios.min.js') }}"></script>


    <script src="{{ asset('select/js/popper.min.js') }}"></script>
    <script src="{{ asset('select/js/jquery.multiselect.js') }}"></script>
    <script src="{{ asset('select/js/main.js') }}"></script>

    <script>
        $('#customer').multiselect({
            columns: 1,
            placeholder: 'مشتریان...',
            search: true,
            searchOptions: {
                'default': 'جستجو کنید...'
            },
            selectAll: false
        });

        $("#get_report").click(function(e) {
            var timeReport = $('#timeReport').find(":selected").val();
            var customers = $('#customers').find(":selected").val();

            axios.post(`{{ url('give_report') }}`, {
                    _token: null,
                    timeReport: timeReport,
                    customers: customers
                })
                .then(response => {
                    var data = response.data;

                    console.log(data);
                    console.log(data[0]);

                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: ''
                        },
                        xAxis: {
                            categories: ['تماس ها']
                        },
                        yAxis: {
                            title: "تعداد",
                        },
                        credits: {
                            enabled: false
                        },
                        plotOptions: {
                            column: {
                                borderRadius: '10%'
                            }
                        },
                        series: [{
                            name: 'ورودی',
                            data: [data[0]]
                        }, {
                            name: 'خروجی',
                            data: [data[1]]
                        }, {
                            name: 'از دست رفته ورودی',
                            data: [data[2]]
                        }, {
                            name: 'از دست رفته خروجی',
                            data: [data[3]]
                        }]
                    });

                }).catch(error => {
                    console.log(error)
                });
        })
    </script>
    {{-- <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: ['تماس ها']
            },
            yAxis: {
                title: "تعداد",
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                column: {
                    borderRadius: '10%'
                }
            },
            series: [{
                name: 'ورودی',
                data: [5]
            }, {
                name: 'خروجی',
                data: [3]
            }, {
                name: 'از دست رفته ورودی',
                data: [2]
            }, {
                name: 'از دست رفته خروجی',
                data: [4]
            }]
        });
    </script> --}}
</body>

</html>
