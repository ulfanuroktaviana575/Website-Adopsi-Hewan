@extends('user/master')


@section('nama-page')
sub-page
@endsection



@section('page-title')
<div class="page-title">
    <div class="container">
        <h1>Information Detail Klinik</h1>
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
        <img src="{{asset('user/assets/img/include_image/bg_klinik1.jpg')}}" alt="">
    </div>
    <!--end background-image-->
</div>
<!--end background-->
@endsection

@section('content')
<section class="block">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <article class="blog-post clearfix">
                    <a>
                        <img src="{{asset($data->picture)}}" alt="">
                    </a>
                    <div class="article-title">
                        <h2><a>{{$data->nama_klinik}}</a></h2>
                        <div class="row justify-content-end">
                            <button class="tombol btn btn-framed btn-primary btn-rounded" id="btn_report"
                                data-id="">Report</button>
                        </div>
                    </div>
                    <div class="meta">
                        <figure>
                            <a class="icon">
                                <i class="fa fa-user"></i>
                                {{$user[$data->user_id]}}
                            </a>
                        </figure>
                        <figure>
                            <i class="fa fa-calendar-o"></i>
                            {{$data->created_at}}
                        </figure>
                    </div>
                    <div class="blog-post-content">
                        <p>@php
                            echo($data->deskripsi)
                            @endphp
                        </p>
                        <hr>
                        <div class="author">
                            <div class="author-image">
                                <div class="background-image">
                                    <img src="{{asset($data->picture)}}" alt="">
                                </div>
                            </div>
                            <!--end author-image-->
                            <div class="author-description">
                                <div class="section-title">
                                    <h2>{{$data->nama_klinik}}</h2>
                                    <h4 class="location">
                                        <a href="#">{{$data->lokasi}}</a>
                                    </h4>
                                    <p></p>
                                    <h4 class="email">
                                        <a href="#"><i class="fa fa-envelope"></i> {{$data->email}}</a>
                                    </h4>
                                    <p></p>
                                    <h4 class="phone">
                                        <a href="#"><i class="fa fa-phone"></i> {{$data->no_telepon}}</a>
                                    </h4>
                                </div>
                            </div>
                            <!--end author-description-->
                        </div>
                        <!--end author-->
                    </div>
                    <!--end blog-post-content-->
                </article>



                <!--end Article-->

                {{-- <section>
                    <div class="blog-posts-navigation clearfix">
                        <a href="#" class="prev">
                            <i class="fa fa-chevron-left"></i>
                            <figure>Previous Post</figure>
                        </a>
                        <!--end prev-->
                        <a href="#" class="next">
                            <i class="fa fa-chevron-right"></i>
                            <figure>Next Post</figure>
                        </a>
                    </div>
                    <!--end blog-posts-navigation-->
                </section> --}}

                <hr>

            </div>
            <!--end col-md-8-->

            <div class="col-md-4">
                <!--============ Side Bar ===============================================================-->
                <aside class="sidebar">
                    <section>
                        <h2>Search Blog</h2>
                        <!--============ Side Bar Search Form ===========================================-->
                        <form class="sidebar-form form">
                            <div class="form-group">
                                <label for="what" class="col-form-label">What?</label>
                                <input name="keyword" type="text" class="form-control" id="what"
                                    placeholder="Enter keyword and press enter">
                            </div>
                            <!--end form-group-->
                        </form>
                        <!--============ End Side Bar Search Form =======================================-->
                    </section>
                    <section>
                        <h2>Latest Clinics</h2>
                        @foreach ($latest as $item)
                        <div class="sidebar-post">
                            <a href="{{route('readmore_clinic', ['id'=>$item->id])}}" class="background-image">
                                <img src="{{asset($item->picture)}}">
                            </a>
                            <!--end background-image-->
                            <div class="description">
                                <h4>
                                    <a href="{{route('readmore_clinic', ['id'=>$item->id])}}">{{$item->nama_klinik}}</a>
                                </h4>
                                <div class="meta">
                                    <a
                                        href="{{route('readmore_clinic', ['id'=>$item->id])}}">{{$user[$item->user_id]}}</a>
                                    <figure>{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</figure>
                                </div>
                                <!--end meta-->
                            </div>
                            <!--end description-->
                        </div>
                        <!--end sidebar-post-->
                        @endforeach

                    </section>

                </aside>
                <!--============ End Side Bar ===========================================================-->
            </div>
            <!--end col-md-3-->
        </div>
    </div>
    <!--end container-->
</section>
<!--end block-->
@endsection
