
	@if(session('message_type'))
	<div class="w3-row">
        <div class="w3-container w3-black w3-padding-large {{ session('message_type') }} message">
        	<div class="message_text">{{ session('message_text') }} <i class="fa fa-remove w3-right close-message"></i></div>
        </div>
    </div>
	@endif