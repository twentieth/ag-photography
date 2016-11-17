<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body class="w3-light-grey">

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
        <div class="w3-row w3-display-container w3-center">
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
            <span class="w3-small tags-lightbox"></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


 
@include('photos.sidenav')

<!-- Header -->
<header class="w3-container w3-padding-32 w3-center w3-margin-bottom">
  <h1 class="w3-xxxlarge">Adam Guła Photography</h1>
  <p class="w3-xlarge">Image gallery</p>
  <p class="w3-padding-16 buttons"><i onclick="myFunction()" class="fa fa-toggle-off w3-xxlarge button-toggle"></i><i onclick="myFunction()" class="fa fa-toggle-on w3-xxlarge button-toggle"></i></p>
</header>

<!-- !PAGE CONTENT! -->
<div class="w3-content" style="max-width:1920px">
  
<!-- Photo Grid -->
<div class="w3-row" id="myGrid">
@if($count>=4)
@php
  $x = 1;
@endphp
@foreach($photos as $photo)
  @if($x===1)
    <div class="w3-quarter">
  @endif
    <img style="width:100%;" class="w3-image w3-greyscale-max image-small" src="/photos/small_color/{{ $photo->name }}.jpg" alt="{{ $photo->title }}">
    <span class="title-hidden" style="display:none;">{{ $photo->title }}</span>
    <span class="description-hidden" style="display:none;">{{ $photo->description }}</span>
    <span class="tags-hidden" style="display:none;">
    @foreach($photo->tags as $tag)
      {{ $tag->tag }} 
    @endforeach
    </span>
  @if($x%$ratio===0 and $x!==1)
    </div>
    <div class="w3-quarter">
  @endif
  @if($loop->last)
    </div>
  @endif
  @php
    $x++;
  @endphp
@endforeach
</div>
@elseif($count===0)
  <div class="w3-center">There are no photos. <a href="/ag-photography/admin/uploadphoto">Click</a> to add a new one.</div>
@else
  @foreach($photos as $photo)
    <div class="w3-quarter">
      <img style="width:100%;" class="w3-image w3-greyscale-max image-small" src="/photos/small_color/{{ $photo->name }}.jpg" alt="{{ $photo->title }}">
      <span class="title-hidden" style="display:none;">{{ $photo->title }}</span>
      <span class="description-hidden" style="display:none;">{{ $photo->description }}</span>
      <span class="tags-hidden" style="display:none;">
      @foreach($photo->tags as $tag)
        {{ $tag->tag }} 
      @endforeach
      </span>
    </div>
  @endforeach
@endif
</div>

<!-- End Page Content -->
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-light-grey w3-center w3-opacity" style="margin-top:128px">
 <div class="w3-xlarge w3-padding-32">
   <!--<a href="#" class="w3-hover-text-indigo"><i class="fa fa-facebook-official"></i></a>-->
   <a href="https://www.flickr.com/photos/139384339@N03" class="w3-hover-text-grey" target="_blank"><i class="fa fa-flickr"></i></a>
 </div>
  <p style="font-weight:normal">Designed by <a href="/ag-photography/contact" target="_blank" class="designed">Adam Guła</a></p>
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

<span class="tag-hidden" style="display:none;">{{ $tag_to_ajax }}</span>
</body>
</html>
 
 
