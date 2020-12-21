<?php $lineSetting = \dash\data::lineSetting(); ?>
<?php require_once(root. 'content_a/website/display-title.php') ?>

<section class="f" data-option='website-line-news-filter'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set filter");?></h3>
      <div class="body">
        <p><?php echo T_("You can extract your favorite posts with different filters");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <a class="btn master" href="<?php echo \dash\url::that(). '/filter'. \dash\request::full_get(); ?>"><?php echo T_("Set filter") ?></a>
      </div>
  </div>
</section>

<?php require_once(root. 'content_a/website/display-item-title.php') ?>
<?php require_once(root. 'content_a/website/display-limit.php') ?>

<section class="f" data-option='website-line-news-template-show'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Set template show");?></h3>
      <div class="body">
        <p><?php echo T_("Change your post template view");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_template" value="1">
      <div class="action">
        <select name="template" class="select22" id="template">
          <option value="0"><?php echo T_("Default") ?></option>
          <option value="simple" <?php if(a($lineSetting, 'template') == 'simple') { echo 'selected'; } ?> ><?php echo T_("Simple") ?></option>
          <option value="special" <?php if(a($lineSetting, 'template') == 'special') { echo 'selected'; } ?> ><?php echo T_("Special") ?></option>
        </select>
      </div>
  </form>
</section>

<section class="f" data-option='website-line-news-remove'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Remove news line");?></h3>
      <div class="body">
        <p><?php echo T_("Are you sure to remove this news line?");?></p>
      </div>
    </div>
  </div>
  <div class="c4 s12">
      <div class="action">
        <div data-confirm data-data='{"remove": "line", "edit_line" : "setting", "id": "<?php echo \dash\request::get('id'); ?>"}' class="btn danger"><?php echo T_("Remove"); ?></div>
      </div>
  </div>
</section>