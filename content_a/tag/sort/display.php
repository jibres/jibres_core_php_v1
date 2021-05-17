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
    <?php echo \lib\app\tag\get::sort_list(); ?>
  </form>
  <?php if(\dash\data::listProductTag()) {?>
  <form method="post" autocomplete="off">
    <input type="hidden" name="addtag" value="1">
    <div class="box">
      <div class="pad">
       <div>
        <select name="tag" class="select22" data-model='tag' data-placeholder="<?php echo T_("Tag"); ?>" >
           <option></option>
          <?php foreach (\dash\data::listProductTag() as $key => $value) {?>
          <option value="<?php echo a($value, 'id'); ?>"><?php echo a($value, 'title'); ?></option>
         <?php } //endfor ?>
        </select>
       </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Add") ?></button>
      </footer>
    </div>
  </form>
<?php }//endif ?>
</div>