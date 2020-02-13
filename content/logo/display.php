
<div class="logoEffect">
  <img alt="Shadow of Jibres logo" class="shadow" src="<?php echo \dash\url::static(); ?>/images/logo/bg-logo-shadow.png">
  <img alt='<?php echo T_("Jibres logo"); ?>' class="logo" src="<?php echo \dash\url::icon(); ?>">
  <video loop muted playsinline autoplay>
      <source type='video/mp4' src="<?php echo \dash\url::static(); ?>/video/bg-logo.mp4"/>
  </video>
</div>




  <section class="page-title">
   <div class="cn">
    <div id="typed-strings" class="hide">
      <h1><?php echo \dash\data::page_title(); ?></h1>
    </div>
    <div class="h1"><span class="typed"></span></div>
    <h2><?php echo \dash\data::page_desc(); ?></h2>
   </div>
  </section>




<article class="logo">
  <div class="cn pTB3x">
    <h2><?php echo T_("Download Logo Pack"); ?></h2>
    <div class="msg mB0-f">
      <p><?php echo T_("All type of Jibres logos are available!"); ?> <a target="_blank" href="https://github.com/jibres/Jibres-logo/archive/master.zip"><?php echo T_("Download latest Jibres logo pack."); ?></a></p>
      <p><?php echo T_("Also you can browse to find our logo based on your need."); ?> <a target="_blank" href="https://github.com/jibres/Jibres-logo/tree/master/dist"><?php echo T_("Jibres logo repository."); ?></a></p>
    </div>
  </div>

  <section class="pTB5x">
   <div class="cn">
    <div class="f align-center mB10">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("MEET THE LOGO"); ?></h3>
        <p><?php echo T_("Our logo represents simplicity, vivacity, agility, scalability and reliability; Values that we believe them as a company."); ?></p>
        <p><?php echo T_("These guidelines are here to help ensure that your use of the Jibres logo is consistent with the way we present ourselves."); ?></p>
      </div>
      <div class="c s12 pLa10">
        <img class="slideImg width-300" src="<?php echo \dash\url::logo(); ?>" alt='<?php echo T_("Jibres"); ?>'>
      </div>
    </div>
   </div>
  </section>



<?php
require_once ('section-standard.php');
require_once ('section-vertical.php');
require_once ('section-icon.php');
?>


  <section class="pTB5x">
   <div class="cn">
    <div class="f align-center">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("SAFE SPACE"); ?></h3>
        <p><?php echo T_("Safe space acts as a buffer between the logo and other visual elements on a page, including text."); ?></p>
        <p><?php echo T_("This space is the minimum distance needed and is equal to third the height of the icon."); ?></p>
      </div>
      <div class="c s12 pLa10">
<?php if (\dash\language::current() === 'fa')
{
?>
        <img class="slideImg width-500" src="<?php echo \dash\url::static(); ?>/logo/styleguide-fa/png/jibres-logo-styleguide-fa-7-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("SAFE SPACE"); ?>'>
<?php
}
else
{
?>
        <img class="slideImg width-500" src="<?php echo \dash\url::static(); ?>/logo/styleguide/png/jibres-logo-styleguide-7-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("SAFE SPACE"); ?>'>
<?php
} // endif
?>
      </div>
    </div>
   </div>
  </section>

  <section class="pTB4x">
   <div class="cn">
    <div class="f align-center">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("MINIMAL SIZE"); ?></h3>
        <p><?php echo T_("Here’s the recommended minimum size at which the logo may be reproduced. For legibility reasons, we ask that you stick to these dimensions."); ?></p>
      </div>
      <div class="c s12 pLa10">
<?php if (\dash\language::current() === 'fa')
{
?>
        <img class="slideImg width-200" src="<?php echo \dash\url::static(); ?>/logo/styleguide-fa/png/jibres-logo-styleguide-fa-8-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("MINIMAL SIZE"); ?>'>
<?php
}
else
{
?>
        <img class="slideImg width-200" src="<?php echo \dash\url::static(); ?>/logo/styleguide/png/jibres-logo-styleguide-8-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("MINIMAL SIZE"); ?>'>
<?php
} // endif
?>
      </div>
    </div>
   </div>
  </section>

  <section class="pTB5x">
   <div class="cn">
    <div class="f align-center">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("JIBRES RED"); ?></h3>
        <p><?php echo T_("The Jibres red is bright and vibrant and we want it to stand out clearly. To that end, here are the color values you can use for both digital and print."); ?></p>
      </div>
      <div class="c s12 pLa10">
        <img class="slideImg width-300" src="<?php echo \dash\url::static(); ?>/logo/styleguide/png/jibres-logo-styleguide-9-img.png" alt='<?php echo T_("JIBRES RED"); ?>'>
      </div>
    </div>
   </div>
  </section>

  <section class="pTB5x">
   <div class="cn">
    <div class="f align-center">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("USING GRAYSCALE"); ?></h3>
        <p><?php echo T_("If the color logotype isn’t an option for technical reasons, use the black or white versions instead."); ?></p>
        <p><?php echo T_("You can create a version using any value on the grayscale."); ?></p>
      </div>
      <div class="c s12 pLa10">
