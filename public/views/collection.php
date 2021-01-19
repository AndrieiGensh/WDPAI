<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css?<?php echo time() ?>"/>
    <title>COLLECTION</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer></script>
    <script src="https://kit.fontawesome.com/d9f59e1a3c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/permissionCheck.js" defer></script>
    <script type="text/javascript" src="./public/js/menutoggle.js" defer></script>
    <script type="text/javascript" src="./public/js/toggleSubmitButton.js" defer></script>
    <script type="text/javascript" src="./public/js/fetchCollectionUpload.js" defer></script>
</head>

<body>

    <header>

    </header>   

    <div class="wrapper">

        <header>

        </header>

        <main>
            <?php include 'public/templates/sidebarTemplate.php'?>

            <div class="collection-content">
                <div class="memory-edit-div" id="hidden">
                    <div class="memory-editor-area" id="">
                        <textarea class="memory-text" id="hidden">

                        </textarea>
                        <div class="memory-placeholder">
                        </div>

                        <div class="memory-buttons-div">
                            <button class="memory-edit-submit-button" id="hidden">Submit</button>
                            <button class="memory-edit-button">Edit</button>
                            <button class="memory-delete-button" id="hidden">Delete</button>
                            <button class="memory-edit-cancel-button" id="hidden">Cancel</button>
                        </div>
                    </div>
                </div>

                <div class="collection-title">
                    Photos
                </div>

                <section class="collection-photos">
                    <?php foreach($photos as $photo): ?>
                    <div class="photo-item" id="<?= $photo->getPhotoId()?>">
                        <img src="public/uploads/<?= $photo->getPhotoName()?>">
                        <div class="collection-element-title">
                            <?= $photo->getPhotoName()?>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <div class="add-form-div">
                        <form class="add-form" method="post" name="PhotoForm" enctype="multipart/form-data">
                            <input class="select-file" type="file" name="file-doc"/>
                            <div class="replacement">
                                <i class="fa fa-plus-circle fa-3x" aria-hidden="true"></i>
                            </div>
                            <input class="select-title" type="text" name="file-title">
                            <button class="submit-button" type="submit" name="submit-file" disabled>SUBMIT</button>
                        </form>
                    </div>
                </section>

                <div class="collection-title">
                    Videos
                </div>

                <section class="collection-videos">
                    <?php for($i = 0; $i <= 5; $i++): ?>
                        <div class="video-item">
                            <img src="public/img/mountains.jpg">
                            <div class="collection-element-title">
                                Video.avi
                            </div>
                        </div>
                    <?php endfor; ?>

                    <div class="add-form-div">
                        <form class="add-form" method="post" name="VideoForm" enctype="multipart/form-data">
                            <input class="select-file" type="file" name="file-doc"/>
                            <div class="replacement">
                                <i class="fa fa-plus-circle fa-3x" aria-hidden="true"></i>
                            </div>
                            <input class="select-title" type="text" name="file-title">
                            <button class="submit-button" type="submit" name="submit-file" disabled>SUBMIT</button>
                        </form>
                    </div>

                </section>

                <div class="collection-title">
                    Memories
                </div>

                <section class="collection-memories">

                    <?php foreach($memories as $memory): ?>
                        <div class="memory-item" id="<?= $memory->getmemoryId()?>">
                                <?= $memory->getMemoryContent()?>
                        </div>
                    <?php endforeach; ?>

                    <div class="memory-item" id="new">
                        Add new Memory by Clicking ME
                    </div>
                </section>
            </div>

        </main>
        
    </div>

    <footer>

    </footer>


</body>
