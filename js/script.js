$('.page-scroll').on('click', function() {

    var tujuan = $(this).attr('href');
   
    var elemenTujuan = $(tujuan);
   
    $('html , body').animate({
     scrollTop: elemenTujuan.offset().top - 100
    }, 1250, 'swing');
   
    e.preventDefault(e);
   });

   (function() {

    var navLinks = $('nav ul li'),
        navH = $('nav ul li').height(),
        section = $('section'),
        documentEl = $(document);
    
    documentEl.on('scroll', function() {
        var currentScrollPos = documentEl.scrollTop();
        
        section.each(function() {
            var self = $(this);
            if ( self.offset().top < (currentScrollPos + navH) && (currentScrollPos + navH) < (self.offset().top + self.outerHeight()) ) {
                var targetClass = '.' + self.attr('class') + '-marker';
                navLinks.removeClass('aktif');
                $(targetClass).addClass('aktif');
            }
        });
        
    });
    
    
    



})();
