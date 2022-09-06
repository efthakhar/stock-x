<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    @vite('resources/js/assets/bootstrap5.css')

    <style>
        .form-container {
            width: 100vw;
            height: 100vh;
        }
        .form {      
            max-width: 350px;
            margin: 0 auto;
            margin-top: 60px;      
        }
    </style>
</head>
<body>

<section>
    <div class="row form-container" >
        <form class="form" action="/login" method="POST">
            {{$errors}}
            <h3>Login</h3>
            @csrf
            <div class="form-group my-2">
                <label class="my-1">Email</label>
                <input type="email" class="form-control" placeholder="Enter email" name="email">         
            </div>

            <div class="form-group my-2">
                <label class="my-1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            
            <button type="submit" class="btn btn-primary my-2">Login</button>

            <br>
            <p>not register yet??
                <a href="/register" class="btn btn-sm btn-primary">
                    Register now
                </a>
            </p>
            
        </form>
    </div>
</section>
    
