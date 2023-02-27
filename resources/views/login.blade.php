<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('/assets/img/favicon.png') }}" type="image/x-icon">
    <title>Orange - Login </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <style>
        html,
        body {
            height: 100%;
        }
        body {
            align-items: center;
            background-color: #f9f9ff;
            display: flex;
            height: 100vh;
        }
        .form-signin {
            max-width: 330px;
            display: block;
        }
        .form-signin .card {
            overflow: hidden;
            border-radius: 20px;
        }
        .form-signin .form-floating:focus-within {
            z-index: 2;
        }
        .form-signin label {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    @if (Session::has('message'))
        <div class="alert alert-danger theme-bg alert-dismissible fade show" role="alert"
            style="    position: fixed;
    top: 20px;
    right: 20px;">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="doLogin">
            <div class="card m-0">
                <div class="card-header">
                    <div class="form-signin-title">
                        <h4 class="m-0"> Log in</h4>
                    </div>
                </div>
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="floatingInput">User name</label>
                        <input name="username" type="text" class="form-control" id="floatingInput"
                            placeholder="User Name" required>
                    </div>
                    <div class="form-group">
                        <label for="floatingPassword">Password</label>
                        <input name="password" type="password" class="form-control" id="floatingPassword"
                            placeholder="Password" required>
                    </div>
                    <button class="w-100 btn btn-md btn-primary theme-bg mt-4" type="submit">Log in</button>
                </div>
            </div>
        </form>
    </main>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
