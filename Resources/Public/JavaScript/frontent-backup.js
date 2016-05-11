var _INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH;

var _ACT_NJPORTFOLIO_WORK_DIGEST_COLS;
var _ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_NEXT;
var _ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_PREV;

var _NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_MAX;

var _ACT_NJPORTFOLIO_WORK_DIGEST_COLLECTION_WIDTH;
var _ACT_NJPORTFOLIO_WORK_DIGEST_COLLECTION_ITEM_WIDTH;

var _NJPORTFOLIO_AJAX_ACTION_WORK_IMAGE = "workImage";
var _NJPORTFOLIO_AJAX_TYPENUM;
var _NJPORTFOLIO_AJAX_LANG;
var _NJPORTFOLIO_AJAX_EXTKEY;

var _NJPORTFOLIO_WORK_DIGEST;
var _NJPORTFOLIO_WORK_DIGEST_COLLECTION;
var _NJPORTFOLIO_WORK_DIGEST_FOCUS;
var _NJPORTFOLIO_WORK_DIGEST_COLLECTION_ITEM

var _njportfolio_work_digest_focus_interval;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//var $tx_njportfolio_work_digest_collection

console.log("hallo welt");

function tx_njportfolio_work_digest_setDimensions(container)
{
	var widthOverall = container.width();
	var widthItem;
	var isInteger = false;
	var rest = 0;
	
	if(!isNaN(widthOverall) && typeof njportfolio_work_digest_cols !== 'undefined' && !isNaN(njportfolio_work_digest_cols))
	{
		widthItem = widthOverall / njportfolio_work_digest_cols;
		if(!isNaN(widthItem))
		{
			widthItem = Math.floor(widthItem);
			$(njportfolio_work_digest_item).css("width",widthItem + "px");
		}
		
	}
	n1console(widthItem, 'width item');
}


function tx_njportfolio_work_digest_init()
{
//	_ACT_NJPORTFOLIO_WORK_DIGEST_COLS = njportfolio_work_digest_cols;
//	_ACT_NJPORTFOLIO_WORK_DIGEST_COLLECTION_WIDTH = $(njportfolio_work_digest_collection).width();
//	_INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH = $(njportfolio_work_digest_collection).width() / njportfolio_work_digest_cols;
//	console.log($(njportfolio_work_digest_collection).width());
//	console.log(_INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH);
//	if(!isNaN(_INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH))
//	{
//		_INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH = Math.floor(_INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH);
//		_ACT_NJPORTFOLIO_WORK_DIGEST_COLLECTION_ITEM_WIDTH = _INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH;
//	}
//	_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_MAX = _INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH * njportfolio_work_digest_cols;
//	
//	_ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_PREV = 	_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_MAX - _INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH;
//
//	_ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_NEXT = _NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_MAX;
}


// external js: masonry.pkgd.js

$(document).ready( function() 
{
	tx_njportfolio_work_digest_init();
	tx_njportfolio_work_digest_setDimensions($(njportfolio_work_digest_collection));
	
	$tx_njportfolio_work_digest_collection.on('mouseenter','.grid-item .thumb',function()
	{
		$(this).children(".overlay").fadeIn(250);
	});
	$tx_njportfolio_work_digest_collection.on('mouseleave','.grid-item .thumb',function()
	{
		$(this).children(".overlay").fadeOut(125);
	});
	
	$tx_njportfolio_work_digest_collection.on( 'click', '.grid-item .thumb .overlay I.fa-eye', function() 
	{
		n1console(this,"clicked");
		
		var params = [];
		
		_NJPORTFOLIO_AJAX_TYPENUM	= njportfolio_work_digest_settings["typeNum"];
		_NJPORTFOLIO_AJAX_LANG		= njportfolio_work_digest_settings['language'];
		_NJPORTFOLIO_AJAX_EXTKEY	= njportfolio_work_digest_settings['key'];
		params["action"]			= _NJPORTFOLIO_AJAX_ACTION_WORK_IMAGE;
		params['lang_id']			= njportfolio_work_digest_settings['language'];
		params['pageId']			= njportfolio_work_digest_settings['pageId'];
		//params['path_template']		= njportfolio_work_digest_settings["ajax"]["path"]["template"];
		//params['path_partial']		= njportfolio_work_digest_settings["ajax"]["path"]["partial"];
		n1console($(this).parent(".grid-item-content").parent(".grid-item"),"parent of thumb");
		params["imageId"]			= $(this).parents(".grid-item").attr("data-file");
		params["imageWidth"]		= _ACT_NJPORTFOLIO_WORK_DIGEST_COLLECTION_WIDTH;
		
		tx_njportfolio_ajaxCall(params);
		
//		var itemContent = this;
//		setItemContentPixelSize( itemContent );
//
//		var itemElem = itemContent.parentNode;
//		$( itemElem ).toggleClass('is-expanded');
//
//		// force redraw
//		var redraw = itemContent.offsetWidth;
//		// renable default transition
//		itemContent.style[ transitionProp ] = '';
//
//		addTransitionListener( itemContent );
//		setItemContentTransitionSize( itemContent, itemElem );
//
//		$tx_njportfolio_work_digest_collection.masonry();
  });
  
});

