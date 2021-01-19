<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?<?php echo time() ?>"/>
    <title>FORUM</title>
    <script src="https://kit.fontawesome.com/d9f59e1a3c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/permissionCheck.js" defer></script>
    <script type="text/javascript" src="./public/js/menutoggle.js" defer></script>
</head>

<body>
    <header>

    </header>
    <div class="wrapper">
        <main>

            <?php include 'public/templates/sidebarTemplate.php'?>

            <div class="forum-content">
                <section class="friends-news">
                    <?php for($i = 0; $i <= 13; $i++): ?>
                            <div class="friend-icon">

                            </div>
                     <?php endfor; ?>
                </section>
                
                <div class="horizontal-underline">

                </div>
                
                <section class="general-news">

                    <?php for($i = 0; $i <= 3; $i++): ?>
                            <div class="news-artickle">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                                occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                            </div>
                    <?php endfor; ?>
                </section>

                <div class="horizontal-underline">

                </div>

                <section class="friends-posts">
                    <?php for($i = 0; $i <= 8; $i++): ?>
                        <div class="post">

                            <div class="friend-icon">

                            </div>
                            <div class="post-content">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                                <div class="date">
                                    24.06.2001
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </section>

            </div>

        </main>
        
    </div>

    <footer>

    </footer>

</body>