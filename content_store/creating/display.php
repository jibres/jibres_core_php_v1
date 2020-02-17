

    <div id="get_started_card">
      <div class="body">
        <div class="pad">
          <h1><?php echo T_("Please wait"); ?></h1>
          <p><?php echo T_("Building your online store in progress."); ?></p>

        </div>
        <img class="loadingGif" src="<?php echo \dash\url::static(); ?>/img/store/loading1.gif" alt='<?php echo T_("Loading Jibres"); ?>'>

      </div>
    </div>


<script>
$.ajax(
  {
   url : "<?php echo \dash\url::this(); ?>",
   type : 'post',
   data : {"create":"store"},
   dataType: 'json',
   success : function()
   {
    Navigate({ url: "<?php echo \dash\url::here(); ?>/opening" });
   },
   done : function()
   {
    Navigate({ url: "<?php echo \dash\url::here(); ?>/opening" });
   },
   fail : function()
   {
    Navigate({ url: "<?php echo \dash\url::here(); ?>/error" });
   },
   statusCode: {
    501: function() {
      Navigate({ url: "<?php echo \dash\url::here(); ?>/error" });
    }
   }
 });
</script>
