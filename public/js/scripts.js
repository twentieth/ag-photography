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
	$(this).removeClass('w3-greyscale-max')
}, function(){
	$(this).addClass('w3-greyscale-max')
})
$('.image-lightbox').css({'maxHeight': window.screen.height*0.8, 'maxWidth': '85%'})

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
    var tags_string = $(this).next().next().next().text()
	var description = $(this).next().next().text()
    var name = src.substr(20,10)
    $('.title-lightbox').text(title)
    $('.description-lightbox').text(description)
    $('.image-lightbox').attr('src', '/photos/medium/' + name + '.jpg')
    $('.image-lightbox').load(function(){
        var tags_arr = tags_string.split(' ')
        var tags = []
        for(var i=0;i<tags_arr.length;i++)
        {
            if(tags_arr[i] != '' && tags_arr[i] != '\n')
            {
                tags.push(tags_arr[i])
            }
        }
        if(tags.length !== 0)
        {
            var tags_urls = 'Cathegories: '
            for(var i=0;i<tags.length;i++)
            {
                var tag = tags[i].toString().trim()
                if(tag)
                {
                    tags_urls += '<a class="w3-padding w3-margin w3-tag w3-round w3-center tag-lightbox" href="/ag-photography/tag/' + tag + '" style="display:inline-block;">' + tag + ' </a>'
                }
            }
            $('.tags-lightbox').html(tags_urls)
        }
        else
        {
            $('.tags-lightbox').html('No cathegories.')
        }
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
        var url = '/ag-photography/tag/' + tag_name
    }
    else
    {
        var url = '/'
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
    	$.ajax({
        	url: url,
        	type: 'POST',
        	data: data
    	}).done(function(data){
            $('.image-lightbox').attr('src', '/photos/medium/' + data.name + '.jpg')
        	$('.title-lightbox').text(data.title)
        	$('.description-lightbox').text(data.description)
            $('.image-lightbox').load(function(){
                var tags = data.tags.split(' ')
                if(tags != '')
                {
                    var tags_urls = 'Cathegories: '
                    for(var i=0;i<tags.length;i++)
                    {
                        var tag = tags[i].toString().trim()
                        if(tag)
                        {
                            tags_urls += '<a class="w3-padding w3-margin w3-tag w3-round w3-center tag-lightbox" href="/ag-photography/tag/' + tag + '" style="display:inline-block;">' + tag + ' </a>'
                        }
                    }
                    $('.tags-lightbox').html(tags_urls)
                }
                else
                {
                    $('.tags-lightbox').html('No cathegories.')
                }
                $('.lightbox').css({'width': "100%"}).show()
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
            $('input[name="your_name"]').before('<span class="w3-normal w3-text-red errors">The field is filled improperly.</span>')
        }
        if(!regex_message.test($('textarea[name="your_message"]').val()))
        {
            $('textarea[name="your_message"]').before('<span class="w3-normal w3-text-red errors">The field is filled improperly.</span>')
        }
        if(!regex_email.test($('input[name="your_email"]').val()))
        {
            $('input[name="your_email"]').before('<span class="w3-normal w3-text-red errors">The field is filled improperly.</span>')
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
            $('input[name="tag"]').before('<span class="w3-normal w3-text-red errors">The field is filled improperly.</span>')
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
            $('input[name="phototitle"]').before('<span class="w3-normal w3-text-red errors">The field is filled improperly.</span>')
        }
        if(!regex_description.test($('textarea[name="photodescription"]').val()))
        {
            $('textarea[name="photodescription"]').before('<span class="w3-normal w3-text-red errors">The field is filled improperly.</span>')
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

    if($('input[name="photodelete"]').is(':checked'))
        {
            $('#form-uploadphoto input[type="submit"]').removeClass('w3-text-black').addClass('w3-text-red').attr('value', 'delete')
        }

    $('input[name="photodelete"]').click(function(){
        if($('input[name="photodelete"]').is(':checked'))
        {
            $('#form-uploadphoto input[type="submit"]').removeClass('w3-text-black').addClass('w3-text-red').attr('value', 'delete')
        }
        else
        {
            $('#form-uploadphoto input[type="submit"]').removeClass('w3-text-red').addClass('w3-text-black').attr('value', 'update')
        }

    })

    $('#form-uploadphoto input[type="submit"]').click(function(){
        if($('input[name="photodelete"]').is(':visible'))
        {
            if(confirm("Are you sure to delete this picture?"))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    })
    $('#form-uploadphoto input[type="reset"]').click(function(){
        if($('input[name="photodelete"]').is(':visible'))
        {
            $('input[type="submit"]').addClass('w3-text-black').attr('value', 'update')
        }
        else
        {
            $('input[type="submit"]').addClass('w3-text-black').attr('value', 'add')
        }
    })







































});
 
