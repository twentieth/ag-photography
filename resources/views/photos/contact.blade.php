@extends ('photos.base')
  
@section ('content')

<div class="w3-row">
<div class="w3-rest">
<div class="w3-container w3-padding-xxlarge w3-xlarge" id="contact-form">

@include ('photos.sidenav')
@include ('photos.messages')

<div class="w3-row">
  <h2 class="w3-xxxlarge">send a message</h2>
</div>

  {!! Form::model($contact, ['action' => 'ContactController@contactSend', 'method' => 'post']) !!}
  {!! Form::label('name', 'your name', ['class' => 'w3-label w3-text-black w3-hover-text-white']) !!}
  @if ($errors->has('name'))
    @foreach ($errors->get('name') as $error)
      <span class="w3-medium w3-text-red errors">{!! $error !!} </span>
    @endforeach
  @endif
  {!! Form::text('name', null, ['class' => 'w3-input', 'placeholder' => '*required']) !!}
  
  {!! Form::label('mail', 'your e-mail', ['class' => 'w3-label w3-text-black w3-hover-text-white']) !!}
  @if ($errors->has('mail'))
    @foreach ($errors->get('mail') as $error)
      <span class="w3-medium w3-text-red errors">{!! $error !!} </span>
    @endforeach
  @endif
  {!! Form::email('mail', null, ['class' => 'w3-input', 'placeholder' => '*required']) !!}

  {!! Form::label('message', 'your message', ['class' => 'w3-label w3-text-black w3-hover-text-white']) !!}
  @if ($errors->has('message'))
    @foreach ($errors->get('message') as $error)
      <span class="w3-medium w3-text-red errors">{!! $error !!} </span>
    @endforeach
  @endif
  {!! Form::textarea('message', null, ['class' => 'w3-input', 'placeholder' => '*required', 'rows' => '4']) !!}

  {!! Form::label('cc_myself', 'do you want to receive the message copy?', ['class' => 'w3-label w3-text-black w3-hover-text-white']) !!}
  {!! Form::checkbox('cc_myself', True, True, ['class' => 'w3-check']) !!}
  <br>
  <br>

  @if ($errors->has('g-recaptcha-response'))
    @foreach ($errors->get('g-recaptcha-response') as $error)
      <span class="w3-medium w3-text-red errors">{!! $error !!} </span>
    @endforeach
  @endif
  {!! NoCaptcha::display() !!}
  <br>
  {!! Form::submit('send', ['class' => 'w3-btn w3-light-grey w3-text-black']) !!}
  {!! Form::reset('clean', ['class' => 'w3-btn w3-light-grey w3-text-black']) !!}
  {!! Form::close() !!}

</div>
</div>
</div>

@endsection ('content')
