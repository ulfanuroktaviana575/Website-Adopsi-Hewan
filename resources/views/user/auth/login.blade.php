@extends('user/master')


@section('nama-page')
sub-page
@endsection



@section('page-title')
<div class="page-title">
    <div class="container">
        <h1>Sign In</h1>
    </div>
    <!--end container-->
</div>
@endsection

@section('brand-logo')
{{asset('user/assets/img/logo.png')}}
@endsection

@section('hero-form')

@endsection

@section('background')
<div class="background">
    <div class="background-image original-size">
        <img src="{{asset('user/assets/img/footer-background-icons.jpg')}}" alt="">
    </div>
    <!--end background-image-->
</div>
<!--end background-->
@endsection

@section('content')
<section class="block">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form class="form clearfix">
                    <div class="form-group">
                        <label for="username" class="col-form-label required">Username</label>
                        <input name="username" type="text" class="form-control" id="username"
                            placeholder="Your Username" required>
                    </div>
                    <!--end form-group-->
                    <div class="form-group">
                        <label for="password" class="col-form-label required">Password</label>
                        <input name="password" type="password" class="form-control" id="password"
                            placeholder="Enter Your Password" required>
                    </div>
                    <!--end form-group-->
                    <div class="d-flex justify-content-between align-items-baseline">
                        <label>
                            <input type="checkbox" name="remember" value="1">
                            Remember Me
                        </label>
                        <button type="submit" class="btn btn-primary">Sign In</button>
                    </div>
                </form>
                <hr>
                <p>
                    Don't have an account? <a href="{{route('register')}}" class="link">Click here.</a>
                </p>
            </div>
            <!--end col-md-6-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>
<!--end block-->
@endsection