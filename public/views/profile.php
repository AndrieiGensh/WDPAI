<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?<?php echo time() ?>"/>
    <title>PROFILE</title>
    <script src="https://kit.fontawesome.com/d9f59e1a3c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/permissionCheck.js" defer></script>
    <script type="text/javascript" src="./public/js/menutoggle.js" defer></script>
    <script type="text/javascript" src="./public/js/profileInfoEditing.js" defer></script>
</head>

<body>
    <div class="wrapper">

        <header>

        </header>

        <main>

            <?php include 'public/templates/sidebarTemplate.php'?>

            <div class="profile-content">
                <div class="profile-head">
                    <div class="profile-image">

                    </div>
                    <h2> <?php echo $name.$surname?></h2>
                    <div class="underline">

                    </div>
                </div>
                <div class="about-me-section">
                    <div class="about-me">
                        About Me
                    </div>

                    <div class="text-bubble">
                        <div class="const-info" name="about-me">
                            <?php echo $about_me?>
                        </div>
                        <textarea class="editable-info" id="hidden">
                        </textarea>
                        <div class="profile-editing-buttons-section">
                            <button class="edit-button" name="edit-about-me">Edit</button>
                            <button class="submit-edit-button" id="hidden" name="submit-about-me-edit">OK</button>
                            <button class="cancel-edit-button" id="hidden" name="cancel-about-me-edit">Cancel</button>
                        </div>
                    </div>

                </div>
                <div class="my-travelers-code-section">
                    <div class="travelers-code">
                        <h3>My "Traveler`s code"</h3>
                    </div>

                    <div class="text-bubble">
                        <div class="const-info" name="code">
                            <?php echo $code?>
                        </div>
                        <textarea class="editable-info" id="hidden">
                        </textarea>
                        <div class="profile-editing-buttons-section">
                            <button class="edit-button" name="edit-code">Edit</button>
                            <button class="submit-edit-button" id="hidden" name="submit-code-edit">OK</button>
                            <button class="cancel-edit-button" id="hidden"  name="cancel-code-edit">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

        </main>

    </div>

    <footer>

    </footer>

</body>