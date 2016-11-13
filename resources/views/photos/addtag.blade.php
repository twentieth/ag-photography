<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body class="w3-light-grey">

  <div class="w3-row">
  <div class="w3-rest">
    <div class="w3-container w3-padding-xxlarge w3-xlarge" id="tag-form">

@include('photos.sidenav')
@include('photos.messages')

<div class="w3-row">
  <h2 class="w3-xxlarge">Add a new tag</h2>
</div>

  {{ Form::open(['url' => '/photos/admin/addtag', 'method' => 'POST', 'id' => 'form-addtag']) }}
  {{ Form::label('tag', 'tag', ['class' => 'w3-label w3-text-black w3-hover-text-white']) }}
  @if($errors->has('tag'))
    @foreach($errors->get('tag') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  {{ Form::text('tag', null, ['class' => 'w3-input', 'placeholder' => '*required']) }}
  {{ Form::submit('add', ['class' => 'w3-btn w3-light-grey w3-text-black']) }}
  {{ Form::reset('clean', ['class' => 'w3-btn w3-light-grey w3-text-black']) }}
  {{ Form::close() }}

  </div>
  </div>
</div>
    </body>
</html>
 
 
