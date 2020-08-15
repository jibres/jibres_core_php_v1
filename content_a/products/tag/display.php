<div class="row">
  <div class="c-xs-12 c-sm-4 c-md-4">
    <form method="post" autocomplete="off">
      <div class="box">
        <div class="body">



          <label for='ftitle'><?php echo T_("Title"); ?> <small class="fc-red">* <?php echo T_("Require"); ?></small></label>
          <div class="input">
            <input type="text" name="title" placeholder='<?php echo T_("Title"); ?> *' value="<?php echo \dash\data::datarow_title(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='100' minlength="1" pattern=".{1,100}" title='<?php echo T_("Title is used to show on website"); ?>' id='ftitle' required>
          </div>

          <label for='fslug'><?php echo T_("Slug"); ?> <small><?php echo T_("Used for url"); ?></small></label>
          <div class="input ltr">
            <input type="text" name="slug" placeholder='<?php echo T_("Slug"); ?>' value="<?php echo \dash\data::datarow_slug(); ?>" maxlength='50' minlength="1" pattern=".{1,50}" title='<?php echo T_("Used in url for categorize addresses"); ?>' id='fslug'>
          </div>

          <div class="mB10">
            <label for='fdesc'><?php echo T_("Description"); ?></label>
            <textarea class="txt" name="desc" rows="3" placeholder='<?php echo T_("Description"); ?>' id='fdesc'><?php echo \dash\data::datarow_desc(); ?></textarea>
          </div>

        </div>
        <footer class="f">
          <?php if(\dash\data::editMode()) {?>
          <div class="cauto">  <div class="btn linkDel" data-confirm  data-data='{"remove": "remove"}'><?php echo T_("Remove"); ?></div></div>
          <?php } //endif ?>
          <div class="c"></div>
          <div class="cauto"><button class="btn master"><?php if(\dash\data::editMode()) { echo T_("Edit"); } else { echo T_("Add"); } ?></button></div>

        </footer>
      </div>



    </form>

  </div>
  <div class="c-xs-12 c-sm-8 c-md-8">


<?php
if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlTable();
    htmlFilter();

  }
  else
  {

    htmlSearchBox();
    htmlTable();
  } //endif

}
else
{
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlFilterNoResult();

  }
  else
  {

    htmlStartAddNew();

  } //endif
} //endif
?>

</div>
</div>






<?php function htmlSearchBox() {?>
  <div class="fs14 mB20">
    <form method="get" data-action>
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" <?php \dash\layout\autofocus::html() ?>  autocomplete='off'>
        <button class="addon btn "><?php echo T_("Search"); ?></button>
      </div>
    </form>
  </div>
<?php }// endfunction ?>


<?php function htmlTable() {?>

  <?php
  $sortLink = \dash\data::sortLink();
  $dataTable = \dash\data::dataTable();
  if(!is_array($dataTable))
  {
    $dataTable = [];
  }
  ?>

  <table class="tbl1 v1 ">
    <thead>
      <tr class="">
        <th><?php echo T_("Title"); ?></th>
        <th><?php echo T_("Slug"); ?></th>
        <th><?php echo T_("Description"); ?></th>
        <th><?php echo T_("Used"); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

        <tr>
          <td><a href="<?php echo \dash\url::that(); ?>?edit=<?php echo \dash\get::index($value, 'id'); ?>">
            <i class="sf-edit"></i>

            <?php echo \dash\get::index($value, 'title'); ?></a></td>

            <td class="fs08"><a href="<?php echo \lib\store::url(); ?>/tag/<?php echo \dash\get::index($value, 'slug'); ?>" target="_blank"><span class="sf-share"></span> <?php echo \dash\get::index($value, 'slug'); ?></a></td>

            <td><?php echo \dash\get::index($value, 'desc'); ?></td>


            <td class="collapsing txtC"><?php if(isset($value['count']) && $value['count']) {?><a target="_blank" href="<?php echo \dash\url::here(); ?>/products?tagid=<?php echo \dash\get::index($value, 'id'); ?>"><?php echo \dash\fit::number($value['count']). ' '. T_("Product") ?></a><?php }else{ echo '-';} ?></td>

          </tr>
        <?php } //endfor ?>
      </tbody>
    </table>

    <?php \dash\utility\pagination::html(); ?>
  <?php }// endfunction ?>







  <?php function htmlFilter() {?>
    <p class="f fs14 msg info2">
      <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
      <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
    </p>
  <?php }// endfunction ?>


  <?php function htmlFilterNoResult() {?>
    <p class="f fs14 msg warn2">
      <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
      <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
    </p>
  <?php }// endfunction ?>


  <?php function htmlStartAddNew() {?>
    <p class="fs14 msg success2"><?php echo T_("Hi!"); ?> <?php echo T_("Try to start with add new records!"); ?></p>
  <?php }// endfunction ?>

