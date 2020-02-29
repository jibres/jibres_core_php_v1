

<div class="f justify-center">
 <div class="c6 m8 s12">
  <div class="cbox">


    <form method="post" autocomplete="off">

    <div class="input ltr">
        <input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\request::get('domain'); ?>">
    </div>

    <label><?php echo T_("Choose register time"); ?></label>

    <div class="f mB10">
      <div class="c pB10 pRa5">
       <div class="radio3">
      <input type="radio" name="period" value="1year" id="period1year">
      <label for="period1year"><?php echo T_("1 Year"); ?> <span> <?php echo \lib\app\nic_domain\price::renew_string("1year"); ?> </span></label>
       </div>
      </div>
      <div class="c pB10">
       <div class="radio3">
      <input type="radio" name="period" value="5year" id="period5year">
      <label for="period5year"><?php echo T_("5 Year"); ?> <span> <?php echo \lib\app\nic_domain\price::renew_string("5year"); ?> </span></label>
       </div>
      </div>
    </div>


<div class="check1 mT20">
  <input type="checkbox" id="sChk1" name="agree">
  <label for="sChk1"><?php
  echo T_("By clicking Register, you are indicating that you have read the :nic and agree to the :terms.",
    [
      'nic' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms/irnic">'. T_('IRNIC agreement') .'</a>',
      'terms' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms">'. T_('Jibres Terms of Service') .'</a>'
    ])
?></label>

    <div class="txtRa mT10">
     <button class="btn success"><?php echo T_("Renew Domain"); ?></button>
    </div>

   </form>


  </div>
 </div>
</div>
