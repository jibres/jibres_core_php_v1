
<?php
pageSteps();

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
  <form method="get" action='<?php echo \dash\url::this(); ?><?php echo \dash\data::moduleType() ?>' data-action>
    <div class="input">
      <?php if(\dash\data::listSpecial()) {?>
        <?php if(\dash\request::get('special')) {?>
          <?php $openKerkere = true; ?>
        <?php } ?>
        <label class="addon" data-kerkere='.showFilterSearch' data-kerkere-icon><?php echo T_("Advance search"); ?></label>
      <?php } ?>
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus autocomplete='off'>

      <?php if(\dash\request::get('type')) {?>
      <input type="hidden" name="type" value="<?php echo \dash\request::get('type'); ?>">
      <?php } ?>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
      <?php if(\dash\data::listSpecial()) {?>

        <div class="showFilterSearch" <?php if(isset($openKerkere) && $openKerkere) {}else{?> data-kerkere-content='hide' <?php } ?>>
           <label for="special"><?php echo T_("Use Special mode"); ?></label>

          <select name="special" class="select22">
            <option value=""><i><?php echo T_("Please select one item"); ?></i></option>
            <?php foreach (\dash\data::listSpecial() as $key => $value) {?>

              <option value="<?php echo $key; ?>" <?php if(\dash\request::get('special') === $key)  { echo 'selected'; }?>> <?php echo $value; ?></option>
            <?php } //endfor ?>

          </select>
            <a href="<?php echo \dash\url::this(); ?>" class="btn "><?php echo T_("Clear filter"); ?></a>
            <button class="btn primary"><?php echo T_("Apply"); ?></button>

        </div>
      <?php } //endif ?>
  </form>
</div>
<?php } //endfunction ?>


<?php function htmlTable() {?>

<?php
$sortLink = \dash\data::sortLink();
?>

  <table class="tbl1 v1 fs11">
    <thead>
      <tr>
        <th data-sort="<?php echo \dash\get::index($value, 'title', 'order'); ?>"><a href='<?php echo \dash\get::index($value, 'title', 'link'); ?>'><?php echo T_("Title"); ?></a></th>
        <th class="s0 max-w200" data-sort="<?php echo \dash\get::index($value, 'slug', 'order'); ?>"><a href='<?php echo \dash\get::index($value, 'slug', 'link'); ?>'><?php echo T_("Slug"); ?></a></th>
        <?php if(!\dash\request::get('type') || \dash\request::get('type') == 'post') {?>
          <th data-sort="<?php echo \dash\get::index($value, 'commentcount', 'order'); ?>"><a href='<?php echo \dash\get::index($value, 'commentcount', 'link'); ?>'><i class="sf-comments fs16"></i></a></th>
        <?php } ?>
        <th data-sort="<?php echo \dash\get::index($value, 'publishdate', 'order'); ?>"><a href='<?php echo \dash\get::index($value, 'publishdate', 'link'); ?>'><?php echo T_("Publish date"); ?></a></th>
        <th data-sort="<?php echo \dash\get::index($value, 'status', 'order'); ?>"><a href='<?php echo \dash\get::index($value, 'status', 'link'); ?>'><?php echo T_("Status"); ?></a></th>
      </tr>
    </thead>

    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>

      <tr class="">
        <td>
          <?php if(isset($value['parent_url']) && $value['parent_url'] && is_array($value['parent_url'])) {?>
            <?php foreach ($value['parent_url'] as $pKey => $pValue) {?>

              <a target="_blank" title='<?php echo T_("Parent"); ?> <?php echo \dash\fit::number($pKey + 1); ?>' href="<?php echo \dash\url::kingdom(); ?>/<?php echo $pValue; ?>"><i class="sf-angle-double-up"></i></a>
            <?php }//endfor ?>
          <?php } //endif ?>
          <a href="<?php echo \dash\url::here(); ?>/posts/edit?id=<?php echo \dash\get::index($value, 'id'); ?>&type=<?php echo \dash\get::index($value, 'type'); ?>"><?php echo \dash\get::index($value, 'title'); ?></a>
        </td>
        <td class="s0 m0 fs09 ltr txtL pRa10" title="<?php echo \dash\get::index($value, 'url'); ?>">

          <a href="<?php echo \dash\url::kingdom(); ?>/<?php echo \dash\get::index($value, 'url'); ?>" target="_blank"><span class="sf-share"></span> <?php echo \dash\get::index($value, 'slug'); ?></a></td>
        <?php if(!\dash\request::get('type') || \dash\request::get('type') == 'post') {?>



        <td class="collapsing txtC"><?php if(isset($value['commentcount']) && $value['commentcount']) {?><a href="<?php echo \dash\url::here(); ?>/comments?post_id=<?php echo \dash\get::index($value, 'id'); ?>"><?php echo \dash\fit::number($value['commentcount']); ?></a><?php }else{ ?><span class="sf-mute">-</span><?php } ?></td>
        <?php } ?>

        <td class="collapsing" ><?php echo \dash\fit::date_human(\dash\get::index($value, 'publishdate')); ?></td>
        <td class="collapsing"><a href="<?php echo \dash\url::here(); ?>/posts?status=<?php echo \dash\get::index($value, 'status'); ?>&type=<?php echo \dash\get::index($value, 'type'); ?>"><?php echo T_(\dash\get::index($value, 'status')); ?></a></td>
      </tr>
      <?php }//endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/posts<?php echo \dash\data::moduleType() ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/posts<?php echo \dash\data::moduleType() ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?> <a href="<?php echo \dash\url::here(); ?>/posts/add<?php echo \dash\data::moduleType() ?>"><?php echo T_("Try to start with add new record!"); ?></a></p>