function tx_njportfolio_work_digest_reset()
{
	var actSize = $(njportfolio_work_digest_container).width();

	var actItemWidth;
	
	if(actSize <= _ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_PREV)
	{
		_ACT_NJPORTFOLIO_WORK_DIGEST_COLS--;
		_ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_NEXT = _ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_PREV;
		_ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_PREV = _ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_PREV - _INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH;
	}
	if(actSize >= _ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_NEXT && actSize < _NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_MAX)
	{
		_ACT_NJPORTFOLIO_WORK_DIGEST_COLS++;
		_ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_PREV = _ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_NEXT;
		_ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_NEXT = _ACT_NJPORTFOLIO_WORK_DIGEST_BREAKPOINT_NEXT + _INIT_NJPORTFOLIO_WORK_DIGEST_ITEM_WIDTH;
	}

	actItemWidth = Math.floor(actSize / _ACT_NJPORTFOLIO_WORK_DIGEST_COLS);
	

	$(njportfolio_work_digest_item).css("width",actItemWidth + "px");
	$tx_njportfolio_work_digest_collection.masonry( 'option', { columnWidth: actItemWidth });
}


//
// Event-Handler : resize window 
//
$(window).resize(function() 
{
	//tx_njportfolio_work_digest_reset();
});


var transitionProp = getStyleProperty('transition');
var transitionEndEvent = {
  WebkitTransition: 'webkitTransitionEnd',
  MozTransition: 'transitionend',
  OTransition: 'otransitionend',
  transition: 'transitionend'
}[ transitionProp ];

function setItemContentPixelSize( itemContent ) {
  var previousContentSize = getSize( itemContent );
  // disable transition
  itemContent.style[ transitionProp ] = 'none';
  // set current size in pixels
  itemContent.style.width = previousContentSize.width + 'px';
  itemContent.style.height = previousContentSize.height + 'px';
}

function addTransitionListener( itemContent ) {
  if ( !transitionProp ) {
    return;
  }
  // reset 100%/100% sizing after transition end
  var onTransitionEnd = function() {
    itemContent.style.width = '';
    itemContent.style.height = '';
    itemContent.removeEventListener( transitionEndEvent, onTransitionEnd, false );
  };
  itemContent.addEventListener( transitionEndEvent, onTransitionEnd, false );
}

function setItemContentTransitionSize( itemContent, itemElem ) {
  // set new size
  var size = getSize( itemElem );
  itemContent.style.width = size.width + 'px';
  itemContent.style.height = size.height + 'px';
}



function tx_njportfolio_ajaxCall(params)
{
	params['lang_iso'] = $("html").attr("lang");
	
	switch(params["action"]) 
    {
		case _NJPORTFOLIO_AJAX_ACTION_WORK_IMAGE:
			tx_njportfolio_ajaxHandler(true, params);
		break;
		default:;
	}
}

