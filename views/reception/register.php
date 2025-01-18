<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/src/css/main.css">
</head>

<body>
    <div id="app-form" class="relative">
        <div class="form-container absolute">
            <div class="form-title">
                <h1>Inscription</h1>
            </div>
            <div class="form-register">
                <form action="Register" method="post" id="register">
                    <div class="form-group-input flex gap-5">
                        <input type="text" class="flex-1" name="firstname" id="firstname" placeholder="Your firstname...">
                        <input type="text" class="flex-1" name="lastname" id="lastname" placeholder="Your lastname...">
                    </div>
                    <div class="error-name flex gap-10 jcsb">
                        <div class="form-error error-firstname">
                        </div>
                        <div class="form-error error-lastname">
                        </div>
                    </div>
                    <div class="form-row flex">
                        <select name="role" id="role" class="flex-1">
                            <option value="">Choose your role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-row flex">
                        <input type="email" class="flex-1" name="email" id="email" placeholder="Your email...">
                    </div>
                    <div class="form-error error-email">
                    </div>
                    <div class="form-row flex">
                        <input type="text" class="flex-1" name="adresse" id="adresse" placeholder="Your adresse...">
                    </div>
                    <div class="form-error error-adresse">
                    </div>
                    <div class="form-row flex relative">
                        <input type="password" class="flex-1" name="password" autocomplete="on" id="password" placeholder="Your password...">
                        <i class="fa-regular absolute icon-password fa-eye-slash"></i>
                    </div>
                    <div class="form-error error-password">
                    </div>

                    <div class="form-row flex relative">
                        <input type="password" class="flex-1" name="confirm_password" autocomplete="on" id="confirm-password"
                            placeholder="Confirm your password...">
                        <i class="fa-regular absolute icon-password fa-eye-slash"></i>
                    </div>
                    <div class="form-error error-confirmPassword">
                    </div>
                    <div class="form-button flex">
                        <button class="btn-submit flex-1" id="btn-submit" style="cursor: not-allowed;" disabled>Register</button>
                    </div>
                </form>
            </div>
            <div class="register-message message">
                Vous avez un compte? si oui, alors <a href="PageConnexion">cliquez ici</a> pour vous connecter.
            </div>
        </div>
    </div>



    <script src="/src/js/listeners.js"></script>
    <script src="/src/js/main.js"></script>
</body>

</html>