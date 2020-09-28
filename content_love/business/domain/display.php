<section class="f">
  <div class="c pRa10">
    <a href="<?php echo \dash\url::current(). '/alllist' ?>" class="stat">
      <h3><?php echo T_("All Domains");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_all_domain());?></div>
    </a>
  </div>

  <div class="c pRa10">
    <a href="<?php echo \dash\url::current(). '/alllist?status=ok'; ?>" class="stat">
      <h3><?php echo T_("Connected domains");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_ok());?></div>
    </a>
  </div>

  <div class="c pRa10">
    <a href="<?php echo \dash\url::current(). '/alllist?status=pending'; ?>" class="stat">
      <h3><?php echo T_("Pending domain");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_pending());?></div>
    </a>
  </div>

  <div class="c pRa10">
    <a href="<?php echo \dash\url::current(). '/alllist?status=failed'; ?>" class="stat">
      <h3><?php echo T_("Cancel domain");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_failed());?></div>
    </a>
  </div>
  <div class="c3 s12">
    <a href="<?php echo \dash\url::current(). '/action'; ?>" class="stat">
      <h3><?php echo T_("Count action");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_action());?></div>
    </a>
  </div>
</section>

<section class="f">
  <div class="c9 s12 pRa10">
    <div id="chartdivactionday" class="box chart x210" data-hint1='Action lasy 30 days per date' data-abc='management/domainhomepage'></div>
  </div>
  <div class="c3 s12">
    <a href="<?php echo \dash\url::current(). '/alllist?addcdnpanel=yes'; ?>" class="stat">
      <h3><?php echo T_("Added to CDN panel");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_cdn_ok());?></div>
    </a>
    <a href="<?php echo \dash\url::current(). '/alllist?addcdnpanel=no'; ?>" class="stat">
      <h3><?php echo T_("Not added to CDN panel");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_cdn_nok());?></div>
    </a>
  </div>
</section>




<section class="f">
  <div class="c3 s6 pRa10">
    <a href="<?php echo \dash\url::current(). '/alllist?dns=resolved'; ?>" class="stat">
      <h3><?php echo T_("DNS resolved");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_dns_resolved());?></div>
    </a>
  </div>
  <div class="c3 s6 pRa10">
    <a href="<?php echo \dash\url::current(). '/alllist?dns=notresolved'; ?>" class="stat">
      <h3><?php echo T_("DNS not resolved");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_dns_notresolved());?></div>
    </a>
  </div>
  <div class="c3 s6 pRa10">
    <a href="<?php echo \dash\url::current(). '/alllist?https=request'; ?>" class="stat">
      <h3><?php echo T_("HTTPS request");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_https_request());?></div>
    </a>
  </div>
  <div class="c3 s6">
    <a href="<?php echo \dash\url::current(). '/alllist?https=requestok'; ?>" class="stat">
      <h3><?php echo T_("HTTPS OK");?></h3>
      <div class="val"><?php echo \dash\fit::stats(\lib\app\business_domain\dashboard::count_https_request_ok());?></div>
    </a>
  </div>
</section>


