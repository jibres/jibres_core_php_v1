<?php $categoryDataTable = \dash\data::categoryDataTable(); ?>
<?php if($categoryDataTable) {?>
<div class="avand category">
    <div class="row">
      <?php foreach ($categoryDataTable as $key => $value) {?>
        <div class="c-xs-6 c-sm-6 c-md-4 c-lg-4 c-xl-3 c-xxl-2">
          <div class="roundedBox"<?php if(a($value, 'file_default') === true) { echo ' data-gr="'.rand(1, 20).'"';} ?>>
            <a class="overlay"<?php if(a($value, 'url')) { echo ' href="'.  a($value, 'url'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
              <figure>
                <img src="<?php echo a($value, 'file'); ?>" alt="<?php echo a($value, 'title'); ?>">
                <figcaption><h2><?php echo a($value, 'title'); ?></h2></figcaption>
              </figure>
            </a>
          </div>
        </div>
      <?php } //endif ?>
    </div>
    <?php \dash\utility\pagination::html(); ?>
</div>
<?php }else{ ?>
  <div class="avand-sm">
    <div class="msg warn2 txtC"><?php echo T_("No tags founded!") ?></div>
  </div>
<?php } //endif ?>