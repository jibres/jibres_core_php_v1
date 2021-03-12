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
        <td><?php echo T_("Status & Validity"); ?></td>
        <td class="ltr"><?php echo \dash\data::domainDetail_status_text(); ?></td>
      </tr>

      <?php if(\dash\data::domainDetail_registrar()) {?>
        <tr>
          <td><?php echo T_("Registrar"); ?></td>
          <td class="ltr"><?php echo T_(ucfirst(\dash\data::domainDetail_registrar())); ?></td>
        </tr>
      <?php } //endif ?>

      <?php if(\dash\data::domainDetail_dateregister()) {?>
        <tr>
          <td><?php echo T_("Registered on"); ?></td>
          <td class="ltr"><?php echo \dash\fit::date(\dash\data::domainDetail_dateregister()); ?></td>
        </tr>
      <?php } //endif ?>

      <?php if(\dash\data::domainDetail_dateexpire()) {?>
        <tr>
          <td><?php echo T_("Expired on"); ?></td>
          <td class="ltr"><?php echo \dash\fit::date(\dash\data::domainDetail_dateexpire()); ?></td>
        </tr>
      <?php } //endif ?>

      <?php if(\dash\data::domainDetail_datemodified()) {?>
        <tr>
          <td><?php echo T_("Last activity"); ?></td>
          <td class="ltr"><?php echo \dash\fit::date(\dash\data::domainDetail_datemodified()); ?></td>
        </tr>
      <?php } //endif ?>

    </tbody>
  </table>
</section>