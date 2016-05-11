var njp_container			= '#tx_njportfolio';
var njp_dialog				= 'tx_njportfolio_dialog';
var njp_dialog_selector		= '#'+njp_dialog;
var njp_overlay 			= 'tx_njportfolio_overlay';
var njp_overlay_selector	= '#'+njp_overlay;

$(document).ready(function() 
{
});


function njpGeneralOverlayShow()
{
	$('body').addClass('noscroll');
	$('body').append('<div id="'+njp_overlay+'"></div>');
	$(njp_overlay_selector).fadeIn(250);
}

function njpGeneralOverlayHide()
{
	$(njp_overlay_selector).fadeOut(250);
	$('body').removeClass('noscroll');
	$(njp_overlay_selector).remove();
}

function njpGeneralGetWindowDimension()
{
	var dim = new Array();
	dim['width'] = parseInt($(window).width());
	dim['height'] = parseInt($(window).height());
	
	return dim;
}

function njpGeneralSetImageDimension($imageId)
{
	var image = new Image();
	image.src = $($imageId).attr('src');
}