
<div class="avand-md">
  <nav class="items">
    <ul>
      <li><a class="f" target="_blank" href="<?php echo \dash\url::kingdom(); ?>/my/domain/buy"><div class="key"><i class="sf-asterisk fc-hot"></i> <?php echo T_("Buy new domain"); ?></div><div class="go"></div></a></li>
    </ul>
  </nav>
</div>
<?php if(\dash\data::myDomainList()) {?>

<div class="avand-md">
  <nav class="items">
    <ul>
      <?php foreach (\dash\data::myDomainList() as $key => $value) {?>
      <li><a class="f" href="<?php echo \dash\url::that(). '/existdomain?domain='. \dash\get::index($value, 'name'); ?>"><div class="key"><?php echo \dash\get::index($value, 'name'); ?></div><div class="go"></div></a></li>
    <?php } //endfor ?>
    </ul>
  </nav>
</div>
<?php } //endif ?>

<div class="avand-md">
  <nav class="items">
    <ul>
      <li><a class="f" href="<?php echo \dash\url::that(); ?>/existdomain"><div class="key"><?php echo T_("Connect existing domain"); ?></div><div class="go"></div></a></li>
    </ul>
  </nav>
</div>
