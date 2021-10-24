<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}


?>
<div class="avand-md">
  <form method='post' data-patch>
    <input type="hidden" name="setsort" value="1">
    <?php echo \lib\app\category\get::sort_list(); ?>
  </form>

  <form method="post" autocomplete="off">
    <input type="hidden" name="addcategory" value="1">
    <div class="box">
      <div class="pad">
        <p>
          <?php echo T_("By adding category to list you can sort it and set one category as child of another") ?>
        </p>
       <div>
        <select name="category" class="select22" data-model='tag' data-placeholder="<?php echo T_("Choose category"); ?>" data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::kingdom(). '/a/category/api'; ?>?json=true&getid=1'>
        </select>
       </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
    </div>
  </form>

</div>