<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body>
@include('photos.messages')
<div class="container">
  
       <h2>Photos List</h2>

       <table class="table">
        <thead>
          <th>Title</th><th>Name</th><th>Photo</th><th>URL</th><th>Tags</th>
        </thead>
        <tbody>
          @foreach($photos as $photo)
            <tr>
              <td>{{ $photo->title }}</td>
              <td>{{ $photo->name }}</td>
              <td>{{ HTML::image("/storage/photos/small_color/$photo->name.jpg") }}</td>
              <td><a href="/admin/photos/photo/{{ $photo->id }}">URL</a></td>
              <td>
                @foreach($photo->tags as $tag)
                  {{ $tag->tag }}
                @endforeach
              </td>
            </tr>
          @endforeach
        </tbody>
       </table>


</div>
</body>
</html>
 
 
