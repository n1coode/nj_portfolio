//
// tx_njportfolio : global query.selectors 
//
var __njportfolio = '.tx_njportfolio';


var __njportfolio_category_list;
var __njportfolio_category_list_item;

var __njportfolio_work									= __njportfolio + '.work';
var __njportfolio_work_digest							= __njportfolio_work + '.digest';
var __njportfolio_work_digest_collection				= __njportfolio_work_digest + ' .collection';	
var __njportfolio_work_digest_collection_categories		= __njportfolio_work_digest_collection + '[data-list="categories"]';
var __njportfolio_work_digest_focus;
var __njportfolio_work_digest_grid;
var __njportfolio_work_digest_grid_item;

var __njportfolio_work_selection;
var __njportfolio_work_selection_item;

//
// tx_njportfolio : global variables // settings
//
var _njportfolio_work_digest_item_WIDTH_init;

var _njportfolio_work_digest_grid_COLS_act;
var _njportfolio_work_digest_grid_WIDTH_act; //also .collection
var _njportfolio_work_digest_grid_item_WIDTH_act;

var _njportfolio_work_digest_BREAKPOINT_MAX;
var _njportfolio_work_digest_BREAKPOINT_NEXT_act;
var _njportfolio_work_digest_BREAKPOINT_PREV_act;

var _njportfolio_ajax_ACTION_work_image			= "workImage";
var _njportfolio_ajax_ACTION_work_digest		= "workDigest";
var _njportfolio_ajax_ACTION_digestCategories	= "digestCategories";

var _njportfolio_ajax_EXTKEY 			= 'tx_njportfolio_pi1';
var _njportfolio_ajax_LANG;
var _njportfolio_ajax_TYPENUM;


var _njportfolio_work_digest;

var _njportfolio_work_digest_focus;
var _njportfolio_work_digest_grid_item;

var _njportfolio_work_digest_focus_INTERVAL;

var _njportfolio_work_digest_MASONRY = [];
var _njportfolio_work_digest_MASONRY_options;

var _njportfolio_data_task_show_menu_categories = '[data-task="show-menu-categories"]';


$(document).ready( function()
{
	tx_njportfolio_init();
});


//
//	controller.action : work.digest
//
$(document).ready( function() 
{
	$(document).on( 'click',__njportfolio_work_digest_grid_item + ' .thumb .overlay I.fa-eye', function() 
	{
		_njportfolio_ajax_TYPENUM	= njportfolio_work_digest_settings["typeNum"];
		_njportfolio_ajax_LANG		= njportfolio_work_digest_settings['language'];
		_njportfolio_ajax_EXTKEY	= njportfolio_work_digest_settings['key']+'_pi1';
		
		var params = [];
		params["action"]			= _njportfolio_ajax_ACTION_work_image;
		params['lang_id']			= njportfolio_work_digest_settings['language'];
		params['pageId']			= njportfolio_work_digest_settings['pageId'];
		params["imageId"]			= $(this).parents(".grid-item").attr("data-file");
		params["imageWidth"]		= _njportfolio_work_digest_grid_WIDTH_act;
		
		tx_njportfolio_ajaxCall(params);
	});
	
	$(document).on('mouseenter',__njportfolio_work_digest_grid_item + ' .thumb',function()
	{
		$(this).children(".overlay").fadeIn(250);

	});
	$(document).on('mouseleave',__njportfolio_work_digest_grid_item + ' .thumb',function()
	{
		$(this).children(".overlay").slideUp(125);
	});

}); //end of $(document).ready()


//
//	controller.action : work.digest.selection
//
$(document).ready( function() 
{
	$(document).on('click',__njportfolio_work_selection_item, function()
	{
		if($(this).hasClass(_STATUS_INACTIVE))
		{
			n1switchStatus($(this), __njportfolio_work_selection_item);
			
			$(__njportfolio_work_digest_collection + '[data-list]')
				.not($(__njportfolio_work_digest_collection+'[data-list='+$(this).attr('data-show')+']'))
					.slideUp(250);
			
			if($(__njportfolio_work_digest_collection+'[data-list='+$(this).attr('data-show')+']').length > 0)
			{
				$(__njportfolio_work_digest_collection+'[data-list='+$(this).attr('data-show')+']').slideDown(250);
			}
			else
			{
				
				var params = [];
				params["action"]			= _njportfolio_ajax_ACTION_work_digest;
				params['lang_id']			= njportfolio_work_digest_settings['language'];
				params['pageId']			= njportfolio_work_digest_settings['pageId'];
				params['typeNum']			= njportfolio_work_digest_settings['typeNum'];
				params['show']				= $(this).attr('data-show');

				if($(this).attr('data-show') === 'categories')
				{
					params['activeCategory'] = njportfolio_work_digest_settings.defaultCategory;
				}

				tx_njportfolio_ajaxCall(params);
			}
		}
	}); 
});


