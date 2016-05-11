var njp_listitem = 'DIV.tx_njportfolio-listitem';
var njp_listitem_title = njp_listitem + ' DIV.title';
var njp_listitem_thumbnail = njp_listitem + ' DIV.thumbnail';

var njp_list_spotlight = 'spotlight';

$(document).ready(function() 
{
	/**
	 * hide thumbnail titles
	 */
	if($(njp_listitem_title).length > 0)
	{
		$(njp_listitem_title).hide();
	}
	
	/**
	 * show / hide title at thumbnail:hover
	 */
	$(njp_listitem).mouseenter(function()
	{
		if($('DIV.title', this).length > 0) $('DIV.title', this).slideDown('fast');
	}); 
	
	$(njp_listitem).mouseleave(function()
	{
		if($('DIV.title', this).length > 0) $('DIV.title', this).fadeOut();
	}); 
	
	if($('DIV.spotlight DIV.next').length > 0)
	{
		alert($('DIV.spotlight DIV.next').length);
	}
});


$(window).resize(function() 
{
	if($('#njbsImgContainer').length > 0)
	{
		$src = $('#njbsImgContainer > DIV.img > IMG').attr('src');
		
		njbsPortfolioHandleImage($src, true);
	}
});


function njbsPostImageCheckDimension($window, $image, $distance)
{ 

	var available = new Array();
	available['width'] = $window['width'] - $distance;
	available['height'] = $window['height'] - $distance;
	
	var checkDim = true;
	
	if( parseInt($image.width) > available['width'] ) checkDim = false;
	if( parseInt($image.height) > available['height'] ) checkDim = false;
	
	return checkDim;
}


function tx_njportfolio_ajaxHandler(loader, params)
{	
	var typeNum = 651767836546;
	
	var data = 'index.php?type='+typeNum;
	
	for(var index in params) 
	{
		if(index.match("id"))
			data = data.concat("&",index,"=",params[index]);
		else
			data = data.concat("&tx_njportfolio_portfolio[",index,"]=",params[index]);
	}
	
	$.ajax(
	{
		async: 'true',
		url: data,
		type: 'POST',
		dataType: 'json',
		data: {
		},
		beforeSend: function(xhr) 
		{
	
		},
		success: function(data) 
		{
			if($(njp_container + ' DIV.' + njp_list_spotlight).length < 1)
			{
				$(njp_container).prepend('<div class="'+njp_list_spotlight+'"></div>');
			}
			$(njp_container + ' DIV.'+njp_list_spotlight).hide();
			$(njp_container + ' DIV.'+njp_list_spotlight).append(data.content);
			
			$headlineWrapperWidth = ($('DIV.'+njp_list_spotlight).outerWidth()*3/4)-105;
			$(njp_container + ' DIV.' + njp_list_spotlight + ' DIV.headlineWrapper')
				.css('width', $headlineWrapperWidth)
				.css('left', -$headlineWrapperWidth);
			
			$spotlightSlidedDown = $(njp_container + ' DIV.'+njp_list_spotlight).slideDown(250);
			
			$.when($spotlightSlidedDown).then(function()
			{
				setTimeout(function()
				{
					$headlineWrapperSlidedIn = $(njp_container + ' DIV.' + njp_list_spotlight + ' DIV.headlineWrapper').animate(
					{
						left: 0,
					}, 'fast', function() {
						// Animation complete.
					});
					
					$.when($headlineWrapperSlidedIn).then(function()
					{
						$(njp_container + ' DIV.' + njp_list_spotlight + ' DIV.headlineWrapper DIV.headline').fadeIn(500);
					});
				}, 500);  // dies funktioniert in jedem Browser
			});
			
			$(njp_listitem + ' DIV.ajaxLoader').remove();
			tx_njportfolio_setSpotlight(params['closeUpWidth'], params['closeUpHeight'], params['navigation']);
			
			if($('DIV.'+njp_list_spotlight+' DIV.next').length > 0)
			{
				$('DIV.'+njp_list_spotlight+' DIV.next').bind("click", function()
				{
					tx_njportfolio_switchPicture('next');
				});
				$('DIV.'+njp_list_spotlight+' DIV.prev').bind("click", function()
				{
					tx_njportfolio_switchPicture('prev');
				});
			}
			
			//$.each(msg.COLUMNS, function(item) {
			//	$('#tx_njblog_overlay DIV.content').append(item);
		    //    });
			//$('#'+njp_dialog').append('response<br>');
			//$('#'+njp_dialog+' DIV.title').html(data.title);
			
			//$(njp_container + ' DIV.'+njp_list_spotlight).slideDown(500);
			
			
			
			//$(njp_container).prepend('<div class="'+njp_list_spotlight+'"></div>');
		},
		error: function(xhr,e) 
		{
			var message = '';
			if(xhr.status==0){
				message = 'You are offline!!\n Please Check Your Network.';
			}else if(xhr.status==404){
				message = 'Requested URL not found.\n' + xhr.responseText;
			}else if(xhr.status==500){
				message = 'Internel Server Error.\n' + xhr.responseText;
			}else if(e=='parsererror'){
				message = 'Parsing JSON Request failed.\n' + xhr.responseText;
			}else if(e=='timeout'){
				message = 'Request Time out.';
			}else {
				message = 'Unknown Error.\n' + xhr.responseText;
			}
			
			$(njp_container + ' DIV.'+njp_list_spotlight).append(message);
		}
		
	});

} //end of function tx_njblog_ajaxHandler


