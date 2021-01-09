<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?<?php echo time() ?>"/>
    <title>COLLECTION</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="https://kit.fontawesome.com/d9f59e1a3c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/menutoggle.js" defer></script>
    <script type="text/javascript" src="./public/js/toggleSubmitButton.js" defer></script>
    <script type="text/javascript" src="./public/js/collectionUpload.js" defer></script>
</head>

<body>

    <header>

    </header>   

    <div class="wrapper">

        <header>

        </header>

        <main>
            <div class="toggle">

            </div>

            <div class="sidebar" id="passive">

                <div class="profile-pic">

                </div>

                <div class="handle">

                </div>

                <ul>

                    <li class="head-sidebar-element">
                        <a href="profile">
                            <i class="fas fa-address-card"><span>Profile</span></i>
                        </a>
                    </li>
                    <li class="sidebar-element">
                        <a href="forum">
                            <i class="fas fa-comments"><span>Forum</span></i>
                        </a>
                    </li>
                    <li class="sidebar-element">
                        <a href="collection">
                            <i class="fas fa-photo-video"><span>Collection</span></i>
                        </a>
                    </li>
                    <li class="foot-sidebar-element">
                        <a href="settings">
                            <i class="fas fa-cogs"><span>Settings</span></i>
                        </a>
                    </li>

                </ul>

                <div class="wheels">

                   <span class="wheel"></span>

                   <span class="wheel"></span>

                </div>

                <div class="exit">
                    <a href="login">
                        <i class="fas fa-door-open"><span>Exit</span></i>
                    </a>
                </div>

            </div>

            <div class="collection-content">

                <div class="collection-title">
                    Photos
                </div>

                <section class="collection-photos">
                    <div class="photo-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Photo.jpg
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Photo.jpg
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Photo.jpg
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Photo.jpg
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Photo.jpg
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Photo.jpg
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Photo.jpg
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Photo.jpg
                        </div>
                    </div>

                    <div class="add-photo-form">
                        <form class="add-photo" method="post" name="UploadForm" enctype="multipart/form-data">
                            <input class="select-photo" type="file" name="photo-image"/>
                            <input class="select-photo-title" type="text" name="photo-title">
                            <button class="submit-button" type="submit" name="submit-photo" disabled>SUBMIT</button>
                    </div>
                </section>

                <div class="collection-title">
                    Videos
                </div>

                <section class="collection-videos">
                    <div class="video-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Video.avi
                        </div>
                    </div>
                    <div class="video-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Video.avi
                        </div>
                    </div>
                    <div class="video-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Video.avi
                        </div>
                    </div>
                    <div class="video-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Video.avi
                        </div>
                    </div>
                    <div class="video-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Video.avi
                        </div>
                    </div>
                    <div class="video-item">
                        <img src="public/img/mountains.jpg">
                        <div class="collection-element-title">
                            Video.avi
                        </div>
                    </div>

                </section>

                <div class="collection-title">
                    Memories
                </div>

                <section class="collection-memories">

                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                         Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                    <div class="memory-item">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. .
                    </div>
                </section>
            </div>

        </main>

        <footer>

        </footer>
        
    </div>

    <footer>

    </footer>

    <script>
        const photoElement = document.querySelector(".photo-item");
        photoElement.addEventListener("click", function(){hide(photoElement); });

        function hide(elem)
        {
            elem.style.visibility = "hidden";
        }
    </script>

</body>
