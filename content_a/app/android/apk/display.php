<?php require_once(root. 'content_a/app/android/pageSteps.php'); ?>

<div class="f fs14">
  <div class="c6 s12">
    <div class="panel mB10">
      <table class="tbl1 v4 mB0">
       <tr>
        <td>
          <?php echo T_("Application logo"); ?>
        </td>
        <?php if(\dash\data::appDetail_logo()) {?>
          <td class="txtL"><img src="<?php echo \dash\data::appDetail_logo() ?>" class='avatar fs18'></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/setting'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
        <td>
          <?php echo T_("Application title"); ?>
        </td>
        <?php if(\dash\data::appDetail_title()) {?>
          <td class="txtL"><?php echo \dash\data::appDetail_title() ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/setting'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
        <td>
          <?php echo T_("Application description"); ?>
        </td>
        <?php if(\dash\data::appDetail_desc()) {?>
          <td class="txtL"><?php echo \dash\data::appDetail_desc() ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/setting'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
        <td>
          <?php echo T_("Application slogan"); ?>
        </td>
        <?php if(\dash\data::appDetail_slogan()) {?>
          <td class="txtL"><?php echo \dash\data::appDetail_slogan() ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/setting'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
        <td>
          <?php echo T_("Intro theme"); ?>
        </td>
        <?php if(\dash\data::appDetail_intro_theme()) {?>
          <td class="txtL"><?php echo \dash\data::appDetail_intro_theme() ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
        <td>
          <?php echo T_("Splash theme"); ?>
        </td>
        <?php if(\dash\data::appDetail_splash_theme()) {?>
          <td class="txtL"><?php echo \dash\data::appDetail_splash_theme() ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/splash'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>



      </table>
    </div>

    <div class="panel mB10">
      <table class="tbl1 v4 mB0">
       <tr>
        <td>
          <?php echo T_("Intro page #1"); ?>
        </td>
        <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'file')) {?>
          <td class="txtL"><img src="<?php echo \dash\get::index(\dash\data::appDetail(), 'page_1', 'file'); ?>" class='avatar fs18'></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
        <td>
          <?php echo T_("Title"); ?>
        </td>
        <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'title')) {?>
          <td class="txtL"><?php echo \dash\get::index(\dash\data::appDetail(), 'page_1', 'title') ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
         <td><?php echo T_("Description"); ?></td>
        </td>
        <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'desc')) {?>
          <td class="txtL"><?php echo \dash\get::index(\dash\data::appDetail(), 'page_1', 'desc') ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>
       </tr>

      </table>
    </div>


    <div class="panel mB10">
      <table class="tbl1 v4 mB0">
       <tr>
        <td>
          <?php echo T_("Intro page #2"); ?>
        </td>
        <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'file')) {?>
          <td class="txtL"><img src="<?php echo \dash\get::index(\dash\data::appDetail(), 'page_2', 'file'); ?>" class='avatar fs18'></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
        <td>
          <?php echo T_("Title"); ?>
        </td>
        <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'title')) {?>
          <td class="txtL"><?php echo \dash\get::index(\dash\data::appDetail(), 'page_2', 'title') ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
         <td><?php echo T_("Description"); ?></td>
        </td>
        <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'desc')) {?>
          <td class="txtL"><?php echo \dash\get::index(\dash\data::appDetail(), 'page_2', 'desc') ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>
       </tr>

      </table>
    </div>


        <div class="panel mB10">
      <table class="tbl1 v4 mB0">
       <tr>
        <td>
          <?php echo T_("Intro page #3"); ?>
        </td>
        <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'file')) {?>
          <td class="txtL"><img src="<?php echo \dash\get::index(\dash\data::appDetail(), 'page_3', 'file'); ?>" class='avatar fs18'></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
        <td>
          <?php echo T_("Title"); ?>
        </td>
        <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'title')) {?>
          <td class="txtL"><?php echo \dash\get::index(\dash\data::appDetail(), 'page_3', 'title') ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>

       <tr>
         <td><?php echo T_("Description"); ?></td>
        </td>
        <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'desc')) {?>
          <td class="txtL"><?php echo \dash\get::index(\dash\data::appDetail(), 'page_3', 'desc') ?></td>
        <?php }else{ ?>
          <td class="txtL"><a href="<?php echo \dash\url::that().'/intro'; ?>"><small class="sf-mute"><?php echo T_("Not set"); ?></small></a></td>
        <?php }//endif ?>
       </tr>
       </tr>

      </table>
    </div>

  </div>




  <div class="c6 s12">
    <?php if(!\dash\data::appQueue()) {?>

      <?php if(\dash\data::isReadyToCreate_ok()) {?>
       <div class="panel mB10 mLa5">
        <table class="tbl1 v4 mB0">

         <tr>
          <td>
            <?php echo T_("Your application is ready to build"); ?>
          </td>
          <td class="txtL">
            <div data-confirm data-data='{"build" : "now"}' class="btn success"><?php echo T_("Build it now"); ?></div>
          </td>
         </tr>

        </table>
      </div>
    <?php }else{ // application is not ready to build ?>

       <div class="panel mB10 mLa10">
        <table class="tbl1 v4 mB0">
          <tr>
            <th class="negative">
              <?php echo T_("You must complete your application detail to build it"); ?>
            </th>
          </tr>
            <?php foreach (\dash\data::isReadyToCreate_msg() as $key => $value) { ?>
              <tr>
                <td><?php echo $value ?></td>
              </tr>
            <?php }//endfor ?>
        </table>
      </div>

    <?php } //endif ?>

  <?php }else{ // the user have one quest queue ?>

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

      <?php }else{ // the other status  ?>

        <tr>
          <td><?php echo T_("Your old request status") ?></td>
          <td class="txtL"><?php echo T_(\dash\data::appQueue_status()); ?></td>
        </tr>
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


  <?php }//endif ?>



  </div>

  </div>
</div>



