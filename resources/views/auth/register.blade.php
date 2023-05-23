
@extends('website.layout')

@section('title')
    Register
@endsection

@section('name')
    Register
@endsection

@section('content')

     <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}" rel="nofollow">Home</a>
                    <span></span> Register
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Create an Account</h3>
                                        </div>
        <form method="POST" action="{{ route('register') }}"enctype="multipart/form-data">
             @csrf
                                            <div class="form-group">
                                                <input placeholder="Name"
                                                class="@error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}"required autocomplete="name" autofocus >
                @error('name')
                 <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                 </span>
                @enderror
                                            </div>


                                            <div class="form-group">
                                                <input placeholder="Email"type="email" id="email" class=" @error('email') is-invalid @enderror" name="email"value="{{ old('email') }}"required autocomplete="email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                @enderror
                                            </div>


                                            <div class="form-group">
                                                <input placeholder="Password"
                                                class="@error('password') is-invalid @enderror" id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                </span>
                @enderror
                                            </div>


                                            <div class="form-group">
                                                <input type="password" placeholder="Confirm password"id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                                            </div>

                                             <div class="form-group">
                                                <input type="file" placeholder="Image" id="image" class=" @error('image') is-invalid @enderror" name="image"value="{{ old('image') }}"required autocomplete="image">
                                            </div>

                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>


                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Submit &amp; Register</button>
                                            </div>


                                        </form>
                                        <div class="text-muted text-center">Already have an account? <a href="{{ route('login') }}">Sign in now</a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                               <img src="{{ asset('assets/website2/assets/imgs/login.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

