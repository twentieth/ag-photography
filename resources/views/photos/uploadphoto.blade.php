<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body>
@include('photos.messages')
<div class="container">

  <h2>Upload Photo</h2>



       <form method="POST" action="/admin/photos/upload" enctype="multipart/form-data" id="form-uploadphoto">
        {{ csrf_field() }}
       	<div class="form-group">
       			<label for="form-phototitle">title</label>
       			<input type="text" name="phototitle" id="form-phototitle" class="form-control" value="{{ old('phototitle') }}">
       		</div>
       		<div class="form-group">
       			<label for="form-photodescription">description</label>
       			<textarea name="photodescription" id="form-photodescription" class="form-control">{{ old('photodescription') }}</textarea>
       		</div>
          <div class="form-group">
            <label for="form-tags">tags</label>
            <select name="phototags[]" class="form-control" id="form-tags" multiple>
              @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->tag }}</option>
              @endforeach
            </select>
          </div>
       		<div class="form-group">
       			<label class="btn btn-info btn-file">
    				Browse Photo<input name="photo" type="file" style="display: none;">
				</label>
			</div>
       		<input type="submit" class="btn btn-primary">
       		<input type="reset" class="btn btn-default">
       </form>
   </div>
    </body>
</html>
 
 
