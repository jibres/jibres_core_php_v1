

    <div id="get_started_card">
      <div class="body">
        <div class="pad">
          <h1><?php echo T_("Please wait"); ?></h1>
          <p><?php echo T_("Building your online store in progress."); ?></p>
          <a style="display: none;" id="linkmhe" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Try again"); ?></a>

        </div>
        <img class="loadingGif" src="<?php echo \dash\url::cdn(); ?>/img/store/loading1.gif" alt='<?php echo T_("Loading Jibres"); ?>'>

      </div>
    </div>


<script type="text/javascript">

document.addEventListener('DOMContentLoaded', function() {


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

}, false);


</script>
