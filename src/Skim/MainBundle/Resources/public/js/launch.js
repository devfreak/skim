var icons = new Array("share", "explore", "profile");

function showIcon(id, delay) {
	$("#" + id).delay(delay+500).animate({
		marginTop: "0px",
		filter : 'alpha(opacity=100)',
		opacity: '1'
	}, 500);
}

function pushUpIcons() 
{
	for(i=0;i<icons.length;i++)
	{
		$("#" + icons[i]).animate({
			top: '25px'
		}, 100).animate({
			top: '-' + $('body').height()
		}, 
		{
			duration: 150
			/*step: function(now, fx)
			{
				if(now < -$('body').height()*0.2)
				{
					$(this).css('opacity', $(this).css('opacity')-0.4);
				}
			}*/
		});
	}
}

function pushDownIcons()
{
	for(i=0;i<icons.length;i++)
	{
		$("#" + icons[i]).animate({
			top: '0' 
		}, 150);
	}
}

$(document).ready(

	function()
	{

		 for(i=0;i<icons.length;i++)
		 {

		 	showIcon(icons[i], i*150);

		 }

		 $('.footer').delay(1200).animate(
		 {
		 	filter : 'alpha(opacity=1)',
			opacity: '1'
		 },
		 
		 500
		 
		 );

		 $('.element').click(pushUpIcons);

		 $('#share').click(function(){

		 	$('#share-page').fadeIn();

		 	$('#share-page #url input').focus();

		 });

		 $('#explore').click(function(){

		 	$('#explore-page').fadeIn();

		 });

		 $('#profile').click(function(){

		 	$('#profile-page').fadeIn();

		 });

		 $('.footer').click(function(){
		 	pushDownIcons();

		 	$('.page').fadeOut();

		 });

	}

);