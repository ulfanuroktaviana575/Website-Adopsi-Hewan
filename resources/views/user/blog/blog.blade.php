@extends('user/master')


@section('nama-page')
sub-page
@endsection



@section('page-title')
<div class="page-title">
    <div class="container">
        <h1>Cari Informasi Terbaik Tentang Hewan Peliharan Anda</h1>
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
    <div class="background-image original-size">
        <img src="assets/img/footer-background-icons.jpg" alt="">
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
                    <a href="blog-post.html">
                        <img src="assets/img/blog-image-01.jpg" alt="">
                    </a>
                    <div class="article-title">
                        <h2><a href="blog-post.html">10 tips untuk Menghilangkan Kutu pada Bulu Anjing</a></h2>
                        <div class="tags framed">
                            <a href="#" class="tag">Cat</a>
                            <a href="#" class="tag">Treat</a>
                        </div>
                    </div>
                    <div class="meta">
                        <figure>
                            <a href="#" class="icon">
                                <i class="fa fa-user"></i>
                                John Doe
                            </a>
                        </figure>
                        <figure>
                            <i class="fa fa-calendar-o"></i>
                            02.05.2017
                        </figure>
                    </div>
                    <div class="blog-post-content">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit
                            amet fermentum sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos. Vestibulum tincidunt, sapien sagittis sollicitudin dapibus,
                            risus mi euismod elit
                        </p>
                        <a href="{{route('blog_detail')}}" class="btn btn-primary btn-framed detail">Read more</a>
                    </div>
                </article>

                <article class="blog-post clearfix">
                    <a href="blog-post.html">
                        <img src="assets/img/blog-image-06.jpg" alt="">
                    </a>
                    <div class="article-title">
                        <h2><a href="blog-post.html">Rekomendasi Tempat Aksesori Hewan Peliharan</a></h2>
                        <div class="tags framed">
                            <a href="#" class="tag">Pets</a>
                            <a href="#" class="tag">Accecories</a>
                        </div>
                    </div>
                    <div class="meta">
                        <figure>
                            <a href="#" class="icon">
                                <i class="fa fa-user"></i>
                                John Doe
                            </a>
                        </figure>
                        <figure>
                            <i class="fa fa-calendar-o"></i>
                            02.05.2017
                        </figure>
                    </div>
                    <div class="blog-post-content">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit
                            amet fermentum sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra,
                            per inceptos himenaeos. Vestibulum tincidunt, sapien sagittis sollicitudin dapibus,
                            risus mi euismod elit
                        </p>
                        <a href="{{route('blog_detail')}}" class="btn btn-primary btn-framed detail">Read more</a>
                    </div>
                </article>

                <!--end Articles-->

                <div class="page-pagination">
                    <nav aria-label="Pagination">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">
                                        <i class="fa fa-chevron-left"></i>
                                    </span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">
                                        <i class="fa fa-chevron-right"></i>
                                    </span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--end page-pagination-->
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
                        <h2>Popular Posts</h2>
                        <div class="sidebar-post">
                            <a href="blog-post.html" class="background-image">
                                <img src="assets/img/blog-image-03.jpg">
                            </a>
                            <!--end background-image-->
                            <div class="description">
                                <h4>
                                    <a href="blog-post.html">How to build a cool swimming pool</a>
                                </h4>
                                <div class="meta">
                                    <a href="#">John Doe</a>
                                    <figure>02.05.2017</figure>
                                </div>
                                <!--end meta-->
                            </div>
                            <!--end description-->
                        </div>
                        <!--end sidebar-post-->

                        <div class="sidebar-post">
                            <a href="blog-post.html" class="background-image">
                                <img src="assets/img/blog-image-04.jpg">
                            </a>
                            <!--end background-image-->
                            <div class="description">
                                <h4>
                                    <a href="blog-post.html">Concrete decorations can be beautiful</a>
                                </h4>
                                <div class="meta">
                                    <a href="#">John Doe</a>
                                    <figure>02.05.2017</figure>
                                </div>
                                <!--end meta-->
                            </div>
                            <!--end description-->
                        </div>
                        <!--end sidebar-post-->

                        <div class="sidebar-post">
                            <a href="blog-post.html" class="background-image">
                                <img src="assets/img/blog-image-05.jpg">
                            </a>
                            <!--end background-image-->
                            <div class="description">
                                <h4>
                                    <a href="blog-post.html">Let’s take a break</a>
                                </h4>
                                <div class="meta">
                                    <a href="#">John Doe</a>
                                    <figure>02.05.2017</figure>
                                </div>
                                <!--end meta-->
                            </div>
                            <!--end description-->
                        </div>
                        <!--end sidebar-post-->

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