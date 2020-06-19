

<div class="f justify-center">

  <div class="c4 s12 pRa10">
    <?php iAddEditBox(); ?>
  </div>

  <div class="c s12">
      <?php iDataBox(); ?>
  </div>
</div>


<?php function iAddEditBox() {?>
<form method="post" class="cbox" autocomplete="off">
  <?php iTitle(); ?>
  <?php iSlug(); ?>


  <?php iDescription(); ?>
  <?php iLanguage(); ?>

  <?php iStatus(); ?>
  <?php if(\dash\data::editMode()) { iedit();} else { iadd(); } ?>
</form>
<?php }// endfunction ?>


<?php function iDataBox() {?>

<?php if(\dash\data::dataTable()) {?>
 <?php if(\dash\data::dataFilter()) {?>

  <?php htmlSearchBox(); ?>
  <?php htmlTable(); ?>
  <?php htmlFilter(); ?>

 <?php }else{ ?>

  <?php htmlSearchBox(); ?>
  <?php htmlTable(); ?>

 <?php } //endif ?>
<?php }else{ ?>
 <?php if(\dash\data::dataFilter()) {?>

  <?php htmlSearchBox(); ?>
  <?php htmlFilterNoResult(); ?>

 <?php }else{ ?>

  <?php htmlStartAddNew(); ?>

 <?php } //endif ?>
<?php } //endif ?>



<?php }// endfunction ?>



<?php function htmlSearchBox() {?>
<div class="cbox fs12">
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

  <table class="tbl1 v2 fs12">
    <thead>
      <tr class="primary ">
        <th data-sort="<?php echo \dash\get::index($sortLink, 'title', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'title', 'link'); ?>"><?php echo T_("Title"); ?></a></th>
        <th data-sort="<?php echo \dash\get::index($sortLink, 'slug', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'slug', 'link'); ?>"><?php echo T_("Slug"); ?></a></th>


        <th><?php echo T_("Description"); ?></th>
        <th data-sort="<?php echo \dash\get::index($sortLink, 'count', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'count', 'link'); ?>"><?php echo T_("Used"); ?></a></th>
        <th class="collapsing" data-sort="<?php echo \dash\get::index($sortLink, 'status', 'order'); ?>"><a href="<?php echo \dash\get::index($sortLink, 'status', 'link'); ?>"><?php echo T_("Status"); ?></a></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

        <tr class="">
          <td><a href="<?php echo \dash\url::that(); ?>?edit=<?php echo \dash\get::index($value, 'id'); ?>">
          <i class="sf-edit"></i>

          <?php echo \dash\get::index($value, 'title'); ?></a></td>



            <td class="fs08"><a href="<?php echo \dash\url::kingdom(); ?>/p/tag/<?php echo \dash\get::index($value, 'slug'); ?>" target="_blank"><span class="sf-share"></span> <?php echo \dash\get::index($value, 'slug'); ?></a></td>



          <td><?php echo \dash\get::index($value, 'desc'); ?></td>
          <?php if(isset($value['type']) && $value['type'] === 'help_tag') {?>

            <td class="collapsing txtC"><?php if(isset($value['count']) && $value['count']) {?><a target="_blank" href="<?php echo \dash\url::here(); ?>/posts?type=help&term=<?php echo \dash\get::index($value, 'slug'); ?>"><?php echo \dash\fit::number($value['count']); ?></a><?php }else{ echo '-';} ?></td>

          <?php }elseif(isset($value['type']) && $value['type'] === 'support_tag') {?>

            <td class="collapsing txtC"><?php if(isset($value['count']) && $value['count']) {?><a target="_blank" href="<?php echo \dash\url::kingdom(); ?>/support/ticket?tag=<?php echo \dash\get::index($value, 'slug'); ?>"><?php echo \dash\fit::number($value['count']); ?></a><?php }else{ echo '-';} ?></td>
          <?php }else{ ?>
            <td class="collapsing txtC"><?php if(isset($value['count']) && $value['count']) {?><a target="_blank" href="<?php echo \dash\url::here(); ?>/posts?term=<?php echo \dash\get::index($value, 'slug'); ?>"><?php echo \dash\fit::number($value['count']); ?></a><?php }else{ echo '-';} ?></td>
          <?php } //endif ?>
          <td class="collapsing txtC"><?php echo T_(\dash\get::index($value, 'status')); ?></td>
        </tr>
      <?php } //endfor ?>
    </tbody>
  </table>

<?php \dash\utility\pagination::html(); ?>
<?php }// endfunction ?>



<?php function iadd() {?>
<button class="btn primary block mT25"><?php echo T_("Add"); ?></button>
<?php }// endfunction ?>

<?php function iedit() {?>
<button class="btn primary block mT25"><?php echo T_("Edit"); ?></button>
<div class="ovh">
  <a href="<?php echo \dash\url::pwd(); ?>" class="badge danger floatL mT5" data-confirm data-method='post' data-data='{"action": "remove"}'><?php echo T_("Remove"); ?></a>
</div>

<?php }// endfunction ?>


