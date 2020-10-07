

<div class="avand-md">
  <div class="msg fs14"><?php echo T_("Select any of the menu items you want and move them to sort") ?></div>
<form method="post">

    <nav class="items">
     <ul class="sortable" data-sortable>

    <?php foreach (\dash\data::menuDetailList() as $key => $value) {?>
       <li data-handle>
        <a class="f item">
          <i class="sf-sort" >
            <input type="hidden" name="sort[]" value="<?php echo $key; ?>">
          </i>
          <div class="key"><?php echo \dash\get::index($value, 'title');?>
            <?php if(\dash\get::index($value, 'target')) {?><i class="sf-external-link fc-mute"></i> <?php }// endif ?>
          </div>

        </a>
       </li>

    <?php } //enfor ?>
     </ul>
   </nav>
</form>
</div>

