var buttons = new Array("magic", "tags", "favorites", "history");

function pushUpButtons() 
{
	for(i=0;i<buttons.length;i++)
	{
		$("." + buttons[i]).animate({
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

$(document).ready(

	function()
	{
		$("#explore-page #explore-select .button").click(
			function()
			{
				pushUpButtons();
			}
		);
	}
);