<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Honeypays | Reset Password</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->
<style type="text/css">
    .wrap-login100 {
    width: 40%;
}
</style>

</head>
<body>
    
    <div class="limiter">
        <div class="container-login100">

            <div class="wrap-login100">
            
                <form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}">
                @csrf

                    <span class="login100-form-title p-b-26">
                        <img src="{{ asset('honeylogo.jpg') }}">
                    </span>

                    <span class="login100-form-title p-b-48">
                        Reset Password
                    </span>

                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "">
                        <input class="input100" type="email" name="email" value="{{ old('email') }}" required>
                        <span class="focus-input100" data-placeholder="*email"></span>
                        @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                    </div>

                   

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                               {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-t-115">
                        <a class="txt2" href="/login">
                            Login
                        </a>
                        
                        |

                        <a class="txt2" href="/register">
                            Sign Up
                        </a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    

    <div id="dropDownSelect1"></div>
    

<!--===============================================================================================-->
    <script src="{{ asset('js/lib/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('js/lib/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://code.tidio.co/myuqp2mwyctv2bsno70lihphmhxi3afo.js"></script>
</body>
</html>