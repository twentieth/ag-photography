<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body>
@include('photos.messages')
<!-- Sidenav -->
<nav class="w3-sidenav w3-black w3-card-2 w3-animate-top w3-center w3-xxlarge" style="display:none;padding-top:150px" id="mySidenav">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-closenav w3-jumbo w3-right w3-display-topright" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <a href="javascript:void(0)" class="w3-text-grey w3-hover-black">About</a>
  <a href="javascript:void(0)" class="w3-text-grey w3-hover-black">Photos</a>
  <a href="javascript:void(0)" class="w3-text-grey w3-hover-black">Shop</a>
  <a href="javascript:void(0)" class="w3-text-grey w3-hover-black">Contact</a>
</nav>

<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1500px">

<!-- Header -->
<header class="w3-container w3-padding-32 w3-center w3-opacity w3-margin-bottom">
  <span class="w3-opennav w3-xxlarge w3-right w3-margin-right" onclick="w3_open()"><i class="fa fa-bars"></i></span>
  <div class="w3-clear"></div>
  <h1>PHOTOLIO</h1>
  <p>A template made by w3.css for photographers.</p>
  <p class="w3-padding-16"><button class="w3-btn" onclick="myFunction()">Toggle Grid Padding</button></p>
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
  {{ HTML::image("/storage/photos/medium/" . $photo->name . '.jpg', $photo->title, array('style' => 'width: 100%;')) }}
  
  <?php $x++; ?>
@endforeach
</div>

<!-- End Page Content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-opacity" style="margin-top:128px">
 <div class="w3-xlarge w3-padding-32">
   <a href="#" class="w3-hover-text-indigo"><i class="fa fa-facebook-official"></i></a>
   <a href="#" class="w3-hover-text-red"><i class="fa fa-pinterest-p"></i></a>
   <a href="#" class="w3-hover-text-light-blue"><i class="fa fa-twitter"></i></a>
   <a href="#" class="w3-hover-text-grey"><i class="fa fa-flickr"></i></a>
   <a href="#" class="w3-hover-text-indigo"><i class="fa fa-linkedin"></i></a>
 </div>
  <p style="font-weight:normal">Powered by <a href="http://www.w3schools.com/w3css/default.asp" target="_blank" class="w3-hover-text-green">w3.css</a></p>
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

function w3_close() {
    document.getElementById("mySidenav").style.display = "none";
}
</script>
</body>
</html>
 
 
