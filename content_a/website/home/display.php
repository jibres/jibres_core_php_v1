

<div class="f">


  <div class="c4 x3 s12">
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

        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/body">
            <div class="key"><?php echo T_('Choose body');?></div>
            <div class="go"></div>
          </a>
        </li>


        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/status">
            <div class="key"><?php echo T_('Site status');?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>


    <nav class="items">
      <ul>
        <li>
          <a class="f" href="<?php echo \dash\url::this();?>/menu">
            <div class="key"><?php echo T_('Menu');?></div>
            <div class="go"></div></a>
          </li>
        </ul>
      </nav>

      <nav class="items">
        <ul>
          <li>
            <a class="f" target="_blank" href="<?php echo \lib\store::url();?>">
              <div class="key"><?php echo T_('Show website');?></div>
              <div class="go"></div></a>
            </li>
          </ul>
        </nav>



        <nav class="items">
          <ul>
            <li><a class="f" href="<?php echo \dash\url::here(); ?>/setting/googleanalytics"><div class="key"><?php echo T_("Google analytics setting"); ?></div><div class="go"></div></a></li>
            <li><a class="f" href="<?php echo \dash\url::here(); ?>/setting/staticfile"><div class="key"><?php echo T_("Static file verify"); ?></div><div class="go"></div></a></li>
            <li><a class="f" href="<?php echo \dash\url::here(); ?>/setting/domain"><div class="key"><?php echo T_("Connect store to your domain"); ?></div><div class="go"></div></a></li>
          </ul>
        </nav>


      </div>
    </div>