//
//	controller.action : work.digest.categories.selection
//
$(document).ready( function() 
{
	$(document).on(
		'click',
		__njportfolio_work_digest_collection_categories + ' .selection LI',
		function()
		{
			if($(this).hasClass(_STATUS_INACTIVE))
			{
				n1switchStatus($(this), __njportfolio_work_digest_collection_categories + ' .selection LI');

				$(__njportfolio_work_digest_collection_categories + ' .works[data-category]')
					.not($(__njportfolio_work_digest_collection_categories + ' .works[data-category='+$(this).attr('data-category')+']'))
					.slideUp(250);
			
			
				if($(__njportfolio_work_digest_collection_categories + ' .works[data-category='+$(this).attr('data-category')+']').length > 0)
				{
					$(__njportfolio_work_digest_collection_categories + ' .works[data-category='+$(this).attr('data-category')+']').slideDown(250);
				}
				else
				{
	
					var params = [];
					params["action"]			= _njportfolio_ajax_ACTION_work_digest;
					params["call"]				= "Categories";			
					params['lang_id']			= njportfolio_work_digest_settings['language'];
					params['pageId']			= njportfolio_work_digest_settings['pageId'];
					params['typeNum']			= njportfolio_work_digest_settings['typeNum'];
					params['show']				= $(this).attr('data-category');

					tx_njportfolio_ajaxCall(params);
				}
			}
		});
});


/**
 * @param {object} $this
 * @param {string} selector
 * @returns {void}
 */
function n1switchStatus($this, selector)
{
	$(selector).removeClass(_STATUS_INACTIVE + ' ' + _STATUS_ACTIVE);
	$(selector).not($this).addClass(_STATUS_INACTIVE);
	$this.addClass(_STATUS_ACTIVE);
}

//
// Event-Handler : document.ready -> on('click','mouseenter','mouseleave')
//
$(document).ready( function() 
{});

//
// Event-Handler : window.resize
//
$(window).resize(function() 
{
	
});


function tx_njportfolio_init()
{
	if($(__njportfolio_work_digest).length > 0)
	{
		var activeCollection = $(__njportfolio_work_digest_collection).attr('data-list');
		var selector = __njportfolio_work_digest_collection + '[data-list="' + activeCollection + '"]';
		n1console(selector);
		tx_njportfolio_masonry_start(selector);
	}
}


//
// AJAX
//

function tx_njportfolio_ajaxCall(params)
{
	
	
	params['lang_iso'] = $("html").attr("lang");
	
	switch(params["action"]) 
    {
		case _njportfolio_ajax_ACTION_work_image:
			tx_njportfolio_ajaxHandler(true, params);
			break;
		case _njportfolio_ajax_ACTION_work_digest:
			_njportfolio_ajax_EXTKEY = njportfolio_work_digest_settings['key']+'_pi1';
			tx_njportfolio_ajaxHandler(true, params);
			break;
		default:;
	}
} //end of function tx_njportfolio_ajaxCall


function tx_njportfolio_ajaxHandler(loader, params)
{
	params['controller']    = "Ajax";
	
	n1console(params);
	
	var data = 'index.php?type=' 
        + params['typeNum']
        + '&L='
        + params['lang_id'];
	
	
	for(var index in params) 
    {
        if(index.match("pageId"))
        {
            data = data.concat('&id=',params[index]);
        }
        else
        {
            data = data.concat("&"+_njportfolio_ajax_EXTKEY+"[",index,"]=",params[index]);
        }
    }
	
	
	$.ajax(
	{
		async: 'true',
		url: data,
		type: 'POST',
		dataType: 'json',
		data: {},
		beforeSend: function()
		{
			var funcName = 'tx_njportfolio_ajax_before_'+params.action;

			var func = window[funcName];
			if (typeof func === 'function') {
				func(params);
			}
			
		}
	}).done(function(data)
	{
		var funcName = 'tx_njportfolio_ajax_done_'+params.action;
		
		var func = window[funcName];
		if (typeof func === 'function') {
			func(data);
		}
		
	}).fail(function(xhr,e)
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
		
		if($('.tx_njportfolio.work.digest .error').length > 0)
		{
			$('.tx_njportfolio.work.digest .error').empty();
		}
		else
		{
			$('.tx_njportfolio.work.digest').prepend(
				'<div class="error"></div>');
		}
		$('.tx_njportfolio.work.digest .ajax.loader').fadeOut();
		$('.tx_njportfolio.work.digest .error').prepend(message);
	}).always();
}

