<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        $students = Student::all(); // Fetch all students from the database
        return view('students.index', compact('students')); // Pass the data to the view
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create'); // Show the create form
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'major' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Create a new student instance
        $student = new Student();
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->major = $request->input('major');

        // Save the student to the database
        $student->save();

        // Optionally, you can use the create() method for mass assignment (after defining $fillable in your model)
        // Student::create($request->all());

        // Redirect to the index page with a success message
        Session::flash('success', 'Student created successfully!');
        return redirect()->route('students.index');
    }

    /**
     * Display the specified student.  We don't really use this in this basic application.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student')); // Pass the student data to the edit form
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Validate the input data.  The email should be unique, except for the current student.
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'date_of_birth' => 'required|date',
            'major' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the student's attributes
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->major = $request->input('major');

        // Save the updated student to the database
        $student->save();

        // Redirect to the index page with a success message
        Session::flash('success', 'Student updated successfully!');
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        // Redirect to the index page with a success message
        Session::flash('success', 'Student deleted successfully!');
        return redirect()->route('students.index');
    }
}