//function tx_njportfolio_closeWork()
//{
//	if($(njp_container + ' DIV.' + njp_list_spotlight).length > 0)
//	{
//		$(njp_container + ' DIV.' + njp_list_spotlight).slideUp(500);
//		
//		setTimeout(function() {
//			$(njp_container + ' DIV.' + njp_list_spotlight).remove();
//		}, 500);  // dies funktioniert in jedem Browser
//		
//		//$(njp_container + ' DIV.' + njp_list_spotlight).slideUp(500);
//		//window.setTimeout($(njp_container + ' DIV.' + njp_list_spotlight).slideUp(500), 20000);
//		//window.setTimeout(alert(2), 20000);
//		
//		//alert(1);
//		//function(){ $(njp_container + ' DIV.' + njp_list_spotlight).slideUp(500); }
//		//setTimeout(function(){$(njp_container + ' DIV.' + njp_list_spotlight).remove()}, 2000);
//	}
//}


function tx_njportfolio_setSpotlight($width, $height, $navigation)
{
	if($(njp_container + ' DIV.' + njp_list_spotlight).length > 0)
	{
		//$(njp_container + ' DIV.' + njp_list_spotlight).fadeOut(500);
		//$(njp_container + ' DIV.' + njp_list_spotlight).remove();
	}
	
	//$(njp_container).prepend('<div class="'+njp_list_spotlight+'"></div>');
	//$(njp_container).prepend('<div class="'+njp_list_spotlight+'" style="display:none;"></div>');
}

function tx_njportfolio_dialogShow($width, $height, $navigation)
{
	$('body').append('<div id="'+njp_dialog+'"></div><div id="'+njp_overlay+'"></div>');
	
	$dWidth=$width+30; 
	$dHeight=$height+65;
	if(parseInt($navigation) > 0) $dHeight+=30;
	
	$(njp_dialog_selector)
		.css('top', ($(window).height() - $dHeight) / 2 )
		.css('left', ($(window).width() - $dWidth) / 2 )
		.css('width', $dWidth)
		.css('height', $dHeight);
	
	$(window).width(); 
	
	$(njp_overlay_selector).fadeIn();
	$(njp_dialog_selector).slideDown();
}

function tx_njportfolio_showWork($pid, $thumb_id, $portfolio_uid, $category_uid, $work_uid, $image_uid, $closeUpWidth, $closeUpHeight, $navigation)
{
	var params = new Array();
	params['id']=$pid;params['controller']="Portfolio";params['action']="showAjax";params['portfolio']=$portfolio_uid;params['category']=$category_uid;params['work']=$work_uid;
	params['image']=$image_uid;params['closeUpWidth']=$closeUpWidth;params['closeUpHeight']=$closeUpHeight;params['navigation']=$navigation;
	
	tx_njportfolio_resetThumbs();
	
	$(njp_listitem).mouseenter(function()
	{
		if($('DIV.title', this).length > 0) $('DIV.title', this).slideDown('fast');
	}); 
	
	$(njp_listitem).mouseleave(function()
	{
		if($('DIV.title', this).length > 0) $('DIV.title', this).fadeOut();
	}); 
	
	$('#tx_njportfolio-listitem-'+$thumb_id).unbind();
	
	//id of the clicked thumb -> set in typo3conf/ext/nj_portfolio/Resources/Private/Templates/Portfolio/List.html
	tx_njportfolio_ajaxLoaderSet('#tx_njportfolio-listitem-'+$thumb_id);
	
	if($(njp_container + ' DIV.' + njp_list_spotlight).length > 0)
	{
		
		$headlineFadedOut	= $(njp_container + ' DIV.' + njp_list_spotlight + ' DIV.headline').fadeOut(250);
		$spotlightSlidedUp 	= $.when($headlineFadedOut).then(function(){$(njp_container + ' DIV.' + njp_list_spotlight).slideUp(250);});	
		
		$.when($spotlightSlidedUp).then(function()
		{
			$(njp_container + ' DIV.' + njp_list_spotlight).empty();
			tx_njportfolio_ajaxHandler(true, params);
		});
		
//		setTimeout(function() {
//			$(njp_container + ' DIV.' + njp_list_spotlight + ' DIV.imgContainer').remove();
//			$(njp_container + ' DIV.' + njp_list_spotlight + ' DIV.headline').remove();
//			tx_njportfolio_ajaxHandler(true, params);
//		}, 500);  // dies funktioniert in jedem Browser
	}
	else
	{
		tx_njportfolio_ajaxHandler(true, params);
	}
	//tx_njportfolio_ajaxHandler(true, params);
	
} //end of function njp_showWork


