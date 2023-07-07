<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/registration.css')}}">
</head>
<body>
<div class="form_wrapper">
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong> <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <div class="form_container">
    <div class="title_container">
      <h2>Employee Registration Form</h2>
    </div>
    <div class="row clearfix">
      <div class="">
      <form action="{{ route('login.custom') }}" method="POST" enctype="multipart/form-data">
        @csrf
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
            <input type="email" name="email" placeholder="Email" />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="password" name="password" placeholder="Password"  />
          </div>
          <input class="button" type="submit" value="Login" /> 
        </form>
        <div class="input_field checkbox_option">
            <label for="cb2">Create a account</label>
            <a class="btn btn-primary" href="{{ route('register-user') }}"> Register</a>
        </div>
      </div>
    </div>
  </div>
</div>
<p class="credit"></p>
</body>
</html>