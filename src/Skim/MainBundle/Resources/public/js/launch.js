var icons = new Array("share", "explore", "connect");

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
			top: '20px'
		}, 100).animate({
			top: '-' + $('body').height()
		}, 300);
	}
}

function pushDownIcons()
{
	for(i=0;i<icons.length;i++)
	{
		$("#" + icons[i]).animate({
			top: '0' 
		});
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

		 });

		 $('.footer').click(function(){
		 	pushDownIcons();

		 	$('.page').fadeOut();

		 });

	}

);