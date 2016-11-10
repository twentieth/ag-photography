$(document).ready(function(){

/*
 CSS START
 */

$('.button').hover(function(){
	$(this).css({'cursor': 'pointer', 'color': 'grey'})
}, function(){
	$(this).css({'cursor': 'normal', 'color': '#f1f1f1'})
})

$('.title-container, .button').css({'color': '#f1f1f1'})

$('.image-small').hover(function(){
	$(this).removeClass('w3-greyscale')
}, function(){
	$(this).addClass('w3-greyscale')
})
$('.image-lightbox').css({'maxHeight': window.screen.height*0.9, 'maxWidth': window.screen.width*0.85})

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
	var src = $(this).attr('src')
	var title = $(this).next().text()
	var description = $(this).next().next().text()
    var tags = $(this).next().next().next().text()
    var name = src.substr(20,10)
    $('.image-lightbox').attr('src', '/photos/medium/' + name + '.jpg')
    $('.title-lightbox').text(title)
    $('.description-lightbox').text(description)
    $('.tags-lightbox').text(tags)
    $('.image-lightbox, .title-lightbox, .description-lightbox, .tags-lightbox').show(function(){
       	$('.lightbox').css({'width': "100%"}).show()
    })
})

$('.close-lightbox').click(function(e){
	e.preventDefault()
	$(".lightbox").fadeOut()
})



/*
 AJAX NEXT IMAGE
 */
$('.button-right, .button-left').on('click', function(e){
    $.ajaxSetup({
    	headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	}
    });
    var src = $('.image-lightbox').attr('src')
    var name = src.substr(15,10)
    var tag_name = $('.tag-hidden').text()
    if(tag_name != '')
    {
        var url = '/photos/index/' + tag_name
    }
    else
    {
        var url = '/photos/index'
    }

    if(e.target.className.search('fa-chevron-right') !== -1)
    {
        var data = {
            direction: 'right',
            name: name,
            tag_name: tag_name
        }
    }
    if(e.target.className.search('fa-chevron-left') !== -1)
    {
        var data = {
            direction: 'left',
            name: name,
            tag_name: tag_name
        }
    }

    $('.lightbox').fadeOut(function(){
    	$('.image-lightbox, .title-lightbox, .description-lightbox, .tags-lightbox').hide()
    	$.ajax({
        	url: url,
        	type: 'POST',
        	data: data
    	}).done(function(data){
        	$('.image-lightbox').attr('src', '/photos/medium/' + data.name + '.jpg')
        	$('.title-lightbox').text(data.title)
        	$('.description-lightbox').text(data.description)
            $('.tags-lightbox').text(data.tags)
        	$('.image-lightbox, .title-lightbox, .description-lightbox, .tags-lightbox').show(function(){
        		$('.lightbox').show()
        	})

    	}).fail(function(){
        	alert('Error')
    	})
    })
    
})

$('form[name="contact"]').on('submit', function(e)
{
    var regex_name = /^[^<>]{1,100}$/i;
    var regex_message = /^[^<>]{1,500}$/i;
    var regex_email = /^[a-z0-9_.+-]+@[a-z0-9-]+\.[a-z0-9-.]+$/i;

    $('.errors').hide()

    if(!regex_name.test($('input[name="your_name"]').val()) || !regex_message.test($('textarea[name="your_message"]').val()) || !regex_email.test($('input[name="your_email"]').val()))
    {

        if(!regex_name.test($('input[name="your_name"]').val()))
        {
            $('input[name="your_name"]').before('<span class="w3-medium w3-text-red errors">The field is filled improperly.</span>')
        }
        if(!regex_message.test($('textarea[name="your_message"]').val()))
        {
            $('textarea[name="your_message"]').before('<span class="w3-medium w3-text-red errors">The field is filled improperly.</span>')
        }
        if(!regex_email.test($('input[name="your_email"]').val()))
        {
            $('input[name="your_email"]').before('<span class="w3-medium w3-text-red errors">The field is filled improperly.</span>')
        }
        return false;
    }
});
$('button[type="reset"], input[type="reset"]').click(function(){
    $('input[type="text"], input[type="email"], input[type="password"], textarea').val('')
    $('.errors').hide()
    $('.message').hide()
});
$('input[type="text"], input[type="email"], input[type="password"], textarea').focus(function(){
    if($(this).prev().hasClass('errors'))
    {
        $(this).prev().hide()
    }
})
$('.close-message').click(function(){
    $('.message').hide()
})

$('#form-addtag').submit(function(){
    var regex_tag = /^[^<>]{1,100}$/i;

    $('.errors').hide()

    if(!regex_tag.test($('input[name="tag"]').val()))
    {

        if(!regex_tag.test($('input[name="tag"]').val()))
        {
            $('input[name="tag"]').before('<span class="w3-medium w3-text-red errors">The field is filled improperly.</span>')
        }
        return false;
    }

})
/*$('#form-uploadphoto').on('submit', function(e)
{
    var regex_title = /^[^<>]{1,100}$/i;
    var regex_description = /^[^<>]{0,500}$/i;

    $('.errors').hide()

    if(!regex_title.test($('input[name="phototitle"]').val()) || !regex_description.test($('textarea[name="photodescription"]').val()))
    {

        if(!regex_title.test($('input[name="phototitle"]').val()))
        {
            $('input[name="phototitle"]').before('<span class="w3-medium w3-text-red errors">The field is filled improperly.</span>')
        }
        if(!regex_description.test($('textarea[name="photodescription"]').val()))
        {
            $('textarea[name="photodescription"]').before('<span class="w3-medium w3-text-red errors">The field is filled improperly.</span>')
        }
        return false;
    }
});

*/


    $('.fa-toggle-off, .fa-toggle-on').click(function(){
        if($(this).hasClass('fa-toggle-off'))
        {
            $('.fa-toggle-off').hide()
            $('.fa-toggle-on').show()
        }
        if($(this).hasClass('fa-toggle-on'))
        {
            $('.fa-toggle-on').hide()
            $('.fa-toggle-off').show()
        }
    })


    $('.dropdown-content-click-cathegories').click(function(){
        $('.dropdown-content-cathegories').slideToggle()
    })











































});
