<!DOCTYPE html>
<html lang="en">
@include('photos.head')
<body class="w3-light-grey">

<div class="w3-row">
<div class="w3-rest">
<div class="w3-container w3-padding-xxlarge w3-xlarge" id="tag-form">

<div class="w3-row">
  <h2 class="w3-xxxlarge">log in</h2>
</div>


                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/authentication') }}">
                    {{ csrf_field() }}
                    <div class="w3-row">
                        <label for="email" class="w3-label w3-text-black w3-hover-text-white">e-mail</label>
                        @if($errors->has('email'))
                            @foreach($errors->get('email') as $error)
                                <span class="w3-medium w3-text-red errors">{{ $error }} </span>
                            @endforeach
                        @endif
                        <input id="email" type="email" class="w3-input" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="w3-row">
                        <label for="password" class="w3-label w3-text-black w3-hover-text-white">password</label>
                        @if($errors->has('password'))
                            @foreach($errors->get('password') as $error)
                                <span class="w3-medium w3-text-red errors">{{ $error }} </span>
                            @endforeach
                        @endif
                        <input id="password" type="password" class="w3-input" name="password">
                    </div>
                    <div class="w3-row">
                        <label class="w3-label w3-text-black w3-hover-text-white">
                            <input type="checkbox" name="remember" class="w3-check">remember me
                        </label>
                    </div>
                    <div class="w3-row">
                        <button type="submit" class="w3-btn w3-light-grey w3-text-black">login</button>
                    </div>

                    </form>
</div>
</div>
</div>
</body>
</html>