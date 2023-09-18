<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('global_assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script src="{{ asset('global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script src="{{ asset('global_assets/js/plugins/pickers/daterangepicker.js') }}"></script>
	<script src="{{ asset('global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>

	<script src="{{ asset('assets/js/app.js') }}"></script>
    <!-- /theme JS files -->
</head>
<body>
    <div class="relative">
        <div class="text-right p-2">
            <a href="{{ route('home') }}" class="btn btn-warning btn-sm">Kembali</a>
            <a href="{{ route('login') }}" class="btn btn-success btn-sm">Admin</a>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div style="margin: 20px 120px; background-color: white;">
                <div style="padding: 20px;">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        const chart = "{{ $chart }}";
        const result = JSON.parse(chart.replace(/&quot;/g,'"'));
        
        const arrayLabel = $.map(result, function(value, index) {
            return [value.name];
        });
        
        const arrayData = $.map(result, function(value, index) {
            return [value.total_qty];
        });

        new Chart(ctx, {
        type: 'bar',
        data: {
            labels: arrayLabel,
            datasets: [{
                label: '#Grafik Sampah',
                data: arrayData,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        });
    </script>
</body>
</html>
