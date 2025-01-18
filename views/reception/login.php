<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/src/css/main.css">
</head>

<body>
    <div id="app-form" class="relative">
        <div class="form-container absolute">
            <div class="form-title">
                <h1>Connexion</h1>
            </div>
            <div class="form-login">
                <form action="authentifier" method="post" id="login">
                    <div class="form-row flex">
                        <input type="email" class="flex-1" name="email" id="email" placeholder="Your email...">
                    </div>
                    <div class="form-error error-email">
                    </div>
                    <div class="form-row flex relative">
                        <input type="password" class="flex-1" name="password" autocomplete="on" id="password"
                            placeholder="Your password...">
                        <i class="fa-regular absolute icon-password fa-eye-slash"></i>
                    </div>
                    <div class="form-error error-password">
                    </div>
                    <div class="form-button flex">
                        <button class="btn-submit flex-1" id="btn-submit" style="cursor:not-allowed;" disabled>login</button>
                    </div>
                </form>
            </div>
            <div class="login-message message">
                Vous n'avez pas un compte? si oui, alors <a href="PageRegister">cliquez ici</a> pour vous connecter.
            </div>
        </div>
    </div>


    <script src="/src/js/listeners.js"></script>
    <script src="/src/js/main.js"></script>
</body>

</html>