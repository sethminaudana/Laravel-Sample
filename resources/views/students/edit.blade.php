@extends('layouts.stApp')

@section('content')
    <h1 class="text-center mb-4">Edit Student</h1>

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

            <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3">
                    <input type="text" name="name" id="name" class="form-control" value="{{ $student->name }}" placeholder="Enter name">
                    <label for="name" class="form-label">Name:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" id="email" class="form-control" value="{{ $student->email }}" placeholder="Enter email">
                    <label for="email" class="form-label">Email:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ $student->date_of_birth }}" placeholder="Select date of birth">
                    <label for="date_of_birth" class="form-label">Date of Birth:</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="major" id="major" class="form-control" value="{{ $student->major }}" placeholder="Enter major">
                    <label for="major" class="form-label">Major:</label>
                </div>
                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile Image:</label>
                    @if($student->profile_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $student->profile_image) }}" alt="Current Profile Image" class="profile-image-large d-block mx-auto">
                            <div class="form-check mt-2 text-center">
                                <input class="form-check-input" type="checkbox" name="remove_profile_image" id="remove_profile_image">
                                <label class="form-check-label" for="remove_profile_image">
                                    Remove current image
                                </label>
                            </div>
                        </div>
                    @else
                        <p class="text-muted text-center">No profile image uploaded.</p>
                    @endif
                    <input type="file" name="profile_image" id="profile_image" class="form-control">
                    <small class="form-text text-muted">Upload a new image to replace the current one (max 2MB, JPEG, PNG, GIF, SVG).</small>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-save me-2"></i>Update Student
                    </button>
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
