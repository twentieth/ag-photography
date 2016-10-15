@if(session('message_type'))
    <div class="alert alert-{{ session('message_type') }}">
        {{ session('message_text') }}
    </div>
@endif

<div class="alert alert-{{ session('message_type') }} alert-js" style="display:none;">

</div>