<?php } //endfunction ?>





<?php function pageSteps() {?>
  <div class="f">

    <div class="c">
    <a class="dcard <?php if(!\dash\request::get('status') ) { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?><?php if(\dash\request::get('type')) { echo '?type='. \dash\request::get('type');} ?>' data-shortkey="49ctrlshift" title='<?php echo T_("All publish posts"); ?>'>
     <div class="statistic">
      <div class="value"><?php echo \dash\fit::number(\dash\data::postCounter_all()); ?></div>
      <div class="label"><i class="sf-all"></i> <?php echo T_("All"); ?> </div>
     </div>
    </a>
   </div>

   <div class="c">
    <a class="dcard <?php if(\dash\request::get('status') === 'publish') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>?status=publish<?php if(\dash\request::get('type')) { echo '&type='. \dash\request::get('type');} ?>' data-shortkey="49ctrlshift" title='<?php echo T_("All publish posts"); ?>'>
     <div class="statistic">
      <div class="value"><?php echo \dash\fit::number(\dash\data::postCounter_publish()); ?></div>
      <div class="label"><i class="sf-publish"></i> <?php echo T_("Published"); ?> </div>
     </div>
    </a>
   </div>

   <div class="c">
    <a class="dcard <?php if(\dash\request::get('status') === 'draft') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>?status=draft<?php if(\dash\request::get('type')) { echo '&type='. \dash\request::get('type');} ?>' data-shortkey="50ctrlshift" title='<?php echo T_("All draft posts"); ?>'>
     <div class="statistic">
      <div class="value"><?php echo \dash\fit::number(\dash\data::postCounter_draft()); ?></div>
      <div class="label"><i class="sf-edit"></i> <?php echo T_("Draft"); ?></div>
     </div>
    </a>
   </div>

   <div class="c">
    <a class="dcard <?php if(\dash\request::get('status') === 'deleted') { echo 'active';} ?>" href='<?php echo \dash\url::this(); ?>?status=deleted<?php if(\dash\request::get('type')) { echo '&type='. \dash\request::get('type');} ?>' data-shortkey="51ctrlshift" title='<?php echo T_("All trash posts"); ?>'>
     <div class="statistic">
      <div class="value"><?php echo \dash\fit::number(\dash\data::postCounter_deleted()); ?></div>
      <div class="label"><i class="sf-trash"></i> <?php echo T_("Deleted"); ?></div>
     </div>
    </a>
   </div>



  </div>
<?php } //endfunction ?>