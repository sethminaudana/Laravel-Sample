<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    //
    /**
     * Display a listing of the students.
     */
    public function index(Request $request)
    {
        $query = Student::query(); // Start a new query builder instance

        // Check if a search term is present in the request
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('major', 'like', '%' . $searchTerm . '%');
        }

        $students = $query->get(); // Execute the query and get the results
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
        // --- TEMPORARY DEBUGGING CODE ---
    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        Log::info('Uploaded file details:', [
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'extension' => $file->getClientOriginalExtension(),
            'size' => $file->getSize(),
            'is_valid' => $file->isValid(),
        ]);
        // You can also use dd($file->getMimeType()); to stop execution and see the MIME type
        // dd($file->getMimeType());
    }
    // --- END TEMPORARY DEBUGGING CODE ---

        // Validate the input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'major' => 'required|string|max:255',
            'profile_image' => 'nullable|image|max:5048', // Image validation rules
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

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Store the image in the 'public' disk under 'profile_images' directory
            // The path returned will be relative to 'storage/app/public/'
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $student->profile_image = $imagePath;
        }

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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation rules
       
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the student's attributes
        $student->name = $request->input('name');
        $student->email = $request->input('email');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->major = $request->input('major');

         // Handle profile image update
         if ($request->hasFile('profile_image')) {
            // Delete old image if it exists
            if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
                Storage::disk('public')->delete($student->profile_image);
            }
            // Store the new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $student->profile_image = $imagePath;
        } elseif ($request->input('remove_profile_image')) { // Check if user wants to remove the image
            if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
                Storage::disk('public')->delete($student->profile_image);
            }
            $student->profile_image = null; // Set image path to null in database
        }

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
         // Delete profile image from storage if it exists
         if ($student->profile_image && Storage::disk('public')->exists($student->profile_image)) {
            Storage::disk('public')->delete($student->profile_image);
        }
        $student->delete();

        // Redirect to the index page with a success message
        Session::flash('success', 'Student deleted successfully!');
        return redirect()->route('students.index');
    }
    /**
     * Generate and download a CSV report of all students.
     */
    public function downloadReportCsv()
    {
        $students = Student::all(); // Fetch all students

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="students_report_' . date('Ymd_His') . '.csv"',
        ];

        $callback = function() use ($students) {
            $file = fopen('php://output', 'w'); // Open a file pointer to php://output
            // Add UTF-8 BOM to prevent Excel from misinterpreting as SYLK
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Add CSV headers
            fputcsv($file, ['ID', 'Name', 'Email', 'Date of Birth', 'Major', 'Created At', 'Updated At']);

            // Add student data
            foreach ($students as $student) {
                fputcsv($file, [
                    $student->id,
                    $student->name,
                    $student->email,
                    $student->date_of_birth,
                    $student->major,
                   // $student->profile_image, // Full path to image
                    // Format timestamps to YYYY-MM-DD HH:MM:SS
                    $student->created_at ? $student->created_at->format('Y-m-d H:i:s') : '',
                    $student->updated_at ? $student->updated_at->format('Y-m-d H:i:s') : '',
                ]);
            }
            fclose($file); // Close the file pointer
        };

        return response()->stream($callback, 200, $headers);
    }
}
