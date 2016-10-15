<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body>
@include('photos.messages')
<div class="container">

       <h2>Photo View</h2>

       

       {{ HTML::image("/storage/photos/medium/$name.jpg") }}
       


</div>
</body>
</html>
 
 
