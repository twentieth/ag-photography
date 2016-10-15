<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style>
            
        </style>

        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    	<div class="container">
       <?php

       




       ?>

       <h2>Test Userform</h2>
       <form method="POST" action="/register">
        {{ csrf_field() }}
       	<div class="form-group">
       			<label for="form-username">username</label>
       			<input type="text" name="username" id="form-username" class="form-control" value="{{ old('username') }}">
       		</div>
       		<div class="form-group">
       			<label for="form-password">password</label>
       			<input type="password" name="password" id="form-password" class="form-control">
       		</div>
       		<div class="form-group">
       			<label for="form-password-repeat">repeat password</label>
       			<input type="password" name="password-repeat" id="form-password-repeat" class="form-control">
       		</div>
       		<div class="form-group">
       			<label for="form-email">e-mail</label>
       			<input type="text" name="email" id="form-email" class="form-control" value="{{ old('email') }}">
       		</div>
       		<input type="submit" class="btn btn-primary">
       		<input type="reset" class="btn btn-default">
       </form>
   </div>
    </body>
</html>
 
