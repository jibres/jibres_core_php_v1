<div class="jibresBanner">
 <div class="avand-lg impact zero">
  <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/bg/jibres-contact-1.jpg" alt='<?php echo T_("Contact Jibres")?>'>
 </div>

 <div class="avand-lg impact">
  <h2><?php echo T_("Thank you for choosing us.");?></h2>
  <p class="mB0-f"><?php echo T_("We do our best to improve jibres's quality. So, knowing your valuable comments about bugs and problems and more importantly your precious offers will help us in this way."); ?></p>
 </div>

 <div class="avand-lg impact">
  <div class="f">
    <div class="c12 s12">
      <div class="showContactNotif"></div>
     <form method="post" data-clear data-refresh data-autoScroll='form'>
<?php
      echo \dash\csrf::html();
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
         <input type="email" name="email" id="email" placeholder='' maxlength='40'>
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
  </div>
 </div>


<?php
if (\dash\language::current() === 'fa')
{
?>

 <div class="avand-lg impact zero">
  <iframe class="block" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3282.187296917843!2d50.876835765574285!3d34.64997254344046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f93bb7231d4a105%3A0x8843ca95f5a8e4a1!2sJibres!5e0!3m2!1sen!2s!4v1584467269428!5m2!1sen!2s"  height="300"  style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
 </div>


 <div class="avand impact">
  <div class="f">
    <div class="c8 s12 pRa10">
     <address class="vcard2">
      <div class="author author_name hide"><span class="fn"><?php echo T_("jibres"); ?></span></div>
      <div class="adr mb-4">
        <div class="inline-block country-name"><?php echo T_("Iran"); ?></div>
        <div class="inline-block locality"><?php echo T_("Qom"); ?></div>
        <div class="inline-block street-address"><?php echo T_("1st alley, Haft-e-tir St"); ?></div>
        <div class="inline-block extended-address"><?php echo T_("Floor2, Yas Building"); ?></div>
        <div class="inline-block postal-code"><?php echo T_("Postal Code"). ' '. \dash\fit::text("37196-17540"); ?></div>
      </div>
      <div class="block mb-2 email ltr">info [at] jibres [.] com</div>
      <a class="block mb-2 tel ltr" href="tel:+982536505281"><?php echo \dash\fit::text('(+98) 25 3650 5281'); ?></a>
     </address>

    </div>

    <div class="c4 s12">
      <a href="https://goo.gl/maps/HUdi1YmcFBz" target="_blank" class="map" title='<?php echo T_("Our location on map"); ?>'>
       <img src="<?php echo \dash\url::cdn(); ?>/images/map/ermile.png" alt="<?php echo \dash\face::site(); ?>">
      </a>
    </div>
  </div>
 </div>

 <div class="avand-lg impact zero">
  <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/bg/jibres-contact-2.jpg" alt='<?php echo \dash\face::title();?>'>
 </div>

<?php
} // endif
?>

</div>