function tx_njportfolio_ajaxLoader($loader)
{
	//no loader given
	var njp_ajax_loader_std = 'typo3conf/ext/nj_portfolio/Resources/Public/Gfx/ajax/000560_64x64.gif';
	
	
	return '<div class="ajaxLoader 000560_64x64" style="display:none;"><img src="typo3conf/ext/nj_portfolio/Resources/Public/Gfx/ajax/000560_64x64.gif"></div>';
	
}

function tx_njportfolio_resetThumbs()
{
	$(njp_listitem + ' DIV.title').fadeOut(250);
	$(njp_listitem + ' DIV.thumbnail').removeClass('ajax');
}

/**
 * @param $thumbnail : id of the clicked thumb -> set in typo3conf/ext/nj_portfolio/Resources/Private/Templates/Portfolio/List.html
 * @returns {String}
 */
function tx_njportfolio_ajaxLoaderSet($thumbnail)
{
	var ajaxBackground = 'background: url(typo3conf/ext/nj_portfolio/Resources/Public/Gfx/ajax/000560_64x64.gif) center center no-repeat; ';
		
	var thumbHeight = $($thumbnail).outerHeight();
	var titleHeight = $($thumbnail + ' DIV.title').outerHeight();
	var ajaxHeight = thumbHeight;
	
	var ajaxStyle = 'style="position:absolute; top:0; right:0; left:0; height:'+ajaxHeight+'px;'+ajaxBackground+'z-index:'+($($thumbnail + ' DIV.thumbnail').css('z-index')-1)+'"';
	
	var ajaxLoader = '<div class="ajaxLoader 000560_64x64" '+ajaxStyle+'></div>';
	
	$($thumbnail+' DIV.thumbnail').addClass('ajax');
	$($thumbnail).prepend(ajaxLoader);
}

function tx_njportfolio_switchPicture($direction)
{
	var selNext = 'DIV.'+njp_list_spotlight+' DIV.next';
	var selPrev = 'DIV.'+njp_list_spotlight+' DIV.prev';
	var selSpotlightImage = '#spotlight-image-';
	
	var numberOfPictures = 1;
	if($('DIV.spotlight-image').length > 0)
	{
		numberOfPictures = $('DIV.spotlight-image').length;
	}
	
	if($direction == "next")
	{
		var actpic = $(selNext).attr("actpic");
		var nextpic = parseInt(actpic) + 1;
		
		$(selNext).attr("actpic", nextpic);
		
		if(actpic == 0)
		{
			$(selPrev).attr("actpic", nextpic);
			$(selPrev).show();
		}

		if(parseInt(actpic) == (parseInt(numberOfPictures)-2))
		{
			$(selNext).hide();
		}
		
		$(selSpotlightImage+actpic).fadeOut(250);
		$(selSpotlightImage+nextpic).fadeIn(1000);
	}
	
	if($direction == "prev")
	{
		var actpic = $(selPrev).attr("actpic");
		var prevpic = parseInt(actpic) - 1;
		
		$(selNext).attr("actpic", prevpic);
		$(selPrev).attr("actpic", prevpic);
		
		if(actpic == 1)
		{
			$(selPrev).hide();
		}
	
		if(parseInt(prevpic) < (parseInt(numberOfPictures)-1))
		{
			$(selNext).show();
		}
		
		$(selSpotlightImage+actpic).fadeOut(250);
		$(selSpotlightImage+prevpic).fadeIn(1000);
	}
}