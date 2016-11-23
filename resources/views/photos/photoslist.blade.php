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
    $count = $photos->count();
  @endphp
  @foreach($photos as $photo)
  <div class="w3-row">
    <li>
      <div class="w3-col s1"><span class="w3-medium w3-text-grey">{{ $count }}</span></div>
      <div class="w3-col s8"><a href="/ag-photography/admin/updatephoto/{{ $photo->id }}">{{ $photo->title }}</a></div>
      <div class="w3-col s3"><a href="/ag-photography/admin/updatephoto/{{ $photo->id }}"><img class="w3-image w3-card-8" src="/photos/small_color/{{ $photo->name }}.jpg" alt="{{ $photo->title }}"></a></div>
    </li>
  </div>
  @php
    $count--;
  @endphp
  @endforeach
</ul>

{{ $photos->links() }}
</div>
</div>
</div>

</body>
</html>
 
 
