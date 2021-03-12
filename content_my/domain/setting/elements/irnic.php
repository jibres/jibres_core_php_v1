<section class="f" data-option='domain-irnic'>
<?php if(\dash\data::domainDetail_verify()){ ?>
  <div class="c8 s12">
<?php } else {?>
  <div class="c12">
<?php } ?>
    <div class="data">
      <h3><?php echo T_("Domain Holders");?></h3>
      <div class="body">
        <p><?php echo T_("Check detail of domain holders for IRNIC.");?></p>
      </div>
    </div>
  </div>
<?php if(\dash\data::domainDetail_verify()){ ?>
  <div class="c4 s12">
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(). '/holder?domain='. \dash\request::get('domain') ?>"><?php echo T_("Manage Domain Holders") ?></a>
    </div>
  </div>
<?php } ?>


  <table class="tbl1 minimal">
    <thead>
      <tr>
        <th><?php echo T_("Type"); ?></th>
        <th><?php echo T_("Handle"); ?></th>
        <th class="collapsing s0"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo T_("IRNIC holder"); ?></td>
        <td class="ltr"><?php echo \dash\data::domainDetail_holder(); ?></td>
        <td class="collapsing s0"></td>
      </tr>
      <tr>
        <td><?php echo T_("IRNIC admin"); ?></td>
        <td class="ltr"><?php echo \dash\data::domainDetail_admin(); ?></td>
        <td class="collapsing s0"></td>
      </tr>
      <tr>
        <td><?php echo T_("IRNIC billing"); ?></td>
        <td class=""><span class="compact"><?php echo \dash\data::domainDetail_bill(); ?></span></td>
<?php if(\dash\data::domainDetail_bill() === 'ji128-irnic') { ?>
        <td class="collapsing s0 txtRa"><img src="<?php echo \dash\url::logo(); ?>" alt="<?php echo T_("Jibres"); ?>"></td>
<?php } else { ?>
      <td class="collapsing s0"></td>
<?php } ?>
      </tr>
      <tr>
        <td><?php echo T_("IRNIC technical"); ?></td>
        <td><span class="compact"><?php echo \dash\data::domainDetail_tech(); ?></span></td>
<?php if(\dash\data::domainDetail_tech() === 'ji128-irnic') { ?>
        <td class="collapsing s0 txtRa"><img src="<?php echo \dash\url::logo(); ?>" alt="<?php echo T_("Jibres"); ?>"></td>
<?php } else { ?>
        <td class="collapsing s0"></td>
<?php } ?>
      </tr>
      <tr>
        <td><?php echo T_("IRNIC Reseller"); ?></td>
        <td><span class="compact"><?php echo \dash\data::domainDetail_reseller(); ?></span></td>
<?php if(\dash\data::domainDetail_reseller() === 'ji128-irnic') { ?>
        <td class="collapsing s0 txtRa"><img src="<?php echo \dash\url::logo(); ?>" alt="<?php echo T_("Jibres"); ?>"></td>
<?php } else { ?>
        <td class="collapsing s0"></td>
<?php } ?>
      </tr>

    </tbody>
  </table>
  <footer>
    <div class="row" data-space='high'>
      <div class="c-auto">
        <a class="link" target="_blank" href="<?php echo \dash\url::kingdom(). '/whois/'. \dash\data::domainDetail_name() ?>"><?php echo T_("Check Whois"); ?> <i class="sf-link-external"></i></a>
      </div>
      <div class="c"></div>
      <div class="c-auto">
        <a class="link" target="_blank" href="<?php echo \dash\url::support(); ?>"><?php echo T_("Help") ?> <i class="sf-link-external"></i></a>
      </div>
    </div>
  </footer>
</section>
