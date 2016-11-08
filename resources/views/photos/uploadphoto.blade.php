<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body class="w3-black">

  <!--<h2>Upload Photo</h2>-->


<div class="w3-row">
  <div class="w3-rest">
    <div class="w3-container w3-padding-xxlarge w3-xlarge" id="uploadphoto-form">

@include('photos.sidenav')
@include('photos.messages')

<div class="w3-row">
  <h2 class="w3-xxlarge">Upload a new photo</h2>
</div>

  {{ Form::open(['url' => '/admin/photos/upload', 'method' => 'POST', 'files' => true, 'id' => 'form-uploadphoto']) }}
  {{ Form::label('phototitle', 'title', ['class' => 'w3-label w3-text-grey w3-hover-text-white']) }}
  @if($errors->has('phototitle'))
    @foreach($errors->get('phototitle') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  {{ Form::text('phototitle', null, ['class' => 'w3-input']) }}
  {{ Form::label('photodescription', 'description', ['class' => 'w3-label w3-text-grey w3-hover-text-white']) }}
  @if($errors->has('photodescription'))
    @foreach($errors->get('photodescription') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  {{ Form::textarea('photodescription', null, ['class' => 'w3-input', 'rows' => '4']) }}
  {{ Form::label('photo', 'add photo', ['class' => 'w3-label w3-text-grey w3-hover-text-white']) }}
  @if($errors->has('photo'))
    @foreach($errors->get('photo') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  <br>
  {{ Form::file('photo') }}
  <br>
  {{ Form::label('phototags', 'tags', ['class' => 'w3-label w3-text-grey w3-hover-text-white']) }}
  @if($errors->has('phototags'))
    @foreach($errors->get('phototags') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  <br>
  {{ Form::select('phototags[]', $tags_arr, null, ['multiple' => true]) }}
  <br>
  <br>
  {{ Form::submit('add', ['class' => 'w3-btn w3-text-grey w3-hover-text-white']) }}
  {{ Form::reset('clean', ['class' => 'w3-btn w3-text-grey w3-hover-text-white']) }}
  {{ Form::close() }}
    </div>
  </div>
</div>

    </body>
</html>
 
 
