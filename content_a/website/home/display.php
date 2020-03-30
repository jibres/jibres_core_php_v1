
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
     </ul>
   </nav>
  </div>
</div>

