@extends('layouts.admin.app')

@section('content')
<!-- Inner content -->
<div class="content-inner">

    <!-- Page header -->
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-lg-inline">
            <div class="page-title d-flex">
                <h4>Dashboard</h4>
            </div>
        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-lg-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <span class="breadcrumb-item active">Dashboard</span>
                </div>

            </div>
        </div>
    </div>
    <!-- /page header -->


    <!-- Content area -->
    <div class="content">

        <!-- Dashboard content -->
        <div class="row">
            <div class="col-xl-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Selamat Datang di Dashboard Admin Bank Sampah</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /dashboard content -->

    </div>
    <!-- /content area -->

</div>
<!-- /inner content -->
@endsection