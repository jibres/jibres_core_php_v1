<section class="f" data-option='domain-detail'>
  <div class="c12">
    <div class="data ltr txtL">
      <div class="row align-center fit">
        <div class="c"><h2 class="mB0-f txtB"><?php echo \dash\data::domainDetail_name();?></h2></div>
        <div class="c-auto"><a target="_blank" data-direct href="https://<?php echo \dash\data::domainDetail_name() ?>" rel="nofollow noopener"><?php echo T_("Visit Domain"); ?> <i class="sf-link-external"></i></a></div>
      </div>
    </div>
  </div>
  <table class="tbl1 minimal">
    <thead>
      <tr>
        <th><?php echo T_("Type"); ?></th>
        <th><?php echo T_("Value"); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th><?php echo T_("Status & Validity"); ?></th>
        <td class="ltr"><?php echo \dash\data::domainDetail_status_text(); ?></td>
      </tr>

      <?php if(\dash\data::domainDetail_registrar()) {?>
        <tr>
          <th><?php echo T_("Registrar"); ?></th>
          <td class="ltr"><?php echo T_(ucfirst(\dash\data::domainDetail_registrar())); ?></td>
        </tr>
      <?php } //endif ?>

      <?php if(\dash\data::domainDetail_dateregister()) {?>
        <tr>
          <th><?php echo T_("Registered on"); ?></th>
          <td class="ltr"><time><?php echo \dash\fit::date_time(\dash\data::domainDetail_dateregister()); ?></time></td>
        </tr>
      <?php } //endif ?>

      <?php if(\dash\data::domainDetail_dateexpire()) {?>
        <tr>
          <th><?php echo T_("Expired on"); ?></th>
          <td class="ltr"><time><?php echo \dash\fit::date_time(\dash\data::domainDetail_dateexpire()); ?></time></td>
        </tr>
      <?php } //endif ?>

      <?php if(\dash\data::domainDetail_datemodified()) {?>
        <tr>
          <th><a href="<?php echo \dash\url::that(). '/action?domain='. \dash\request::get('domain') ?>"><?php echo T_("Last activity"); ?></a></th>
          <td class="ltr"><time><?php echo \dash\fit::date_time(\dash\data::domainDetail_datemodified()); ?></time></td>
        </tr>
      <?php } //endif ?>

    </tbody>
  </table>
</section>