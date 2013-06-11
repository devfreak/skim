function showIcon(id, delay) {
	$("#" + id).delay(delay+500).animate({
		marginTop: "0px",
		filter : 'alpha(opacity=100)',
		opacity: '1'
	}, 500);
}

$(document).ready(

	function()
	{
		
		 var icons = new Array("share", "explore", "connect");

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

	}

);