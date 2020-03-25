
<?php $addNew = false; ?>

<div class="f fs14 justify-center">
  <div class="c6 m8 s12 x4">

    <div  class="box impact">
      <header><h2><?php echo T_("Your Store Android Application Status");?></h2></header>
<?php
if(\dash\data::appQueue_status() === 'queue' || \dash\data::appQueue_status() === 'inprogress')
{
?>
        <div class="body">
          <p><?php echo T_("Your request to create store app is saved and on queue in our app factory."). ' '. T_("We are send a message notification to you after your app is being ready. which usually take some minutes."); ?></p>

          <div class="msg f">
            <div class="c"><?php echo T_("Build series"); ?></div>
            <div class="cauto"><?php echo \dash\fit::number(\dash\data::appQueue_build()); ?></div>
          </div>
          <div class="msg f">
            <div class="c"><?php echo T_("Queue start time"); ?></div>
            <div class="cauto"><?php echo \dash\fit::date_human(\dash\data::appQueue_daterequest()); ?></div>
          </div>

          <div class="msg f">
            <div class="c"><?php echo T_("Status"); ?></div>
            <div class="cauto"><?php echo T_(ucfirst(\dash\data::appQueue_status())); ?></div>
          </div>
        </div>

        <div class="body zeroPad">
          <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/gif/jibres-app-queue.gif" alt='<?php echo \dash\face::title(); ?>'>
        </div>
<?php
}
elseif(\dash\data::appQueue_status() === 'done' || \dash\data::appQueue_status() === 'enable')
{
?>
        <div class="body">
          <div class="msg success2">
            <?php echo T_("Your application is ready to use"); ?>
          </div>

          <?php if(\dash\data::downoadAPK()) {?>
          <div class="msg"><?php echo T_("You can share your app link via social networks or publish your app via stores."). ' <b>'. T_('Go change the worlds.'). '</b>'; ?><br>
          </div>

          <div class="input txtL">
            <span data-copy="#downloadLinkAPK" class="btn addon"><?php echo T_("Copy App Link"); ?></span>
             <input id="downloadLinkAPK" type="text" value="<?php echo \dash\data::downoadAPK(); ?>" class='txtL' readonly>
          </div>

          <?php }//endif ?>
        </div>

        <div class="body zeroPad">
          <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/gif/jibres-rocket-launching.gif" alt='<?php echo \dash\face::title(); ?>'>
        </div>
<?php
}
else
{
// create first app
?>
        <div class="body">
            <?php $addNew = true; ?>
            <?php if(\dash\data::appQueue_status()){ // the other status  ?>
              <div class="msg f">
                <div class="c"><?php echo T_("Your old request status") ?></div>
                <div class="cauto"><?php echo T_(ucfirst(\dash\data::appQueue_status())); ?></div>
              </div>
            <?php }//endif ?>

        </div>
<?php
}
//endif
?>

    </div>

  </div>
</div>



