

<div class="avand-md">
  <div class="msg fs14"><?php echo T_("Select any of the menu items you want and move them to sort") ?></div>
<form method="post" data-patch>

    <nav class="items">
     <ol data-sortable2>

    <?php foreach (\dash\data::menuDetailList() as $key => $value) {?>
       <li>
        <a class="f item">
          <i class="sf-thumbnails" data-handle>
            <input type="hidden" name="sort[]" value="<?php echo $key; ?>">
          </i>
          <div class="key"><?php echo a($value, 'title');?><?php if(a($value, 'target')) {?><i class="sf-external-link fc-mute"></i> <?php }// endif ?></div>
        </a>
       </li>

    <?php } //enfor ?>
     </ol>
   </nav>
</form>
</div>

