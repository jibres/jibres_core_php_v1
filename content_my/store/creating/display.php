

    <div id="get_started_card">
      <div class="body">
        <div class="pad">
          <h1><?php echo T_("Please wait"); ?></h1>
          <p><?php echo T_("Building your online store in progress."); ?></p>

        </div>
        <img class="loadingGif" src="<?php echo \dash\url::cdn(); ?>/img/store/loading1.gif" alt='<?php echo T_("Loading Jibres"); ?>'>

      </div>
    </div>


<script>
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
</script>