<?php if (\dash\language::current() === 'fa')
{
?>
        <img class="slideImg width-300" src="<?php echo \dash\url::static(); ?>/logo/styleguide-fa/png/jibres-logo-styleguide-fa-10-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("USING GRAYSCALE"); ?>'>
<?php
}
else
{
?>
        <img class="slideImg width-300" src="<?php echo \dash\url::static(); ?>/logo/styleguide/png/jibres-logo-styleguide-10-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("USING GRAYSCALE"); ?>'>
<?php
} // endif
?>
      </div>
    </div>
   </div>
  </section>

  <section class="pTB5x">
   <div class="cn">
    <div class="f align-center">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("BACKGROUND COLOR"); ?></h3>
        <p><?php echo T_("Our logo must always have good contrast with the background to ensure maximum impact and accessibility."); ?></p>
        <p><?php echo T_("Use the black or white versions if the logo is to be presented on a background color."); ?></p>
        <p><?php echo T_("If you’re going with grayscale, make sure you choose a version where the contrast between the logo and the background is strong."); ?></p>
      </div>
      <div class="c s12 pLa10">
<?php if (\dash\language::current() === 'fa')
{
?>
        <img class="slideImg width-300" src="<?php echo \dash\url::static(); ?>/logo/styleguide-fa/png/jibres-logo-styleguide-fa-11-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("BACKGROUND COLOR"); ?>'>
<?php
}
else
{
?>
        <img class="slideImg width-300" src="<?php echo \dash\url::static(); ?>/logo/styleguide/png/jibres-logo-styleguide-11-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("BACKGROUND COLOR"); ?>'>
<?php
} // endif
?>
      </div>
    </div>
   </div>
  </section>

  <section class="pTB5x">
   <div class="cn">
    <div class="f align-center">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("WORDMARK"); ?></h3>
        <p><?php echo T_("Here’s what you need to know about the wordmark:"); ?></p>
        <ul class="list">
          <li><?php echo T_("The font used for the wordmark is Acre Medium."); ?></li>
          <li><?php echo T_("This font is only used in the logo."); ?></li>
          <li><?php echo T_("'Jibres' is written as one word, with the letters'J' capitalized in all instances."); ?></li>
        </ul>
      </div>
      <div class="c s12 pLa10">
<?php if (\dash\language::current() === 'fa')
{
?>
        <img class="slideImg width-300" src="<?php echo \dash\url::static(); ?>/logo/styleguide-fa/png/jibres-logo-styleguide-fa-12-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("WORDMARK"); ?>'>
<?php
}
else
{
?>
        <img class="slideImg width-300" src="<?php echo \dash\url::static(); ?>/logo/styleguide/png/jibres-logo-styleguide-12-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("WORDMARK"); ?>'>
<?php
} // endif
?>
      </div>
    </div>
   </div>
  </section>

  <section class="pTB5x">
   <div class="cn">
    <div class="f align-center">
      <div class="c4 m6 s12">
        <h3 class="mB50"><?php echo T_("LOGO DON'TS"); ?></h3>
        <p><?php echo T_("Use the Jibres logos as provided and please do not make any changes to them :)"); ?></p>
      </div>
      <div class="c s12 pLa10">
<?php if (\dash\language::current() === 'fa')
{
?>
        <img class="slideImg width-300" src="<?php echo \dash\url::static(); ?>/logo/styleguide-fa/png/jibres-logo-styleguide-fa-14-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("LOGO DO NOTS"); ?>'>
<?php
}
else
{
?>
        <img class="slideImg width-300" src="<?php echo \dash\url::static(); ?>/logo/styleguide/png/jibres-logo-styleguide-14-img.png" alt='<?php echo T_("Jibres"); ?> <?php echo T_("LOGO DO NOTS"); ?>'>
<?php
} // endif
?>
      </div>
    </div>
   </div>
  </section>

</article>


<?php
require_once ('section-styleguide.php');
?>
