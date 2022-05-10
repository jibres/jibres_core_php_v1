


<div class="f justify-center">
 <div class="c6 m8 s12">

  <?php if(\dash\request::get('type') === 'new') {?>

   <div class="box p-4">
    <div class="alert2">
      <?php echo T_('Please go to nic.ir for register new account'); ?>


      </div>
      <a class="btn-link" href="https://www.nic.ir/Create_New_Handle?class=Person" target="_blank" data-direct><?php echo T_("Register on IRNIC") ?></a>
   </div>

    <?php if(false) { // the IRNIC disable create contact from api :) Date: 2020-06-22 ?>
   <div class="box p-4">
   <form method="post" autocomplete="off">
    <div class="msg fs09 info2"><?php echo T_('This form used to register iranian persons on nic.ir system and all fields is require because IRNIC need them. If you want to create another type of account or you are not iranian, please go to nic.ir website and directly create IRNIC handle.'); ?></div>
    <p class="alert-danger text-gray-400 fs09"><?php echo T_("Enter fill all data in English!"); ?></p>

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
    <div class="mb-2">
      <label for='country'><?php echo T_("Country"); ?></label>
      <select class="select22" name="country" id="country" data-model='country'>
        <option value=""><?php echo T_("Choose your country"); ?></option>
        <?php foreach (\dash\data::countryList() as $key => $value) {?>
          <option value="<?php echo $key; ?>" > <?php echo a($value, 'name'); if(\dash\language::current() !== 'en') { echo ' - '. T_(ucfirst(a($value, 'name'))); } ?></option>
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




    <label for="address"><?php echo T_("Address"); ?> <small class="text-gray-400"><?php echo T_("Enter in Latin characters"); ?></small></label>
    <textarea class="txt ltr mb-2" name="address" id="address" maxlength='300' rows="1"></textarea>

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

    <p class="text-gray-400"><?php
  echo T_("By clicking Create IRNIC Handle, you are indicating that you have read the :nic and agree to the :terms.",
    [
      'nic' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms/irnic">'. T_('IRNIC agreement') .'</a>',
      'terms' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms">'. T_('Jibres Terms of Service') .'</a>'
    ])
?></p>


    <div class="txtRa">
     <button class="btn-success"><?php echo T_("Create IRNIC handle"); ?></button>
    </div>
   </form>
  </div>
<?php } //ENDIF // the IRNIC disable create contact from api :) Date: 2020-06-22 ?>

  <?php }else{ ?>




   <div class="box p-4">
    <form method="post" autocomplete="off">
     <label for="ioldcontact"><?php echo T_("IRNIC Handle"); ?></label>
     <div class="input ltr">
      <input type="text" name="oldcontact" id="ioldcontact">
     </div>
     <p class="text-gray-400"><?php echo T_('Please enter your IRNIC handle that registerd on nic.ir'); ?></p>
     <p class="text-gray-400"><?php echo T_("If you don't know about IRNIC, you can register via Jibres or directly on nic.ir website."); ?> <a href="<?php echo \dash\url::current(); ?>?type=new"><?php echo T_('Register IRNIC handle'); ?></a></p>

     <div class="txtRa">
      <button class="btn-success"><?php echo T_("Add IRNIC handle"); ?></button>
     </div>
    </form>
   </div>


  <?php } //endif ?>


 </div>
</div>

