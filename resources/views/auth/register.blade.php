<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    @vite('resources/js/assets/bootstrap5.css')

    <style>
        .form-container{
            width: 100vw;
            height: 100vh;
        }
        .form{      
            max-width: 350px;
            margin: 0 auto;
            margin-top: 60px;      
        }
    </style>
</head>
<body>

<section>
    <div class="row form-container" >
        {{$errors}}
        <form class="form" action="/register" method="POST">
            <h3>Register</h3>
            @csrf
            <div class="form-group my-2">
                <label class="my-1">Name</label>
                <input type="name" class="form-control" placeholder="Enter email" name="name">         
            </div>

            <div class="form-group my-2">
                <label class="my-1">Email</label>
                <input type="email" class="form-control" placeholder="Enter email" name="email">         
            </div>

            <div class="form-group my-2">
                <label class="my-1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            
            <button type="submit" class="btn btn-primary my-2">Submit</button>
        </form>
    </div>
</section>
    
