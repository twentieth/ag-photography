<!-- Sidenav -->

<nav class="w3-sidenav w3-black w3-card-2 w3-animate-top w3-center w3-xxlarge my-sidenav" style="display:none;padding-top:150px;position:fixed;top:0;bottom:0;left:0;right:0;z-index:50;">
  <a href="#" class="w3-closenav w3-jumbo w3-right w3-display-topright close-my-sidenav" style="padding:6px 24px">
    <i class="fa fa-remove"></i>
  </a>
  <a href="/ag-photography" class="w3-text-grey w3-hover-black">home</a>
  @if(isset($tags))
  <div class="dropdown">
    <a href="javascript:void(0)" class="w3-text-grey w3-hover-light-grey dropdown-content-click-cathegories"><span class="fa fa-chevron-down"></span> cathegories</a>
    <div class="dropdown-content dropdown-content-cathegories">
      @foreach($tags as $tag)
        <a class="w3-black w3-text-grey w3-hover-black w3-xlarge" href="/ag-photography/tag/{{{ $tag->tag }}}">{{ $tag->tag }}</a>
      @endforeach
      <a class="w3-black w3-text-grey w3-hover-black w3-xlarge dropdown-up" href="#"><span class="fa fa-chevron-up"></span></a>
    </div>
  </div>
  @endif
  @if(Auth::check())
  <div class="dropdown">
    <a href="javascript:void(0)" class="w3-text-grey w3-hover-light-grey dropdown-content-click-admin"><span class="fa fa-chevron-down"></span> admin</a>
    <div class="dropdown-content dropdown-content-admin">
      <a href="/ag-photography/admin/uploadphoto" class="w3-black w3-text-grey w3-hover-black w3-xlarge">add a new photo</a>
      <a href="/ag-photography/admin/addtag" class="w3-black w3-text-grey w3-hover-black w3-xlarge">add a new tag</a>
      <a href="/ag-photography/admin/photoslist" class="w3-black w3-text-grey w3-hover-black w3-xlarge">photoslist</a>
      <a class="w3-black w3-text-grey w3-hover-black w3-xlarge dropdown-up" href="#"><span class="fa fa-chevron-up"></span></a>
    </div>
  </div>
  @endif
  <a href="/ag-photography/contact" class="w3-text-grey w3-hover-black">contact</a>
  <!--<a href="javascript:void(0)" class="w3-text-grey w3-hover-black">About</a>-->
  @if(Auth::check())
    <a href="/ag-photography/logout" class="w3-text-grey w3-hover-black">log out</a>
  @else
    <!--<a href="/login" class="w3-text-grey w3-hover-black">Log In</a>-->
  @endif
</nav>


<span class="w3-opennav w3-xxlarge w3-right w3-margin-right w3-padding-top open-my-sidenav"><i class="fa fa-bars"></i></span>
<div class="w3-clear"></div>