<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f fs14 justify-center">
  <div class="c8 s12">


    <div class="panel mB10 mLa5">
        <table class="tbl1 v4 mB0">
      <?php if(\dash\data::appQueue_status() === 'queue' || \dash\data::appQueue_status() === 'inprogress') {?>

         <tr>
          <td>
            <?php echo T_("Your build request was saved"); ?>
          </td>
          <td class="txtL">
            <?php echo \dash\fit::date_human(\dash\data::appQueue_daterequest()); ?>
          </td>
         </tr>
         <tr>
          <td>
            <?php echo T_("Build"); ?>
          </td>
          <td class="txtL">
            <?php echo \dash\fit::number(\dash\data::appQueue_build()); ?>
          </td>
         </tr>
         <tr>
           <td colspan="2">
             <?php echo T_("Please wait until your application is built, This process may take several minutes"); ?>
           </td>
         </tr>

    <?php }elseif(\dash\data::appQueue_status() === 'done' || \dash\data::appQueue_status() === 'enable') {?>

         <tr>
          <td>
            <?php echo T_("Your application is ready to use"); ?>
          </td>
          <td class="txtL">
            <?php if(\dash\data::downoadAPK()) {?>
            <a target="_blank" href="<?php echo \dash\data::downoadAPK(); ?>" class="btn success"><?php echo T_("Download Now"); ?></a>
            <?php }//endif ?>
          </td>
         </tr>

          <?php if(\dash\data::downoadAPK()) {?>
         <tr>
           <td colspan="2">
             <?php echo T_("You can share this link to everyone need to download your application"); ?>
           </td>
         </tr>
         <tr>
          <td><span data-copy="#downloadLinkAPK" class="btn xs"><?php echo T_("Copy"); ?></span></td>

          <td class="txtL">
            <div class="input">
              <input id="downloadLinkAPK" type="text" value="<?php echo \dash\data::downoadAPK(); ?>" class='txtL' readonly>
            </div>
          </td>
         </tr>
        <?php }//endif ?>

        <?php }else{ // create first app  ?>

        <?php if(\dash\data::appQueue_status()){ // the other status  ?>
          <tr>
            <td><?php echo T_("Your old request status") ?></td>
            <td class="txtL"><?php echo T_(\dash\data::appQueue_status()); ?></td>
          </tr>
        <?php }//endif ?>

        <tr>
          <td>
            <?php echo T_("Your application is ready to build again"); ?>
          </td>
          <td class="txtL">
            <div data-confirm data-data='{"build" : "now"}' class="btn success"><?php echo T_("Build it now"); ?></div>
          </td>
         </tr>


        <?php }//endif ?>

        </table>
      </div>



  </div>
</div>



