
<section class="f" data-option='master-domain'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Master domain");?></h3>
      <div class="body">
        <p><?php echo T_("Choose the main domain of your business. With it, other domains connected to your business will be transferred to this domain");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="master" value="master">
    <div class="action">
      <select name="masterdomain" class="select22" data-placeholder='<?php echo T_("Please choose one domain as master") ?>'>
        <option value="" readonly><?php echo T_("Please choose one domain as master") ?></option>
        <?php foreach (\dash\data::domainList() as $key => $value) {?>
            <option value="<?php echo \dash\get::index($value, 'domain'); ?>" <?php if(\dash\get::index($value, 'master')) { echo "selected";} ?>><?php echo \dash\get::index($value, 'domain') ?></option>
        <?php } ?>
      </select>
    </div>
  </form>
</section>




<section class="f" data-option='default-redirect-to-master'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Redirect all domain to master");?></h3>
      <div class="body">
        <p><?php echo T_("Enable these settings if you want to route all business domain independently");?></p>
        <?php if(!\dash\data::redirectAllDomainToMaster()) { ?>
          <div class="msg minimal warn2"><?php echo T_("Be careful in this case you are at risk in terms of content and SEO") ?></div>
        <?php }else{ ?>
          <div class="msg minimal success2"><?php echo T_("All sites linked to your business will be redirected to the main domain") ?></div>
        <?php } // endif ?>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="redirect" value="redirect">
    <div class="action">
        <div class="switch1">
          <input id="redirect_all_domain_to_master" type="checkbox" name="redirect_all_domain_to_master" <?php if(\dash\data::redirectAllDomainToMaster()) {echo 'checked';} ?>>
          <label for="redirect_all_domain_to_master"></label>
        </div>
    </div>
  </form>
</section>
