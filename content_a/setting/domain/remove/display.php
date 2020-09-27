<?php $ifmaster = (\dash\data::masterDomain_domain() === \dash\request::get('domain') && is_array(\dash\data::domainList()) && count(\dash\data::domainList()) > 2); ?>
<div class="avand-lg">
  <input type="hidden" name="setting" value="setting">
  <div class="box">
    <div class="body">
      <?php if($ifmaster) {?>
        <div class="msg success2 minimal"><?php echo T_("Add this time your business master domain set on this domain") ?></div>

        <form class="c4 s12" method="post" data-patch>
          <input type="hidden" name="master" value="master">
          <div class="action">
            <label><?php echo T_("You must set master domain on another domain to remove it") ?></label>
            <select name="masterdomain" class="select22" data-placeholder='<?php echo T_("Please choose one domain as master") ?>'>
              <option value="" readonly><?php echo T_("Please choose one domain as master") ?></option>
              <?php foreach (\dash\data::domainList() as $key => $value) {?>
                <option value="<?php echo \dash\get::index($value, 'domain'); ?>" <?php if(\dash\get::index($value, 'master')) { echo "selected";} ?>><?php echo \dash\get::index($value, 'domain') ?></option>
              <?php } ?>
            </select>
          </div>
        </form>
      <?php }else{ ?>
        <p><?php echo T_("Remove domain from your business") ?></p>
        <div class="msg danger2 minimal"><?php echo T_("You are trying to remove domain :domain from your business", ['domain' => '<b>'. \dash\data::domainDetail_domain(). '</b>']) ?></div>
        <p class="fc-red"><?php echo T_("If you sure to want to remove this domain from your business click the below button") ?></p>
      <?php } //endif ?>
    </div>
    <footer class="f">
      <div class="c"></div>
      <?php if($ifmaster) {?>
        <div class="cauto"><button class="btn linkDel disabled" ><?php echo T_("Change master domain first") ?></button></div>
      <?php }else{ ?>
        <div class="cauto"><button class="btn linkDel" data-confirm data-data='{"removedomain" : "removedomain"}'><?php echo T_("Remove domain") ?></button></div>
      <?php } //endif ?>
    </footer>
  </div>
</div>