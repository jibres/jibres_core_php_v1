<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<div class="f fs14">
  <div class="c2 s12">

    <div class="msg minimal mB5 <?php if(\dash\data::appDetail_logo()) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Application logo"); ?></div>
    </div>

    <div class="msg minimal mB5 <?php if(\dash\data::appDetail_title()) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Application title"); ?></div>
    </div>

    <div class="msg minimal mB5 <?php if(\dash\data::appDetail_desc()) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo ''; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Application description"); ?></div>
    </div>


    <div class="msg minimal mB5 <?php if(\dash\data::appDetail_slogan()) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo ''; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Application slogan"); ?></div>
    </div>

    <div class="msg minimal mB5 <?php if(\dash\data::appDetail_intro_theme()) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Intro theme"); ?></div>
    </div>


    <div class="msg minimal mB5 <?php if(\dash\data::appDetail_splash_theme()) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Splash theme"); ?></div>
    </div>


    <div class="msg minimal mB5 <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'title')) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Title"). ' '. T_("Intro page #1"); ?></div>
    </div>

    <div class="msg minimal mB5 <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'desc')) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo ''; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Description"). ' '. T_("Intro page #1"); ?></div>
    </div>

    <div class="msg minimal mB5 <?php if(\dash\get::index(\dash\data::appDetail(), 'page_1', 'file')) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("File"). ' '. T_("Intro page #1"); ?></div>
    </div>



    <div class="msg minimal mB5 <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'title')) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Title"). ' '. T_("Intro page #2"); ?></div>
    </div>

    <div class="msg minimal mB5 <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'desc')) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo ''; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Description"). ' '. T_("Intro page #2"); ?></div>
    </div>

    <div class="msg minimal mB5 <?php if(\dash\get::index(\dash\data::appDetail(), 'page_2', 'file')) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("File"). ' '. T_("Intro page #2"); ?></div>
    </div>


    <div class="msg minimal mB5 <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'title')) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Title"). ' '. T_("Intro page #3"); ?></div>
    </div>

    <div class="msg minimal mB5 <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'desc')) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo ''; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("Description"). ' '. T_("Intro page #3"); ?></div>
    </div>

    <div class="msg minimal mB5 <?php if(\dash\get::index(\dash\data::appDetail(), 'page_3', 'file')) { echo 'success2'; $myIcon = 'sf-check fc-green fs14'; }else{echo 'danger2'; $myIcon = 'sf-times fc-red fs14';} ?> f align-center">
      <div class="c2"><i class="<?php echo $myIcon ?>"></i></div>
      <div class="c"><?php echo T_("File"). ' '. T_("Intro page #3"); ?></div>
    </div>

  </div>

  <div class="c">
      <div class="f">
        <div class="c"><?php require(root. 'content_a/app/android/appPreview.php'); ?></div>
        <div class="c"><?php require(root. 'content_a/app/android/appPreview.php'); ?></div>
        <div class="c"><?php require(root. 'content_a/app/android/appPreview.php'); ?></div>
        <div class="c"><?php require(root. 'content_a/app/android/appPreview.php'); ?></div>

      </div>
  </div>


  </div>
</div>



