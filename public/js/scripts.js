$(document).ready(function(){




$('').submit(function(e){
	$.ajaxSetup({
        headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	e.preventDefault();
	
	
});



























});
