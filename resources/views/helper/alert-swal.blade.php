@if(session()->has('success'))
    <script type="text/javascript">
        var message = "{{ session()->get('success') }}";
        var swalInit = swal.mixin({
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-light',
                                denyButton: 'btn btn-light',
                                input: 'form-control'
                            }
                        });
        swalInit.fire('Sukses!', message, 'success');
    </script>
@endif
@if(session()->has('error'))
    <script type="text/javascript">
        var message = "{{ session()->get('error') }}";
        var swalInit = swal.mixin({
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: 'btn btn-primary',
                                cancelButton: 'btn btn-light',
                                denyButton: 'btn btn-light',
                                input: 'form-control'
                            }
                        });
        swalInit.fire('Error!', message, 'error');
    </script>
@endif