<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student ID-Card</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-3">
<a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>  
<h2>Student ID-Card</h2>
  <p>Xyz School/college</p>
  <div class="card" style="width:400px">
    @if($student->image)
    <img class="card-img-top" src="{{ asset('images/'.$student->image) }}" style="width:100%">
    @else 
    <span>No image found!</span>
    @endif
    <div class="card-body">
      <h4 class="card-title">{{ $student->name }}</h4>
      <p class="card-text">Class : {{ $student->education }}</p>
      <p class="card-text">Phone Number : {{ $student->phone }}</p>
      <p class="card-text">EmailID : {{ $student->email }}</p>
    </div>
  </div>
  <br>
</div>

</body>
</html>
