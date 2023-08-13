<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <meta name="description" content="POS">
      <meta name="keywords" content="Login Page">
      <meta name="author" content="ND">
      <meta name="robots" content="noindex, nofollow">
      <title>Login</title>
      <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css" integrity="sha512-RtgdY8FN0wFbR4ascGaGFDgjPJBzXP6WZZExVmmWJOaTCm4B0nF3e4G9iy9SfATuFQxyc+Mq7hXINynh3iwLDg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha512-0S+nbAYis87iX26mmj/+fWt1MmaKCv80H+Mbo+Ne7ES4I6rxswpfnC6PxmLiw33Ywj2ghbtTw0FkLbMWqh4F7Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="{{ asset('auth/style.css') }}">
   </head>
   <body class="account-page">
      <form method="POST" action="{{ route('login') }}">
         @csrf
         <div class="row">
            <div class="col-4"></div>
            <div class="col-8">
               <div class="main-wrapper">
                  <div class="account-content">
                     <div class="login-wrapper">
                        <div class="login-content">
                           <div class="login-userset">
                              <div class="login-logo logo-normal">
                                 <img src="{{ asset('auth/logo.png') }}" alt="img">
                              </div>
                              <a href="index.html" class="login-logo logo-white">
                              <img src="{{ asset('auth/logo-white.png') }}" alt>
                              </a>
                              <div class="login-userheading">
                                 <h3>{{ __('Login') }}</h3>
                              </div>
                              <div class="form-login">
                                 <label>{{ __('Username') }}</label>
                                 <div class="form-addons">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-login">
                                 <label>{{ __('Password') }}</label>
                                 <div class="pass-group">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="form-login">
                                 <button type="submit" class="btn btn-login">
                                 {{ __('Login') }}
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js" integrity="sha512-24XP4a9KVoIinPFUbcnjIjAjtS59PUoxQj3GNVpWc86bCqPuy3YxAcxJrxFCxXe4GHtAumCbO2Ze2bddtuxaRw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js" integrity="sha512-pax4MlgXjHEPfCwcJLQhigY7+N8rt6bVvWLFyUMuxShv170X53TRzGPmPkZmGBhk+jikR8WBM4yl7A9WMHHqvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   </body>
</html>