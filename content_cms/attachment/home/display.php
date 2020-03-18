
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
  }
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

  }

}
?>






<?php function htmlSearchBox() {?>
<div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::this(); ?>' >
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus autocomplete='off'>

      <?php if(\dash\request::get('type')) {?>

      <input type="hidden" name="type" value="<?php echo \dash\request::get('type'); ?>">

      <?php } // endif ?>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>
<?php } //endfunction ?>


<?php function htmlTable() {?>


<?php
$sortLink = \dash\data::sortLink();
$dataTable = \dash\data::dataTable();
if(!is_array($dataTable))
{
  $dataTable = [];
}

?>

  <table class="tbl1 v1 fs11 tblFiles">
    <thead>
      <tr>
        <th></th>
        <th data-sort="<?php echo \dash\get::index($sortLink, 'title', 'order'); ?>"><a href='<?php echo \dash\get::index($sortLink, 'title', 'link'); ?>'><?php echo T_("File Name"); ?></a></th>
        <th class="max-w200 s0 m0" data-sort="<?php echo \dash\get::index($sortLink, 'type', 'order'); ?>"><a href='<?php echo \dash\get::index($sortLink, 'type', 'link'); ?>'><?php echo T_("Type"); ?></a></th>
        <th class="max-w200" data-sort="<?php echo \dash\get::index($sortLink, 'size', 'order'); ?>"><a href='<?php echo \dash\get::index($sortLink, 'size', 'link'); ?>'><?php echo T_("Size"); ?></a></th>
        <th class="max-w200 s0" data-sort="<?php echo \dash\get::index($sortLink, 'date', 'order'); ?>"><a href='<?php echo \dash\get::index($sortLink, 'date', 'link'); ?>'><?php echo T_("Date"); ?></a></th>
      </tr>
    </thead>

    <tbody>

      <?php foreach ($dataTable as $key => $value) {?>

      <tr>
        <td class="thumb">
          <a href="<?php echo $value['path']; ?>" target="_blank">
            <?php if(isset($value['type']) && $value['type'] === 'image') {?>

            <img src="<?php echo \dash\get::index($value, 'path'); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">

            <?php }else{ ?>

            <div><span>.<?php echo \dash\get::index($value, 'ext'); ?></span></div>

            <?php } //endif ?>

          </a>
        </td>
        <td>
            <div class="fileName" title="<?php echo \dash\get::index($value, 'title'); ?>"><?php echo substr(\dash\get::index($value, 'title'), 0, 70); ?></div>
            <div class="f">
              <div class="c">
                <a class="badge primary" href="<?php echo \dash\get::index($value, 'path'); ?>" target="_blank"><?php echo T_("View"); ?></a>
              </div>

            </div>
        </td>
        <td class="s0 m0 ltr txtL collapsing"><i class="sf-file-<?php echo \dash\get::index($value, 'type'); ?>-o fs16 mR5"></i> <?php echo \dash\get::index($value, 'mime'); ?></td>
        <td><?php echo \dash\fit::number(\dash\get::index($value, 'size')); ?></td>
        <td class="s0 ltr txtL collapsing"><div><?php echo \dash\fit::date(\dash\get::index($value, 'datecreated')); ?></div></td>
      </tr>
      <?php }//endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?> <a href="<?php echo \dash\url::this(); ?>/add"><?php echo T_("Try to start with add new record!"); ?></a></p>
<?php } //endfunction ?>




