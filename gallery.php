<!DOCTYPE html>
<html>
<head>
    <title>Roger Ricketts Art Gallery</title>
    <style type="text/css">
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            max-width: 1200px;
        }

        .gallery img {
            width: 100%;
            height: auto;
            object-fit: contain;
            transition: transform .5s ease;
            cursor: pointer;
        }

        .gallery img.active {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
            max-width: 100%;
            max-height: 100%;
        }

        @media screen and (min-width: 768px) {
            .gallery img {
                width: auto;
                max-height: 200px;
                margin: 5px;
            }
        }
    </style>
</head>
<body>
<div class="gallery">
    <?php
    $dir = "files/artwork/";
    $images = glob($dir . "*.png");
    foreach ($images as $image):
        ?>
        <img src="<?php echo $image; ?>" alt="" onclick="expandImage(this)">
    <?php endforeach; ?>
</div>
<script type="text/javascript">
    let images = document.querySelectorAll('.gallery img');
    let activeImageIndex = 0;

    document.addEventListener('keydown', function (event) {
        if (event.keyCode === 37) {
            navigate(-1);
        } else if (event.keyCode === 39) {
            navigate(1);
        }
    });

    function expandImage(image) {
        image.classList.add('active');
        activeImageIndex = Array.from(images).indexOf(image);
    }

    function shrinkImage() {
        images[activeImageIndex].classList.remove('active');
    }

    function navigate(direction) {
        shrinkImage();

        activeImageIndex += direction;
        if (activeImageIndex < 0) {
            activeImageIndex = images.length - 1;
        } else if (activeImageIndex >= images.length) {
            activeImageIndex = 0;
        }

        images[activeImageIndex].classList.add('active');
        images[activeImageIndex].addEventListener('transitionend', function () {
            images[activeImageIndex].removeEventListener('transitionend', this);
            isTransitioning = false;
        });
    }
</script>
</body>
</html>
