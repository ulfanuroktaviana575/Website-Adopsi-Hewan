@extends('user/master')


@section('nama-page')
sub-page
@endsection



@section('page-title')
<div class="page-title">
    <div class="container">
        <h1><strong>Postingan Blog</strong></h1>
    </div>
    <!--end container-->
</div>
@endsection

@section('brand-logo')
{{asset('user/assets/img/include_image/logo_adoptpets.png')}}
@endsection

@section('hero-form')

@endsection

@section('background')
<div class="background">
    <div class="background-image">
        <img src="{{asset('user/assets/img/include_image/bg_akunsaya.jpg')}}" alt="">
    </div>
    <!--end background-image-->
</div>
@endsection

@section('content')
<section class="block">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <nav class="nav flex-column side-nav">
                    <a class="nav-link active icon" href="{{route('account')}}">
                        <i class="fa fa-user"></i>Profil Saya
                    </a>
                    <a class="nav-link icon" href="{{route('edit_posting')}}">
                        <i class="fa fa-paw"></i>Postingan Hewan
                    </a>
                    <a class="nav-link icon" href="">
                        <i class="fa fa-book"></i>Postingan Blog
                    </a>
                    <a class="nav-link icon" href="{{route('posting_clinic')}}">
                        <i class="fa fa-hospital-o"></i>Postingan Clinic
                    </a>
                    <a class="nav-link icon" href="{{route('alreadyadopt')}}">
                        <i class="fa fa-check"></i>Menunggu Disetujui
                    </a>
                    <a class="nav-link icon" href="{{route('logout')}}">
                        <i class="fa fa-sign-out"></i>Logout
                    </a>
                </nav>
            </div>
            <!--end col-md-3-->
            <div class="col-md-9">
                <!--============ Section Title===================================================================-->
                <div class="section-title clearfix">
                    <div class="float-left float-xs-none">
                        <label class="mr-3 align-text-bottom">Urutkan Berdasarkan: </label>
                        <select name="sorting" id="sorting" class="small width-200px"
                            data-placeholder="Default Sorting">
                            <option value="">Default Sorting</option>
                            <option value="1">Newest First</option>
                            <option value="2">Oldest First</option>
                            <option value="3">Lowest Price First</option>
                            <option value="4">Highest Price First</option>
                        </select>

                    </div>
                    <div class="float-right d-xs-none thumbnail-toggle">
                        <a href="#" class="change-class" data-change-from-class="list" data-change-to-class="grid"
                            data-parent-class="items">
                            <i class="fa fa-th"></i>
                        </a>
                        <a href="#" class="change-class active" data-change-from-class="grid"
                            data-change-to-class="list" data-parent-class="items">
                            <i class="fa fa-th-list"></i>
                        </a>
                    </div>
                </div>
                <!--============ Items ==========================================================================-->
                <div class="items list compact grid-xl-3-items grid-lg-2-items grid-md-2-items">
                    <div class="item">
                        <div class="wrapper">
                            <div class="image">
                                <h3>
                                    <a href="" class="title"></a>
                                </h3>
                                <a class="image-wrapper background-image">
                                    <img src="" alt="">
                                </a>
                            </div>

                            <!--end image-->
                            <div class="additional-info">
                                <ul>
                                    <li>
                                        <aside class="fas fa-calendar-alt"></aside>
                                    </li>
                                </ul>
                            </div>
                            <div class="description">
                                <p> </p>
                            </div>
                            <div class="admin-controls">
                                <a href="">
                                    <i class="fa fa-pencil"></i>Edit
                                </a>
                                <form action="" class="form-hapus">
                                    <button type="submit" onclick=""
                                        class="btn btn-framed btn-danger small btn-rounded"><i class="fa fa-trash"></i>
                                        Hapus</button>
                                </form>
                            </div>
                            <a href="" class="detail text-caps underline">Detail</a>
                        </div>
                    </div>
                    <!--end item-->

                </div>
                <!--end items-->
            </div>
            <!--end col-md-9-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end block-->
@endsection