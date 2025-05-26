@extends('layouts.stApp')

@section('content')
    <h1 class="text-center mb-4">Student List</h1>

    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Student
        </a>
        
        <div>
            <form action="{{ route('students.index') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Search by name, email, or major..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">
                <i class="bi bi-search"></i> Search
            </button>
        </form>
    </div>
        
    </div>

    <div >
        <div>
            <div >
                <table class="table table-hover table-striped">
                    <thead class="bg-light">
                        <tr>
                            
                            <th>Name</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Major</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <!-- <td>{{ $student->id }}</td> -->
                            <td>{{ $student->name }}</td>
                            <td>
                                @if($student->profile_image)
                                    <img src="{{ asset('storage/' . $student->profile_image) }}" alt="Profile Image"  style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                                @else
                                    <img src="https://placehold.co/50x50/cccccc/333333?text=No+Image" alt="No Image"  style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 1px solid #ccc;">
                                @endif
                            </td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->date_of_birth }}</td>
                            <td>{{ $student->major }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    
                                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-info ">
                                        <i class="bi bi-eye">view</i>
                                    </a>
                                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil">update</i>
                                    </a>
                                    
                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this student?')">
                                            <i class="bi bi-trash">delete</i>
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a href="{{ route('students.report.csv') }}" class="btn btn-success"> <i class="bi bi-download me-2"></i>Download Report (CSV)
        </a>
    </div>
@endsection