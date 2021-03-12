<section class="f" data-option='domain-history'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Domain action history");?></h3>
      <div class="body">

      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn primary" href="<?php echo \dash\url::that(). '/action?domain='. \dash\request::get('domain') ?>"><?php echo T_("Manage Lock domain") ?></a>
      </div>
  </div>
</section>
