<div class="avand category">
  <?php if(!\dash\data::dataRow()) {  /* load all category detail*/ ?>
    <?php $categoryDataTable = \dash\data::categoryDataTable(); ?>

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
  <?php } //endif ?>

  <?php if(\dash\data::dataRow()) { /* load one category detail*/ ?>

    <?php if(\dash\detect\device::detectPWA()) {?>
      <div class="roundedBox mB25">
        <div class="overlay">
          <figure>
            <img src="<?php echo \dash\data::dataRow_file(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>">
            <figcaption><h2><?php echo \dash\data::dataRow_title(); ?></h2></figcaption>
          </figure>
        </div>
        <?php if(\dash\data::dataRow_desc()) { ?>
          <div><?php echo \dash\data::dataRow_desc(); ?></div>
        <?php } ?>
      </div>
    <?php } else { ?>
      <div class="box">
        <div class="pad">

          <a href="<?php echo \dash\url::kingdom(). '/tag'; ?>">
            <?php echo T_("Tags") ?>
          </a>
          <?php if(\dash\data::dataRow_parent() && is_array(\dash\data::dataRow_parent())) {?>
            <?php foreach (\dash\data::dataRow_parent() as $key => $value) { echo ' / '; ?>

            <a href="<?php echo a($value, 'url') ?>">
              <?php echo a($value, 'title') ?>
            </a>
          <?php } //endfor ?>

        <?php } //endif ?>
      </div>
    </div>
    <div class="box mB25-f">
      <div class="body">
        <div class="row">
          <div class="c-10 c-xs-12">
            <h2><?php echo \dash\data::dataRow_title(); ?></h2>
            <div><?php echo \dash\data::dataRow_desc(); ?></div>
          </div>
          <div class="c-2 c-xs-12">
            <img class="w300" src="<?php echo \dash\data::dataRow_file(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>">
          </div>
        </div>
      </div>
    </div>
    <?php if(\dash\data::dataRow_child() && is_array(\dash\data::dataRow_child())) {?>
        <div class="box">
          <div class="pad">
            <div class="row">

      <?php foreach (\dash\data::dataRow_child() as $key => $value) {?>

            <a  class="c-auto txtC" href="<?php echo a($value, 'url') ?>">
            <div>

              <img class="w100" src="<?php echo a($value, 'file') ?>" alt="<?php echo a($value, 'title') ?>">
            </div>
            <div class="txtC">
              <?php echo a($value, 'title') ?>
            </div>

            </a>


      <?php } //endif ?>
            </div>
          </div>
        </div>
    <?php } //endif ?>

  <?php } ?>



  <?php if(\dash\data::productList()) {?>
    <?php \lib\website::product_list(\dash\data::productList(), 2); ?>

    <?php \dash\utility\pagination::html(); ?>
  <?php } //endif ?>

<?php } //endif ?>
</div>