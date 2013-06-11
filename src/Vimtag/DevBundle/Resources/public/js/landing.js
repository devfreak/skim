/*
 * @landing.js
 */

var interest = $.ajax();
var currentUrlID;
var t;

function interestAction()
{
    if(y) {
    interest.abort();

    interest = $.ajax({

        url: Routing.generate('interested', {id: currentUrlID}),
        type: 'GET',
        success: function(response) {
alert('end');
            $('#url-interests').text(response.interests.url);
            $('#user-interests').text(response.interests.user);

            var urlToUser = '';

            var obj = response.urlToUser;
            for (var prop in obj) {

                    urlToUser += 'Kategorie: ' + obj[prop].category + '<br>';
                    urlToUser += 'Url-score: ' + obj[prop].urlscore_percentage + '%' + '<br>';
                    urlToUser += 'User-score: ' + obj[prop].userscore_percentage + '%' + '<br>';
                    urlToUser += 'Ergebnis: ' + obj[prop].result + '%' + '<br>';
                
            }

            $('#urlToUser').html(urlToUser);

            var userToUrl = '';

            var obj = response.userToUrl;
            for (var prop in obj) {

                    userToUrl += 'Kategorie: ' + obj[prop].category + '<br>';
                    userToUrl += 'User-score: ' + obj[prop].userscore_percentage + '%' + '<br>';
                    userToUrl += 'Url-score: ' + obj[prop].urlscore_percentage + '%' + '<br>';
                    userToUrl += 'Ergebnis: ' + obj[prop].result + '%' + '<br>';
                
            }

            $('#userToUrl').html(userToUrl);

        }

    });}

}

$(document).ready(

    function()
    {

        $('#next').click(
            function()
            {
                y = false;
                interest.abort(clearTimeout(t));
                $.ajax({

                    url: Routing.generate('next'),
                    type: 'GET',
                    success: function(response) {

                        currentUrlID = response.id;

                        $('#render').attr('src', 'http://' + response.url);
                        if (top != self) { top.location.replace(self.location.href); }
                        var i = 0;
                        $("#render").load(function() {
                            if(i==0)
                              {  y = true;clearTimeout(t)
                             t = setTimeout(interestAction,10000); }
                         i++
                        });
                    }

                });
            }

        );



    }

);