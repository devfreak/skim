/*
 * @landing.js
 */

$(document).ready(

    function()
    {
        $('#next').click(

            function()
            {
                $.ajax({

                    url: Routing.generate('next'),
                    type: 'GET',
                    success: function(response) {
                        $('#render').attr('src', 'http://' + response.url);
                    }

                });
            }

        );
    }

);