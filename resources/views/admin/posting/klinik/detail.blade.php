@extends('admin/master')

@section('title')
Detail Postingan Klinik
@endsection

{{-- my css --}}
@section('custom-style')

<!--STYLESHEET-->
<!--=================================================-->

<!--Open Sans Font [ OPTIONAL ]-->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


<!--Bootstrap Stylesheet [ REQUIRED ]-->
<link href="{{asset('admin/asset/css/bootstrap.min.css')}}" rel="stylesheet">


<!--Nifty Stylesheet [ REQUIRED ]-->
<link href="{{asset('admin/asset/css/nifty.min.css')}}" rel="stylesheet">


<!--Nifty Premium Icon [ DEMONSTRATION ]-->
<link href="{{asset('admin/asset/css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">


<!--=================================================-->



<!--Pace - Page Load Progress Par [OPTIONAL]-->
<link href="{{asset('admin/asset/plugins/pace/pace.min.css')}}" rel="stylesheet">
<script src="{{asset('admin/asset/plugins/pace/pace.min.js')}}"></script>


<!--Demo [ DEMONSTRATION ]-->
<link href="{{asset('admin/asset/css/demo/nifty-demo.min.css')}}" rel="stylesheet">



<!--DataTables [ OPTIONAL ]-->
<link href="{{asset('admin/asset/plugins/datatables/media/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('admin/asset/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css')}}"
    rel="stylesheet">

<link rel="stylesheet" href="{{asset('user/assets/fonts/font-awesome.css')}}" type="text/css">


@endsection

{{-- judul halaman pada bagian atas halaman --}}
@section('page-head')
<div id="page-head">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Detail Postingan Klinik</h1>
    </div>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End page title-->


    <!--Breadcrumb-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard_admin')}}"><i class="demo-pli-home"></i></a></li>
        <li><a href="">Posting</a></li>
        <li><a href="{{route('posting_clinic_list')}}">Data Postingan Klinik</a></li>
        <li class="active">Detail</li>
    </ol>
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <!--End breadcrumb-->
</div>
@endsection

{{-- content halaman --}}
@section('content')
<div id="page-content">
    <!-- Basic Data Tables -->
    <!--===================================================-->
    <div class="panel blog blog-details">
        <div class="panel-body">
            <div class="blog-title media-block">
                <div class="media-right textright">
                    <span class="mar-rgt"><i class="fa fa-phone icon-fw"></i>{{$data->no_telepon}}</span>
                    <i class="fa fa-envelope icon-fw"></i>{{$data->email}}
                </div>
                <div class="media-body">
                    <a href="#" class="btn-link">
                        <h1>{{ $data->nama_klinik}}</h1>
                    </a>
                    <!-- <p>Oleh : <a href="#" class="btn-link">{{$user[$data->user_id]}}</a></p> -->
                    <p>Lokasi : <a href="#" class="btn-link">{{$data->lokasi}}</a></p>
                </div>
            </div>
            <div class="blog-header">
                <img src="{{asset($data->picture)}}" alt="Image">
            </div>
            <div class="blog-content">

                <div class="blog-body">
                    <p>@php
                        echo $data->deskripsi
                        @endphp
                    </p>
                </div>
            </div>
            <div class="blog-footer">
                <div class="media-left">
                    <span
                        class="label label-success">{{\Carbon\Carbon::parse($data->created_at)->format('d.m.Y')}}</span>
                    <small>Diposting Oleh : <a href="#" class="btn-link">{{$user[$data->user_id]}}</a></small>
                </div>
                <!-- <div class="media-body text-right">
                    <span class="mar-rgt"><i class="demo-pli-heart-2 icon-fw"></i>{{$data->no_telepon}}</span>
                    <i class="demo-pli-mail icon-fw"></i>{{$data->email}}
                </div> -->
            </div>
        </div>
    </div>
    <!--===================================================-->
    <!-- End Striped Table -->

</div>
@endsection

{{-- cutom java script --}}
@section('custom-js')

<!--JAVASCRIPT-->
<!--=================================================-->

<!--jQuery [ REQUIRED ]-->
<script src="{{asset('admin/asset/js/jquery.min.js')}}"></script>


<!--BootstrapJS [ RECOMMENDED ]-->
<script src="{{asset('admin/asset/js/bootstrap.min.js')}}"></script>


<!--NiftyJS [ RECOMMENDED ]-->
<script src="{{asset('admin/asset/js/nifty.min.js')}}"></script>




<!--=================================================-->

<!--Demo script [ DEMONSTRATION ]-->
<script src="{{asset('admin/asset/js/demo/nifty-demo.min.js')}}"></script>


<!--DataTables [ OPTIONAL ]-->
<script src="{{asset('admin/asset/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin/asset/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('admin/asset/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}">
</script>


<!--DataTables Sample [ SAMPLE ]-->
<script src="{{asset('admin/asset/js/demo/tables-datatables.js')}}"></script>

@endsection