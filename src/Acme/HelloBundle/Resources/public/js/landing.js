/*
 * @landing.js
 */

$(document).ready(function() 
{

	$('.close').click(function() 
	{

   		$('.alert').fadeOut();

	});

	$('#optin').submit(function() 
	{

		$('.alert').hide();

		var inputValue = $('#optin-input').val();
        var _tokenValue = $('#optin__token').val();
 		var url = Routing.generate('optin');
        
        $.ajax(
        {
        	url: url,
        	type: 'post',
        	dataType: 'json',
            data: 
            {
                'optin[email]': inputValue,
                'optin[_token]': _tokenValue
            },
            success: function(response)
            {

            	$('#optin-message').removeClass('alert-success');

                if(response.success)
                	$('#optin-message').addClass('alert-success');

                $('#optin-message-text').html(response.text);

                $('#optin-message').fadeIn();

            }
        });

        return false;

	});

});