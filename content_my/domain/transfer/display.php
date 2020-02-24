
<?php if(!\dash\data::myDomain()) {?>

<div class="cbox">

 <form class="domainSearchBox" action='<?php echo \dash\url::current() ?>' method='get' autocomplete='off'>
   <h4 class="txtC"><?php echo T_('Enter domain to transfer'); ?></h4>
  <div class="input ltr">
   <input type="text" name="q" id='domainFirstSearch' maxlength='63' value="<?php echo \dash\request::get('q'); ?>" autocomplete='off'>
   <button class="addon btn primary"><?php echo T_('Search'); ?></button>
  </div>
 </form>

</div>


<?php }else{ ?>

<div class="f justify-center">
    <div class="c6 m8 s12">
        <div class="cbox">

            <form method="post" autocomplete="off" class="mB20" >
                <input type="hidden" name="domain" value="<?php echo \dash\data::myDomain() ?>">
                <div class="msg ltr txtB fs14"><?php echo \dash\data::myDomain() ?></div>
                  <label for="irnicid"><?php echo T_("IRNIC contact admin"); ?></label>

                  <div class="f mB10">
                    <?php foreach (\dash\data::myContactList() as $key => $value) {?>
                      <div class="c6 s12 pRa5">
                          <div class="radio3">
                            <input type="radio" name="irnicid" value="<?php echo \dash\get::index($value, 'nic_id'); ?>" id="ir-<?php echo \dash\get::index($value, 'nic_id'); ?>">
                            <label for="ir-<?php echo \dash\get::index($value, 'nic_id'); ?>"><?php echo \dash\get::index($value, 'nic_id'); ?></label>
                          </div>
                      </div>
                    <?php } //endfor ?>

                    <div class="c6 s12 pRa5">
                          <div class="radio3">
                            <input type="radio" name="irnicid" value="something-else" id="ir-something-else">
                            <label for="ir-something-else"><?php echo T_("Something else") ?></label>
                          </div>
                      </div>
                </div>

                <div data-response='irnicid' data-response-where='something-else' data-response-hide>
                    <label for="irnicid"><?php echo T_("IRNIC id"); ?> <small><a href="<?php echo \dash\url::this() ?>/irnic/add?type=new" target="_blank" ><?php echo T_("Create new contact"); ?></a></small></label>
                    <div class="input">
                        <input type="text" name="irnicid-other" id="irnicid" maxlength="100">
                    </div>
                </div>



                <label for="ips"><?php echo T_("Transfer code"); ?></label>
                <div class="input ltr">
                    <input type="text" name="pin"  id="ips" maxlength="100">
                </div>

                <div class="check1">
                  <input type="checkbox" name="agree" id="agree">
                  <label for="agree"><?php echo T_("I have read and agree to the terms and conditions"); ?> <small><a target="_blank" href="https://www.nic.ir/Domain_Register_Policy.html"><?php echo T_("Show terms"); ?></a></small></label>
                </div>

                <div class="txtRa">
                    <button class="btn success"><?php echo T_("Transfer"); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php } //endif ?>