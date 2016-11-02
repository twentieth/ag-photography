<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body class="w3-black">

  <div class="w3-row">
  <div class="w3-rest">
    <div class="w3-container w3-padding-xxlarge w3-black w3-xlarge" style="position:absolute;top:0;bottom:0;right:0;left:0;" id="tag-form">

       <!--<h2>Add Tag</h2>-->

  {{ Form::open(['url' => '/admin/tags/add', 'method' => 'POST', 'id' => 'form-addtag']) }}
  {{ Form::label('tag', 'tag', ['class' => 'w3-label w3-text-grey w3-hover-text-white']) }}
  @if($errors->has('tag'))
    @foreach($errors->get('tag') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  {{ Form::text('tag', null, ['class' => 'w3-input', 'placeholder' => '*required']) }}
  {{ Form::submit('add', ['class' => 'w3-btn w3-text-grey w3-hover-text-white']) }}
  {{ Form::reset('clean', ['class' => 'w3-btn w3-text-grey w3-hover-text-white']) }}
  {{ Form::close() }}

  </div>
  </div>
</div>
    </body>
</html>
 
 
