<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?<?php echo time() ?>"/>
    <title>SETTINGS</title>
    <script src="https://kit.fontawesome.com/d9f59e1a3c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/permissionCheck.js" defer></script>
    <script type="text/javascript" src="./public/js/menutoggle.js" defer></script>
    <script type="text/javascript" src="./public/js/settingsProcessing.js" defer></script>
</head>

<body>

    <header>

    </header>

    <div class="wrapper">

        <main>

            <?php include 'public/templates/sidebarTemplate.php'?>

            <div class="settings-content">

                <div class="settings">

                    <div class="settings-handle">

                    </div>

                    <div class="upper-part" id="customisation">
                        <div class="setting-header"> 
                            <h4>Customisation </h4>
                            <div class="setting-header-underline"> </div>
                        </div>
                    </div>

                    <div class="middle-part" id="terms">
                        <div class="setting-header"> 
                            <h4>Terms of privacy </h4>
                            <div class="setting-header-underline"> </div>
                        </div>
                    </div>

                    <div class="bottom-part" id="'account-settings">
                        <div class="setting-header"> 
                            <h4>Account settings </h4>
                            <div class="setting-header-underline"> </div>
                        </div>
                        <div class="delete-account">
                            <h4>Delete this Account</h4>
                            <button class="delete-account-button">Delete</button>
                        </div>
                    </div>

                </div>

                <div class="settings">

                    <div class="settings-handle">

                    </div>

                    <div class="upper-part" id="notifications">
                        <div class="setting-header"> 
                            <h4>Notifications </h4>
                            <div class="setting-header-underline"> </div>
                        </div>
                    </div>

                    <div class="bottom-part"> 
                        <div class="setting-header" id="show-me">
                            <h4>Show me... </h4>
                            <div class="setting-header-underline"> </div>
                        </div>
                    </div>

                    <div class="settings-buttons">
                        <button class="save-settings">Save</button>
                        <button class="default-settings">Default</button>
                    </div>

                </div>

            </div>

        </main>
        
    </div>

    <footer>

    </footer>

</body>