
<div class="msg info2 fs16"><?php echo T_("Please set general detail about your website."); ?></div>

<div class="setupGuide">
 <header><?php echo T_("Website Setup Progress"); ?></header>
 <section>
  <div class="f">
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_logo()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/logo"><?php echo T_('Website Header');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_splash()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/splash"><?php echo T_('Website Body');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_title()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/title"><?php echo T_('Website Footer');?></a></div>
   <div class="c"><a class="item <?php if(\dash\data::setupGuide_intro()) { echo 'complete'; } ?>" href="<?php echo \dash\url::this();?>/intro"><?php echo T_('Publish');?></a></div>
  </div>
 </section>
</div>

<div class="welcome">
  <p><?php echo T_("Easily Create your store website"); ?></p>
  <h2><?php echo T_("Create a custom website for your store"); ?></h2>

  <div class="buildBtn">
    <a class="btn xl master" href="<?php echo \dash\url::this(); ?>/header?setup=wizard"><?php echo T_("Let's Go"); ?></a>
  </div>
</div>




<div class="f">


  <div class="c4 x3 s12">
   <nav class="items">
     <ul>
       <li>
        <a class="f" href="<?php echo \dash\url::this();?>/menu">
          <div class="key"><?php echo T_('Menu');?></div>
          <div class="go"></div></a>
       </li>
       <?php if(\dash\data::issetHeader()) {?>
         <li>
          <a class="f" href="<?php echo \dash\url::this();?>/header/customize">
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
          <a class="f" href="<?php echo \dash\url::this();?>/footer/customize">
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
  </div>
</div>

