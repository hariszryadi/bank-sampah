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
            <a href="{{ route('chart') }}" class="btn btn-warning btn-sm">Grafik</a>
            <a href="{{ route('login') }}" class="btn btn-success btn-sm">Admin</a>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="d-flex justify-content-center">
                <img src="{{ asset('img/banksampah_logo.png') }}" alt="" width="150px">
            </div>
            
            <div style="margin: 20px 120px; background-color: white;">
                <div style="padding: 20px;">
                    <form id="count-price">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama Penyetor</label>
                                    <input type="text" class="form-control" id="name" placeholder="Nama Penyetor">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="waste">Jenis Sampah</label>
                                    <select name="waste" class="form-control select-search" id="waste">
                                        <option value="" selected disabled>Pilih</option>
                                        @foreach ($waste as $item)
                                            <option value="{{ $item->id }}">{{ $item->category->name . ' - ' . $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="qty">Jumlah/kg</label>
                                    <input type="number" class="form-control" id="qty" name="qty" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total">Jumlah Harga</label>
                                    <input type="text" class="form-control" id="total" readonly>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Hitung</button>
                        <button type="button" id="btn-store" class="btn btn-danger" style="display: none;">Setor</button>
                    </form>
                </div>
            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </div>

    <script>
        // Init select2
        $('.select-search').select2();

        var name, waste, qty;

        $('#count-price').on('submit', function (e) {
            e.preventDefault();

            name = $('#name').val();
            waste = $('#waste').val();
            qty = $('#qty').val();

            if (name == '') {
                alert('Nama penyetor harus diisi');
                $('#total').val('');
                $('#btn-store').hide();
            } else if (waste == null) {
                alert('Pilih jenis sampah');
                $('#total').val('');
                $('#btn-store').hide();
            } else if (qty < 0) {
                alert('Jumlah harus dalam angka positif');
                $('#total').val('');
                $('#btn-store').hide();
            } else {
                $.ajax({
                    url: "{{ route('count') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {waste: waste, qty: qty},
                    success: function (resp) {
                        $('#total').val('Rp'+parseInt(resp).toLocaleString());
                        $('#btn-store').show();
                    },
                    error: function (xhr, status, error) {
                        alert(xhr.responseText);
                    }
                })
            }
        })

        $('#btn-store').on('click', function () {
            $.ajax({
                url: "{{ route('count.store') }}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {name: name, waste: waste, qty: qty},
                success: function (resp) {
                    var swalInit = swal.mixin({
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-light',
                                denyButton: 'btn btn-light',
                                input: 'form-control'
                            }
                        });
                    swalInit.fire('Sukses!', 'Sampah berhasil disetor', 'success').then((result) => {
                        // Reload the Page
                        location.reload();
                    });;
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            })
        })
    </script>
</body>
</html>
