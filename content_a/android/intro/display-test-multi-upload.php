<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<?php $introSaved = \dash\data::introSaved(); ?>

<form method="post" autocomplete="off" class="f">

<?php for ($i=1; $i <= 3 ; $i++) { ?>

  <div class="justify-center mB20 c4 s12 pA5">
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

            <div class="box min-y120" data-uploader data-name="file<?php echo $i; ?>" data-ratio="1" data-final='#finalImage<?php echo $i; ?>'>
              <input type="file" accept="image/jpeg, image/png" id="file<?php echo $i; ?>">
              <label for="file<?php echo $i; ?>"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
            </div>

           </div>
        </div>

        <footer class="txtRa">
          <button class="btn success"><?php echo \dash\data::nextBtnAll(); ?></button>
        </footer>

      </div>
    </div>
    <div class="c6 s12">
       <section class="mobileFrame" data-intro>
        <div class="screen">
          <div class="imgBox">
            <img id="finalImage<?php echo $i; ?>" src="<?php echo \dash\get::index($introSaved, $i, 'image'); ?>" alt='<?php echo \dash\get::index($introSaved, $i, 'title'); ?>'>
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


