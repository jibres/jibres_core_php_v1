

<div class="f justify-center">
<?php if(\dash\request::get('type')) {?>
  <div class="c4 s12 pRa10">
    <?php iAddEditBox(); ?>
  </div>
<?php }//endif ?>
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
  <?php catIcon(); ?>
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

        <?php if(!\dash\request::get('type')) {?>

          <th data-sort="<?php echo @$sortLink['type']['order']; ?>"><a href="<?php echo @$sortLink['type']['link']; ?>"><?php echo T_("Type"); ?></a></th>

        <?php } //endif?>

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

            <?php if(isset($value['meta']['icon'])) {?>

              <span title="sf-<?php echo @$value['meta']['icon']; ?>" class="mA3 floatRa sf-<?php echo @$value['meta']['icon']; ?>"></span>
            <?php } // endif ?>
          <?php echo @$value['title']; ?></a></td>

          <?php if(isset($value['type']) && $value['type'] === 'help_tag') {?>

            <td class="fs08"><a href="<?php echo \dash\url::kingdom(); ?>/support/tag/<?php echo @$value['slug']; ?>" target="_blank"><span class="sf-share"></span> <?php echo @$value['slug']; ?></a></td>
          <?php }elseif(isset($value['type']) && $value['type'] === 'support_tag') {?>

            <td class="fs08"><a href="<?php echo \dash\url::kingdom(); ?>/support/ticket?tag=<?php echo @$value['slug']; ?>" target="_blank"><span class="sf-share"></span> <?php echo @$value['slug']; ?></a></td>

          <?php }else{ ?>

            <td class="fs08"><a href="<?php echo \dash\url::kingdom(); ?>/<?php echo @$value['url']; ?>" target="_blank"><span class="sf-share"></span> <?php echo @$value['slug']; ?></a></td>
          <?php } //endif ?>

          <?php if(!\dash\request::get('type')) {?>

            <td><a href="<?php echo \dash\url::this(); ?>?type=<?php echo @$value['type']; ?>"><?php echo T_(@$value['type']); ?></a></td>

          <?php } // endif ?>

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




