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




  <div class="c6">
    <?php if(\dash\data::isReadyToCreate_ok()) {?>
     <div class="panel mB10 mLa10">
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

    <div class="mLa5 hide">
      <h4><?php echo T_("Download your application now"); ?></h4>

      <form method="post" autocomplete="off">
          <?php if(\dash\data::downoadAPK()) {?>
            <a target="_blank" href="<?php echo \dash\data::downoadAPK(); ?>" class="btn block success xl"><?php echo T_("Download Now"); ?></a>
          <?php }//endif ?>
        <div class="txtRa mT10">
          <button class="btn secondary"><?php echo T_("Rebuild"); ?></button>
        </div>
      </form>
    </div>


  <?php } //endif ?>



  </div>

  </div>
</div>



