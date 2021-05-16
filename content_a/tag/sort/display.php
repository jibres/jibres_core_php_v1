<?php
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}
?>
<div class="msg fs14"><?php echo T_("Select any of the tags you want and move them to sort") ?></div>


<div class="avand-md">
  <form method='post' data-patch>
    <input type="hidden" name="setsort" value="1">
    <?php echo \lib\app\menu\generate::admin($dataTable); ?>
  </form>
  <nav class="items">
    <ul>
      <li>
        <a class="f" href="<?php echo \dash\url::this(). '/add'. \dash\request::full_get(['firstlevel' => 1]); ?>">
          <div class="go plus ok"></div>
          <div class="key"><?php echo T_("Add new tag");?></div>
        </a>
      </li>
    </ul>
  </nav>
</div>