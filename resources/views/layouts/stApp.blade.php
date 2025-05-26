<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .table {
    width: 100%;
    table-layout: auto;
}

.table th, .table td {
    white-space: nowrap; /* Optional: prevents line breaks in cells */
    text-align: left;
    padding: 8px;
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
        .card-body {
    /* Remove any height or max-height properties */
    overflow: visible;  /* Ensure content is visible */
    padding: 1rem; /* Add padding, if needed */
}
        
        .card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px); /* Slight lift on card hover */
        }
        .form-control:focus {
            border-color: #66b0ff;
            box-shadow: 0 0 0 3px rgba(102, 176, 255, 0.2);
        }
        .alert {
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .profile-image-large { /* For the show view display */
            width: 200px; /* Adjusted size */
            height: 200px; /* Adjusted size */
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #66b0ff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>