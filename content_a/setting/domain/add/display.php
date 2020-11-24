
<div class="avand-md">

  <div class="msg font-14">
    <?php echo T_("Enter the domain one of the available methods to connect the domain to your store") ?>
  </div>

  <nav class="items">
    <ul>
      <li><a class="f" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/my/domain/buy"><div class="key"><i class="sf-asterisk fc-hot"></i> <?php echo T_("Buy new domain"); ?></div><div class="go"></div></a></li>
    </ul>
  </nav>



  <nav class="items">
    <ul>
      <li><a class="f" href="<?php echo \dash\url::that(); ?>/existdomain"><div class="key"><?php echo T_("Connect existing domain"); ?></div><div class="go"></div></a></li>
    </ul>
  </nav>


  <?php if(\dash\data::myDomainList()) {?>

    <nav class="items">
      <ul>
        <li data-kerkere='.ShowMyDomainJibres'><a class="f"><div class="key"><?php echo T_("Connect your domain registered in Jibres"); ?></div><div class="go"></div></a></li>
      </ul>
    </nav>

    <nav class="items ShowMyDomainJibres" data-kerkere-content='hide'>
      <ul>
        <?php foreach (\dash\data::myDomainList() as $key => $value) {?>
          <li><a class="f" href="<?php echo \dash\url::that(). '/existdomain?domain='. \dash\get::index($value, 'name'); ?>"><div class="key"><?php echo \dash\get::index($value, 'name'); ?></div><div class="go"></div></a></li>
        <?php } //endfor ?>
      </ul>
    </nav>
  <?php } //endif ?>
</div>