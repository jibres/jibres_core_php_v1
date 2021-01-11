<div class="jibresBanner">
 <div class="avand-md impact zero">
  <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/story/jibres-story-love.gif" alt='<?php echo \dash\face::title();?>'>
 </div>


 <div class="avand-md impact font-16">
  <h2><?php echo T_("Our Company Detail"); ?></h2>
  <table class="tbl1 v5 mB0-f">
   <tr>
    <td class="txtRa"><?php echo T_("Brand"); ?></td>
    <td class="txtB"><?php echo T_("Jibres"); ?></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Company Name"); ?></td>
    <td class="txtB"><?php echo T_("Rooz Andish Kavir Peyma Ltd"); ?></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Company Establishment Date"); ?></td>
    <td class="txtB ltr"><?php echo \dash\fit::date("2015-06-22"); ?></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Company Registration Number"); ?></td>
    <td class="txtB ltr"><?php echo \dash\fit::number(13552, false); ?></td>
   </tr>
    <td class="txtRa"><?php echo T_("Company Identification Number"); ?></td>
    <td class="txtB ltr"><?php echo \dash\fit::number(14005025553, false); ?></td>
   </tr>

<?php if(\dash\url::isLocal()) { ?>
   <tr>
    <td class="txtRa"><?php echo T_("Company VAT ID"); ?></td>
    <td class="txtB ltr"><?php echo \dash\fit::number(411491163378, false); ?></td>
   </tr>
<?php } ?>
<?php if (\dash\language::current() === 'fa') { ?>
    <td class="txtRa"><?php echo T_("Knowledge-based Company"); ?></td>
    <td class="txtB"><?php echo T_("New Type 2"); ?></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Knowledge-based Acquisition Date"); ?></td>
    <td class="txtB ltr"><?php echo \dash\fit::date("2019-05-04"); ?></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Company Headquarter"); ?></td>
    <td class="txtB"><?php echo T_("Qom, Iran"); ?></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Address"); ?></td>
    <td class="txtB"><?php echo T_("Floor2, Yas Building, #39, 1st alley, Haft-e-tir St"); ?></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Postal Code"); ?></td>
    <td class="txtB"><?php echo \dash\fit::number("37196-17540", false); ?></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Primary Company Phone Number"); ?></td>
    <td class="txtB ltr"><a href="tel:+982536505281"><?php echo \dash\fit::number("+98-25-3650-5281", false); ?></a></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Tehran Office Number"); ?></td>
    <td class="txtB ltr"><a href="tel:+982128422590"><?php echo \dash\fit::number("+98-21-2842-2590", false); ?></a></td>
   </tr>
<?php } ?>
   <tr>
    <td class="txtRa"><?php echo T_("Email Address"); ?></td>
    <td class="txtB ltr"><a href="mailto:info@jibres.com">Info [ @ ] Jibres.com</a></td>
   </tr>

   <tr>
    <td class="txtRa"><?php echo T_("CEO"); ?></td>
    <td class="txtB"><a href="<?php echo \dash\url::cdn(); ?>/vcard/Jibres-vCard-Javad-Adib.vcf"><?php echo T_("Mr. Javad Adib"); ?></a></td>
   </tr>

  </table>
 </div>


<?php if (\dash\language::current() === 'fa') { ?>
 <div class="avand-md impact font-16 pB25-f">
  <p>داستان شکل‌گیری ایده جیبرس و شروع اون یک روایت مفصل است. من جواد ادیب هستم و میخوام داستان جیبرس رو براتون روایت کنم.</p>

  <p>یکی بود یکی نبود. برمیگردیم به خیلی وقت پیش، سال ۱۳۹۲ شمسی؛ انگار یه قرن از اون دوران گذشته. پنج جوان بودیم از پنج شهر متفاوت. جواد،‌ سامان، حسن، محمد و امید. همین اولش احتمالا این سوال براتون پیش اومد که چطور با هم آشنا شدیم؟ مسابقات مهارت. ما هر کدوم نماینده یک استان و رقیب هم تو مسابقات کشوری تو دوره‌های مختلف بودیم. رشته نرم‌افزار و وب.</p>

  <video class="block" controls preload="metadata">
    <source type="video/mp4" src="<?php echo \dash\url::cdn(); ?>/video/WorldSkills-SkillsChangeLives.mp4">
  </video>
  <p class="msg minimal font-14 txtC mT10 mB0-f">این ویدیوی رسمی مسابقات جهانی مهارت هست و به‌راستی که مهارت زندگی را تغییر می‌دهد.</p>
 </div>




 <div class="avand-md impact font-16">

 </div>


<?php } else { ?>
 <div class="avand-md impact font-16">
  <p><?php echo T_("Soon") ?></p>
 </div>
<?php } ?>

 <div class="avand-md impact zero">
  <img class="block" src="<?php echo \dash\url::cdn(); ?>/img/story/jibres-love.gif" alt='<?php echo T_("Sincerely, Javad Adib") ?>'>
 </div>

</div>