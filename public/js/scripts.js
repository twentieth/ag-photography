$(document).ready(function(){




$('').submit(function(e){
	$.ajaxSetup({
        headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	e.preventDefault();
	
	
});


/*
 CSS START
 */

$('.button').hover(function(){
	$(this).css({'cursor': 'pointer', 'color': 'grey'})
}, function(){
	$(this).css({'cursor': 'normal', 'color': '#f1f1f1'})
})

$('.title-container, .button').css({'color': '#f1f1f1'})


/*
 CSS END
 */
$('.close-my-sidenav').click(function(e){
	e.preventDefault()
	$('.my-sidenav').hide()
})
$('.open-my-sidenav').click(function(e){
	e.preventDefault()
	$('.my-sidenav').css({'display': 'block', 'width': '100%'}).show()
})

$('.image-small').on('click', function(){
	var title = $(this).next().text()
	var src = $(this).attr('src')
	var description = $(this).next().next().text()
	$('.title-lightbox').text(title)
	$('.image-lightbox').attr('src', src)
	$('.description-lightbox').text(description)
	$('.lightbox').css({'width': "100%"}).show()
})

$('.close-lightbox').click(function(e){
	e.preventDefault()
	$(".lightbox").hide()
})

















});
