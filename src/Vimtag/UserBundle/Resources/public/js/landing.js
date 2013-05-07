/*
 * @landing.js
 */

$(document).ready(function() 
{

    $('#join').click(

        function()
        {

            $('#startUp').fadeOut(100, function()

                {
                    $('#optinPage').fadeIn();
                }

            );

        }

    );

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

                $('#optin-submit').addClass('btn-info');
                $('#optin-submit').removeAttr('disabled');
                $('#optin-submit').text('Remind Me');

                if(response.success)
                {
                	$('#optin-message').addClass('alert-success');
                    $('#optin-submit').attr('disabled','disabled');
                    $('#optin-submit').addClass('btn-success');
                    $('#optin-submit').text('Done');
                }

                $('#optin-message-text').html(response.text);

                $('#optin-message').fadeIn();

            },
            beforeSend: function() 
            {

                $('#optin-submit').removeClass('btn-info');
                $('#optin-submit').attr('disabled','disabled');
                $('#optin-submit').text('Loading...');

            }
        });

        return false;

	});

});