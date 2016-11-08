<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body class="w3-white">
  
<!-- Sidenav -->
<nav class="w3-sidenav w3-black w3-card-2 w3-animate-top w3-center w3-xxlarge my-sidenav" style="display:none;padding-top:150px">
  <a href="#" class="w3-closenav w3-jumbo w3-right w3-display-topright close-my-sidenav" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <a href="/photos/index" class="w3-text-grey w3-hover-black">Home</a>
  @if(isset($tags))
  <div class="w3-dropdown-click">
    <a href="javascript:void(0)" class="w3-text-grey w3-hover-light-grey dropdown-content-click-cathegories">Cathegories</a>
    <div class="w3-dropdown-content dropdown-content-cathegories">
      @foreach($tags as $tag)
        <a class="w3-black w3-text-grey w3-hover-black w3-xlarge" href="/photos/index/{{{ $tag->tag }}}">{{ $tag->tag }}</a>
      @endforeach
    </div>
  </div>
  @endif
  <a href="/admin/photos/upload" target="_blank" class="w3-text-grey w3-hover-black">Add a new photo</a>
  <a href="/admin/tags/add" target="_blank" class="w3-text-grey w3-hover-black">Add a new tag</a>
  <a href="/photos/contact" class="w3-text-grey w3-hover-black">Contact</a>
  <a href="javascript:void(0)" class="w3-text-grey w3-hover-light-grey">About</a>
</nav>

<!-- Lightbox -->
<section class="w3-sidenav w3-black w3-animate-top w3-center w3-xxlarge lightbox" style="display:none;padding-top:150px">
  <a href="#" class="w3-closenav w3-jumbo w3-right w3-display-topright close-lightbox" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  
  <div class="w3-row">
    <div class="w3-rest">
      <div class="w3-container photo" style="width:100%;">
        <div class="w3-row">
          <div class="w3-margin title-container">
            <span class="title-lightbox"></span>
          </div>
        </div>
        <div class="w3-row w3-display-container">
          <!--{{ HTML::image("/storage/photos/medium/" . '108504139' . '.jpg', 'łąka', array('class' => 'w3-image w3-border w3-border-light-grey image')) }}-->
            <img class="w3-image w3-border w3-border-light-grey image-lightbox" src="" alt="">
            <div class="w3-display-left w3-container button-left"><i class="fa fa-chevron-left button"></i></div>
            <div class="w3-display-right w3-container button-right"><i class="fa fa-chevron-right button"></i></div>
            
        </div>
        <div class="w3-row">
          <div class="w3-container w3-medium w3-margin description-container">
            <span class="description-lightbox"></span>
          </div>
        </div>
        <div class="w3-row">
          <div class="w3-margin tags-container">
            <span class="tags-lightbox"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1500px">
 

<!-- Header -->
<header class="w3-container w3-padding-32 w3-center w3-margin-bottom">
  <span class="w3-opennav w3-xxlarge w3-right w3-margin-right open-my-sidenav"><i class="fa fa-bars"></i></span>
  <div class="w3-clear"></div>
  <h1 class="w3-xxxlarge">Adam Guła Photography</h1>
  <p class="w3-xlarge">Image gallery</p>
  <p class="w3-padding-16"><i onclick="myFunction()" class="fa fa-toggle-off w3-xxlarge button-toggle"></i><i onclick="myFunction()" class="fa fa-toggle-on w3-xxlarge button-toggle"></i></p>
</header>

<!-- Photo Grid -->
<div class="w3-row" id="myGrid" style="margin-bottom:128px">

<?php $x = 0; ?>
@foreach($photos as $photo)

<?php
    if($x%$count===0 && $x!==0)
    {
  ?>
      </div>
  <?php
    }
  ?>
  <?php
    if($x===0 || $x%$count===0)
    {
  ?>
      <div class="w3-third">
  <?php
    }
  ?>
  <!--<span onclick="w3_open_lightbox()">{{ HTML::image("/storage/photos/medium/" . $photo->name . '.jpg', $photo->title, array('style' => 'width: 100%;', 'class' => 'w3-image image-small')) }}</span>-->
  <img style="width:100%;" class="w3-image w3-greyscale w3-hover-normal image-small" src="/photos/small_color/{{ $photo->name }}.jpg" alt="{{ $photo->title }}">
  <span class="title-hidden" style="display:none;">{{ $photo->title }}</span>
  <span class="description-hidden" style="display:none;">{{ $photo->description }}</span>
  
  <?php $x++; ?>
@endforeach
</div>
<!-- End Page Content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-opacity" style="margin-top:128px">
 <div class="w3-xlarge w3-padding-32">
   <a href="#" class="w3-hover-text-indigo"><i class="fa fa-facebook-official"></i></a>
   <a href="#" class="w3-hover-text-grey"><i class="fa fa-flickr"></i></a>
 </div>
  <p style="font-weight:normal">Designed by <a href="/photos/contact" target="_blank" class="w3-hover-text-green">Adam Guła</a></p>
</footer>
 
<script>
// Toggle grid padding
function myFunction() {
    var x = document.getElementById("myGrid");
    if (x.className === "w3-row") {
        x.className = "w3-row-padding";
    } else {
        x.className = x.className.replace("w3-row-padding", "w3-row");
    }
}

// Open and close sidenav
function w3_open() {
    document.getElementById("mySidenav").style.width = "100%";
    document.getElementById("mySidenav").style.display = "block";
}




</script>
</body>
</html>
 
 
