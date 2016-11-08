<!-- Sidenav Second -->

<header class="w3-container w3-padding-32 w3-center w3-margin-bottom">
  <span class="w3-opennav w3-xxlarge w3-right w3-margin-right open-my-sidenav"><i class="fa fa-bars"></i></span>
  <nav class="w3-sidenav w3-light-grey w3-card-2 w3-animate-top w3-center w3-xxlarge my-sidenav" style="display:none;padding-top:150px;position:fixed;top:0;bottom:0;right:0;left:0;">
  <a href="#" class="w3-closenav w3-jumbo w3-right w3-display-topright close-my-sidenav" style="padding:6px 24px">
    <i class="fa fa-remove w3-text-grey"></i>
  </a>
  <a href="/photos/index" class="w3-text-grey w3-hover-light-grey">Home</a>
  @if(isset($tags))
  <div class="w3-dropdown-click">
  	<a href="javascript:void(0)" class="w3-text-grey w3-hover-light-grey dropdown-content-click-cathegories">Cathegories</a>
  	<div class="w3-dropdown-content dropdown-content-cathegories">
  		@foreach($tags as $tag)
  			<a class="w3-light-grey w3-text-grey w3-hover-light-grey w3-xlarge" href="/photos/index/{{{ $tag->tag }}}">{{ $tag->tag }}</a>
  		@endforeach
  	</div>
  </div>
  @endif
  <a href="/admin/photos/upload" target="_blank" class="w3-text-grey w3-hover-light-grey">Add a new photo</a>
  <a href="/admin/tags/add" target="_blank" class="w3-text-grey w3-hover-light-grey">Add a new tag</a>
  <a href="/photos/contact" class="w3-text-grey w3-hover-light-grey">Contact</a>
  <a href="javascript:void(0)" class="w3-text-grey w3-hover-light-grey">About</a>
</nav>
</header> 
