<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<?php $introSaved = \dash\data::introSaved(); ?>

<form method="post" autocomplete="off">

<?php for ($i=1; $i <= 3 ; $i++) { ?>

  <div class="f justify-center mB20">
    <div class="c6 m8 s12">
      <div class="box">
        <header><h2><?php echo T_("App Intro detail"); ?> <?php echo T_("Page"). ' '. \dash\fit::number($i); ?></h2></header>

        <div class="body">

            <div class="intro<?php echo $i; ?>" >
            <label for="title<?php echo $i; ?>"><?php echo T_("Title"); ?></label>
            <div class="input">
              <input type="text" name="title<?php echo $i; ?>" id="title<?php echo $i; ?>" value="<?php echo \dash\get::index($introSaved, $i, 'title'); ?>" maxlength="50">
            </div>

            <label for="desc<?php echo $i; ?>"><?php echo T_("Description"); ?></label>
            <div class="input">
              <input type="text" name="desc<?php echo $i; ?>" id="desc<?php echo $i; ?>" value="<?php echo \dash\get::index($introSaved, $i, 'desc'); ?>" maxlength="100">
            </div>

            <label for="file<?php echo $i; ?>"><?php echo T_("Image"); ?></label>
            <div class="input">
              <input type="file" name="file<?php echo $i; ?>" id="file<?php echo $i; ?>">
            </div>
           </div>

        </div>
        <?php if($i === 3) {?>
        <footer class="txtRa">
          <button class="btn success"><?php echo T_("Save"); ?></button>
           <?php if(\dash\get::index($introSaved, 'usersaved')) {?>
            <a class="btn secondary" href="<?php echo \dash\url::that(). '/review'; ?>"><?php echo T_("Next"); ?></a>
           <?php } //endif ?>
        </footer>
      <?php } //endif ?>
      </div>
    </div>
    <div class="c6 s12">
       <section class="mobileFrame" data-intro>
        <div class="screen">
          <div class="imgBox">
            <img src="<?php echo \dash\get::index($introSaved, $i, 'image'); ?>" alt='<?php echo \dash\get::index($introSaved, $i, 'title'); ?>'>
          </div>
          <h2><?php echo \dash\get::index($introSaved, $i, 'title'); ?></h2>
          <p><?php echo \dash\get::index($introSaved, $i, 'desc'); ?></p>
          <nav class="f align-center">
            <?php if ($i === 1) {?>
            <div class="c4 prev txtLa"><?php echo T_("Skip"); ?></div>
            <div class="c4 step"><i class="current"></i><i></i><i></i></div>
            <div class="c4 next txtRa"><?php echo T_("Next"); ?></div>
            <?php } elseif ($i === 2) {?>
            <div class="c4 prev txtLa"><?php echo T_("Skip"); ?></div>
            <div class="c4 step"><i></i><i class="current"></i><i></i></div>
            <div class="c4 next txtRa"><?php echo T_("Next"); ?></div>
            <?php } elseif ($i === 3) {?>
            <div class="c12 next"><?php echo T_("Get Started"); ?></div>
            <?php }?>
          </nav>
        </div>
       </section>
    </div>
  </div>

<?php } //endfor ?>

</form>


