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

  {{ Form::open(['url' => '/ag-photography/contact', 'method' => 'POST', 'name' => 'contact']) }}
  {{ Form::label('your_name', 'your name', ['class' => 'w3-label w3-text-black w3-hover-text-white']) }}
  @if ($errors->has('your_name'))
    @foreach ($errors->get('your_name') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  {{ Form::text('your_name', null, ['class' => 'w3-input', 'placeholder' => '*required']) }}
  {{ Form::label('your_email', 'your e-mail', ['class' => 'w3-label w3-text-black w3-hover-text-white']) }}
  @if ($errors->has('your_email'))
    @foreach ($errors->get('your_email') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  {{ Form::email('your_email', null, ['class' => 'w3-input', 'placeholder' => '*required']) }}
  {{ Form::label('your_message', 'your message', ['class' => 'w3-label w3-text-black w3-hover-text-white']) }}
  @if ($errors->has('your_message'))
    @foreach ($errors->get('your_message') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  {{ Form::textarea('your_message', null, ['class' => 'w3-input', 'placeholder' => '*required', 'rows' => '4']) }}
  {{ Form::label('cc_myself', 'do you want to receive the message copy?', ['class' => 'w3-label w3-text-black w3-hover-text-white']) }}
  {{ Form::checkbox('cc_myself', True, True, ['class' => 'w3-check']) }}
  <br>
  <br>
  @if ($errors->has('g-recaptcha-response'))
    @foreach ($errors->get('g-recaptcha-response') as $error)
      <span class="w3-medium w3-text-red errors">{{ $error }} </span>
    @endforeach
  @endif
  {!! NoCaptcha::display() !!}
  <br>
  {{ Form::submit('send', ['class' => 'w3-btn w3-light-grey w3-text-black']) }}
  {{ Form::reset('clean', ['class' => 'w3-btn w3-light-grey w3-text-black']) }}
  {{ Form::close() }}

</div>
</div>
</div>

@endsection ('content')
