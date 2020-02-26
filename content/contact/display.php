<div class="jibresBanner">
 <div class="fit">

 <div class="f content">
  <div class="c6 s12">

  <p>
    <?php echo T_("Thank you for choosing us."); ?><br/>
    <?php echo T_("We do our best to improve jibres's quality. So, knowing your valuable comments about bugs and problems and more importantly your precious offers will help us in this way."); ?>
  </p>

   <form method="post" data-clear>

    <?php \dash\utility\hive::html() ?>

    <?php
    if(!\dash\user::login())
    {
    ?>

      <div class="input pA5">
       <label class="addon" for="name"><?php echo T_("Name"); ?></label>
       <input type="text" name="name" id="name" placeholder='<?php echo T_("Full Name"); ?>' maxlength='40'>
      </div>
      <div class="input pA5">
       <label class="addon" for="mobile"><?php echo T_("Mobile"); ?></label>
       <input type="tel" name="mobile" id="mobile" placeholder='98 912 333 4444' maxlength="17" autocomplete="off" data-validity='<?php echo T_("Please enter valid mobile number. `:val` is incorrect"); ?>'>
      </div>
      <div class="input pA5">
       <label class="addon" for="email"><?php echo T_("Email"); ?></label>
       <input type="email" name="email" id="email" placeholder='mail@example.com' maxlength='40'>
      </div>

    <?php
    } // endif
    ?>

    <div class="pA5">
     <textarea class="c txt" name="content" placeholder='<?php echo T_("Your Message"); ?>' rows=4 minlength="5" maxlength="1000" data-resizable></textarea>
    </div>
    <div class="input pA5 mTB25">
     <button type="submit" name="submit-contact" class="btn block success"><?php echo T_("Send"); ?></button>
    </div>

   </form>
  </div>


  <div class="c4 s12 os bg-white pA25">
    <h3><?php echo T_("How to contact us"); ?></h3>
    <div class="contact-data">

       <address class="vcard mB10">
        <div class="author author_name hide"><span class="fn"><?php echo T_("jibres"); ?></span></div>
        <div class="adr">

<?php
if (\dash\language::current() === 'en')
{
?>
          <div class="extended-address"><?php echo T_("Ermile, Floor2, Yas Building"); ?></div>
          <div class="street-address"><?php echo T_("1st alley, Haft-e-tir St"); ?></div>
          <div class="locality"><?php echo T_("Qom"); ?></div>
          <div class="country-name"><?php echo T_("Iran"); ?></div>
<?php
}
else
{
?>
          <div class="country-name"><?php echo T_("Iran"); ?></div>
          <div class="locality"><?php echo T_("Qom"); ?></div>
          <div class="street-address"><?php echo T_("1st alley, Haft-e-tir St"); ?></div>
          <div class="extended-address"><?php echo T_("Floor2, Yas Building"); ?></div>
<?php
} // endif
?>
          <div class="postal-code"><?php echo T_("Postal Code"). ' '. \dash\fit::text("37196-17540"); ?></div>
        </div>
        <div class="email ltr">info@jibres.com</div>
        <a class="tel ltr" href="tel:+982536505281"><?php echo \dash\fit::text('(+98) 25 3650 5281'); ?></a>
        <a class="tel ltr" href="tel:+982536505460"><?php echo \dash\fit::text('(+98) 25 3650 5460'); ?></a>
        <a class="tel ltr mT10" href="tel:+982128422590"><?php echo \dash\fit::text('(+98) 21 2842 2590'); ?></a>
       </address>
    </div>
    <a href="https://goo.gl/maps/HUdi1YmcFBz" target="_blank" class="map" title='<?php echo T_("Our location on map"); ?>'>
     <img src="<?php echo \dash\url::cdn(); ?>/images/map/ermile.png" alt="<?php echo \dash\data::site_title(); ?>">
    </a>

  </div>

 </div>

 </div>
</div>