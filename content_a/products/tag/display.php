

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
<?php if(\dash\request::get('type') === 'category') {?>

  <?php iParent(); ?>

<?php }//endif ?>

  <?php iDescription(); ?>
  <?php iLanguage(); ?>

  <?php tagColor(); ?>
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


<?php function tagColor() {?>
  <?php if(\dash\request::get('type') === 'support_tag' || \dash\permission::supervisor()) {?>

<label><?php echo T_("Tag color"); ?></label>
<div class="ui fluid selection dropdown">
  <input type="hidden" name="color" value="<?php $meta = \dash\data::datarow_meta(); echo @$meta['color']; ?>">
  <i class="dropdown icon"></i>
  <div class="default text"><?php echo T_("Select tag color"); ?></div>
  <div class="menu">

    <div class="item" data-value="primary"><span class="mA3 badge rounded primary">&nbsp;</span> <?php echo T_("Primary"); ?></div>
    <div class="item" data-value="secondary"><span class="mA3 badge rounded secondary">&nbsp;</span> <?php echo T_("Secondary"); ?></div>
    <div class="item" data-value="success"><span class="mA3 badge rounded success">&nbsp;</span> <?php echo T_("Success"); ?></div>
    <div class="item" data-value="danger"><span class="mA3 badge rounded danger">&nbsp;</span> <?php echo T_("Danger"); ?></div>
    <div class="item" data-value="warning"><span class="mA3 badge rounded warning">&nbsp;</span> <?php echo T_("Warning"); ?></div>
    <div class="item" data-value="info"><span class="mA3 badge rounded info">&nbsp;</span> <?php echo T_("Info"); ?></div>
    <div class="item" data-value="light"><span class="mA3 badge rounded light">&nbsp;</span> <?php echo T_("Light"); ?></div>
    <div class="item" data-value="dark"><span class="mA3 badge rounded dark">&nbsp;</span> <?php echo T_("Dark"); ?></div>
    <div class="item" data-value="pain"><span class="mA3 badge rounded pain">&nbsp;</span> <?php echo T_("Pain"); ?></div>

  </div>
</div>
<?php } //endif ?>

<?php }// endfunction ?>

