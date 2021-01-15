<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?<?php echo time() ?>"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="https://kit.fontawesome.com/d9f59e1a3c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/registrationValidation.js" defer></script>
    <title>REGISTRATION</title>
</head>

<body>
    <header>

    </header>

    <div class="wrapper">
        <main>
            <div class="registration-form-div">
                <div class="handle" id="registration-handle">

                </div>
                <form class="registration-form" enctype="multipart/form-data">
                    <div class="message">
                    </div>
                    <input class="registration-input" type="text" name="new_user_name" placeholder="Enter your name">
                    <input class="registration-input" type="text" name="new_user_surname" placeholder="Enter your surname">
                    <input class="registration-input" type="text" name="new_user_email" placeholder="Enter your email">
                    <input class="registration-input" type="text" name="new_user_password" placeholder="Enter your password">
                    <input class="registration-input" type="text" name="new_user_password_repeat" placeholder="Repeat password">
                    <div class="button-holder">
                        <button class="submit-registration-btn">Submit</button>
                        <button class="cancel-registration-btn">Cancel</button>
                    </div>
                </form>

            </div>
        </main>

    </div>

    <footer>

    </footer>

</body>