function tx_njportfolio_ajaxHandler(loader, params)
{
	params['controller']    = "Ajax";
	
	n1console(params);
	
	var data = 'index.php?type=' 
        + _NJPORTFOLIO_AJAX_TYPENUM 
        + '&L='
        + _NJPORTFOLIO_AJAX_LANG;
	
	
	for(var index in params) 
    {
        if(index.match("pageId"))
        {
            data = data.concat('&id=',params[index]);
        }
        else
        {
            data = data.concat("&"+_NJPORTFOLIO_AJAX_EXTKEY+"_pi1[",index,"]=",params[index]);
        }
    }
	
	
	$.ajax(
	{
		async: 'true',
		url: data,
		type: 'POST',
		dataType: 'json',
		data: {}
	}).done(function(data)
	{
		switch(params.action)
		{
			case _NJPORTFOLIO_AJAX_ACTION_WORK_IMAGE:
				
				if(data.success)
				{
					setTimeout(function() 
					{
						$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).remove();
						$(_NJPORTFOLIO_WORK_DIGEST).prepend(data.content);
						
						//----- scroll to top of work digest
						$position = $(_NJPORTFOLIO_WORK_DIGEST).position();
						tx_njcollection_scollToPosition($position.top);
						//---------------
						$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).animate(
						{
							borderTopColor : 'red',
							borderTopWidth : '9px',
							borderTopStyle : 'solid'
						},250);
						
						
						
						$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).slideDown(250);
					},250);
					n1console("outsideTimeout");
					if($(_NJPORTFOLIO_WORK_DIGEST_FOCUS).length > 0)
					{
						n1console("insideTimeout");
						$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).slideUp(250);
					}
					
					
//					_njportfolio_work_digest_focus_interval =
//						tx_njcollection_timeoutInterval(function()
//						{
//							if($(_NJPORTFOLIO_WORK_DIGEST_FOCUS).length > 0)
//							{
//								$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).slideUp(250);
//							}
//						},250,1);
//					$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).remove();	
//					
//					$(_NJPORTFOLIO_WORK_DIGEST).prepend(data.content);
//					$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).slideDown(250);
				}
				break;
				
			default:;
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
		
		$('#n1content').prepend(message);
	}).always();
}


function tx_njportfolio_work_digest_focus_close($this,$workImageId)
{
	n1console("clicked");
	$this.animate({maxWidth:0},250).hide(0).attr("style","");
	$dataFile = $this.parents(".focus").attr("data-file");
	n1console($dataFile,"data-file");
	
	setTimeout(function() 
	{
		$position = $(_NJPORTFOLIO_WORK_DIGEST_COLLECTION_ITEM + '[data-file="'+$dataFile+'"]').offset();
		n1console($position, "position");
		tx_njcollection_scollToPosition($position.top);
	},250);
	$this.parents(".focus").slideUp(250);
}


//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

var _njportfolio_work_digest_item_WIDTH_init;

var _njportfolio_work_digest_grid_COLS_act;
var _njportfolio_work_digest_grid_WIDTH_act; //also .collection
var _njportfolio_work_digest_grid_item_WIDTH_act;

var _njportfolio_work_digest_BREAKPOINT_MAX;
var _njportfolio_work_digest_BREAKPOINT_NEXT_act;
var _njportfolio_work_digest_BREAKPOINT_PREV_act;

var _njportfolio_ajax_ACTION_work_image = "workImage";
var _njportfolio_ajax_ACTION_digest		= "digest";
var _njportfolio_ajax_EXTKEY;
var _njportfolio_ajax_LANG;
var _njportfolio_ajax_TYPENUM;

var __njportfolio_work_digest;
var __njportfolio_work_digest_collection;
var __njportfolio_work_digest_focus;
var __njportfolio_work_digest_grid;
var __njportfolio_work_digest_grid_item;

var __njportfolio_category_list;
var __njportfolio_category_list_item;

var __njportfolio_work_selection;
var __njportfolio_work_selection_item;

var _njportfolio_work_digest;

var _njportfolio_work_digest_focus;
var _njportfolio_work_digest_grid_item;

var _njportfolio_work_digest_focus_INTERVAL;

var _njportfolio_work_digest_MASONRY;
var _njportfolio_work_digest_MASONRY_options;

var _njportfolio_data_task_show_menu_categories = '[data-task="show-menu-categories"]';





//
// Event-Handler : window.resize
//
$(window).resize(function() 
{
	
});


function tx_njportfolio_ajaxCall(params)
{
	params['lang_iso'] = $("html").attr("lang");
	
	switch(params["action"]) 
    {
		case _njportfolio_ajax_ACTION_work_image:
			tx_njportfolio_ajaxHandler(true, params);
		break;
		case _njportfolio_ajax_ACTION_digest:
			tx_njportfolio_ajaxHandler(true, params);
		break;
		default:;
	}
}


