  $.ajax(
    {
     url : "<?php echo \dash\url::that(); ?>",
     type : 'post',
     data : {"create":"store"},
     dataType: 'json',
     success : function()
     {
      Navigate({ url: "<?php echo \dash\url::this(); ?>/opening" });
     },
     done : function()
     {
      Navigate({ url: "<?php echo \dash\url::this(); ?>/opening" });
     },
     fail : function()
     {
      Navigate({ url: "<?php echo \dash\url::this(); ?>/error" });
     },
     statusCode: {
      501: function() {
        Navigate({ url: "<?php echo \dash\url::this(); ?>/error" });
      }
     }
   });

  $("#linkmhe").delay( (60 * 1000) ).fadeIn( 400 );