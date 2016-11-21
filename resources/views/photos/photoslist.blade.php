<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body class="w3-light-grey">

 
<div class="w3-row">
<div class="w3-rest">
<div class="w3-container w3-padding-xxlarge w3-xlarge">

@include('photos.sidenav')
@include('photos.messages')


<ul class="w3-ul">
  @php
    $x = 1;
  @endphp
  @foreach($photos as $photo)
  <div class="w3-row">
    <li>
      <div class="w3-col m1"><span class="w3-medium w3-text-grey">{{ $x }}</span></div>
      <div class="w3-col m4"><a href="/ag-photography/admin/updatephoto/{{ $photo->id }}">{{ $photo->title }}</a></div>
      <div class="w3-col m3"><img class="w3-image w3-card-8" src="/photos/small_color/{{ $photo->name }}.jpg" alt="{{ $photo->title }}"></div>
    </li>
  </div>
  @php
    $x++;
  @endphp
  @endforeach
</ul>


</div>
</div>
</div>

</body>
</html>
 
 