<?php function iTitle() {?>
<label for='ftitle'><?php echo T_("Title"); ?> <small class="fc-red">* <?php echo T_("Require"); ?></small></label>
<div class="input">
 <input type="text" name="title" placeholder='<?php echo T_("Title"); ?> *' value="<?php echo \dash\data::datarow_title(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='100' minlength="1" pattern=".{1,100}" title='<?php echo T_("Title is used to show on website"); ?>' id='ftitle' required>
</div>
<?php }// endfunction ?>


<?php function iSlug() {?>
<label for='fslug'><?php echo T_("Slug"); ?> <small><?php echo T_("Used for url"); ?></small></label>
<div class="input ltr">
 <input type="text" name="slug" placeholder='<?php echo T_("Slug"); ?>' value="<?php echo \dash\data::datarow_slug(); ?>" maxlength='50' minlength="1" pattern=".{1,50}" title='<?php echo T_("Used in url for categorize addresses"); ?>' id='fslug'>
</div>
<?php }// endfunction ?>




<?php function iDescription() {?>
<div class="mB10">
  <label for='fdesc'><?php echo T_("Description"); ?></label>
  <textarea class="txt" name="desc" rows="7" placeholder='<?php echo T_("Description"); ?>' id='fdesc'><?php echo \dash\data::datarow_desc(); ?></textarea>
</div>
<?php }// endfunction ?>


<?php function iStatus() {?>
<?php if(\dash\permission::supervisor()) {?>


<label for="status"><?php echo T_("Status"); ?></label>
<select name="status" class="input select">
  <option value=""><?php echo T_("Please select one itme"); ?></option>
  <option value="enable" <?php if(\dash\data::datarow_status() == 'enable') { echo 'selected';} ?>><?php echo T_("Enable"); ?></option>
  <option value="disable" <?php if(\dash\data::datarow_status() == 'disable') { echo 'selected';} ?>><?php echo T_("Disable"); ?></option>
  <option value="expired" <?php if(\dash\data::datarow_status() == 'expired') { echo 'selected';} ?>><?php echo T_("Expired"); ?></option>
  <option value="awaiting" <?php if(\dash\data::datarow_status() == 'awaiting') { echo 'selected';} ?>><?php echo T_("Awaiting"); ?></option>
  <option value="filtered" <?php if(\dash\data::datarow_status() == 'filtered') { echo 'selected';} ?>><?php echo T_("Filtered"); ?></option>
  <option value="blocked" <?php if(\dash\data::datarow_status() == 'blocked') { echo 'selected';} ?>><?php echo T_("Blocked"); ?></option>
  <option value="spam" <?php if(\dash\data::datarow_status() == 'spam') { echo 'selected';} ?>><?php echo T_("Spam"); ?></option>
  <option value="violence" <?php if(\dash\data::datarow_status() == 'violence') { echo 'selected';} ?>><?php echo T_("Violence"); ?></option>
  <option value="pornography" <?php if(\dash\data::datarow_status() == 'pornography') { echo 'selected';} ?>><?php echo T_("Pornography"); ?></option>
  <option value="other" <?php if(\dash\data::datarow_status() == 'other') { echo 'selected';} ?>><?php echo T_("Other"); ?></option>
</select>

<?php }else{ ?>

<label for="status"><?php echo T_("Status"); ?></label>
<select name="status" class="input select">
  <option value=""><?php echo T_("Please select one itme"); ?></option>
  <option value="enable" <?php if(\dash\data::datarow_status() == 'enable') { echo 'selected';} ?>><?php echo T_("Enable"); ?></option>
  <option value="disable" <?php if(\dash\data::datarow_status() == 'disable') { echo 'selected';} ?>><?php echo T_("Disable"); ?></option>
</select>

<?php }//endif ?>

<?php }// endfunction ?>



<?php function iexcerpt() {?>
<label for='excerpt'><?php echo T_("Excerpt"); ?></label>
<textarea class="txt" name="excerpt" rows="7" placeholder='<?php echo T_("Description"); ?>' id='excerpt'><?php echo \dash\data::datarow_excerpt(); ?></textarea>
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


<?php function iLanguage() {?>
<div class="mB10">
  <label for="language"><?php echo T_("Language"); ?></label>
  <select name="language" class="select22">
    <option value=""><i><?php echo T_("Please select one item"); ?></i></option>
    <?php foreach (\dash\language::all(true) as $key => $value) {?>


      <option value="<?php echo $key; ?>" <?php if(\dash\data::datarow_language() == $key || (!\dash\data::datarow_language() && \dash\language::currentAll() == $key)) {echo 'selected';} ?>><?php echo $value; ?></option>

    <?php } //endfor ?>

  </select>
</div>
<?php }// endfunction ?>




