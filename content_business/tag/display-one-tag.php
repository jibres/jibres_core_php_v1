<div class="avand category">
    <div class="box">
      <div class="pad">
        <a href="<?php echo \dash\url::kingdom(). '/tag'; ?>"><?php echo T_("Tags") ?></a>
        <?php if(\dash\data::dataRow_parent() && is_array(\dash\data::dataRow_parent())) {?>
          <?php foreach (\dash\data::dataRow_parent() as $key => $value) { echo ' / '; ?>
          <a href="<?php echo a($value, 'url') ?>"><?php echo a($value, 'title') ?></a>
        <?php } //endfor ?>
      <?php } //endif ?>
    </div>
  </div>
  <div class="box">
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
<?php
if(\dash\data::productList())
{
  \lib\website::product_list(\dash\data::productList(), 2);
  \dash\utility\pagination::html();
}
?>
</div>