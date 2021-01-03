<div class="avand">
  <div class="blogEx box">
  <?php
    if(\dash\data::dataRow_type() === 'post' || \dash\data::dataRow_type() === 'page')
    {
      require_once(core. '/layout/tools/display-post-view.php');
    }
    else
    {
      require_once(core. '/layout/tools/display-tag-view.php');
    }
  ?>
  </div>
</div>