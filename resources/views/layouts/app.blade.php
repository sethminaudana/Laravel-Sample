<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
            .btn-primary {
                background-color: #66b0ff; /* A brighter blue */
                border-color: #66b0ff;
                transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.2s ease; /* Added transform */
            }
            .btn-primary:hover {
                background-color: #3399ff; /* A slightly darker blue on hover */
                border-color: #3399ff;
                transform: translateY(-2px); /* Slight lift on hover */
            }
            .btn-secondary {
                background-color: #e0e0e0;
                border-color: #e0e0e0;
                color: #333;
                transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.2s ease;
            }
            .btn-secondary:hover {
                background-color: #c7c7c7;
                border-color: #c7c7c7;
                transform: translateY(-2px);
            }
            .btn-danger {
                background-color: #ff6666; /* A brighter red */
                border-color: #ff6666;
                transition: background-color 0.3s ease, border-color 0.3s ease, transform 0.2s ease;
            }
            .btn-danger:hover {
                background-color: #ff3333; /* A slightly darker red on hover */
                border-color: #ff3333;
                transform: translateY(-2px);
            }
            .card {
                transition: box-shadow 0.3s ease, transform 0.2s ease; /* Added transform to card */
                overflow: visible; /* Ensure content is visible */
            }
            .card:hover {
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
                transform: translateY(-4px); /* Slight lift on card hover */
            }
            .card-body {
                overflow: visible;  /* Ensure content is visible */
                padding: 1rem; /* Add padding, if needed */
            }
            .form-control:focus {
                border-color: #66b0ff;
                box-shadow: 0 0 0 3px rgba(102, 176, 255, 0.2);
            }
            .alert {
                border-radius: 0.5rem;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }
            .profile-image {
                width: 50px; /* Small size for table */
                height: 50px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid #ddd;
            }
            .profile-image-large {
                width: 150px; /* Larger size for show view */
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
                border: 3px solid #66b0ff;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }
            .profile-image-table {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ccc;
    }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
