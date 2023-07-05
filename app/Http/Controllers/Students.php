<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class Students extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('students.index',compact('students'))->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'education' => 'required',
            'password' => 'required|min:6',
            'phone' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg'

        ]);
        
        $fileName = time() . '.' . $request->image->extension();
        
        //$request->image->storeAs('/public/images', $fileName);
        $request->image->move(public_path('images'), $fileName);

        
        $students = new Student;
        $students->name = $request->name;
        $students->email = $request->email;
        $students->education = $request->education;
        $students->phone = $request->phone;
        $students->password = $request->password;
        $students->image = $fileName;
        $students->save();
   
        return redirect()->route('students.index')->with('success','Student register successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // dd($product->id);
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|min:6|max:12',
            'education' => 'required',
            'password' => 'required|min:6'
        ]);
        $filename = '';
        if ($request->image) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $path = 'images/'.$student->image;
            if(File::exists($path))
            { 
                // dd("Hello");
                File::delete($path);
            }
        }else{
            $fileName = $student->image;
        }
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->education = $request->education;
        $student->password = bcrypt($request->input('password'));
        $student->image = $fileName;
        $student->update();
  
        return redirect()->route('students.index')->with('success','Student details updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
  
        return redirect()->route('students.index')->with('success','Student record deleted successfully');

    }
}