<?php function catIcon() {?>
  <?php if(\dash\request::get('type') === 'help' || \dash\permission::supervisor()) {?>

<label class="mT10"><?php echo T_("Category icon"); ?></label>
<div class="ui fluid selection dropdown mB10 search">
  <input type="hidden" name="icon" value="<?php $meta = \dash\data::datarow_meta(); echo @$meta['icon']; ?>">
  <i class="dropdown icon"></i>
  <div class="default text"><?php echo T_("Select category icon"); ?></div>
  <div class="menu">
    <div class="item" data-value="angle-down"><i class="mRa10 sf-angle-down"></i> <code class="fc-mute">angle-down</code></div>
    <div class="item" data-value="angle-left"><i class="mRa10 sf-angle-left"></i> <code class="fc-mute">angle-left</code></div>
    <div class="item" data-value="angle-right"><i class="mRa10 sf-angle-right"></i> <code class="fc-mute">angle-right</code></div>
    <div class="item" data-value="angle-up"><i class="mRa10 sf-angle-up"></i> <code class="fc-mute">angle-up</code></div>
    <div class="item" data-value="bell"><i class="mRa10 sf-bell"></i> <code class="fc-mute">bell</code></div>
    <div class="item" data-value="bell-o"><i class="mRa10 sf-bell-o"></i> <code class="fc-mute">bell-o</code></div>
    <div class="item" data-value="bell-slash"><i class="mRa10 sf-bell-slash"></i> <code class="fc-mute">bell-slash</code></div>
    <div class="item" data-value="bell-slash-o"><i class="mRa10 sf-bell-slash-o"></i> <code class="fc-mute">bell-slash-o</code></div>
    <div class="item" data-value="bug"><i class="mRa10 sf-bug"></i> <code class="fc-mute">bug</code></div>
    <div class="item" data-value="bolt"><i class="mRa10 sf-bolt"></i> <code class="fc-mute">bolt</code></div>
    <div class="item" data-value="check"><i class="mRa10 sf-check"></i> <code class="fc-mute">check</code></div>
    <div class="item" data-value="chain-broken"><i class="mRa10 sf-chain-broken"></i> <code class="fc-mute">chain-broken</code></div>
    <div class="item" data-value="cc-paypal"><i class="mRa10 sf-cc-paypal"></i> <code class="fc-mute">cc-paypal</code></div>
    <div class="item" data-value="cc-visa"><i class="mRa10 sf-cc-visa"></i> <code class="fc-mute">cc-visa</code></div>
    <div class="item" data-value="cloud-download"><i class="mRa10 sf-cloud-download"></i> <code class="fc-mute">cloud-download</code></div>
    <div class="item" data-value="cloud-upload"><i class="mRa10 sf-cloud-upload"></i> <code class="fc-mute">cloud-upload</code></div>
    <div class="item" data-value="cloud"><i class="mRa10 sf-cloud"></i> <code class="fc-mute">cloud</code></div>
    <div class="item" data-value="comment"><i class="mRa10 sf-comment"></i> <code class="fc-mute">comment</code></div>
    <div class="item" data-value="comment-o"><i class="mRa10 sf-comment-o"></i> <code class="fc-mute">comment-o</code></div>
    <div class="item" data-value="commenting"><i class="mRa10 sf-commenting"></i> <code class="fc-mute">commenting</code></div>
    <div class="item" data-value="clone"><i class="mRa10 sf-clone"></i> <code class="fc-mute">clone</code></div>
    <div class="item" data-value="commenting-o"><i class="mRa10 sf-commenting-o"></i> <code class="fc-mute">commenting-o</code></div>
    <div class="item" data-value="comments"><i class="mRa10 sf-comments"></i> <code class="fc-mute">comments</code></div>
    <div class="item" data-value="comments-o"><i class="mRa10 sf-comments-o"></i> <code class="fc-mute">comments-o</code></div>
    <div class="item" data-value="cog"><i class="mRa10 sf-cog"></i> <code class="fc-mute">cog</code></div>
    <div class="item" data-value="desktop"><i class="mRa10 sf-desktop"></i> <code class="fc-mute">desktop</code></div>
    <div class="item" data-value="envelope-o"><i class="mRa10 sf-envelope-o"></i> <code class="fc-mute">envelope-o</code></div>
    <div class="item" data-value="envelope"><i class="mRa10 sf-envelope"></i> <code class="fc-mute">envelope</code></div>
    <div class="item" data-value="ellipsis-v"><i class="mRa10 sf-ellipsis-v"></i> <code class="fc-mute">ellipsis-v</code></div>
    <div class="item" data-value="ellipsis-h"><i class="mRa10 sf-ellipsis-h"></i> <code class="fc-mute">ellipsis-h</code></div>
    <div class="item" data-value="crop"><i class="mRa10 sf-crop"></i> <code class="fc-mute">crop</code></div>
    <div class="item" data-value="crosshairs"><i class="mRa10 sf-crosshairs"></i> <code class="fc-mute">crosshairs</code></div>
    <div class="item" data-value="bar-chart"><i class="mRa10 sf-bar-chart"></i> <code class="fc-mute">bar-chart</code></div>
    <div class="item" data-value="balance-scale"><i class="mRa10 sf-balance-scale"></i> <code class="fc-mute">balance-scale</code></div>
    <div class="item" data-value="arrows-h"><i class="mRa10 sf-arrows-h"></i> <code class="fc-mute">arrows-h</code></div>
    <div class="item" data-value="arrows-v"><i class="mRa10 sf-arrows-v"></i> <code class="fc-mute">arrows-v</code></div>
    <div class="item" data-value="arrows-alt"><i class="mRa10 sf-arrows-alt"></i> <code class="fc-mute">arrows-alt</code></div>
    <div class="item" data-value="arrows"><i class="mRa10 sf-arrows"></i> <code class="fc-mute">arrows</code></div>
    <div class="item" data-value="android"><i class="mRa10 sf-android"></i> <code class="fc-mute">android</code></div>
    <div class="item" data-value="align-right"><i class="mRa10 sf-align-right"></i> <code class="fc-mute">align-right</code></div>
    <div class="item" data-value="align-left"><i class="mRa10 sf-align-left"></i> <code class="fc-mute">align-left</code></div>
    <div class="item" data-value="align-justify"><i class="mRa10 sf-align-justify"></i> <code class="fc-mute">align-justify</code></div>
    <div class="item" data-value="align-center"><i class="mRa10 sf-align-center"></i> <code class="fc-mute">align-center</code></div>
    <div class="item" data-value="bullhorn"><i class="mRa10 sf-bullhorn"></i> <code class="fc-mute">bullhorn</code></div>
    <div class="item" data-value="asterisk"><i class="mRa10 sf-asterisk"></i> <code class="fc-mute">asterisk</code></div>
    <div class="item" data-value="bookmark-o"><i class="mRa10 sf-bookmark-o"></i> <code class="fc-mute">bookmark-o</code></div>
    <div class="item" data-value="bookmark"><i class="mRa10 sf-bookmark"></i> <code class="fc-mute">bookmark</code></div>
    <div class="item" data-value="caret-right"><i class="mRa10 sf-caret-right"></i> <code class="fc-mute">caret-right</code></div>
    <div class="item" data-value="caret-left"><i class="mRa10 sf-caret-left"></i> <code class="fc-mute">caret-left</code></div>
    <div class="item" data-value="caret-down"><i class="mRa10 sf-caret-down"></i> <code class="fc-mute">caret-down</code></div>
    <div class="item" data-value="caret-up"><i class="mRa10 sf-caret-up"></i> <code class="fc-mute">caret-up</code></div>
    <div class="item" data-value="file-code-o"><i class="mRa10 sf-file-code-o"></i> <code class="fc-mute">file-code-o</code></div>
    <div class="item" data-value="file-audio-o"><i class="mRa10 sf-file-audio-o"></i> <code class="fc-mute">file-audio-o</code></div>
    <div class="item" data-value="file-archive-o"><i class="mRa10 sf-file-archive-o"></i> <code class="fc-mute">file-archive-o</code></div>
    <div class="item" data-value="file-excel-o"><i class="mRa10 sf-file-excel-o"></i> <code class="fc-mute">file-excel-o</code></div>
    <div class="item" data-value="file"><i class="mRa10 sf-file"></i> <code class="fc-mute">file</code></div>
    <div class="item" data-value="file-pdf-o"><i class="mRa10 sf-file-pdf-o"></i> <code class="fc-mute">file-pdf-o</code></div>
    <div class="item" data-value="file-powerpoint-o"><i class="mRa10 sf-file-powerpoint-o"></i> <code class="fc-mute">file-powerpoint-o</code></div>
    <div class="item" data-value="file-text"><i class="mRa10 sf-file-text"></i> <code class="fc-mute">file-text</code></div>
    <div class="item" data-value="file-text-o"><i class="mRa10 sf-file-text-o"></i> <code class="fc-mute">file-text-o</code></div>
    <div class="item" data-value="file-word-o"><i class="mRa10 sf-file-word-o"></i> <code class="fc-mute">file-word-o</code></div>
    <div class="item" data-value="files-o"><i class="mRa10 sf-files-o"></i> <code class="fc-mute">files-o</code></div>
    <div class="item" data-value="film"><i class="mRa10 sf-film"></i> <code class="fc-mute">film</code></div>
    <div class="item" data-value="file-video-o"><i class="mRa10 sf-file-video-o"></i> <code class="fc-mute">file-video-o</code></div>
    <div class="item" data-value="floppy-o"><i class="mRa10 sf-floppy-o"></i> <code class="fc-mute">floppy-o</code></div>
    <div class="item" data-value="file-image-o"><i class="mRa10 sf-file-image-o"></i> <code class="fc-mute">file-image-o</code></div>
    <div class="item" data-value="file-o"><i class="mRa10 sf-file-o"></i> <code class="fc-mute">file-o</code></div>
    <div class="item" data-value="flag"><i class="mRa10 sf-flag"></i> <code class="fc-mute">flag</code></div>
    <div class="item" data-value="flag-checkered"><i class="mRa10 sf-flag-checkered"></i> <code class="fc-mute">flag-checkered</code></div>
    <div class="item" data-value="flag-o"><i class="mRa10 sf-flag-o"></i> <code class="fc-mute">flag-o</code></div>
    <div class="item" data-value="gavel"><i class="mRa10 sf-gavel"></i> <code class="fc-mute">gavel</code></div>
    <div class="item" data-value="heart"><i class="mRa10 sf-heart"></i> <code class="fc-mute">heart</code></div>
    <div class="item" data-value="heart-o"><i class="mRa10 sf-heart-o"></i> <code class="fc-mute">heart-o</code></div>
    <div class="item" data-value="history"><i class="mRa10 sf-history"></i> <code class="fc-mute">history</code></div>
    <div class="item" data-value="home"><i class="mRa10 sf-home"></i> <code class="fc-mute">home</code></div>
    <div class="item" data-value="hourglass"><i class="mRa10 sf-hourglass"></i> <code class="fc-mute">hourglass</code></div>
    <div class="item" data-value="hourglass-end"><i class="mRa10 sf-hourglass-end"></i> <code class="fc-mute">hourglass-end</code></div>
    <div class="item" data-value="hourglass-half"><i class="mRa10 sf-hourglass-half"></i> <code class="fc-mute">hourglass-half</code></div>
    <div class="item" data-value="hourglass-o"><i class="mRa10 sf-hourglass-o"></i> <code class="fc-mute">hourglass-o</code></div>
    <div class="item" data-value="info"><i class="mRa10 sf-info"></i> <code class="fc-mute">info</code></div>
    <div class="item" data-value="industry"><i class="mRa10 sf-industry"></i> <code class="fc-mute">industry</code></div>
    <div class="item" data-value="graduation-cap"><i class="mRa10 sf-graduation-cap"></i> <code class="fc-mute">graduation-cap</code></div>
    <div class="item" data-value="globe"><i class="mRa10 sf-globe"></i> <code class="fc-mute">globe</code></div>
    <div class="item" data-value="glass"><i class="mRa10 sf-glass"></i> <code class="fc-mute">glass</code></div>
    <div class="item" data-value="line-chart"><i class="mRa10 sf-line-chart"></i> <code class="fc-mute">line-chart</code></div>
    <div class="item" data-value="github-square"><i class="mRa10 sf-github-square"></i> <code class="fc-mute">github-square</code></div>
    <div class="item" data-value="github-alt"><i class="mRa10 sf-github-alt"></i> <code class="fc-mute">github-alt</code></div>
    <div class="item" data-value="github"><i class="mRa10 sf-github"></i> <code class="fc-mute">github</code></div>
    <div class="item" data-value="language"><i class="mRa10 sf-language"></i> <code class="fc-mute">language</code></div>
    <div class="item" data-value="laptop"><i class="mRa10 sf-laptop"></i> <code class="fc-mute">laptop</code></div>
    <div class="item" data-value="quote-left"><i class="mRa10 sf-quote-left"></i> <code class="fc-mute">quote-left</code></div>
    <div class="item" data-value="quote-right"><i class="mRa10 sf-quote-right"></i> <code class="fc-mute">quote-right</code></div>
    <div class="item" data-value="spinner"><i class="mRa10 sf-spinner"></i> <code class="fc-mute">spinner</code></div>
    <div class="item" data-value="star"><i class="mRa10 sf-star"></i> <code class="fc-mute">star</code></div>
    <div class="item" data-value="star-half"><i class="mRa10 sf-star-half"></i> <code class="fc-mute">star-half</code></div>
    <div class="item" data-value="star-half-o"><i class="mRa10 sf-star-half-o"></i> <code class="fc-mute">star-half-o</code></div>
    <div class="item" data-value="star-o"><i class="mRa10 sf-star-o"></i> <code class="fc-mute">star-o</code></div>
    <div class="item" data-value="sort-amount-asc"><i class="mRa10 sf-sort-amount-asc"></i> <code class="fc-mute">sort-amount-asc</code></div>
    <div class="item" data-value="sort-alpha-desc"><i class="mRa10 sf-sort-alpha-desc"></i> <code class="fc-mute">sort-alpha-desc</code></div>
    <div class="item" data-value="sort-alpha-asc"><i class="mRa10 sf-sort-alpha-asc"></i> <code class="fc-mute">sort-alpha-asc</code></div>
    <div class="item" data-value="sort-amount-desc"><i class="mRa10 sf-sort-amount-desc"></i> <code class="fc-mute">sort-amount-desc</code></div>
    <div class="item" data-value="sort-numeric-desc"><i class="mRa10 sf-sort-numeric-desc"></i> <code class="fc-mute">sort-numeric-desc</code></div>
    <div class="item" data-value="sort-numeric-asc"><i class="mRa10 sf-sort-numeric-asc"></i> <code class="fc-mute">sort-numeric-asc</code></div>
    <div class="item" data-value="rss"><i class="mRa10 sf-rss"></i> <code class="fc-mute">rss</code></div>
    <div class="item" data-value="windows"><i class="mRa10 sf-windows"></i> <code class="fc-mute">windows</code></div>
    <div class="item" data-value="unlock"><i class="mRa10 sf-unlock"></i> <code class="fc-mute">unlock</code></div>
    <div class="item" data-value="unlock-alt"><i class="mRa10 sf-unlock-alt"></i> <code class="fc-mute">unlock-alt</code></div>
    <div class="item" data-value="youtube-play"><i class="mRa10 sf-youtube-play"></i> <code class="fc-mute">youtube-play</code></div>
    <div class="item" data-value="user-plus"><i class="mRa10 sf-user-plus"></i> <code class="fc-mute">user-plus</code></div>
    <div class="item" data-value="user"><i class="mRa10 sf-user"></i> <code class="fc-mute">user</code></div>
    <div class="item" data-value="user-md"><i class="mRa10 sf-user-md"></i> <code class="fc-mute">user-md</code></div>
    <div class="item" data-value="user-secret"><i class="mRa10 sf-user-secret"></i> <code class="fc-mute">user-secret</code></div>
    <div class="item" data-value="users"><i class="mRa10 sf-users"></i> <code class="fc-mute">users</code></div>
    <div class="item" data-value="user-times"><i class="mRa10 sf-user-times"></i> <code class="fc-mute">user-times</code></div>
    <div class="item" data-value="volume-up"><i class="mRa10 sf-volume-up"></i> <code class="fc-mute">volume-up</code></div>
    <div class="item" data-value="volume-off"><i class="mRa10 sf-volume-off"></i> <code class="fc-mute">volume-off</code></div>
    <div class="item" data-value="volume-down"><i class="mRa10 sf-volume-down"></i> <code class="fc-mute">volume-down</code></div>
    <div class="item" data-value="wrench"><i class="mRa10 sf-wrench"></i> <code class="fc-mute">wrench</code></div>
    <div class="item" data-value="thumbs-down"><i class="mRa10 sf-thumbs-down"></i> <code class="fc-mute">thumbs-down</code></div>
    <div class="item" data-value="thumbs-o-down"><i class="mRa10 sf-thumbs-o-down"></i> <code class="fc-mute">thumbs-o-down</code></div>
    <div class="item" data-value="thumbs-o-up"><i class="mRa10 sf-thumbs-o-up"></i> <code class="fc-mute">thumbs-o-up</code></div>
    <div class="item" data-value="thumbs-up"><i class="mRa10 sf-thumbs-up"></i> <code class="fc-mute">thumbs-up</code></div>
    <div class="item" data-value="thumb-tack"><i class="mRa10 sf-thumb-tack"></i> <code class="fc-mute">thumb-tack</code></div>
    <div class="item" data-value="trello"><i class="mRa10 sf-trello"></i> <code class="fc-mute">trello</code></div>
    <div class="item" data-value="tachometer"><i class="mRa10 sf-tachometer"></i> <code class="fc-mute">tachometer</code></div>
    <div class="item" data-value="recycle"><i class="mRa10 sf-recycle"></i> <code class="fc-mute">recycle</code></div>
    <div class="item" data-value="graph-bar"><i class="mRa10 sf-graph-bar"></i> <code class="fc-mute">graph-bar</code></div>
    <div class="item" data-value="graph-horizontal"><i class="mRa10 sf-graph-horizontal"></i> <code class="fc-mute">graph-horizontal</code></div>
    <div class="item" data-value="check-1"><i class="mRa10 sf-check-1"></i> <code class="fc-mute">check-1</code></div>
    <div class="item" data-value="monitor"><i class="mRa10 sf-monitor"></i> <code class="fc-mute">monitor</code></div>
    <div class="item" data-value="wrench-1"><i class="mRa10 sf-wrench-1"></i> <code class="fc-mute">wrench-1</code></div>
    <div class="item" data-value="widget"><i class="mRa10 sf-widget"></i> <code class="fc-mute">widget</code></div>
    <div class="item" data-value="thumbnails"><i class="mRa10 sf-thumbnails"></i> <code class="fc-mute">thumbnails</code></div>
    <div class="item" data-value="save"><i class="mRa10 sf-save"></i> <code class="fc-mute">save</code></div>
    <div class="item" data-value="chart-pie"><i class="mRa10 sf-chart-pie"></i> <code class="fc-mute">chart-pie</code></div>
    <div class="item" data-value="chart-line"><i class="mRa10 sf-chart-line"></i> <code class="fc-mute">chart-line</code></div>
    <div class="item" data-value="chart-bar"><i class="mRa10 sf-chart-bar"></i> <code class="fc-mute">chart-bar</code></div>
    <div class="item" data-value="chart-area"><i class="mRa10 sf-chart-area"></i> <code class="fc-mute">chart-area</code></div>
    <div class="item" data-value="chat"><i class="mRa10 sf-chat"></i> <code class="fc-mute">chat</code></div>
    <div class="item" data-value="flow-tree"><i class="mRa10 sf-flow-tree"></i> <code class="fc-mute">flow-tree</code></div>
    <div class="item" data-value="gauge"><i class="mRa10 sf-gauge"></i> <code class="fc-mute">gauge</code></div>
    <div class="item" data-value="flight"><i class="mRa10 sf-flight"></i> <code class="fc-mute">flight</code></div>
    <div class="item" data-value="graph"><i class="mRa10 sf-graph"></i> <code class="fc-mute">graph</code></div>
    <div class="item" data-value="grid"><i class="mRa10 sf-grid"></i> <code class="fc-mute">grid</code></div>
    <div class="item" data-value="dzone"><i class="mRa10 sf-dzone"></i> <code class="fc-mute">dzone</code></div>
    <div class="item" data-value="enter"><i class="mRa10 sf-enter"></i> <code class="fc-mute">enter</code></div>
    <div class="item" data-value="pinboard"><i class="mRa10 sf-pinboard"></i> <code class="fc-mute">pinboard</code></div>
    <div class="item" data-value="share"><i class="mRa10 sf-share"></i> <code class="fc-mute">share</code></div>
    <div class="item" data-value="out"><i class="mRa10 sf-out"></i> <code class="fc-mute">out</code></div>
    <div class="item" data-value="signout"><i class="mRa10 sf-signout"></i> <code class="fc-mute">signout</code></div>
    <div class="item" data-value="sign-out"><i class="mRa10 sf-sign-out"></i> <code class="fc-mute">sign-out</code></div>
    <div class="item" data-value="lock"><i class="mRa10 sf-lock"></i> <code class="fc-mute">lock</code></div>
    <div class="item" data-value="info-circle"><i class="mRa10 sf-info-circle"></i> <code class="fc-mute">info-circle</code></div>
    <div class="item" data-value="question"><i class="mRa10 sf-question"></i> <code class="fc-mute">question</code></div>
    <div class="item" data-value="question-circle"><i class="mRa10 sf-question-circle"></i> <code class="fc-mute">question-circle</code></div>
    <div class="item" data-value="plus-circle"><i class="mRa10 sf-plus-circle"></i> <code class="fc-mute">plus-circle</code></div>
    <div class="item" data-value="plus"><i class="mRa10 sf-plus"></i> <code class="fc-mute">plus</code></div>
    <div class="item" data-value="search"><i class="mRa10 sf-search"></i> <code class="fc-mute">search</code></div>
    <div class="item" data-value="times-circle"><i class="mRa10 sf-times-circle"></i> <code class="fc-mute">times-circle</code></div>
    <div class="item" data-value="times"><i class="mRa10 sf-times"></i> <code class="fc-mute">times</code></div>
    <div class="item" data-value="filter"><i class="mRa10 sf-filter"></i> <code class="fc-mute">filter</code></div>
    <div class="item" data-value="clipboard"><i class="mRa10 sf-clipboard"></i> <code class="fc-mute">clipboard</code></div>
    <div class="item" data-value="at"><i class="mRa10 sf-at"></i> <code class="fc-mute">at</code></div>
    <div class="item" data-value="instagram"><i class="mRa10 sf-instagram"></i> <code class="fc-mute">instagram</code></div>
    <div class="item" data-value="archive"><i class="mRa10 sf-archive"></i> <code class="fc-mute">archive</code></div>
    <div class="item" data-value="print"><i class="mRa10 sf-print"></i> <code class="fc-mute">print</code></div>
    <div class="item" data-value="tags"><i class="mRa10 sf-tags"></i> <code class="fc-mute">tags</code></div>
    <div class="item" data-value="tag"><i class="mRa10 sf-tag"></i> <code class="fc-mute">tag</code></div>
    <div class="item" data-value="bars"><i class="mRa10 sf-bars"></i> <code class="fc-mute">bars</code></div>
    <div class="item" data-value="cogs"><i class="mRa10 sf-cogs"></i> <code class="fc-mute">cogs</code></div>
    <div class="item" data-value="tasks"><i class="mRa10 sf-tasks"></i> <code class="fc-mute">tasks</code></div>
    <div class="item" data-value="analytics-chart-graph"><i class="mRa10 sf-analytics-chart-graph"></i> <code class="fc-mute">analytics-chart-graph</code></div>
    <div class="item" data-value="chart"><i class="mRa10 sf-chart"></i> <code class="fc-mute">chart</code></div>
    <div class="item" data-value="database"><i class="mRa10 sf-database"></i> <code class="fc-mute">database</code></div>
    <div class="item" data-value="whatsapp"><i class="mRa10 sf-whatsapp"></i> <code class="fc-mute">whatsapp</code></div>
    <div class="item" data-value="linkedin-square"><i class="mRa10 sf-linkedin-square"></i> <code class="fc-mute">linkedin-square</code></div>
    <div class="item" data-value="linkedin"><i class="mRa10 sf-linkedin"></i> <code class="fc-mute">linkedin</code></div>
    <div class="item" data-value="twitter-square"><i class="mRa10 sf-twitter-square"></i> <code class="fc-mute">twitter-square</code></div>
    <div class="item" data-value="twitter"><i class="mRa10 sf-twitter"></i> <code class="fc-mute">twitter</code></div>
    <div class="item" data-value="retweet"><i class="mRa10 sf-retweet"></i> <code class="fc-mute">retweet</code></div>
    <div class="item" data-value="refresh"><i class="mRa10 sf-refresh"></i> <code class="fc-mute">refresh</code></div>
    <div class="item" data-value="load-c"><i class="mRa10 sf-load-c"></i> <code class="fc-mute">load-c</code></div>
    <div class="item" data-value="trophy"><i class="mRa10 sf-trophy"></i> <code class="fc-mute">trophy</code></div>
    <div class="item" data-value="ribbon-b"><i class="mRa10 sf-ribbon-b"></i> <code class="fc-mute">ribbon-b</code></div>
    <div class="item" data-value="ribbon-a"><i class="mRa10 sf-ribbon-a"></i> <code class="fc-mute">ribbon-a</code></div>
    <div class="item" data-value="edit-write"><i class="mRa10 sf-edit-write"></i> <code class="fc-mute">edit-write</code></div>
    <div class="item" data-value="building"><i class="mRa10 sf-building"></i> <code class="fc-mute">building</code></div>
    <div class="item" data-value="pencil-square-o"><i class="mRa10 sf-pencil-square-o"></i> <code class="fc-mute">pencil-square-o</code></div>
    <div class="item" data-value="pencil-square"><i class="mRa10 sf-pencil-square"></i> <code class="fc-mute">pencil-square</code></div>
    <div class="item" data-value="pencil"><i class="mRa10 sf-pencil"></i> <code class="fc-mute">pencil</code></div>
    <div class="item" data-value="bold"><i class="mRa10 sf-bold"></i> <code class="fc-mute">bold</code></div>
    <div class="item" data-value="crop-1"><i class="mRa10 sf-crop-1"></i> <code class="fc-mute">crop-1</code></div>
    <div class="item" data-value="align-center-1"><i class="mRa10 sf-align-center-1"></i> <code class="fc-mute">align-center-1</code></div>
    <div class="item" data-value="align-justify-1"><i class="mRa10 sf-align-justify-1"></i> <code class="fc-mute">align-justify-1</code></div>
    <div class="item" data-value="align-left-1"><i class="mRa10 sf-align-left-1"></i> <code class="fc-mute">align-left-1</code></div>
    <div class="item" data-value="indent"><i class="mRa10 sf-indent"></i> <code class="fc-mute">indent</code></div>
    <div class="item" data-value="outdent"><i class="mRa10 sf-outdent"></i> <code class="fc-mute">outdent</code></div>
    <div class="item" data-value="superscript"><i class="mRa10 sf-superscript"></i> <code class="fc-mute">superscript</code></div>
    <div class="item" data-value="subscript"><i class="mRa10 sf-subscript"></i> <code class="fc-mute">subscript</code></div>
    <div class="item" data-value="align-right-1"><i class="mRa10 sf-align-right-1"></i> <code class="fc-mute">align-right-1</code></div>
    <div class="item" data-value="font"><i class="mRa10 sf-font"></i> <code class="fc-mute">font</code></div>
    <div class="item" data-value="list"><i class="mRa10 sf-list"></i> <code class="fc-mute">list</code></div>
    <div class="item" data-value="pencil-square-1"><i class="mRa10 sf-pencil-square-1"></i> <code class="fc-mute">pencil-square-1</code></div>
    <div class="item" data-value="text-height"><i class="mRa10 sf-text-height"></i> <code class="fc-mute">text-height</code></div>
    <div class="item" data-value="trash"><i class="mRa10 sf-trash"></i> <code class="fc-mute">trash</code></div>
    <div class="item" data-value="trash-o"><i class="mRa10 sf-trash-o"></i> <code class="fc-mute">trash-o</code></div>
    <div class="item" data-value="ban"><i class="mRa10 sf-ban"></i> <code class="fc-mute">ban</code></div>
    <div class="item" data-value="minus-circle"><i class="mRa10 sf-minus-circle"></i> <code class="fc-mute">minus-circle</code></div>
    <div class="item" data-value="minus-square"><i class="mRa10 sf-minus-square"></i> <code class="fc-mute">minus-square</code></div>
    <div class="item" data-value="link"><i class="mRa10 sf-link"></i> <code class="fc-mute">link</code></div>
    <div class="item" data-value="link-external"><i class="mRa10 sf-link-external"></i> <code class="fc-mute">link-external</code></div>
    <div class="item" data-value="tools"><i class="mRa10 sf-tools"></i> <code class="fc-mute">tools</code></div>
    <div class="item" data-value="wrench-2"><i class="mRa10 sf-wrench-2"></i> <code class="fc-mute">wrench-2</code></div>
    <div class="item" data-value="power-off"><i class="mRa10 sf-power-off"></i> <code class="fc-mute">power-off</code></div>
    <div class="item" data-value="credit-card"><i class="mRa10 sf-credit-card"></i> <code class="fc-mute">credit-card</code></div>
    <div class="item" data-value="user-7"><i class="mRa10 sf-user-7"></i> <code class="fc-mute">user-7</code></div>
    <div class="item" data-value="user-6"><i class="mRa10 sf-user-6"></i> <code class="fc-mute">user-6</code></div>
    <div class="item" data-value="user-4"><i class="mRa10 sf-user-4"></i> <code class="fc-mute">user-4</code></div>
    <div class="item" data-value="user-3"><i class="mRa10 sf-user-3"></i> <code class="fc-mute">user-3</code></div>
    <div class="item" data-value="user-5"><i class="mRa10 sf-user-5"></i> <code class="fc-mute">user-5</code></div>
    <div class="item" data-value="forum-user"><i class="mRa10 sf-forum-user"></i> <code class="fc-mute">forum-user</code></div>
    <div class="item" data-value="file-1"><i class="mRa10 sf-file-1"></i> <code class="fc-mute">file-1</code></div>
    <div class="item" data-value="folder"><i class="mRa10 sf-folder"></i> <code class="fc-mute">folder</code></div>
    <div class="item" data-value="folder-1"><i class="mRa10 sf-folder-1"></i> <code class="fc-mute">folder-1</code></div>
    <div class="item" data-value="medal"><i class="mRa10 sf-medal"></i> <code class="fc-mute">medal</code></div>
    <div class="item" data-value="network"><i class="mRa10 sf-network"></i> <code class="fc-mute">network</code></div>
    <div class="item" data-value="save-1"><i class="mRa10 sf-save-1"></i> <code class="fc-mute">save-1</code></div>
    <div class="item" data-value="star-1"><i class="mRa10 sf-star-1"></i> <code class="fc-mute">star-1</code></div>
    <div class="item" data-value="display"><i class="mRa10 sf-display"></i> <code class="fc-mute">display</code></div>
    <div class="item" data-value="dollar"><i class="mRa10 sf-dollar"></i> <code class="fc-mute">dollar</code></div>
    <div class="item" data-value="euro"><i class="mRa10 sf-euro"></i> <code class="fc-mute">euro</code></div>
    <div class="item" data-value="pound"><i class="mRa10 sf-pound"></i> <code class="fc-mute">pound</code></div>
    <div class="item" data-value="money-banknote"><i class="mRa10 sf-money-banknote"></i> <code class="fc-mute">money-banknote</code></div>
    <div class="item" data-value="male-rounded-1"><i class="mRa10 sf-male-rounded-1"></i> <code class="fc-mute">male-rounded-1</code></div>
    <div class="item" data-value="female-rounded-1"><i class="mRa10 sf-female-rounded-1"></i> <code class="fc-mute">female-rounded-1</code></div>
    <div class="item" data-value="female"><i class="mRa10 sf-female"></i> <code class="fc-mute">female</code></div>
    <div class="item" data-value="male"><i class="mRa10 sf-male"></i> <code class="fc-mute">male</code></div>
    <div class="item" data-value="arrows-out"><i class="mRa10 sf-arrows-out"></i> <code class="fc-mute">arrows-out</code></div>
    <div class="item" data-value="print-1"><i class="mRa10 sf-print-1"></i> <code class="fc-mute">print-1</code></div>
    <div class="item" data-value="zoom-out"><i class="mRa10 sf-zoom-out"></i> <code class="fc-mute">zoom-out</code></div>
    <div class="item" data-value="earth"><i class="mRa10 sf-earth"></i> <code class="fc-mute">earth</code></div>
    <div class="item" data-value="building-o"><i class="mRa10 sf-building-o"></i> <code class="fc-mute">building-o</code></div>
    <div class="item" data-value="briefcase"><i class="mRa10 sf-briefcase"></i> <code class="fc-mute">briefcase</code></div>
    <div class="item" data-value="interface-windows"><i class="mRa10 sf-interface-windows"></i> <code class="fc-mute">interface-windows</code></div>
    <div class="item" data-value="angle-double-down"><i class="mRa10 sf-angle-double-down"></i> <code class="fc-mute">angle-double-down</code></div>
    <div class="item" data-value="angle-double-left"><i class="mRa10 sf-angle-double-left"></i> <code class="fc-mute">angle-double-left</code></div>
    <div class="item" data-value="angle-double-right"><i class="mRa10 sf-angle-double-right"></i> <code class="fc-mute">angle-double-right</code></div>
    <div class="item" data-value="angle-double-up"><i class="mRa10 sf-angle-double-up"></i> <code class="fc-mute">angle-double-up</code></div>
    <div class="item" data-value="arrow-circle-down"><i class="mRa10 sf-arrow-circle-down"></i> <code class="fc-mute">arrow-circle-down</code></div>
    <div class="item" data-value="arrow-circle-left"><i class="mRa10 sf-arrow-circle-left"></i> <code class="fc-mute">arrow-circle-left</code></div>
    <div class="item" data-value="arrow-circle-o-down"><i class="mRa10 sf-arrow-circle-o-down"></i> <code class="fc-mute">arrow-circle-o-down</code></div>
    <div class="item" data-value="area-chart"><i class="mRa10 sf-area-chart"></i> <code class="fc-mute">area-chart</code></div>
    <div class="item" data-value="arrow-circle-o-left"><i class="mRa10 sf-arrow-circle-o-left"></i> <code class="fc-mute">arrow-circle-o-left</code></div>
    <div class="item" data-value="arrow-circle-o-right"><i class="mRa10 sf-arrow-circle-o-right"></i> <code class="fc-mute">arrow-circle-o-right</code></div>
    <div class="item" data-value="arrow-circle-o-up"><i class="mRa10 sf-arrow-circle-o-up"></i> <code class="fc-mute">arrow-circle-o-up</code></div>
    <div class="item" data-value="arrow-circle-right"><i class="mRa10 sf-arrow-circle-right"></i> <code class="fc-mute">arrow-circle-right</code></div>
    <div class="item" data-value="arrow-circle-up"><i class="mRa10 sf-arrow-circle-up"></i> <code class="fc-mute">arrow-circle-up</code></div>
    <div class="item" data-value="arrow-down"><i class="mRa10 sf-arrow-down"></i> <code class="fc-mute">arrow-down</code></div>
    <div class="item" data-value="arrow-left"><i class="mRa10 sf-arrow-left"></i> <code class="fc-mute">arrow-left</code></div>
    <div class="item" data-value="arrow-right"><i class="mRa10 sf-arrow-right"></i> <code class="fc-mute">arrow-right</code></div>
    <div class="item" data-value="arrow-up"><i class="mRa10 sf-arrow-up"></i> <code class="fc-mute">arrow-up</code></div>
    <div class="item" data-value="battery-empty"><i class="mRa10 sf-battery-empty"></i> <code class="fc-mute">battery-empty</code></div>
    <div class="item" data-value="battery-full"><i class="mRa10 sf-battery-full"></i> <code class="fc-mute">battery-full</code></div>
    <div class="item" data-value="battery-half"><i class="mRa10 sf-battery-half"></i> <code class="fc-mute">battery-half</code></div>
    <div class="item" data-value="battery-quarter"><i class="mRa10 sf-battery-quarter"></i> <code class="fc-mute">battery-quarter</code></div>
    <div class="item" data-value="battery-three-quarters"><i class="mRa10 sf-battery-three-quarters"></i> <code class="fc-mute">battery-three-quarters</code></div>
    <div class="item" data-value="barcode"><i class="mRa10 sf-barcode"></i> <code class="fc-mute">barcode</code></div>
    <div class="item" data-value="at-1"><i class="mRa10 sf-at-1"></i> <code class="fc-mute">at-1</code></div>
    <div class="item" data-value="bed"><i class="mRa10 sf-bed"></i> <code class="fc-mute">bed</code></div>
    <div class="item" data-value="binoculars"><i class="mRa10 sf-binoculars"></i> <code class="fc-mute">binoculars</code></div>
    <div class="item" data-value="bold-1"><i class="mRa10 sf-bold-1"></i> <code class="fc-mute">bold-1</code></div>
    <div class="item" data-value="book"><i class="mRa10 sf-book"></i> <code class="fc-mute">book</code></div>
    <div class="item" data-value="bus"><i class="mRa10 sf-bus"></i> <code class="fc-mute">bus</code></div>
    <div class="item" data-value="calculator"><i class="mRa10 sf-calculator"></i> <code class="fc-mute">calculator</code></div>
    <div class="item" data-value="calendar"><i class="mRa10 sf-calendar"></i> <code class="fc-mute">calendar</code></div>
    <div class="item" data-value="calendar-check-o"><i class="mRa10 sf-calendar-check-o"></i> <code class="fc-mute">calendar-check-o</code></div>
    <div class="item" data-value="calendar-minus-o"><i class="mRa10 sf-calendar-minus-o"></i> <code class="fc-mute">calendar-minus-o</code></div>
    <div class="item" data-value="camera"><i class="mRa10 sf-camera"></i> <code class="fc-mute">camera</code></div>
    <div class="item" data-value="camera-retro"><i class="mRa10 sf-camera-retro"></i> <code class="fc-mute">camera-retro</code></div>
    <div class="item" data-value="car"><i class="mRa10 sf-car"></i> <code class="fc-mute">car</code></div>
    <div class="item" data-value="cart-plus"><i class="mRa10 sf-cart-plus"></i> <code class="fc-mute">cart-plus</code></div>
    <div class="item" data-value="cc-mastercard"><i class="mRa10 sf-cc-mastercard"></i> <code class="fc-mute">cc-mastercard</code></div>
    <div class="item" data-value="check-circle"><i class="mRa10 sf-check-circle"></i> <code class="fc-mute">check-circle</code></div>
    <div class="item" data-value="check-circle-o"><i class="mRa10 sf-check-circle-o"></i> <code class="fc-mute">check-circle-o</code></div>
    <div class="item" data-value="check-square"><i class="mRa10 sf-check-square"></i> <code class="fc-mute">check-square</code></div>
    <div class="item" data-value="check-square-o"><i class="mRa10 sf-check-square-o"></i> <code class="fc-mute">check-square-o</code></div>
    <div class="item" data-value="chevron-down"><i class="mRa10 sf-chevron-down"></i> <code class="fc-mute">chevron-down</code></div>
    <div class="item" data-value="chevron-left"><i class="mRa10 sf-chevron-left"></i> <code class="fc-mute">chevron-left</code></div>
    <div class="item" data-value="chevron-right"><i class="mRa10 sf-chevron-right"></i> <code class="fc-mute">chevron-right</code></div>
    <div class="item" data-value="chevron-up"><i class="mRa10 sf-chevron-up"></i> <code class="fc-mute">chevron-up</code></div>
    <div class="item" data-value="child"><i class="mRa10 sf-child"></i> <code class="fc-mute">child</code></div>
    <div class="item" data-value="chrome"><i class="mRa10 sf-chrome"></i> <code class="fc-mute">chrome</code></div>
    <div class="item" data-value="circle-o-notch"><i class="mRa10 sf-circle-o-notch"></i> <code class="fc-mute">circle-o-notch</code></div>
    <div class="item" data-value="code"><i class="mRa10 sf-code"></i> <code class="fc-mute">code</code></div>
    <div class="item" data-value="code-fork"><i class="mRa10 sf-code-fork"></i> <code class="fc-mute">code-fork</code></div>
    <div class="item" data-value="coffee"><i class="mRa10 sf-coffee"></i> <code class="fc-mute">coffee</code></div>
    <div class="item" data-value="compress"><i class="mRa10 sf-compress"></i> <code class="fc-mute">compress</code></div>
    <div class="item" data-value="copyright"><i class="mRa10 sf-copyright"></i> <code class="fc-mute">copyright</code></div>
    <div class="item" data-value="css3"><i class="mRa10 sf-css3"></i> <code class="fc-mute">css3</code></div>
    <div class="item" data-value="diamond"><i class="mRa10 sf-diamond"></i> <code class="fc-mute">diamond</code></div>
    <div class="item" data-value="eject"><i class="mRa10 sf-eject"></i> <code class="fc-mute">eject</code></div>
    <div class="item" data-value="exchange"><i class="mRa10 sf-exchange"></i> <code class="fc-mute">exchange</code></div>
    <div class="item" data-value="eur"><i class="mRa10 sf-eur"></i> <code class="fc-mute">eur</code></div>
    <div class="item" data-value="exclamation"><i class="mRa10 sf-exclamation"></i> <code class="fc-mute">exclamation</code></div>
    <div class="item" data-value="exclamation-circle"><i class="mRa10 sf-exclamation-circle"></i> <code class="fc-mute">exclamation-circle</code></div>
    <div class="item" data-value="exclamation-triangle"><i class="mRa10 sf-exclamation-triangle"></i> <code class="fc-mute">exclamation-triangle</code></div>
    <div class="item" data-value="expand"><i class="mRa10 sf-expand"></i> <code class="fc-mute">expand</code></div>
    <div class="item" data-value="expeditedssl"><i class="mRa10 sf-expeditedssl"></i> <code class="fc-mute">expeditedssl</code></div>
    <div class="item" data-value="external-link"><i class="mRa10 sf-external-link"></i> <code class="fc-mute">external-link</code></div>
    <div class="item" data-value="eyedropper"><i class="mRa10 sf-eyedropper"></i> <code class="fc-mute">eyedropper</code></div>
    <div class="item" data-value="fast-backward"><i class="mRa10 sf-fast-backward"></i> <code class="fc-mute">fast-backward</code></div>
    <div class="item" data-value="fast-forward"><i class="mRa10 sf-fast-forward"></i> <code class="fc-mute">fast-forward</code></div>
    <div class="item" data-value="fax"><i class="mRa10 sf-fax"></i> <code class="fc-mute">fax</code></div>
    <div class="item" data-value="firefox"><i class="mRa10 sf-firefox"></i> <code class="fc-mute">firefox</code></div>
    <div class="item" data-value="flask"><i class="mRa10 sf-flask"></i> <code class="fc-mute">flask</code></div>
    <div class="item" data-value="folder-o"><i class="mRa10 sf-folder-o"></i> <code class="fc-mute">folder-o</code></div>
    <div class="item" data-value="folder-2"><i class="mRa10 sf-folder-2"></i> <code class="fc-mute">folder-2</code></div>
    <div class="item" data-value="folder-open"><i class="mRa10 sf-folder-open"></i> <code class="fc-mute">folder-open</code></div>
    <div class="item" data-value="folder-open-o"><i class="mRa10 sf-folder-open-o"></i> <code class="fc-mute">folder-open-o</code></div>
    <div class="item" data-value="font-1"><i class="mRa10 sf-font-1"></i> <code class="fc-mute">font-1</code></div>
    <div class="item" data-value="frown-o"><i class="mRa10 sf-frown-o"></i> <code class="fc-mute">frown-o</code></div>
    <div class="item" data-value="gift"><i class="mRa10 sf-gift"></i> <code class="fc-mute">gift</code></div>
    <div class="item" data-value="gratipay"><i class="mRa10 sf-gratipay"></i> <code class="fc-mute">gratipay</code></div>
    <div class="item" data-value="google-plus"><i class="mRa10 sf-google-plus"></i> <code class="fc-mute">google-plus</code></div>
    <div class="item" data-value="google"><i class="mRa10 sf-google"></i> <code class="fc-mute">google</code></div>
    <div class="item" data-value="git-square"><i class="mRa10 sf-git-square"></i> <code class="fc-mute">git-square</code></div>
    <div class="item" data-value="git"><i class="mRa10 sf-git"></i> <code class="fc-mute">git</code></div>
    <div class="item" data-value="hand-peace-o"><i class="mRa10 sf-hand-peace-o"></i> <code class="fc-mute">hand-peace-o</code></div>
    <div class="item" data-value="header"><i class="mRa10 sf-header"></i> <code class="fc-mute">header</code></div>
    <div class="item" data-value="headphones"><i class="mRa10 sf-headphones"></i> <code class="fc-mute">headphones</code></div>
    <div class="item" data-value="heartbeat"><i class="mRa10 sf-heartbeat"></i> <code class="fc-mute">heartbeat</code></div>
    <div class="item" data-value="hourglass-start"><i class="mRa10 sf-hourglass-start"></i> <code class="fc-mute">hourglass-start</code></div>
    <div class="item" data-value="html5"><i class="mRa10 sf-html5"></i> <code class="fc-mute">html5</code></div>
    <div class="item" data-value="indent-1"><i class="mRa10 sf-indent-1"></i> <code class="fc-mute">indent-1</code></div>
    <div class="item" data-value="inbox"><i class="mRa10 sf-inbox"></i> <code class="fc-mute">inbox</code></div>
    <div class="item" data-value="internet-explorer"><i class="mRa10 sf-internet-explorer"></i> <code class="fc-mute">internet-explorer</code></div>
    <div class="item" data-value="italic"><i class="mRa10 sf-italic"></i> <code class="fc-mute">italic</code></div>
    <div class="item" data-value="linux"><i class="mRa10 sf-linux"></i> <code class="fc-mute">linux</code></div>
    <div class="item" data-value="lightbulb-o"><i class="mRa10 sf-lightbulb-o"></i> <code class="fc-mute">lightbulb-o</code></div>
    <div class="item" data-value="life-ring"><i class="mRa10 sf-life-ring"></i> <code class="fc-mute">life-ring</code></div>
    <div class="item" data-value="level-down"><i class="mRa10 sf-level-down"></i> <code class="fc-mute">level-down</code></div>
    <div class="item" data-value="level-up"><i class="mRa10 sf-level-up"></i> <code class="fc-mute">level-up</code></div>
    <div class="item" data-value="list-ol"><i class="mRa10 sf-list-ol"></i> <code class="fc-mute">list-ol</code></div>
    <div class="item" data-value="list-ul"><i class="mRa10 sf-list-ul"></i> <code class="fc-mute">list-ul</code></div>
    <div class="item" data-value="location-arrow"><i class="mRa10 sf-location-arrow"></i> <code class="fc-mute">location-arrow</code></div>
    <div class="item" data-value="magic"><i class="mRa10 sf-magic"></i> <code class="fc-mute">magic</code></div>
    <div class="item" data-value="map-marker"><i class="mRa10 sf-map-marker"></i> <code class="fc-mute">map-marker</code></div>
    <div class="item" data-value="map"><i class="mRa10 sf-map"></i> <code class="fc-mute">map</code></div>
    <div class="item" data-value="meh-o"><i class="mRa10 sf-meh-o"></i> <code class="fc-mute">meh-o</code></div>
    <div class="item" data-value="map-pin"><i class="mRa10 sf-map-pin"></i> <code class="fc-mute">map-pin</code></div>
    <div class="item" data-value="mars"><i class="mRa10 sf-mars"></i> <code class="fc-mute">mars</code></div>
    <div class="item" data-value="microphone"><i class="mRa10 sf-microphone"></i> <code class="fc-mute">microphone</code></div>
    <div class="item" data-value="microphone-slash"><i class="mRa10 sf-microphone-slash"></i> <code class="fc-mute">microphone-slash</code></div>
    <div class="item" data-value="mobile"><i class="mRa10 sf-mobile"></i> <code class="fc-mute">mobile</code></div>
    <div class="item" data-value="money"><i class="mRa10 sf-money"></i> <code class="fc-mute">money</code></div>
    <div class="item" data-value="moon-o"><i class="mRa10 sf-moon-o"></i> <code class="fc-mute">moon-o</code></div>
    <div class="item" data-value="motorcycle"><i class="mRa10 sf-motorcycle"></i> <code class="fc-mute">motorcycle</code></div>
    <div class="item" data-value="mouse-pointer"><i class="mRa10 sf-mouse-pointer"></i> <code class="fc-mute">mouse-pointer</code></div>
    <div class="item" data-value="music"><i class="mRa10 sf-music"></i> <code class="fc-mute">music</code></div>
    <div class="item" data-value="paint-brush"><i class="mRa10 sf-paint-brush"></i> <code class="fc-mute">paint-brush</code></div>
    <div class="item" data-value="picture-o"><i class="mRa10 sf-picture-o"></i> <code class="fc-mute">picture-o</code></div>
    <div class="item" data-value="phone-square"><i class="mRa10 sf-phone-square"></i> <code class="fc-mute">phone-square</code></div>
    <div class="item" data-value="phone"><i class="mRa10 sf-phone"></i> <code class="fc-mute">phone</code></div>
    <div class="item" data-value="paper-plane"><i class="mRa10 sf-paper-plane"></i> <code class="fc-mute">paper-plane</code></div>
    <div class="item" data-value="paper-plane-o"><i class="mRa10 sf-paper-plane-o"></i> <code class="fc-mute">paper-plane-o</code></div>
    <div class="item" data-value="pie-chart"><i class="mRa10 sf-pie-chart"></i> <code class="fc-mute">pie-chart</code></div>
    <div class="item" data-value="play"><i class="mRa10 sf-play"></i> <code class="fc-mute">play</code></div>
    <div class="item" data-value="play-circle-o"><i class="mRa10 sf-play-circle-o"></i> <code class="fc-mute">play-circle-o</code></div>
    <div class="item" data-value="plug"><i class="mRa10 sf-plug"></i> <code class="fc-mute">plug</code></div>
    <div class="item" data-value="plus-square"><i class="mRa10 sf-plus-square"></i> <code class="fc-mute">plus-square</code></div>
    <div class="item" data-value="plus-square-o"><i class="mRa10 sf-plus-square-o"></i> <code class="fc-mute">plus-square-o</code></div>
    <div class="item" data-value="power-off-1"><i class="mRa10 sf-power-off-1"></i> <code class="fc-mute">power-off-1</code></div>
    <div class="item" data-value="registered"><i class="mRa10 sf-registered"></i> <code class="fc-mute">registered</code></div>
    <div class="item" data-value="repeat"><i class="mRa10 sf-repeat"></i> <code class="fc-mute">repeat</code></div>
    <div class="item" data-value="rocket"><i class="mRa10 sf-rocket"></i> <code class="fc-mute">rocket</code></div>
    <div class="item" data-value="rss-square"><i class="mRa10 sf-rss-square"></i> <code class="fc-mute">rss-square</code></div>
    <div class="item" data-value="scissors"><i class="mRa10 sf-scissors"></i> <code class="fc-mute">scissors</code></div>
    <div class="item" data-value="safari"><i class="mRa10 sf-safari"></i> <code class="fc-mute">safari</code></div>
    <div class="item" data-value="search-plus"><i class="mRa10 sf-search-plus"></i> <code class="fc-mute">search-plus</code></div>
    <div class="item" data-value="search-minus"><i class="mRa10 sf-search-minus"></i> <code class="fc-mute">search-minus</code></div>
    <div class="item" data-value="sellsy"><i class="mRa10 sf-sellsy"></i> <code class="fc-mute">sellsy</code></div>
    <div class="item" data-value="server"><i class="mRa10 sf-server"></i> <code class="fc-mute">server</code></div>
    <div class="item" data-value="share-alt"><i class="mRa10 sf-share-alt"></i> <code class="fc-mute">share-alt</code></div>
    <div class="item" data-value="share-alt-square"><i class="mRa10 sf-share-alt-square"></i> <code class="fc-mute">share-alt-square</code></div>
    <div class="item" data-value="share-square"><i class="mRa10 sf-share-square"></i> <code class="fc-mute">share-square</code></div>
    <div class="item" data-value="share-square-o"><i class="mRa10 sf-share-square-o"></i> <code class="fc-mute">share-square-o</code></div>
    <div class="item" data-value="shield"><i class="mRa10 sf-shield"></i> <code class="fc-mute">shield</code></div>
    <div class="item" data-value="shopping-cart"><i class="mRa10 sf-shopping-cart"></i> <code class="fc-mute">shopping-cart</code></div>
    <div class="item" data-value="sign-in"><i class="mRa10 sf-sign-in"></i> <code class="fc-mute">sign-in</code></div>
    <div class="item" data-value="signal"><i class="mRa10 sf-signal"></i> <code class="fc-mute">signal</code></div>
    <div class="item" data-value="sitemap"><i class="mRa10 sf-sitemap"></i> <code class="fc-mute">sitemap</code></div>
    <div class="item" data-value="slack"><i class="mRa10 sf-slack"></i> <code class="fc-mute">slack</code></div>
    <div class="item" data-value="sliders"><i class="mRa10 sf-sliders"></i> <code class="fc-mute">sliders</code></div>
    <div class="item" data-value="sort"><i class="mRa10 sf-sort"></i> <code class="fc-mute">sort</code></div>
    <div class="item" data-value="smile-o"><i class="mRa10 sf-smile-o"></i> <code class="fc-mute">smile-o</code></div>
    <div class="item" data-value="sort-asc"><i class="mRa10 sf-sort-asc"></i> <code class="fc-mute">sort-asc</code></div>
    <div class="item" data-value="sort-desc"><i class="mRa10 sf-sort-desc"></i> <code class="fc-mute">sort-desc</code></div>
    <div class="item" data-value="soundcloud"><i class="mRa10 sf-soundcloud"></i> <code class="fc-mute">soundcloud</code></div>
    <div class="item" data-value="space-shuttle"><i class="mRa10 sf-space-shuttle"></i> <code class="fc-mute">space-shuttle</code></div>
    <div class="item" data-value="stack-overflow"><i class="mRa10 sf-stack-overflow"></i> <code class="fc-mute">stack-overflow</code></div>
    <div class="item" data-value="sun-o"><i class="mRa10 sf-sun-o"></i> <code class="fc-mute">sun-o</code></div>
    <div class="item" data-value="superscript-1"><i class="mRa10 sf-superscript-1"></i> <code class="fc-mute">superscript-1</code></div>
    <div class="item" data-value="table"><i class="mRa10 sf-table"></i> <code class="fc-mute">table</code></div>
    <div class="item" data-value="tablet"><i class="mRa10 sf-tablet"></i> <code class="fc-mute">tablet</code></div>
    <div class="item" data-value="taxi"><i class="mRa10 sf-taxi"></i> <code class="fc-mute">taxi</code></div>
    <div class="item" data-value="television"><i class="mRa10 sf-television"></i> <code class="fc-mute">television</code></div>
    <div class="item" data-value="terminal"><i class="mRa10 sf-terminal"></i> <code class="fc-mute">terminal</code></div>
    <div class="item" data-value="text-height-1"><i class="mRa10 sf-text-height-1"></i> <code class="fc-mute">text-height-1</code></div>
    <div class="item" data-value="text-width"><i class="mRa10 sf-text-width"></i> <code class="fc-mute">text-width</code></div>
    <div class="item" data-value="th"><i class="mRa10 sf-th"></i> <code class="fc-mute">th</code></div>
    <div class="item" data-value="th-large"><i class="mRa10 sf-th-large"></i> <code class="fc-mute">th-large</code></div>
    <div class="item" data-value="th-list"><i class="mRa10 sf-th-list"></i> <code class="fc-mute">th-list</code></div>
    <div class="item" data-value="trademark"><i class="mRa10 sf-trademark"></i> <code class="fc-mute">trademark</code></div>
    <div class="item" data-value="tree"><i class="mRa10 sf-tree"></i> <code class="fc-mute">tree</code></div>
    <div class="item" data-value="undo"><i class="mRa10 sf-undo"></i> <code class="fc-mute">undo</code></div>
    <div class="item" data-value="underline"><i class="mRa10 sf-underline"></i> <code class="fc-mute">underline</code></div>
    <div class="item" data-value="umbrella"><i class="mRa10 sf-umbrella"></i> <code class="fc-mute">umbrella</code></div>
    <div class="item" data-value="tty"><i class="mRa10 sf-tty"></i> <code class="fc-mute">tty</code></div>
    <div class="item" data-value="trophy-1"><i class="mRa10 sf-trophy-1"></i> <code class="fc-mute">trophy-1</code></div>
    <div class="item" data-value="upload"><i class="mRa10 sf-upload"></i> <code class="fc-mute">upload</code></div>
    <div class="item" data-value="usd"><i class="mRa10 sf-usd"></i> <code class="fc-mute">usd</code></div>
    <div class="item" data-value="venus"><i class="mRa10 sf-venus"></i> <code class="fc-mute">venus</code></div>
    <div class="item" data-value="wheelchair"><i class="mRa10 sf-wheelchair"></i> <code class="fc-mute">wheelchair</code></div>
    <div class="item" data-value="weixin"><i class="mRa10 sf-weixin"></i> <code class="fc-mute">weixin</code></div>
    <div class="item" data-value="video-camera"><i class="mRa10 sf-video-camera"></i> <code class="fc-mute">video-camera</code></div>
    <div class="item" data-value="wifi"><i class="mRa10 sf-wifi"></i> <code class="fc-mute">wifi</code></div>
    <div class="item" data-value="wordpress"><i class="mRa10 sf-wordpress"></i> <code class="fc-mute">wordpress</code></div>
    <div class="item" data-value="youtube"><i class="mRa10 sf-youtube"></i> <code class="fc-mute">youtube</code></div>
    <div class="item" data-value="pin"><i class="mRa10 sf-pin"></i> <code class="fc-mute">pin</code></div>
    <div class="item" data-value="anchor"><i class="mRa10 sf-anchor"></i> <code class="fc-mute">anchor</code></div>
    <div class="item" data-value="alarm"><i class="mRa10 sf-alarm"></i> <code class="fc-mute">alarm</code></div>
    <div class="item" data-value="instagram-1"><i class="mRa10 sf-instagram-1"></i> <code class="fc-mute">instagram-1</code></div>
    <div class="item" data-value="heart-1"><i class="mRa10 sf-heart-1"></i> <code class="fc-mute">heart-1</code></div>
    <div class="item" data-value="task"><i class="mRa10 sf-task"></i> <code class="fc-mute">task</code></div>
    <div class="item" data-value="broadcast"><i class="mRa10 sf-broadcast"></i> <code class="fc-mute">broadcast</code></div>
    <div class="item" data-value="bug-1"><i class="mRa10 sf-bug-1"></i> <code class="fc-mute">bug-1</code></div>
    <div class="item" data-value="star-2"><i class="mRa10 sf-star-2"></i> <code class="fc-mute">star-2</code></div>
    <div class="item" data-value="mark-github"><i class="mRa10 sf-mark-github"></i> <code class="fc-mute">mark-github</code></div>
    <div class="item" data-value="flag-1"><i class="mRa10 sf-flag-1"></i> <code class="fc-mute">flag-1</code></div>
    <div class="item" data-value="bug-2"><i class="mRa10 sf-bug-2"></i> <code class="fc-mute">bug-2</code></div>
    <div class="item" data-value="android-1"><i class="mRa10 sf-android-1"></i> <code class="fc-mute">android-1</code></div>
    <div class="item" data-value="bluetooth"><i class="mRa10 sf-bluetooth"></i> <code class="fc-mute">bluetooth</code></div>
    <div class="item" data-value="heart-2"><i class="mRa10 sf-heart-2"></i> <code class="fc-mute">heart-2</code></div>
    <div class="item" data-value="hashtag"><i class="mRa10 sf-hashtag"></i> <code class="fc-mute">hashtag</code></div>
    <div class="item" data-value="windows-1"><i class="mRa10 sf-windows-1"></i> <code class="fc-mute">windows-1</code></div>
    <div class="item" data-value="barcode-1"><i class="mRa10 sf-barcode-1"></i> <code class="fc-mute">barcode-1</code></div>
    <div class="item" data-value="glass-1"><i class="mRa10 sf-glass-1"></i> <code class="fc-mute">glass-1</code></div>
    <div class="item" data-value="tags-1"><i class="mRa10 sf-tags-1"></i> <code class="fc-mute">tags-1</code></div>
    <div class="item" data-value="tag-1"><i class="mRa10 sf-tag-1"></i> <code class="fc-mute">tag-1</code></div>
    <div class="item" data-value="skype"><i class="mRa10 sf-skype"></i> <code class="fc-mute">skype</code></div>
    <div class="item" data-value="yang-ying"><i class="mRa10 sf-yang-ying"></i> <code class="fc-mute">yang-ying</code></div>
    <div class="item" data-value="address-book"><i class="mRa10 sf-address-book"></i> <code class="fc-mute">address-book</code></div>
    <div class="item" data-value="alert"><i class="mRa10 sf-alert"></i> <code class="fc-mute">alert</code></div>
    <div class="item" data-value="adjust"><i class="mRa10 sf-adjust"></i> <code class="fc-mute">adjust</code></div>
    <div class="item" data-value="code-1"><i class="mRa10 sf-code-1"></i> <code class="fc-mute">code-1</code></div>
    <div class="item" data-value="basket"><i class="mRa10 sf-basket"></i> <code class="fc-mute">basket</code></div>
    <div class="item" data-value="attach"><i class="mRa10 sf-attach"></i> <code class="fc-mute">attach</code></div>
    <div class="item" data-value="globe-1"><i class="mRa10 sf-globe-1"></i> <code class="fc-mute">globe-1</code></div>
    <div class="item" data-value="lamp"><i class="mRa10 sf-lamp"></i> <code class="fc-mute">lamp</code></div>
    <div class="item" data-value="left-quote"><i class="mRa10 sf-left-quote"></i> <code class="fc-mute">left-quote</code></div>
    <div class="item" data-value="headphones-1"><i class="mRa10 sf-headphones-1"></i> <code class="fc-mute">headphones-1</code></div>
    <div class="item" data-value="moon-stroke"><i class="mRa10 sf-moon-stroke"></i> <code class="fc-mute">moon-stroke</code></div>
    <div class="item" data-value="moon-fill"><i class="mRa10 sf-moon-fill"></i> <code class="fc-mute">moon-fill</code></div>
    <div class="item" data-value="mic"><i class="mRa10 sf-mic"></i> <code class="fc-mute">mic</code></div>
    <div class="item" data-value="home-1"><i class="mRa10 sf-home-1"></i> <code class="fc-mute">home-1</code></div>
    <div class="item" data-value="chat-alt-fill"><i class="mRa10 sf-chat-alt-fill"></i> <code class="fc-mute">chat-alt-fill</code></div>
    <div class="item" data-value="bolt-1"><i class="mRa10 sf-bolt-1"></i> <code class="fc-mute">bolt-1</code></div>
    <div class="item" data-value="right-quote"><i class="mRa10 sf-right-quote"></i> <code class="fc-mute">right-quote</code></div>
    <div class="item" data-value="right-quote-alt"><i class="mRa10 sf-right-quote-alt"></i> <code class="fc-mute">right-quote-alt</code></div>
    <div class="item" data-value="pin-1"><i class="mRa10 sf-pin-1"></i> <code class="fc-mute">pin-1</code></div>
    <div class="item" data-value="atom"><i class="mRa10 sf-atom"></i> <code class="fc-mute">atom</code></div>
    <div class="item" data-value="celcius"><i class="mRa10 sf-celcius"></i> <code class="fc-mute">celcius</code></div>
    <div class="item" data-value="thermometer"><i class="mRa10 sf-thermometer"></i> <code class="fc-mute">thermometer</code></div>
    <div class="item" data-value="sun-black"><i class="mRa10 sf-sun-black"></i> <code class="fc-mute">sun-black</code></div>
    <div class="item" data-value="sun"><i class="mRa10 sf-sun"></i> <code class="fc-mute">sun</code></div>
    <div class="item" data-value="card"><i class="mRa10 sf-card"></i> <code class="fc-mute">card</code></div>
    <div class="item" data-value="edit"><i class="mRa10 sf-edit"></i> <code class="fc-mute">edit</code></div>
    <div class="item" data-value="pencil-1"><i class="mRa10 sf-pencil-1"></i> <code class="fc-mute">pencil-1</code></div>
    <div class="item" data-value="plane"><i class="mRa10 sf-plane"></i> <code class="fc-mute">plane</code></div>
    <div class="item" data-value="bag"><i class="mRa10 sf-bag"></i> <code class="fc-mute">bag</code></div>
    <div class="item" data-value="new-sign"><i class="mRa10 sf-new-sign"></i> <code class="fc-mute">new-sign</code></div>
    <div class="item" data-value="sell-sign"><i class="mRa10 sf-sell-sign"></i> <code class="fc-mute">sell-sign</code></div>
    <div class="item" data-value="load-a"><i class="mRa10 sf-load-a"></i> <code class="fc-mute">load-a</code></div>
    <div class="item" data-value="load-d"><i class="mRa10 sf-load-d"></i> <code class="fc-mute">load-d</code></div>
    <div class="item" data-value="load-b"><i class="mRa10 sf-load-b"></i> <code class="fc-mute">load-b</code></div>
    <div class="item" data-value="spin-alt"><i class="mRa10 sf-spin-alt"></i> <code class="fc-mute">spin-alt</code></div>
    <div class="item" data-value="pull-request"><i class="mRa10 sf-pull-request"></i> <code class="fc-mute">pull-request</code></div>
    <div class="item" data-value="network-1"><i class="mRa10 sf-network-1"></i> <code class="fc-mute">network-1</code></div>
    <div class="item" data-value="merge"><i class="mRa10 sf-merge"></i> <code class="fc-mute">merge</code></div>
    <div class="item" data-value="fork-repo"><i class="mRa10 sf-fork-repo"></i> <code class="fc-mute">fork-repo</code></div>
    <div class="item" data-value="publish"><i class="mRa10 sf-publish"></i> <code class="fc-mute">publish</code></div>
    <div class="item" data-value="facebook-square"><i class="mRa10 sf-facebook-square"></i> <code class="fc-mute">facebook-square</code></div>
    <div class="item" data-value="facebook-official"><i class="mRa10 sf-facebook-official"></i> <code class="fc-mute">facebook-official</code></div>
    <div class="item" data-value="pinterest-square"><i class="mRa10 sf-pinterest-square"></i> <code class="fc-mute">pinterest-square</code></div>
    <div class="item" data-value="pinterest-p"><i class="mRa10 sf-pinterest-p"></i> <code class="fc-mute">pinterest-p</code></div>
    <div class="item" data-value="skype-1"><i class="mRa10 sf-skype-1"></i> <code class="fc-mute">skype-1</code></div>
    <div class="item" data-value="model-s"><i class="mRa10 sf-model-s"></i> <code class="fc-mute">model-s</code></div>
    <div class="item" data-value="vcard"><i class="mRa10 sf-vcard"></i> <code class="fc-mute">vcard</code></div>
    <div class="item" data-value="clock-o"><i class="mRa10 sf-clock-o"></i> <code class="fc-mute">clock-o</code></div>
    <div class="item" data-value="calendar-o"><i class="mRa10 sf-calendar-o"></i> <code class="fc-mute">calendar-o</code></div>
    <div class="item" data-value="arrow-vertical"><i class="mRa10 sf-arrow-vertical"></i> <code class="fc-mute">arrow-vertical</code></div>
    <div class="item" data-value="arrow-horizontal"><i class="mRa10 sf-arrow-horizontal"></i> <code class="fc-mute">arrow-horizontal</code></div>


  </div>
</div>
<?php } // endif ?>
<?php }// endfunction ?>

