<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<?php $addNew = false; ?>

<div class="f fs14 justify-center">
  <div class="c6 m8 s12">

    <div  class="box impact">
      <header><h2><?php echo T_("Build Application Now");?></h2></header>
        <div class="body zeroPad">
          <?php if(\dash\data::appQueue_status() === 'queue' || \dash\data::appQueue_status() === 'inprogress') {?>
            <div class="msg">
              <?php echo T_("Your build request was saved"); ?>
              <?php echo \dash\fit::date_human(\dash\data::appQueue_daterequest()); ?>
            </div>
            <div class="msg">
              <?php echo T_("Build series"); ?>
              <?php echo \dash\fit::number(\dash\data::appQueue_build()); ?>
            </div>
            <div class="msg">
              <?php echo T_("Please wait until your application is built, This process may take several minutes"); ?>
            </div>
        <?php }elseif(\dash\data::appQueue_status() === 'done' || \dash\data::appQueue_status() === 'enable') {?>
            <div class="msg success2">
              <?php echo T_("Your application is ready to use"); ?>
            </div>

            <?php if(\dash\data::downoadAPK()) {?>

            <div class="msg">
              <?php echo T_("You can share this link to everyone need to download your application"); ?>
            <br>

            <div class="input txtL">
              <span data-copy="#downloadLinkAPK" class="btn addon"><?php echo T_("Copy"); ?></span>
               <input id="downloadLinkAPK" type="text" value="<?php echo \dash\data::downoadAPK(); ?>" class='txtL' readonly>
            </div>
            </div>

            <?php }//endif ?>

        <?php }else{ // create first app  ?>

            <?php $addNew = true; ?>
            <?php if(\dash\data::appQueue_status()){ // the other status  ?>
              <div class="msg">
                <?php echo T_("Your old request status") ?>
                <div class="txtL"><?php echo T_(ucfirst(\dash\data::appQueue_status())); ?></div>
              </div>
            <?php }//endif ?>

          <?php }//endif ?>

        </div>

        <?php if($addNew) {?>
          <footer class="txtRa">
            <div data-confirm data-data='{"build" : "now"}' class="btn success"><?php echo T_("Build it now"); ?></div>
          </footer>
        <?php }elseif(\dash\data::downoadAPK())  {?>
          <footer class="txtRa">
                <a target="_blank" href="<?php echo \dash\data::downoadAPK(); ?>" class="btn success"><?php echo T_("Download Now"); ?></a>
          </footer>
        <?php } //endif ?>

    </div>


  </div>
</div>



