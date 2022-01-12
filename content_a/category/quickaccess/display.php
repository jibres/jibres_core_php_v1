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
    <?php if($result = \lib\app\category\quickaccess::get_list()) {?>
      <ol class="items2" data-layer-limit="1" data-sortable>
        <?php foreach ($result as $key => $value) {?>
          <li>
            <div class="f item">
              <i class="sf-thumbnails sortHandle" data-handle>
                <?php echo \dash\utility\icon::svg('list', 'bootstrap', null, 'text-blue-500 h-6 w-6') ?>
                <input type="hidden" name="sort[]" value="<?php echo a($value, 'id') ?>">
              </i>
              <div class="key"><?php echo a($value, 'title') ?></div>
              <div class="value">
                <a href="<?php echo \dash\url::this(). '/edit?id='. a($value, 'id') ?>"><?php echo T_("Edit") ?></a>
              </div>
              <div class="value">

                <div data-ajaxify data-data='{"remove": "<?php echo a($value, 'id') ?>"}' href="'. $_option['editlink'] .'?'. \dash\request::build_query($editlink_args). '"><?php echo \dash\utility\icon::svg('trash', 'bootstrap', null, 'text-red-500 h-3 w-3 mt-2') ?></div>
              </div>
            </div>
          </li>
        <?php } //endif ?>
      </ol>
    <?php } // end if ?>
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