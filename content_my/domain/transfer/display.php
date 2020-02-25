

<div class="f justify-center">
 <div class="c6 m8 s12">
  <div class="cbox">


    <form method="post" autocomplete="off">

    <div class="input ltr">
        <input type="text" name="domain" placeholder='<?php echo T_("Domain"); ?>' value="<?php echo \dash\request::get('domain'); ?>">
    </div>



<?php
if (\dash\data::myContactList())
{
?>
    <label for="irnicid"><?php echo T_("IRNIC Handle"); ?></label>
    <div class="f">
<?php
 foreach (\dash\data::myContactList() as $key => $value)
 {
?>
       <div class="c6 s12 pB5 pRa5">
        <div class="radio3">
       <input type="radio" name="irnicid" value="<?php echo \dash\get::index($value, 'nic_id'); ?>" id="ir-<?php echo \dash\get::index($value, 'nic_id'); ?>" <?php if(\dash\get::index($value, 'isdefault')) { echo 'checked';} ?>>
       <label for="ir-<?php echo \dash\get::index($value, 'nic_id'); ?>"><?php echo \dash\get::index($value, 'nic_id'); ?></label>
        </div>
       </div>
<?php
 }
?>
      <div class="c6 s12 pB5 pRa5">
        <div class="radio3">
        <input type="radio" name="irnicid" value="something-else" id="ir-something-else">
        <label for="ir-something-else"><?php echo T_("Another IRNIC Handle") ?></label>
        </div>
      </div>
    </div>
     <div data-response='irnicid' data-response-where='something-else' data-response-effect='slide' data-response-hide>
      <label for="irnicid"><?php echo T_("Enter Your new IRNIC Handle"); ?></label>
      <div class="input ltr">
       <input type="text" name="irnicid-new" id="irnicid" maxlength="15">
      </div>
     </div>

<?php
}
else
{
?>
      <label for="irnicid"><?php echo T_("IRNIC Handle"); ?> <a href="<?php echo \dash\url::this() ?>/irnic/add?type=new" target="_blank" ><?php echo T_("Don't have IRNIC Handle? Create one."); ?></a></label>
      <div class="input ltr">
       <input type="text" name="irnicid-new" id="irnicid" maxlength="15">
      </div>
<?php
}
?>


    <div class="input ltr mT20">
        <input type="text" name="code" placeholder='<?php echo T_("Transfer code"); ?>' >
    </div>



 <p class="fc-mute"><?php
  echo T_("By clicking Transfer, you are indicating that you have read the :nic and agree to the :terms.",
    [
      'nic' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms/irnic">'. T_('IRNIC agreement') .'</a>',
      'terms' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms">'. T_('Jibres Terms of Service') .'</a>'
    ])
?></p>

    <div class="txtRa mT10">
     <button class="btn success"><?php echo T_("Transfer Domain"); ?></button>
    </div>

   </form>


  </div>
 </div>
</div>
