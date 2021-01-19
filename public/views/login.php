<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="./public/js/loginButtonsBehaviour.js" defer></script>
    <title>LOGIN FORM</title>
</head>

<body>
    <div class="wrapper">
        <main>
            <div class="login-div">
                <div class="logo">Voyager</div>
                <form class="login-form" action="login" method="post">
                    <div class = "message">
                        <?php
                        if(isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <input class="login-register-input" name="email" type="text" placeholder="user email">
                    <input class="login-register-input" name="password" type="password" placeholder="user password">
                    <div class="login-buttons">
                        <button class="login-as-guest">Login as guest</button>
                        <button type="submit">LOG IN</button>
                        <button class="create-account">Sign up</button>
                    </div>
                </form>
            </div>
        </main>

    </div>
</body>