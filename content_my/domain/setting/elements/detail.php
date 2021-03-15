<section class="f" data-option='domain-detail'>
  <div class="c12">
    <div class="data">
      <div class="ltr txtL">
        <div class="row align-center fit">
          <div class="c"><h2 class="mB0-f txtB"><?php echo \dash\data::domainDetail_name();?></h2></div>
          <div class="c-auto"><a target="_blank" data-direct href="https://<?php echo \dash\data::domainDetail_name() ?>" rel="nofollow noopener"><?php echo T_("Visit Domain"); ?> <i class="sf-link-external"></i></a></div>
        </div>
      </div>
      <?php if(\dash\data::tempPeriod()) {?>
        <div class="font-12"><?php echo T_("You registered this domain for :val.", ['val' => \dash\data::tempPeriod()]). ' '. T_("After approved domain by IRNIC your domain expire date will be updated"); ?></div>
        <?php }//endif ?>
    </div>
  </div>
  <table class="tbl1 minimal">
    <thead>
      <tr>
        <th><?php echo T_("Status & Validity"); ?></th>
        <th class="ltr"><?php echo \dash\data::domainDetail_status_text(); ?></th>
      </tr>
    </thead>
    <tbody>
      <tr>
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
          <td><time class="ltr"><?php echo \dash\fit::date_time(\dash\data::domainDetail_dateregister()); ?></time></td>
        </tr>
      <?php } //endif ?>

      <?php if(\dash\data::domainDetail_dateexpire()) {?>
        <tr>
          <td><?php echo T_("Expired on"); ?></td>
          <td>
            <time class="ltr"><?php echo \dash\fit::date_time(\dash\data::domainDetail_dateexpire()); ?></time>
<?php if(\dash\data::domainDetail_can_renew()) {?>
            <a class="link mLa10" href="<?php echo \dash\url::this(). '/renew?domain='. \dash\request::get('domain'); ?>"><?php echo T_("Renew") ?></a>
<?php } //endif ?>
          </td>
        </tr>
      <?php } //endif ?>


      <?php if(\dash\data::domainDetail_datemodified()) {?>
        <tr>
          <td><a href="<?php echo \dash\url::that(). '/action?domain='. \dash\request::get('domain') ?>"><?php echo T_("Last activity"); ?></a></td>
          <td><time class="ltr"><?php echo \dash\fit::date_time(\dash\data::domainDetail_datemodified()); ?></time></td>
        </tr>
      <?php } //endif ?>

    </tbody>
  </table>
</section>