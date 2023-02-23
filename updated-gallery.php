<!DOCTYPE html>
<html>
  <head>
    <title>Roger Ricketts Gallery</title>
    <style>
      .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        grid-gap: 10px;
      }
      
      .gallery img {
        width: 100%;
        height: auto;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
      }
      
      .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
      }
      
      .modal-content {
        display: block;
        max-width: 80%;
        max-height: 80%;
        margin: auto;
      }
      
      .close {
        color: #fff;
        font-size: 24px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="gallery">
      <?php
        $directory = "files/artwork";
        $images = glob($directory . "/*.png");
        foreach($images as $image) {
          echo '<img src="' . $image . '" onclick="openModal(this)">';
        }
      ?>
    </div>
    
    <div id="myModal" class="modal">
      <span class="close" onclick="closeModal()">&times;</span>
      <img class="modal-content" id="modalImage">
    </div>
    
    <script>
      function openModal(img) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("modalImage");
        modal.style.display = "block";
        modalImg.src = img.src;
        img.style.transform = "scale(1.2)";
      }
      
      function closeModal() {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("modalImage");
        modal.style.display = "none";
        modalImg.src = "";
        var galleryImages = document.getElementsByClassName("gallery")[0].getElementsByTagName("img");
        for (var i = 0; i < galleryImages.length; i++) {
          galleryImages[i].style.transform = "scale(1)";
        }
      }
    </script>
  </body>
</html>
