<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Management System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Students List</h2>
                    <p>This table is show all the students of xyz school or college:</p>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('students.create') }}"> Add New Student Details</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if (count($students) == 0)
        <div class="alert alert-danger">
            <p>No Data Found</p>
        </div>
        @else
        <table class="table table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Education</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Password</th>
        <th>Student Image</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($students as $student)
      <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $student->name }}</td>
        <td>{{ $student->education }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->phone }}</td>
        <td>{{ $student->password }}</td>
        <td>
        @if($student->image)
        <img src="{{ asset('images/'.$student->image) }}" style="height: 70px;width:100px;">
        @else 
        <span>No image found!</span>
        @endif
        </td>
        <td>
            <form action="{{ route('students.destroy',$student->id) }}" method="POST">

                <a class="btn btn-info" href="{{ route('students.show',$student->id) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('students.edit',$student->id) }}">Edit</a>

                @csrf
                @method('DELETE')
    
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
        {!! $students->links() !!}
</div>
</body>
</html>
