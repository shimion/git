jQuery.noConflict();
function slideFrame(thumbid, move_by, direction, type, match_height)
	{
		/* Set the new position & frame number */
		move_by = jQuery(thumbid).parent().width();
		jQuery(thumbid).children("li").animate({width: move_by+"px"});

		frame_left = jQuery(thumbid).css(type).replace("px", "");
		frame = (-(frame_left/move_by));
		maxsize = (jQuery(thumbid).children("li").size()-1);
		jQuery(".dot-selected").removeClass("dot-selected");

		if(direction == 0)
			{
				new_frame =  Math.round((frame/1)+1);
				if(jQuery.browser.msie)
					maxsize = (maxsize-1);

				if(maxsize <= frame)
					new_frame = 0;

				new_left = -(new_frame*move_by)+"px";

			}
		else
			{
				new_frame = Math.round((frame/1)-1);

				if(frame == 0)
					new_frame = maxsize;

				new_left = -(new_frame*move_by)+"px";
			}
		jQuery.noslide = 0;
		gotoFrame(thumbid, new_frame);
	}


function gotoFrame(thumbid, frame){
	parentwidth = jQuery(thumbid).parent().width();
	new_left  = -(frame*parentwidth);

	jQuery(".dot-selected").removeClass("dot-selected");
	jQuery(".slider-dots").children().eq(frame).addClass("dot-selected");

	jQuery(thumbid).animate({"left": new_left}, {duration: 500});

	frame_left = jQuery(thumbid).css("left").replace("px", "");

	theli = jQuery(".slider ul.gallery-container").children("li").eq(frame);
	useheight = theli.height();

	if(useheight < jQuery(".controls").height())
		useheight = jQuery(".controls").height();

	setTimeout(function(){
		jQuery(".slider, .slider .portfolio-image").animate({height: useheight}, 250);
	}, 150);
	jQuery.noslide = 0;
}

function resize_slide(element){
	var width = jQuery(element).width();
	if(jQuery(element).children("ul").css("left") == undefined){
		return false;
	}

	var left = jQuery(element).children("ul").css("left").replace("px", "");
	var maxmove = -(jQuery(element).children("ul").children("li").size()*width);
	if(jQuery(element).children("ul").children("li").length > 1){
		var frame = jQuery(".dot-selected").index();
		jQuery(element).children("ul").children("li").animate({width: width}, 150);
		setTimeout(function(){
			jQuery(element).children("ul").animate({left: -(frame*width)}, 700);
		}, 250);
	} else {
		jQuery(element).children("ul").children("li").animate({width: width}, 150);
	 	var frame = 0;
	}

	theli = jQuery(".slider ul.gallery-container").children("li").eq(frame);
	setTimeout(function(){
		useheight = theli.height();
		jQuery(".slider, .slider .portfolio-image").animate({height: (useheight)}, 250);
		jQuery.noslide = 0;
	}, 2000);
}
function clear_auto_slide(){
	jQuery("div[id^='slider-auto-']").each(function(){
		if(!isNaN(jQuery(this).text()) && jQuery(this).text() !== "0" && jQuery(this).text() !== "")
			{clearInterval(SliderInterval);}
	});
}

jQuery(window).resizeend({
	onDragEnd: function(){
		jQuery.noslide = 1;
		resize_slide(".slider");
	}
});

jQuery(document).ready(function()
	{
		jQuery("#menu-drop-button").bind("click", function(){
			jQuery("#nav").slideToggle();
			return false;
		});
		
		if(jQuery.browser.msie || jQuery.browser.mozilla)
			{Screen = jQuery("html");}
		else
			{Screen = jQuery("body");}

		resize_slide(".slider");

		jQuery.frame_no = 0;
		jQuery.noslide = 0;
		thumbid = ".slider ul.gallery-container";
		jQuery(thumbid).animate({"left": 0}, {duration: 500});
		jQuery("div[id^='slider-auto-']").each(function(){
			if(!isNaN(jQuery(this).text()) && jQuery(this).text() !== "0" && jQuery(this).text() !== "")
				{
					SliderInterval = setInterval(function(){
						slideFrame(thumbid, 940, 0, "left");
					}, (jQuery(this).text()*1000));
				}
		});

		jQuery(".gallery-container li").mouseover(function(){clear_auto_slide();});

		jQuery(".slider .slider-dots a").bind("click", function(){
			if(jQuery.noslide == 0)
				{
					jQuery.noslide = 1;
					jQuery(".dot-selected").removeClass("dot-selected");
					frame_no = jQuery(this).index();
					gotoFrame(thumbid, frame_no);
				}
			return false;
		});
		jQuery.video_frame = 1;
		jQuery(".video-selector li a").click(function(){
			videoid = jQuery(this).attr("rel");

			new_videoid = jQuery(this).attr("rel").replace("#video_widget_", "");
			old_videoid = "#video_widget_"+jQuery.video_frame;

			jQuery(old_videoid).slideUp();
			jQuery(videoid).slideDown();

			jQuery(this).parent().parent().children(".selected").removeClass("selected");
			jQuery(this).parent().addClass("selected");

			jQuery.video_frame = new_videoid;
			return false;
		});

	});


jQuery(document).ready(function() {

	jQuery(".cart-bottom").click(function(){
		jQuery("#panel").slideToggle("fast");
		jQuery(this).toggleClass("active"); return false;
	});
	jQuery('.filter-overlay').hide();
	jQuery('.archive-shop-filter').hover(function() {
		jQuery(this).find('.filter-overlay').slideDown();
	},
	function() {
		jQuery('.filter-overlay').slideUp();
	});
});