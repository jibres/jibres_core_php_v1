<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f fs14 justify-center">
  <div class="c6 s12">

    <div class="checklist" <?php if(\dash\data::appDetail_logo()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Application logo"); ?></div>

    <div class="checklist" <?php if(\dash\data::appDetail_title()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Application title"); ?></div>

    <div class="checklist" <?php if(\dash\data::appDetail_desc()) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Application description"); ?></div>


    <div class="checklist" <?php if(\dash\data::appDetail_slogan()) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Application slogan"); ?></div>

    <div class="checklist" <?php if(\dash\data::appDetail_intro_theme()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Intro theme"); ?></div>


    <div class="checklist" <?php if(\dash\data::appDetail_splash_theme()) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Splash theme"); ?></div>


    <div class="checklist" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'title')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Title"). ' '. T_("Intro page #1"); ?></div>

    <div class="checklist" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'desc')) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Description"). ' '. T_("Intro page #1"); ?></div>

    <div class="checklist" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'file')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("File"). ' '. T_("Intro page #1"); ?></div>



    <div class="checklist" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'title')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Title"). ' '. T_("Intro page #2"); ?></div>

    <div class="checklist" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'desc')) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Description"). ' '. T_("Intro page #2"); ?></div>

    <div class="checklist" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'file')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("File"). ' '. T_("Intro page #2"); ?></div>


    <div class="checklist" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'title')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("Title"). ' '. T_("Intro page #3"); ?></div>

    <div class="checklist" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'desc')) { echo 'data-okay';}else{echo '';} ?>><?php echo T_("Description"). ' '. T_("Intro page #3"); ?></div>

    <div class="checklist" <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'file')) { echo 'data-okay';}else{echo 'data-fail';} ?>><?php echo T_("File"). ' '. T_("Intro page #3"); ?></div>

  </div>


  </div>
</div>



