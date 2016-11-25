@extends('photos.base')
  
@section('content')

 
<div class="w3-row">
  <div class="w3-rest">
    <div class="w3-container w3-padding-xxlarge w3-xlarge" id="uploadphoto-form">

@include('photos.sidenav')
@include('photos.messages')

<div class="w3-row">
  @if(!isset($updatephoto))
    <h2 class="w3-xxxlarge">upload a new picture</h2>
  @else
    <h2 class="w3-xxxlarge">update the picture</h2>
  @endif
</div>
  @if(!isset($updatephoto))
    {{ Form::open(['action' => 'PhotosAdminController@upload', 'method' => 'POST', 'files' => true, 'id' => 'form-uploadphoto']) }}
  @else
    {{ Form::open(['action' => ['PhotosAdminController@upload', $photo->id], 'method' => 'POST', 'files' => true, 'id' => 'form-uploadphoto']) }}
  @endif
  {{ Form::label('phototitle', 'title', ['class' => 'w3-label w3-text-black w3-hover-text-white']) }}
  @if($errors->has('phototitle'))
    @foreach($errors->get('phototitle') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  @if(!isset($updatephoto))
    {{ Form::text('phototitle', null, ['class' => 'w3-input']) }}
  @else
    {{ Form::text('phototitle', $photo->title, ['class' => 'w3-input']) }}
  @endif
  {{ Form::label('photodescription', 'description', ['class' => 'w3-label w3-text-black w3-hover-text-white']) }}
  @if($errors->has('photodescription'))
    @foreach($errors->get('photodescription') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  @if(!isset($updatephoto))
    {{ Form::textarea('photodescription', null, ['class' => 'w3-input', 'rows' => '4']) }}
  @else
    {{ Form::textarea('photodescription', $photo->description, ['class' => 'w3-input', 'rows' => '4']) }}
  @endif
  {{ Form::label('photo', 'add photo', ['class' => 'w3-label w3-text-black w3-hover-text-white']) }}
  @if($errors->has('photo'))
    @foreach($errors->get('photo') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  <br>
  @if(isset($updatephoto))
    <div class="w3-row w3-medium w3-text-grey">current photo:</div>
    <div class="w3-row">
      <img class="w3-image w3-col m3 w3-card-8 photo-update" src="/photos/small_color/{{ $photo->name }}.jpg" alt="{{ $photo->title }}">
    </div>
  @endif
  {{ Form::file('photo') }}
  <br>
  {{ Form::label('phototags', 'tags', ['class' => 'w3-label w3-text-black w3-hover-text-white']) }}
  @if($errors->has('phototags'))
    @foreach($errors->get('phototags') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  <br>
  @if(isset($updatephoto))
  <div class="w3-row w3-medium w3-text-grey w3-padding-bottom current-tags">
    @if($photo->tags->count() !== 0)
      current tags:
    @else
      no current tags
    @endif
      @foreach($photo->tags as $tag)
        <span class="">{{ $tag->tag }} </span>
      @endforeach
    </div>
  @endif
  {{ Form::select('phototags[]', $tags_arr, null, ['multiple' => true]) }}
  <br>
  <br>
  @if(isset($updatephoto))
    {{ Form::label('photodelete', 'do you want to delete this photo?', ['class' => 'w3-label w3-text-red w3-hover-text-white']) }}
    {{ Form::checkbox('photodelete') }}
    <br>
    <br>
  @endif
  @if(!isset($updatephoto))
    {{ Form::submit('add', ['class' => 'w3-btn w3-light-grey w3-text-black']) }}
  @else
    {{ Form::submit('update', ['class' => 'w3-btn w3-light-grey w3-text-black']) }}
  @endif
  {{ Form::reset('clean', ['class' => 'w3-btn w3-light-grey w3-text-black']) }}
  {{ Form::close() }}
    </div>
  </div>
</div>

@endsection('content')
