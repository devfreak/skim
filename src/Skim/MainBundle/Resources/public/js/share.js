var tags = 0;

function newTag(value)
{
	return '<div class="child" id="tag'+tags+'"><h1 class="depth" title="'+value+'">'+value+'</h1></div>';
}

function addTagToCloud(tag)
{
	$('#share-page #tagcloud').html($('#share-page #tagcloud').html() + tag);
	$('#tag'+tags).animate(
		{
			opacity: 1,
			filter: "alpha(opacity=100)"
		},
		500
	);
}

$(document).ready(
	function()
	{
		$("#share-page #url form").submit(
			function()
			{
				$("#url").fadeOut(100, function(){$("#tags").fadeIn(100, 
		 		function(){$('#tags input').focus()})});
				return false;
			}
		);

		$("#share-page #tags input").keyup(
			
			function(code) {
				if(code.keyCode==32)
				{
					tags += 1;
					var tag = newTag($('#share-page #tags input').val());
					$('#share-page #tags input').val(null);
					addTagToCloud(tag);
				}
			}

		);

		$(".child").click(
			function()
			{
				$(this).remove();
			}
		);

	}
);