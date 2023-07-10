jQuery(document).ready(function(){

$("#gallery_product").elevateZoom({gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true });

$("#gallery_product").bind("click", function(e) { var ez = $('#gallery_product').data('elevateZoom');   $.fancybox(ez.getGalleryList()); return false; });

});