<?php function htmlSearchBox() {?>
<div class="cbox fs12">
  <form method="get" data-action>
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q'); ?>" autofocus  autocomplete='off'>
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
        <th data-sort="<?php echo @$sortLink['title']['order']; ?>"><a href="<?php echo @$sortLink['title']['link']; ?>"><?php echo T_("Title"); ?></a></th>
        <th data-sort="<?php echo @$sortLink['slug']['order']; ?>"><a href="<?php echo @$sortLink['slug']['link']; ?>"><?php echo T_("Slug"); ?></a></th>


        <th><?php echo T_("Description"); ?></th>
        <th data-sort="<?php echo @$sortLink['count']['order']; ?>"><a href="<?php echo @$sortLink['count']['link']; ?>"><?php echo T_("Used"); ?></a></th>
        <th data-sort="<?php echo @$sortLink['status']['order']; ?>"><a href="<?php echo @$sortLink['status']['link']; ?>"><?php echo T_("Status"); ?></a></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($dataTable as $key => $value) {?>

        <tr class="">
          <td><a href="<?php echo \dash\url::this(); ?>?type=<?php echo @$value['type']; ?>&edit=<?php echo @$value['id']; ?>">
            <?php if(isset($value['meta']['color'])) {?>
              <span title=" <?php echo @$value['meta']['color']; ?>" class="mA3 floatRa badge rounded  <?php echo @$value['meta']['color']; ?>">&nbsp;</span>
            <?php } // endif ?>


          <?php echo @$value['title']; ?></a></td>



            <td class="fs08"><a href="<?php echo \dash\url::kingdom(); ?>/<?php echo @$value['url']; ?>" target="_blank"><span class="sf-share"></span> <?php echo @$value['slug']; ?></a></td>



          <td><?php echo @$value['desc']; ?></td>
          <?php if(isset($value['type']) && $value['type'] === 'help_tag') {?>

            <td class="collapsing txtC"><?php if(isset($value['count']) && $value['count']) {?><a target="_blank" href="<?php echo \dash\url::here(); ?>/posts?type=help&term=<?php echo @$value['slug']; ?>"><?php echo \dash\fit::number($value['count']); ?></a><?php }else{ echo '-';} ?></td>

          <?php }elseif(isset($value['type']) && $value['type'] === 'support_tag') {?>

            <td class="collapsing txtC"><?php if(isset($value['count']) && $value['count']) {?><a target="_blank" href="<?php echo \dash\url::kingdom(); ?>/support/ticket?tag=<?php echo @$value['slug']; ?>"><?php echo \dash\fit::number($value['count']); ?></a><?php }else{ echo '-';} ?></td>
          <?php }else{ ?>
            <td class="collapsing txtC"><?php if(isset($value['count']) && $value['count']) {?><a target="_blank" href="<?php echo \dash\url::here(); ?>/posts?term=<?php echo @$value['slug']; ?>"><?php echo \dash\fit::number($value['count']); ?></a><?php }else{ echo '-';} ?></td>
          <?php } //endif ?>
          <td class="collapsing txtC"><?php echo T_(@$value['status']); ?></td>
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
  <a href="<?php echo \dash\url::pwd(); ?>" class="badge danger floatL mT5" data-ajaxify data-method='post' data-data='{"action": "remove"}'><?php echo T_("Remove"); ?></a>
</div>

<?php }// endfunction ?>


<?php function iTitle() {?>
<label for='ftitle'><?php echo T_("Title"); ?> <small class="fc-red">* <?php echo T_("Require"); ?></small></label>
<div class="input">
 <input type="text" name="title" placeholder='<?php echo T_("Title"); ?> *' value="<?php echo \dash\data::datarow_title(); ?>" autofocus maxlength='100' minlength="1" pattern=".{1,100}" title='<?php echo T_("Title is used to show on website"); ?>' id='ftitle' required>
</div>
<?php }// endfunction ?>


<?php function iSlug() {?>
<label for='fslug'><?php echo T_("Slug"); ?> <small><?php echo T_("Used for url"); ?></small></label>
<div class="input ltr">
 <input type="text" name="slug" placeholder='<?php echo T_("Slug"); ?>' value="<?php echo \dash\data::datarow_slug(); ?>" maxlength='50' minlength="1" pattern=".{1,50}" title='<?php echo T_("Used in url for categorize addresses"); ?>' id='fslug'>
</div>
<?php }// endfunction ?>



<?php function iParent() {?>

<label for="parent"><?php echo T_("Parent Category"); ?></label>
<select name="parent" class="input select">
  <option value=""><?php echo T_("Please select one itme"); ?></option>
  <?php foreach (\dash\data::dataTable() as $key => $item) {?>
  <?php if(isset($item['id']) && $item['id'] == \dash\request::get("edit")) {}else{?>

    <option value="<?php echo $item['id']; ?>" <?php if(\dash\data::datarow_parent() == $item['id']) {echo 'selected';} ?>><?php echo @$item['title']; ?></option>
  <?php }//endif ?>
  <?php } //endfor ?>
</select>
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
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php }// endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php }// endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2"><?php echo T_("Hi!"); ?> <?php echo T_("Try to start with add new records!"); ?></p>
<?php }// endfunction ?>


<?php function iLanguage() {?>
<div class="mB10">
  <label for="language"><?php echo T_("Language"); ?></label>
  <select name="language" class="ui dropdown select">
    <option value=""><i><?php echo T_("Please select one item"); ?></i></option>
    <?php foreach (\dash\data::lang_list() as $key => $value) {?>


      <option value="<?php echo $key; ?>" <?php if(\dash\data::datarow_language() == $key || (!\dash\data::datarow_language() && \dash\data::lang_current() == $key)) {echo 'selected';} ?>><?php echo $value; ?></option>

    <?php } //endfor ?>

  </select>
</div>
<?php }// endfunction ?>