function tx_njportfolio_ajaxHandler(loader, params)
{
	params['controller']    = "Ajax";
	
	n1console(params);
	
	var data = 'index.php?type=' 
        + _njportfolio_ajax_TYPENUM 
        + '&L='
        + _njportfolio_ajax_LANG;
	
	
	for(var index in params) 
    {
        if(index.match("pageId"))
        {
            data = data.concat('&id=',params[index]);
        }
        else
        {
            data = data.concat("&"+_njportfolio_ajax_EXTKEY+"_pi1[",index,"]=",params[index]);
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
			switch(params.action)
			{
				case _njportfolio_ajax_ACTION_work_image:
					tx_njportfolio_ajax_before_workImage();
				break;
			case _njportfolio_ajax_ACTION_digest:
					tx_njportfolio_ajax_before_digest(params['option']);
				default:;
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
		
		$('#n1footer').prepend(message);
	}).always();
}


function tx_njportfolio_ajax_before_workImage()
{
	$dimension = [];
	$dimension['width'] = $(__njportfolio_work_digest_grid).width();
	$dimension['height'] = $(__njportfolio_work_digest_grid).height();

	$pos = [];
	$pos['left'] = ($dimension['width'] - $(__njportfolio_work_digest_grid_item).width()) / 2;
	$pos['top'] = ($dimension['height'] - $(__njportfolio_work_digest_grid_item).height()) / 2;
	
	$(__njportfolio_work_digest_grid_item).animate(
	{
		left:0,
		top: 0,
		opacity: 0
	},250);
	
}




function tx_njportfolio_ajax_done_workImage(data) //TODO
{
	if(data.success)
	{

				//	setTimeout(function() 
					//{
						//$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).remove();
						//$('#n1content').prepend(data.content);
						
						//----- scroll to top of work digest
						//$position = $(_NJPORTFOLIO_WORK_DIGEST).position();
						//tx_njcollection_scollToPosition($position.top);
						
						n1console(__njportfolio_work_digest_grid);
						n1console(data);
						$(__njportfolio_work_digest_grid).prepend(data.content);
						$(".focus").fadeIn(250);
						//---------------
						//$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).animate(
						//{
						//	borderTopColor : 'red',
						//	borderTopWidth : '9px',
						//	borderTopStyle : 'solid'
						//},250);
						
						
						
//						$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).slideDown(250);
//					},250);
//					n1console("outsideTimeout");
//					if($(_NJPORTFOLIO_WORK_DIGEST_FOCUS).length > 0)
//					{
//						n1console("insideTimeout");
//						$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).slideUp(250);
//					}
					
					
//					_njportfolio_work_digest_focus_interval =
//						tx_njcollection_timeoutInterval(function()
//						{
//							if($(_NJPORTFOLIO_WORK_DIGEST_FOCUS).length > 0)
//							{
//								$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).slideUp(250);
//							}
//						},250,1);
//					$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).remove();	
//					
//					$(_NJPORTFOLIO_WORK_DIGEST).prepend(data.content);
//					$(_NJPORTFOLIO_WORK_DIGEST_FOCUS).slideDown(250);
	}
}


function tx_njportfolio_ajax_done_digest(data)
{
//	setTimeout(function()
//	{
//		$(__njportfolio_work_digest_grid).prepend(data.content).show(0);
//		$(__njportfolio_work_digest_grid_item).show(0);
//	},250);
//	$(__njportfolio_work_digest_collection).css("maxWidth", "100%");
//	
//	setTimeout(function()
//	{
//		n1console(_njportfolio_work_digest_MASONRY, "masonry");
//		
//			_njportfolio_work_digest_MASONRY.masonry(_njportfolio_work_digest_MASONRY_options);
//		
//	},250);
//	$(__njportfolio_work_digest + ' ' + _ajax_loader).fadeOut(125);
//	
//	
//	
//	n1console(__njportfolio_work_digest_grid);
//	n1console(data);
//	//if(data.success)
//	//{
//		
//	//}
//}
//
//
//
//function tx_njportfolio_work_digest_focus_close($this,$workImageId)
//{
//	n1console("clicked");
//	$this.animate({maxWidth:0},250).hide(0).attr("style","");
//	$dataFile = $this.parents(".focus").attr("data-file");
//	n1console($dataFile,"data-file");
//	
//	setTimeout(function() 
//	{
//		$position = $(__njportfolio_work_digest_grid_item + '[data-file="'+$dataFile+'"]').offset();
//		n1console($position, "position");
//		tx_njcollection_scollToPosition($position.top);
//	},250);
//	$this.parents(".focus").slideUp(250);
//	
//	_njportfolio_work_digest_MASONRY.masonry(_njportfolio_work_digest_MASONRY_options);
//	$(__njportfolio_work_digest_grid_item).animate(
//	{
//		opacity: 100
//	},250);
 }