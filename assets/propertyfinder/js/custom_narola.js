jQuery(document).ready(function($){
    
    function resize_map(){
       var center = map.getCenter();
       google.maps.event.trigger(map, "resize");
       map.setCenter(center);
    }

    function resize_street_view_map(){
       var position = panorama.getPosition();
       google.maps.event.trigger(panorama, "resize");
       panorama.getPosition(position);
    }

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      resize_street_view_map();
      resize_map();
    });

    $('#ps').change(function(){
       if($(this).val()=='4-Rent'){
          $('#div_rent_slot').css('display','inline-block');
          $('#div_bathrooms').addClass('sc_ps_bathrooms');
          $('#div_bathrooms').removeClass('sc_ps_bedrooms');
       }else{
          $('#div_rent_slot').css('display','none');
          $('#div_bathrooms').addClass('sc_ps_bedrooms');
          $('#div_bathrooms').removeClass('sc_ps_bathrooms');
       }
    });

    $("[data-toggle=popover]").popover({
       html: true, 
       content: function() {
          return $('#popover-content').html();
       }
    });
    $('.carousel').carousel({
      interval: false,
      controls: true
    });

   //  function onVrViewLoad() {
   //    var img = '<?php echo site_url("assets/propertyfinder/images/slider/1.jpg"); ?>';
   //    var vrView = new VRView.setContentInfo('#vrview', {
   //       image: 'http://storage.googleapis.com/vrview/examples/coral.jpg',
   //       preview: 'http://storage.googleapis.com/vrview/examples/coral.jpg',
   //       is_stereo: true
   //   });
   // }
});