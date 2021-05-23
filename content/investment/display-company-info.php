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
   <tr>
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
   <tr>
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
    <td class="txtRa"><?php echo T_("Website"); ?></td>
    <td class="txtB ltr"><a href="<?php echo \dash\url::kingdom(); ?>"><?php echo \dash\url::domain(); ?></a></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Email Address"); ?></td>
    <td class="txtB ltr"><a href="mailto:info@jibres.com">Info [ @ ] Jibres.com</a></td>
   </tr>

   <tr>
    <td class="txtRa"><?php echo T_("CEO"); ?></td>
    <td class="txtB"><a href="<?php echo \dash\url::cdn(); ?>/vcard/Jibres-vCard-Javad-Adib.vcf"><?php echo T_("Mr. Javad Adib"); ?></a></td>
   </tr>

   <tr>
    <td class="txtRa"><?php echo T_("Activity"); ?></td>
    <td class="txtB"><?php echo T_("eCommerce Platform"). ' - '. T_("Financial technology"). (' - '). T_("Fintech"); ?></td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Keywords"); ?></td>
    <td class="txtB">
      <a rel="nofollow noopener" href="https://en.wikipedia.org/wiki/Financial_technology"><?php echo T_("Fintech"); ?></a><br>
      <a rel="nofollow noopener" href="https://en.wikipedia.org/wiki/E-commerce"><?php echo T_("E-commerce"); ?></a><br>
      <a><?php echo T_("Website Builder"); ?></a><br>
      <a><?php echo T_("App Builder"); ?></a><br>
      <a><?php echo T_("Telegram Seller"); ?></a><br>
      <a rel="nofollow noopener" href="https://en.wikipedia.org/wiki/Point_of_sale"><?php echo T_("POS Software"); ?></a><br>
      <a><?php echo T_("Instagram Sell Assistant"); ?></a><br>
      <a><?php echo T_("PWA Builder"); ?></a><br>
      <a rel="nofollow noopener" href="https://en.wikipedia.org/wiki/Customer_relationship_management"><?php echo T_("CRM"); ?></a><br>
      <a rel="nofollow noopener" href="https://en.wikipedia.org/wiki/Content_management"><?php echo T_("Content Management System"); ?></a><br>
      <a><?php echo T_("Form Builder"); ?></a><br>
      <a><?php echo T_("Accounting"); ?></a>
      </td>
   </tr>
   <tr>
    <td class="txtRa"><?php echo T_("Public release date"); ?></td>
    <td class="txtB"><?php echo \dash\fit::datetime_full("2021-03-29", false); ?></td>
   </tr>
  </table>
 </div>