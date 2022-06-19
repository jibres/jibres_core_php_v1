<?php $masterdomain = null; ?>
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
            <option value="<?php echo a($value, 'domain'); ?>" <?php if(a($value, 'master')) { $masterdomain = a($value, 'domain'); echo "selected";} ?>><?php echo a($value, 'domain') ?></option>
        <?php } ?>
      </select>
    </div>
  </form>
</section>

<?php if($masterdomain) {?>
<section class="f" data-option='redirect-subdomain-to-domain'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Redirect jibres subdomain to business master domain");?></h3>
      <div class="body">
        <p><?php echo T_("Turn's on to redirect all requests from the Jibres subdomain to your website's primary domain."); ?></p>
        <div class="msg minimal <?php if(\dash\data::redirectJibresSubdomainToMaster()) { echo "success2";}  ?> ltr mb-0 mt-4 row">
          <div class="c-xs-12 c-5"><?php $domain = (\dash\url::tld() === 'com') ? 'jibres.store': 'jibres.store'; echo \lib\store::detail('subdomain').'.'. $domain; ?></div>
          <div class="c-xs-12 c-2 text-center"> <i class="sf-chevron-right"></i><i class="sf-chevron-right"></i><i class="sf-chevron-right"></i> </div>
          <div class="c-xs-12 c-5 text-right"><b><?php echo $masterdomain; ?></b></div>
        </div>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="redirectsubdomain" value="redirectsubdomain">
    <div class="action">
        <div class="switch1">
          <input id="redirect_jibres_subdomain_to_master" type="checkbox" name="redirect_jibres_subdomain_to_master" <?php if(\dash\data::redirectJibresSubdomainToMaster()) {echo 'checked';} ?>>
          <label for="redirect_jibres_subdomain_to_master"></label>
        </div>
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
          <div class="alert-success"><?php echo T_("All sites linked to your business will be redirected to the main domain") ?></div>
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
<?php } //endif ?>