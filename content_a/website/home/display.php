<nav class="items">
  <ul>
    <?php if(\dash\data::issetHeader()) {?>
      <li>
        <a class="f" href="<?php echo \dash\url::this();?>/header">
          <div class="key"><?php echo T_('Customize header');?></div>
          <div class="go"></div>
        </a>
      </li>
    <?php }else{ ?>
      <li>
        <a class="f" href="<?php echo \dash\url::this();?>/header">
          <div class="key"><?php echo T_('Choose header');?></div>
          <div class="go"></div>
        </a>
      </li>
    <?php } ?>
     </ul>
</nav>


<?php require_once(root. 'content_a/website/body/display.php'); ?>


<nav class="items">
  <ul>

    <?php if(\dash\data::issetFooter()) {?>
      <li>
        <a class="f" href="<?php echo \dash\url::this();?>/footer">
          <div class="key"><?php echo T_('Customize footer');?></div>
          <div class="go"></div>
        </a>
      </li>
    <?php }else{ ?>
      <li>
        <a class="f" href="<?php echo \dash\url::this();?>/footer">
          <div class="key"><?php echo T_('Choose footer');?></div>
          <div class="go"></div>
        </a>
      </li>
    <?php } ?>
      </ul>
</nav>
