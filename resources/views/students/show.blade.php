@extends('layouts.stApp')

@section('content')
    <h1 class="text-center mb-4">Student Details</h1>

    <div class="card shadow-lg text-center">
        <div class="card-body">
            @if($student->profile_image)
            <img src="{{ asset('storage/' . $student->profile_image) }}" alt="Profile Image" class="profile-image-large mb-3">
        @else
            <img src="https://placehold.co/150x150/cccccc/333333?text=No+Image" alt="No Image" class="profile-image-large mb-3">
        @endif
            <h2 class="card-title">{{ $student->name }}</h2>
            <p class="card-text"><strong>Email:</strong> {{ $student->email }}</p>
            <p class="card-text"><strong>Date of Birth:</strong> {{ $student->date_of_birth }}</p>
            <p class="card-text"><strong>Major:</strong> {{ $student->major }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Back to List
            </a>
        </div>
    </div>
@endsection