//
//	controller.action : ajax.digest
//

function tx_njportfolio_ajax_before_workDigest(params)
{
	n1console('tx_njportfolio_ajax_before_workDigest');
	switch(params.call)
	{
		case 'Categories':
			tx_njportfolio_ajax_before_workDigest_categories(params);
			break;
		default:
			tx_njportfolio_ajax_before_workDigest_default(params);
	}

} //end of function tx_njportfolio_ajax_before_digest()


function tx_njportfolio_ajax_before_workDigest_categories(params)
{
	
}


function tx_njportfolio_ajax_before_workDigest_default(params)
{
	$(__njportfolio_work_digest + ' .error').remove();
	$(__njportfolio_work_digest + ' [data-list]').slideUp(250);
	$(__njportfolio_work_digest + ' .ajax.loader').slideDown(250);
}


function tx_njportfolio_ajax_done_workDigest(data)
{
	switch(data.call)
	{
		case 'Categories':
			tx_njportfolio_ajax_done_workDigest_categories(data);
			break;
		default:
			tx_njportfolio_ajax_done_workDigest_default(data);
	}
	
 }
 
 function tx_njportfolio_ajax_done_workDigest_categories(data)
 {
	 var ___target = __njportfolio_work_digest_collection_categories;
	 $(___target).append(data.content);
	 tx_njportfolio_masonry_start(___target);
 }
 
 
 function tx_njportfolio_ajax_done_workDigest_default(data)
 {
	var ___targetClass = 'collection';
	var ___target = __njportfolio_work_digest + ' .' + ___targetClass + '[data-list=' + data.container + ']';

	setTimeout(function()
	{
		$(__njportfolio_work_digest).append(
				'<div class="' + ___targetClass + '" data-list="' + data.container + '"></div>');

		if(data.success)
		{
			$(___target)
				.append(data.content);
		}
		else
		{
			$(___target)
				.append("error: something went wrong;");
		}
		$(___target).slideDown(250);

		tx_njportfolio_masonry_start(___target);
	},250);
	$(__njportfolio_work_digest + ' .ajax.loader').fadeOut(250);
 }
 
 
 function tx_njportfolio_masonry_start($selector,$cols,$speed)
 {
	_njportfolio_work_digest_grid_COLS_act = $cols ? $cols : 4; //TODO get from work.controller
			
	var speed = $speed ? $speed : 700; //TODO get from work.controller
	
	if($selector)
	{
		var gridSizer = $selector + ' .grid-sizer';
		var gridItem = $selector + ' .grid-item';
		
		var container = $($selector).attr('data-list');
		
		var selector = $($selector + ' .masonry.grid');
		selector.on('layoutComplete', tx_njportfolio_masonry_layoutComplete(gridItem));
		
		var masonryOptions = {         // initial masonry options
			columnWidth: gridSizer,
			itemSelector: gridItem,
			percentPosition: true,
			animate: true,
			animationOptions: {
			  duration: speed,
			  queue: true
			}
		};
	
		selector.imagesLoaded(function()
		{
			_njportfolio_work_digest_MASONRY[container] = selector
				.masonry(masonryOptions);
		});
	}
	else 
	{
		n1console('no selector given')
	}
 }
 
 function tx_njportfolio_masonry_layoutComplete(selector)
 {
	 n1console(selector);
	var i = 0;
	var images = [];
	
	var i = 0;
	$(selector + ' IMG').each(function()
	{
		images[i] = $(this);
		i++;
	});
	tx_njcollection_array_shuffle(images);
	
	i = 0;
	n1console(images);
	images.forEach(function(entry) 
	{
		entry.delay(i * 250).animate({opacity:90},250,function(){});
		i++;
	});
}