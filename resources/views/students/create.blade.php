<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register Student</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add new student</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
        </div>
    </div>
</div>
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
  <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
  @csrf
    <div class="mb-3 mt-3">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter student's name" name="name" value="{{old('name')}}">
    </div>
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter student's email id" name="email" value="{{old('email')}}">
    </div>
    <div class="mb-3">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Create password for student access" name="password" >
    </div>
    <div class="mb-3 mt-3">
    <label for="education">Education:</label>
        <select class="form-select" name='education'>
            <option value='10th'>10th</option>
            <option value='11th'>11th</option>
            <option value='12th'>12th</option>
        </select>
    </div>    
    <div class="mb-3 mt-3">
      <label for="phone">Phone Number:</label>
      <input type="tel" class="form-control" id="phone" placeholder="Enter student's phone number" name="phone" value="{{old('phone')}}">
    </div>
    <div class="mb-3 mt-3">
      <label for="image">Image:</label>
      <input type="file" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
