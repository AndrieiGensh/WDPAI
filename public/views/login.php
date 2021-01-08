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
                <form>
                    <input name="username" type="text" placeholder="user name">
                    <input name="email" type="text" placeholder="user email">
                    <input name="password" type="password" placeholder="user password">
                    <input name="commitpassword" type="password" placeholder="commit password">
                    <button>SIGN UP</button>
                </form>
            </div>
            <div class="OR">
                OR
            </div>
            <div class="login">
                <form action="login" method="post">
                    <div class = "message">
                        <?php
                        if(isset($messages)) {
                            foreach ($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <input name="email" type="text" placeholder="user email">
                    <input name="password" type="password" placeholder="user password">
                    <button type="submit">LOG IN</button>
                </form>
            </div>
        </div>
    </div>

</body>