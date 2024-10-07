<meta name="csrf-token" content="{{ csrf_token() }}">


@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Login</h2>
    <form id="loginForm">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<!-- jQuery and Bootstrap scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Set up AJAX defaults
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    $(document).ready(function() {
        // Set up AJAX defaults
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                // 'Authorization': 'Bearer ' + localStorage.getItem('token') // Include token in requests
            }
        });
    });

    $('#loginForm').submit(function(e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            type: 'POST',
            url: '/login', // Adjust according to your route
            data: $(this).serialize(), // Send the form data
            success: function(response) {
                // If login is successful, redirect to the customers index page
                if (response.token) {
                    // Store token in local storage or session storage
                    localStorage.setItem('token', response.token);
                    // Redirect to the customers index
                    window.location.href = response.redirect; // Redirect to the customers index route
                }
            },
            error: function(xhr) {
                // Handle error
                console.error(xhr);
                if (xhr.status === 401) {
                    alert('Invalid credentials. Please check your email and password.');
                } else {
                    alert('Login failed. Please try again.');
                }
            }
        });
    });
</script>
@endsection
