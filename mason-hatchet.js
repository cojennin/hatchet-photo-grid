$(function(){
    /*
    $('#photo-grid-container').masonry({
        // options
        itemSelector : '.picture'
    });
    */
    var $container = $('#photo-grid-container');
    $container.imagesLoaded( function(){
          $container.masonry({
            itemSelector : '.picture'
          });
    });
    var inserted_hover_box;
    $('.picture img').bind({mouseenter: function(){
        var div_element = document.createElement("div");
        div_element.setAttribute('class', 'hatchet-gallery-hover-box');
        var parentContainer = this.parentNode;
		//var text = $(this).parent().attr('title');
		var text = $(this).parent().next().html();
		if(text.indexOf('Photo') != -1)
			div_element.setAttribute("style", "height:"+($(this).height()+15)+"px;");
		else
			div_element.setAttribute("style", "height:"+($(this).height()+0)+"px;");
        $(this).css('z-index', '11');
        
		text = text.replace('|', '<br />');
        div_element.innerHTML = '<p style="font-size:12px;color:#777;padding:5px 0px 5px 5px;position:absolute;bottom:-10px">'+text+'</p>';
        inserted_hover_box = parentContainer.insertBefore(div_element, this.nextSibling); 
    },
    mouseleave: function(){
        $(inserted_hover_box).remove();
        $(this).css('z-index', '0');

    }});
});

$(document).ready(function(){
  $(".fancy-img").fancybox({
  beforeShow: function(){
   var hatchet_cap = $(this.elemenet).find('img');
   var img_alt = $(this.element).next('.photo-names').prev().find('img').attr('alt');
   this.title = img_alt + ' ' + $(this.element).next('.photo-names').text();
  },
  helpers: {
   title : {
    type : 'inside'
   }
  }
 });
});
