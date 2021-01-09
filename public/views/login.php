<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN FORM</title>
</head>

<body>
    <div class="bodycontainer">
        <div class="upper-container">
            <div class="logo">
                Voyager
            </div>
    
        </div>
        <div class="container">
            <div class="signup">
                <form class="register-form" method="post">
                    <input class="login-register-input" name="username" type="text" placeholder="user name">
                    <input class="login-register-input" name="email" type="text" placeholder="user email">
                    <input class="login-register-input" name="password" type="password" placeholder="user password">
                    <input class="login-register-input" name="commitpassword" type="password" placeholder="commit password">
                    <button type="submit">SIGN UP</button>
                </form>
            </div>
            <div class="OR">
                OR
            </div>
            <div class="login">
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
                    <button type="submit">LOG IN</button>
                </form>
            </div>
        </div>
    </div>

</body>