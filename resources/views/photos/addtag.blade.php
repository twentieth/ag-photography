<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body>
@include('photos.messages')
<div class="container">

       <h2>Add Tag</h2>

       

       <form method="POST" action="/admin/tags/add" id="form-addtag">
        {{ csrf_field() }}
       	<div class="form-group">
       			<label for="form-tag">title</label>
       			<input type="text" name="tag" id="form-tag" class="form-control" value="{{ old('tag') }}">
       	</div>
       		
       		<input type="submit" class="btn btn-primary" value="Submit">
       		<input type="reset" class="btn btn-default" value="Reset">
       </form>
   </div>
    </body>
</html>
 
 
