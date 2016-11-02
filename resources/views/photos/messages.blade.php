
<div style="position:relative;color:white;z-index:100;" class="">
	@if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
@endif
</div>


    

<div style="position:relative;z-index:99;color:white;" class="alert alert-{{ session('message_type') }} alert-js" style="">

</div>