


<div class="f justify-center">
 <div class="c6 m8 s12">

  <?php if(\dash\request::get('type') === 'new') {?>

   <div class="cbox">
   <form method="post" autocomplete="off">
    <div class="msg fs09 info2"><?php echo T_('This form used to register iranian persons on nic.ir system and all fields is require because IRNIC need them. If you want to create another type of account or you are not iranian, please go to nic.ir website and directly create IRNIC handle.'); ?></div>
    <p class="msg danger2 fc-mute fs09"><?php echo T_("Enter fill all data in English!"); ?></p>

    <h3><?php echo T_('Basic Information'); ?></h3>
    <div class="hide">
     <label for="intitle"><?php echo T_("Address Title"); ?></label>
     <div class="input">
      <input type="text" name="title" id="intitle">
     </div>
    </div>

    <div class="f">
     <div class="c6 s12 pRa10">
      <label for="ifirstname"><?php echo T_("Firstname"); ?></label>
      <div class="input ltr">
       <input type="text" name="firstname" id="ifirstname" maxlength="70">
      </div>
     </div>
     <div class="c6 s12">
       <label for="ilastname"><?php echo T_("Lastname"); ?></label>
       <div class="input ltr">
        <input type="text" name="lastname" id="ilastname" maxlength="70">
       </div>
     </div>
    </div>

    <label for="inationalcode"><?php echo T_("Iranian National Code"); ?></label>
    <div class="input ltr">
     <input type="text" name="nationalcode" id="inationalcode" maxlength="30">
    </div>


    <h3><?php echo T_('Street Infromation'); ?></h3>
    <div class="mB10">
      <label for='country'><?php echo T_("Country"); ?></label>
      <select class="select22" name="country" id="country" data-model='country'>
        <option value=""><?php echo T_("Choose your country"); ?></option>

        <?php foreach (\dash\data::countryList() as $key => $value) {?>

          <option value="<?php echo $key; ?>" > <?php echo \dash\get::index($value, 'name'); if(\dash\language::current() !== 'en') { echo ' - '. T_(ucfirst(\dash\get::index($value, 'name'))); } ?></option>

     <?php } //endif ?>

      </select>
    </div>

    <div class="f">
     <div class="c6 s12 pRa5">
      <label for="province"><?php echo T_("State/Province"); ?></label>
      <div class="input ltr">
        <input type="text" name="province" id="province" maxlength="50">
      </div>
     </div>
     <div class="c6 s12">
      <label for="city"><?php echo T_("City"); ?></label>
      <div class="input ltr">
        <input type="text" name="city" id="city" maxlength="50">
      </div>
     </div>
    </div>




    <label for="address"><?php echo T_("Address"); ?> <small class="fc-mute"><?php echo T_("Enter in Latin characters"); ?></small></label>
    <textarea class="txt ltr mB10" name="address" id="address" maxlength='300' rows="1"></textarea>

    <label for="postcode"><?php echo T_("Post code"); ?></label>
    <div class="input">
      <input type="text" name="postcode" id="postcode" data-format="postalCode">
    </div>




    <h3><?php echo T_('Contact Infromation'); ?></h3>

    <div class="f">
     <div class="c6 s12 pRa5">
      <label for="iphone"><?php echo T_("Phone Number"); ?></label>
      <div class="input">
        <input type="text" name="phone" id="iphone" data-format="tel">
      </div>
     </div>
     <div class="c6 s12 pRa5">
      <label for="iemail"><?php echo T_("Email Address"); ?></label>
      <div class="input ltr">
       <input type="email" name="email" id="iemail" maxlength="100">
      </div>
     </div>
    </div>

    <p class="fc-mute"><?php
  echo T_("By clicking Create IRNIC Handle, you are indicating that you have read the :nic and agree to the :terms.",
    [
      'nic' => '<a href="'. \dash\url::kingdom(). '/terms/irnic" target="_blank">'. T_('IRNIC agreement') .'</a>',
      'terms' => '<a href="'. \dash\url::kingdom(). '/terms" target="_blank">'. T_('Jibres Terms of Service') .'</a>'
    ])
?></p>


    <div class="txtRa">
     <button class="btn success"><?php echo T_("Create IRNIC handle"); ?></button>
    </div>
   </form>
  </div>


  <?php }else{ ?>




   <div class="cbox">
    <form method="post" autocomplete="off">
     <label for="ioldcontact"><?php echo T_("IRNIC Handle"); ?></label>
     <div class="input ltr">
      <input type="text" name="oldcontact" id="ioldcontact">
     </div>
     <p class="fc-mute"><?php echo T_('Please enter your IRNIC handle that registerd on nic.ir'); ?></p>
     <p class="fc-mute"><?php echo T_("If you don't know about IRNIC, you can register via Jibres or directly on nic.ir website."); ?> <a href="<?php echo \dash\url::current(); ?>?type=new"><?php echo T_('Register IRNIC handle'); ?></a></p>

     <div class="txtRa">
      <button class="btn success"><?php echo T_("Add IRNIC handle"); ?></button>
     </div>
    </form>
   </div>


  <?php } //endif ?>


 </div>
</div>

