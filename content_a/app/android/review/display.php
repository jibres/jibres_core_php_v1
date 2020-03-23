<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f fs14 justify-center">
  <div class="c6 s12">

    <?php if(\dash\data::isReadyToCreate_ok()) {?>
    <div  class="box impact mB25-f">
      <header><h2><?php echo T_("Review Application detail");?></h2></header>
        <div class="body">
          <p class="mB0-f"><?php echo T_("Hooray!"). ' 😍<br>'. T_("Your Application ready to build") ?></p>
        </div>
        <footer class="txtRa">
          <a class="btn primary" href="<?php echo \dash\url::that(). '/apk'; ?>"><?php echo T_("Let's go build my android app"); ?></a>
        </footer>
    </div>
    <?php } // endif ?>

    <div class="mB20">


      <a href="<?php echo \dash\url::that(). '/logo'; ?>" class="checklist fc-black" <?php if(\dash\data::appDetail_logo()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Application logo"); ?></a>
      <hr>

      <a href="<?php echo \dash\url::that(). '/setting'; ?>" class="checklist fc-black" <?php if(\dash\data::appDetail_title()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Application title"); ?></a>

      <a href="<?php echo \dash\url::that(). '/setting'; ?>" class="checklist fc-black" <?php if(\dash\data::appDetail_desc()) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Application description"); ?></a>


      <a href="<?php echo \dash\url::that(). '/setting'; ?>" class="checklist fc-black" <?php if(\dash\data::appDetail_slogan()) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Application slogan"); ?></a>
      <hr>

      <a href="<?php echo \dash\url::that(). '/splash'; ?>" class="checklist fc-black" <?php if(\dash\data::appDetail_splash_theme()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Splash theme"); ?></a>
      <hr>


      <a href="<?php echo \dash\url::that(). '/intro'; ?>" class="checklist fc-black" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'title')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Title"). ' '. T_("Intro page #1"); ?></a>

      <a href="<?php echo \dash\url::that(). '/intro'; ?>" class="checklist fc-black" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'desc')) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Description"). ' '. T_("Intro page #1"); ?></a>

      <a href="<?php echo \dash\url::that(). '/intro'; ?>" class="checklist fc-black" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'file')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("File"). ' '. T_("Intro page #1"); ?></a>



      <a href="<?php echo \dash\url::that(). '/intro'; ?>" class="checklist fc-black" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'title')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Title"). ' '. T_("Intro page #2"); ?></a>

      <a href="<?php echo \dash\url::that(). '/intro'; ?>" class="checklist fc-black" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'desc')) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Description"). ' '. T_("Intro page #2"); ?></a>

      <a href="<?php echo \dash\url::that(). '/intro'; ?>" class="checklist fc-black" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'file')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("File"). ' '. T_("Intro page #2"); ?></a>


      <a href="<?php echo \dash\url::that(). '/intro'; ?>" class="checklist fc-black" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'title')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Title"). ' '. T_("Intro page #3"); ?></a>

      <a href="<?php echo \dash\url::that(). '/intro'; ?>" class="checklist fc-black" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'desc')) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Description"). ' '. T_("Intro page #3"); ?></a>

      <a href="<?php echo \dash\url::that(). '/intro'; ?>" class="checklist fc-black" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'file')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("File"). ' '. T_("Intro page #3"); ?></a>
    </div>

  </div>


  </div>
</div>



