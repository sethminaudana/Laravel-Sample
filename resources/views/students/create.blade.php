@extends('layouts.stApp')

@section('content')
    <h1 class="text-center mb-4">Add New Student</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter name">
                    <label for="name" class="form-label">Name:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email">
                    <label for="email" class="form-label">Email:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" placeholder="Select date of birth">
                    <label for="date_of_birth" class="form-label">Date of Birth:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="major" id="major" class="form-control" value="{{ old('major') }}" placeholder="Enter major">
                    <label for="major" class="form-label">Major:</label>
                </div>
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile Image:</label>
                    <input type="file" name="profile_image" id="profile_image" class="form-control">
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save me-2"></i>Save Student
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection