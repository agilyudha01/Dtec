<!DOCTYPE html>
<html>
    <head>
        <title>login</title>
        <style>
             body {
                background-image: url("{{ asset('img/logo4.png') }}");
                background-size: 100vh;
                background-repeat: no-repeat;
                background-position: first baseline;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .form{
                padding: 10px;
                padding-bottom: 20px;
                background-color: aqua;
            }
            .row {
                margin: 20px;
            }
            .login-form {
                background: rgba(255, 255, 255, 0.8);
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                width: 350px;
            }
            .login-form h3 {
                margin-bottom: 20px;
                text-align: center;
            }
            .form-group {
                margin-bottom: 20px;
            }
            .form-control {
                border-radius: 5px;
            }
            .btn-primary {
                width: 100%;
                border-radius: 5px;
            }
            .btn-primary:hover {
                background-color: #0069d9;
            }
        </style>
    </head>
    <body>
        <div class="form">
            <form method="post">
                Sigin up
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="name" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@gmail.com" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Sigin up</button>

            </form>
        </div>

    </body>
</html>