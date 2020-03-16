<?php
$dataRow = \dash\data::dataRow();
$myFirstURL = '';
?>

<form class="f justify-center" method="post" autocomplete="off">
 <div class="c s12 pRa10">
  <div class="cbox mB10">
   <?php iTitle(); ?>
   <?php iContent(); ?>
  </div>
   <?php iSEO(); ?>
 </div>

 <div class="c3 x2 s12 mB10">
  <div class="cbox mB10 pA0-f">
    <div class="f">

      <?php $canEditPostStatus = false; ?>

      <?php if(\dash\data::dataRow_status() === 'draft') {?>
        <?php $canEditPostStatus = true; ?>

        <?php
          if(\dash\data::myDataType() == 'post')
          {
            $canEditPostStatus = \dash\permission::check('cpPostsEditStatus');
          }
          elseif(\dash\data::myDataType() == 'help')
          {
            $canEditPostStatus = \dash\permission::check('cpHelpCenterEditStatus');
          }
        ?>

  <?php if($canEditPostStatus) {?>
        <div class="c7 pA5">
          <button class="btn primary block"><?php echo T_("Save as draft"); ?></button>
        </div>

        <div class="c5 pA5">
          <button class="btn success block" name="publishBtn" value="publish"><?php echo T_("Publish"); ?></button>
        </div>

      <div class="c12 pA5">
        <a class="btn secondary block outline" href="<?php echo \dash\url::kingdom(); ?>/<?php echo $myFirstURL. \dash\data::dataRow_url(); ?>" target="_blank"><?php echo T_("Preview"); ?></a>
      </div>

  <?php }else{ ?>

      <div class="c12 pA5">
          <button class="btn primary block"><?php echo T_("Save as draft"); ?></button>
      </div>
      <div class="c6 pA5">
        <a class="btn secondary block outline" href="<?php echo \dash\url::kingdom(); ?>/<?php echo $myFirstURL. \dash\data::dataRow_url(); ?>" target="_blank"><?php echo T_("Preview"); ?></a>
      </div>
  <?php } // endif ?>

<?php }else{ ?>
  <?php if((\dash\data::myDataType() == 'help' && \dash\permission::check('cpHelpCenterEditPublished')) || \dash\permission::check('cpPostsEditPublished')) {?>

      <div class="c6 pA5">
        <button class="btn primary block"><?php echo T_("Save"); ?></button>
      </div>
      <div class="c6 pA5">
        <a class="btn secondary block outline" href="<?php echo \dash\url::kingdom(); ?>/<?php echo $myFirstURL. \dash\data::dataRow_url(); ?>" target="_blank"><?php echo T_("Preview"); ?></a>
      </div>
  <?php } //endif ?>

<?php } //endif ?>

    </div>
  </div>

  <?php iThumb(); ?>
  <?php iSubType(); ?>
  <?php iDownload(); ?>
  <?php iCat(); ?>
  <?php iTag(); ?>
  <?php iSpecialList(); ?>
  <?php iComment(); ?>
  <?php iPublishdate(); ?>
  <?php iStatus(); ?>
  <?php iLanguage(); ?>
  <?php iSource(); ?>
  <?php iRedirect(); ?>
  <?php iCreator(); ?>
  <?php iIcon(); ?>
  <?php galleryImporter(); ?>
 </div>
</form>

<?php iGalleryShow(); ?>








<?php function iTitle() {?>
<div class="input mB10">
  <input type="text" name="title" id="title" placeholder='<?php echo T_("Enter title here"); ?> *' value="<?php echo \dash\data::dataRow_title(); ?>" autofocus required maxlength='200' minlength="1" pattern=".{1,200}">
  <?php if(\dash\data::dataRow_type() === 'post') {?>

  <span class="addon" data-kerkere='.subTitle' <?php if(\dash\data::dataRow_subtitle()) {?> data-kerkere-icon='open' <?php }else{ ?> data-kerkere-icon <?php }//endif ?>><?php echo T_("Add Subtitle"); ?></span>
  <?php } //endif ?>
</div>

<?php if(\dash\data::dataRow_type() === 'post') {?>

<div class="subTitle" data-kerkere-content='<?php if(\dash\data::dataRow_subtitle()) {echo 'show'; }else{ echo 'hide'; } ?>'>
  <label><?php echo T_("Subtitle"); ?> <small><?php echo T_("Subtitle show under title and used on press websites"); ?></small></label>
  <div class="input">
    <input type="text" name="subtitle" id="subtitle" placeholder='<?php echo T_("Enter subtitle here"); ?>' value="<?php echo \dash\data::dataRow_subtitle(); ?>" maxlength='300' minlength="1" pattern=".{1,300}">
  </div>
</div>
<?php }//endif ?>
<?php }//endfunction ?>


<?php function iContent() {?>
<textarea class="txt mB10" data-editor id='descInput' name="content" placeholder='<?php echo T_("Write post "); ?>' maxlength='100000' rows="15"><?php echo \dash\data::dataRow_content(); ?></textarea>
<?php }//endfunction ?>



<?php function iThumb() {?>
<?php
$dataRow = \dash\data::dataRow();
$myFirstURL = '';
?>
<section class="pbox">
  <header data-kerkere='.thumbPanel' data-kerkere-icon='open' data-kerkere-status="open"><?php echo T_("Featured Image"); ?><?php if(isset($dataRow['meta']['thumb']) && $dataRow['meta']['thumb']) {?><span class="floatRa sf-check fc-green"></span><?php }else{ ?><span class="floatRa sf-times fc-red"></span><?php } //endif ?></header>
  <div class="body thumbPanel" data-kerkere-content='show'>
    <?php if(isset($dataRow['meta']['thumb']) && $dataRow['meta']['thumb']) {?>

   <div class="mB20">
    <div class="mediaBox">
      <img src="<?php echo $dataRow['meta']['thumb']; ?>" alt="<?php echo \dash\data::dataRow_title(); ?>">
    </div>
    <div class="floatRa badge danger mT5" data-confirm data-data='{"deleteThumb": 1}'><?php echo T_("Remove"); ?></div>
   </div>
<?php }//endif ?>

  <div>
    <label for="fthumb" class="block"><?php echo T_("Featured Image"); ?></label>
    <div class="input" >
     <input type="file" accept="image/gif, image/jpeg, image/png" name="thumb" id="fthumb" data-max="1000">
     </label>
    </div>
  </div>

  </div>
</section>
<?php }//endfunction ?>






<?php function iSpecialList() {?>
<?php if(\dash\data::listSpecial()) {?>

<section class="pbox">
    <header data-kerkere='.specialPanel' data-kerkere-icon='close'><?php echo T_("Special mode"); ?></header>
    <div class="body specialPanel" data-kerkere-content='hide'>
      <label for="special"><?php echo T_("Use Special mode"); ?></label>

      <select name="special" class="select22">
        <option value=""><i><?php echo T_("Please select one item"); ?></i></option>

        <?php if(\dash\data::dataRow_special()) {?>

          <option value="0" ><?php echo T_("Non"); ?></option>

        <?php } //endif ?>

        <?php foreach (\dash\data::listSpecial() as $key => $value) {?>

          <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRow_special() == $key) { echo "selected"; }?>><?php echo $value; ?></option>

        <?php } //endfor ?>

      </select>
    </div>
  </section>
<?php }//endif ?>
<?php }//endfunction ?>



<?php function iCreator() {?>
<?php if(\dash\permission::check('cpChangePostCreator')) {?>

<section class="pbox">
    <header data-kerkere='.creatorPanel' data-kerkere-icon='close'><?php echo T_("Writer"); ?> <span class="floatRa"><img title="<?php echo \dash\data::userAuthorPost_displayname(); ?>" class="avatar fs08" src="<?php echo \dash\data::userAuthorPost_avatar(); ?>"></span></header>
    <div class="body creatorPanel" data-kerkere-content='hide'>

        <?php if(!in_array(\dash\data::userAuthorPost_id(), \dash\data::allUserAuthorId())) {?>

          <div>
            <img class="ui mini avatar image" src="<?php echo \dash\data::userAuthorPost_avatar(); ?>">
            <?php echo \dash\data::userAuthorPost_displayname(); ?> <small><?php echo \dash\data::userAuthorPost_mobile(); ?></small>
          </div>

        <?php } //endif ?>

      <label><?php echo T_("Change post writer"); ?></label>
      <div class="ui fluid selection dropdown">
        <div class="default text"><?php echo T_("Choose new post writer"); ?></div>
        <input type="hidden" name="creator" value="<?php echo \dash\data::dataRow_user_id(); ?>">
        <i class="dropdown icon"></i>
        <div class="menu">
          <?php foreach (\dash\data::postAdder() as $key => $value) {?>

            <div class="item <?php if(\dash\data::dataRow_user_id() == $value['id']) { echo 'active selected';}  ?>" data-value="<?php echo $value['id']; ?>">
              <img class="ui mini avatar image" src="<?php echo \dash\get::index($value, 'avatar'); ?>">
              <?php echo \dash\get::index($value, 'displayname'); ?> <small class="floatRa"><?php echo \dash\get::index($value, 'mobile'); ?></small>
            </div>
          <?php } //endfor ?>
        </div>
      </div>
    </div>
  </section>
<?php }else{ ?>
<section class="pbox">
    <header data-kerkere='.creatorPanel' data-kerkere-icon='close'><?php echo T_("Writer"); ?></header>
    <div class="body creatorPanel" data-kerkere-content='hide'>
      <div>
        <img class="ui mini avatar image" src="<?php echo \dash\data::userAuthorPost_displayname(); ?>">
        <?php echo \dash\data::userAuthorPost_displayname(); ?>
      </div>
    </div>
  </section>
<?php }// endif ?>

<?php }//endfunction ?>



<?php function iCat() {?>

<?php if(\dash\data::dataRow_type() == 'post') {?>

<?php $postCat = \dash\app\term::load_category_html(["post_id" => \dash\data::dataRow_id(), "id" => true, "type" => "cat" ]); ?>


  <section class="pbox">
    <header data-kerkere='.catPanel' data-kerkere-icon='close'><?php echo T_("Category"); ?><span class="badge floatRa"><?php echo \dash\fit::number(count($postCat)); ?></span></header>
    <div class="body catPanel" data-kerkere-content='hide'>
      <label><?php echo T_("Choose category for posts is fix url of post relative and help people find it better."); ?></label>
      <?php if(\dash\data::listCats()) {?>

      <div>
        <div>
          <?php if(\dash\data::listCats() && is_array(\dash\data::listCats())) {?>
            <?php $postCat = \dash\data::postCat(); if(!is_array($postCat)) { $postCat = [];} ?>
            <?php foreach (\dash\data::listCats() as $key => $value) {?>

            <div class="check1">
              <input type="checkbox" name="cat_<?php echo \dash\get::index($value, 'id'); ?>" value="<?php echo \dash\get::index($value, 'title'); ?>" id="cat_<?php echo \dash\get::index($value, 'id'); ?>" <?php if(in_array($value['id'], $postCat)) { echo 'checked';} ?>>
              <label for="cat_<?php echo \dash\get::index($value, 'id'); ?>"><?php echo \dash\get::index($value, 'title'); ?></label>
            </div>

          <?php } //endfor ?>
        <?php } //endif ?>

        </div>
      </div>
      <?php }else{ ?>
      <div class="msg warn2 mB0"><a href="<?php echo \dash\url::here(); ?>/terms?type=<?php if(\dash\data::myDataType() == 'help') { echo 'help'; }else{echo 'cat';} ?>"><?php echo T_("Add new category"); ?></a></div>
      <?php } //endif ?>
    </div>

  </section>

<?php } //endif ?>
<?php }//endfunction ?>



<?php function iTag() {?>

<?php

$myTagType = null;

if(\dash\data::dataRow_type() === 'page')
{
  // nothing
}
else
{
  if(\dash\data::dataRow_type() === 'help')
  {
    $myTagType = 'help_tag';
  }
  else
  {
    $myTagType = 'tag';
  }

  $postTag = \dash\app\term::load_tag_html(["post_id" => \dash\request::get('id') , "title" => true, "format" => 'csv', "type" => $myTagType]);
  $tagCount = 0;

  if($postTag)
  {
    $tagCount = count(explode(',', $postTag));
  }


?>

<section class="pbox">
  <header data-kerkere='.tagPanel' data-kerkere-icon='close'><?php echo T_("Keywords"); ?><span class="badge floatRa"><?php echo \dash\fit::number($tagCount); ?></span></header>
  <div class="body tagPanel" data-kerkere-content='hide'>
    <div class="tagDetector">

      <div class="input mB10 hide">
        <input type="text" class="input tagVals" name="tag" value="<?php echo $postTag; ?>" id="tagValues" placeholder='<?php echo T_("Tag"); ?>'>
      </div>
      <label><?php echo T_("Add tag to link articles"); ?></label>
      <div class="input">
        <input type="text" class="tagInput" placeholder='<?php echo T_("Keywords"); ?>...'>
        <button class="addon tagAdd"><?php echo T_("Add"); ?></button>
      </div>
      <div class="tagBox"></div>
    </div>
  </div>

</section>
<?php }//endif ?>

<?php }//endfunction ?>



<?php function iComment() {?>
  <?php if(\dash\data::dataRow_type() != 'page')  {?>

<section class="pbox">
  <header data-kerkere='.commentPanel' data-kerkere-icon='close'><?php echo T_("Comments"); ?><?php if(\dash\data::dataRow_comment() === 'open') {?><span class="floatRa sf-check fc-green"></span><?php } //endif ?></header>
  <div class="body commentPanel" data-kerkere-content='hide'>
    <div class="switch1">
     <input type="checkbox" name="comment" id="comment" <?php if(\dash\data::dataRow_comment() === 'open') { echo 'checked'; }?>>
     <label for="comment"></label>
     <label for="comment"><?php echo T_("Allow Comments"); ?></label>
    </div>
  </div>
</section>
<?php } //endif ?>
<?php }//endfunction ?>



<?php function iSubType() {?>

<?php
if(\dash\data::dataRow_type() === 'post')
{
$subtypIcon = 'list';
  switch (\dash\data::dataRow_subtype())
  {
    case 'image':
      $subtypIcon = 'picture-o';
      break;

    case 'gallery':
      $subtypIcon = 'picture';
      break;

    case 'video':
      $subtypIcon = 'movie';
      break;

    case 'audio':
      $subtypIcon = 'volume-up';
      break;


    default:
      $subtypIcon = 'list';
      break;
  }

?>


<section class="pbox">
  <header data-kerkere='.subTypeBlock' data-kerkere-icon='close'><?php echo T_("Theme"); ?> <span class="floatRa"><i class="sf-<?php echo $subtypIcon; ?>"></i></span></header>
  <div class="body subTypeBlock" data-kerkere-content='hide'>

    <label><?php echo T_("Adjust the display style of your post"); ?></label>
    <div class="ui fluid selection dropdown">
      <input type="hidden" name="subtype" value="<?php echo \dash\data::dataRow_subtype(); ?>">
      <i class="dropdown icon"></i>
      <div class="default text"><?php echo T_("Select one item"); ?></div>
      <div class="menu">
        <div class="item" data-value="standard"><i class="sf-list"></i> <?php echo T_("Standard"); ?></div>
        <div class="item" data-value="image"><i class="sf-picture-o"></i> <?php echo T_("Image"); ?></div>
        <div class="item" data-value="gallery"><i class="sf-picture"></i> <?php echo T_("Gallery"); ?></div>
        <div class="item" data-value="video"><i class="sf-movie"></i> <?php echo T_("Video"); ?></div>
        <div class="item" data-value="audio"><i class="sf-volume-up"></i> <?php echo T_("Audio"); ?></div>
      </div>
    </div>

  </div>
</section>
<?php } //endif ?>
<?php }//endfunction ?>




<?php function iDownload() {?>

<?php
$dataRow = \dash\data::dataRow();
$myFirstURL = '';
?>
  <?php if(\dash\data::dataRow_type() == 'post') {?>

<section class="pbox">
  <header data-kerkere='.downloadBlock' data-kerkere-icon='close'><?php echo T_("Download"); ?>
    <?php if(isset($dataRow['meta']['download']['url']) && $dataRow['meta']['download']['url']) {?>

    <span class="floatRa">
      <a <?php if(isset($dataRow['meta']['download']['title']) && $dataRow['meta']['download']['title']) { echo 'title="'. $dataRow['meta']['download']['title']. '"'; }?> href="<?php echo \dash\get::index($dataRow, 'meta', 'download', 'url'); ?>" class="badge <?php echo \dash\get::index($dataRow, 'meta', 'download', 'color'); ?>"  target="_blank" >
        <i class="sf-ellipsis-h"></i></a>
    </span>

    <?php } //endif ?>
  </header>
  <div class="body downloadBlock" data-kerkere-content='hide'>

    <label for="ibtntitle"><?php echo T_("Button title"); ?></label>
    <div class="input">
      <input type="text" name="btntitle" maxlength="5000" id="ibtntitle" value="<?php echo \dash\get::index($dataRow, 'meta', 'download', 'title'); ?>">
    </div>

    <label for="ibtnurl"><?php echo T_("URL"); ?></label>
    <div class="input">
      <input type="url" name="btnurl" maxlength="5000" id="ibtnurl" value="<?php echo \dash\get::index($dataRow, 'meta', 'download', 'url'); ?>">
    </div>

    <div class="check1">
       <input type="checkbox" name="btntarget" id="ibtntarget" <?php if(isset($dataRow['meta']['download']['target']) && $dataRow['meta']['download']['target']) { echo 'checked';} ?>>
      <label for="ibtntarget"><?php echo T_("Open in new tab"); ?></label>
    </div>

    <label><?php echo T_("Button color"); ?></label>
    <div class="ui fluid selection dropdown">
      <input type="hidden" name="btncolor" value="<?php echo \dash\get::index($dataRow, 'meta', 'download', 'color'); ?>">
      <i class="dropdown icon"></i>
      <div class="default text"><?php echo T_("Select button color"); ?></div>
      <div class="menu">

        <div class="item" data-value=""><?php echo T_("Non"); ?></div>
        <div class="item" data-value="primary"><span class="mA3 badge rounded primary">&nbsp;</span> <?php echo T_("Primary"); ?></div>
        <div class="item" data-value="primary2"><span class="mA3 badge rounded primary2">&nbsp;</span> <?php echo T_("Primary"); ?> <?php echo \dash\fit::number(2); ?></div>
        <div class="item" data-value="secondary"><span class="mA3 badge rounded secondary">&nbsp;</span> <?php echo T_("Secondary"); ?></div>
        <div class="item" data-value="secondary2"><span class="mA3 badge rounded secondary2">&nbsp;</span> <?php echo T_("Secondary"); ?> <?php echo \dash\fit::number(2); ?></div>
        <div class="item" data-value="success"><span class="mA3 badge rounded success">&nbsp;</span> <?php echo T_("Success"); ?></div>
        <div class="item" data-value="success2"><span class="mA3 badge rounded success2">&nbsp;</span> <?php echo T_("Success"); ?> <?php echo \dash\fit::number(2); ?></div>
        <div class="item" data-value="danger"><span class="mA3 badge rounded danger">&nbsp;</span> <?php echo T_("Danger"); ?></div>
        <div class="item" data-value="danger2"><span class="mA3 badge rounded danger2">&nbsp;</span> <?php echo T_("Danger"); ?> <?php echo \dash\fit::number(2); ?></div>
        <div class="item" data-value="warning"><span class="mA3 badge rounded warning">&nbsp;</span> <?php echo T_("Warning"); ?></div>
        <div class="item" data-value="warning2"><span class="mA3 badge rounded warning2">&nbsp;</span> <?php echo T_("Warning"); ?> <?php echo \dash\fit::number(2); ?></div>
        <div class="item" data-value="info"><span class="mA3 badge rounded info">&nbsp;</span> <?php echo T_("Info"); ?></div>
        <div class="item" data-value="info2"><span class="mA3 badge rounded info2">&nbsp;</span> <?php echo T_("Info"); ?> <?php echo \dash\fit::number(2); ?></div>
        <div class="item" data-value="light"><span class="mA3 badge rounded light">&nbsp;</span> <?php echo T_("Light"); ?></div>
        <div class="item" data-value="dark"><span class="mA3 badge rounded dark">&nbsp;</span> <?php echo T_("Dark"); ?></div>
        <div class="item" data-value="pain"><span class="mA3 badge rounded pain">&nbsp;</span> <?php echo T_("Pain"); ?></div>
      </div>
    </div>


  </div>
</section>

<?php } //endif ?>
<?php }//endfunction ?>




<?php function iSource() {?>
<?php
$dataRow = \dash\data::dataRow();
$myFirstURL = '';
?>

<?php if(\dash\data::dataRow_type() == 'post') {?>

<section class="pbox">
  <header data-kerkere='.sourceBlock' data-kerkere-icon='close'><?php echo T_("Sourse"); ?>
    <?php if(isset($dataRow['meta']['source']['title']) && $dataRow['meta']['source']['title']) {?>

    <span class="floatRa">
      <a <?php if(isset($dataRow['meta']['source']['title']) && $dataRow['meta']['source']['title']) {?> title="<?php echo $dataRow['meta']['source']['title']; ?>"  <?php } ?> target="_blank" href="<?php echo \dash\get::index($dataRow, 'meta', 'source', 'url'); ?>" class="badge primary">
        <i class="sf-check"></i></a>
    </span>
    <?php } //endif ?>
  </header>
  <div class="body sourceBlock" data-kerkere-content='hide'>

     <label for="isrctitle"><?php echo T_("Sourse title"); ?></label>
    <div class="input">
      <input type="text" name="srctitle" maxlength="5000" id="isrctitle" value="<?php echo \dash\get::index($dataRow, 'meta', 'source', 'title'); ?>">
    </div>

    <label for="isrcurl"><?php echo T_("Sourse URL"); ?></label>
    <div class="input">
      <input type="url" name="srcurl" maxlength="5000" id="isrcurl" value="<?php echo \dash\get::index($dataRow, 'meta', 'source', 'url'); ?>">
    </div>

  </div>
</section>
<?php } //endif ?>

<?php }//endfunction ?>



<?php function iRedirect() {?>

<?php
$dataRow = \dash\data::dataRow();
$myFirstURL = '';
?>

<?php if(\dash\data::dataRow_type() === 'post') {?>

<section class="pbox">
  <header data-kerkere='.redirectorBlock' data-kerkere-icon='close'><?php echo T_("Redirect"); ?>
    <?php if(isset($dataRow['meta']['redirect']) && $dataRow['meta']['redirect']) {?>

    <span class="floatRa">
        <i class="sf-check"></i>
    </span>
    <?php } ?>
  </header>
  <div class="body redirectorBlock" data-kerkere-content='hide'>

     <label for="iredirecturl"><?php echo T_("Set post redirect"); ?></label>
    <div class="input">
      <input type="url" name="redirecturl" maxlength="5000" id="iredirecturl" value="<?php echo \dash\get::index($dataRow, 'meta', 'redirect'); ?>">
    </div>


  </div>
</section>
<?php } // endif ?>
<?php }//endfunction ?>





<?php function iPublishdate() {?>

<?php if(\dash\data::dataRow_type() === 'post') {?>

<section class="pbox">
  <header data-kerkere='.publishDatePanel' data-kerkere-icon='close'><?php echo T_("Publish Date"); ?></header>
  <div class="body publishDatePanel" data-kerkere-content='hide'>

    <?php if(!\dash\data::dataRow_publishdate()) {?>


      <div class="radio3 mB5">
        <input type="radio" name="publishdatetype" value="now" id="publishdatetypenow" <?php if(!\dash\data::dataRow_publishdate()) { echo 'checked';} ?>>
        <label for="publishdatetypenow"><?php echo T_("When published"); ?></label>
      </div>

      <div class="radio3 mB5">
        <input type="radio" name="publishdatetype" value="bydate" id="publishdatetypebydate" <?php if(\dash\data::dataRow_publishdate()) { echo 'checked';} ?>>
        <label for="publishdatetypebydate"><?php echo T_("At special date"); ?></label>
      </div>

    <?php } ?>

    <div data-response='publishdatetype' data-response-where='bydate' <?php if(!\dash\data::dataRow_publishdate()){ echo 'data-response-hide';} ?> data-response-effect='slide'>

      <div>
        <label for="publishdate"><?php echo T_("Publish date"); ?></label>
        <div class="input ltr">
          <input type="text" name="publishdate" id="publishdate" placeholder='<?php echo T_("Default is now"); ?>' value="<?php echo \dash\data::dataRow_publishdate(); ?>" maxlength='15' data-format="date">
        </div>
      </div>
      <div>
        <label for="publishtime"><?php echo T_("Publish time"); ?></label>
        <div class="input clockpicker ltr">
          <input type="text" name="publishtime" id="publishtime" placeholder='<?php echo T_("Publish time"); ?>' autocomplete="off" <?php if(\dash\data::dataRow_publishdate()) {?> value="<?php echo date("H:i", strtotime(\dash\data::dataRow_publishdate())); ?>" <?php } ?> >
        </div>
      </div>
    </div>

  </div>
</section>
<?php } // endif ?>
<?php }//endfunction ?>




<?php function iStatus() {?>

<?php

  $canEditPostStatus = true;

  if(\dash\data::myDataType() == 'post')
  {
    $canEditPostStatus = \dash\permission::check('cpPostsEditStatus');
  }
  elseif(\dash\data::myDataType() == 'help')
  {
    $canEditPostStatus = \dash\permission::check('cpHelpCenterEditStatus');
  }
?>




<?php if($canEditPostStatus) {?>

<section class="pbox">
  <header data-kerkere='.statusPanel' data-kerkere-icon='close'><?php echo T_("Status"); ?> <?php if(\dash\data::dataRow_status() === 'publish') {?><span class="floatRa sf-publish fc-green"></span><?php }elseif(\dash\data::dataRow_status() == 'draft') {?><span class="floatRa sf-edit fc-orange"></span><?php }elseif(\dash\data::dataRow_status() === 'deleted') {?><span class="floatRa sf-trash fc-red"></span><?php } ?></header>
  <div class="body statusPanel" data-kerkere-content='hide'>
    <div class="radio1 green">
      <input type="radio" id="r-publish" name="status" value="publish" <?php if(\dash\data::dataRow_status() === 'publish' || !\dash\data::dataRow_status()) { echo 'checked';} ?>>
      <label for="r-publish"><?php echo T_("Publish"); ?></label>
    </div>

    <div class="radio1 black">
      <input type="radio" id="r-draft" name="status" value="draft" <?php if(\dash\data::dataRow_status() === 'draft') { echo 'checked';} ?>>
      <label for="r-draft"><?php echo T_("Draft"); ?></label>
    </div>

    <?php if(\dash\permission::check('cpPostsDelete') || \dash\permission::check('cpHelpCenterDelete') || \dash\permission::check('cpPageDelete')) {?>

    <div class="radio1 red">
      <input type="radio" id="r-deleted" name="status" value="deleted" <?php if(\dash\data::dataRow_status() === 'deleted') { echo 'checked';} ?>>
      <label for="r-deleted"><?php echo T_("Deleted"); ?></label>
    </div>
    <?php } // endif ?>

  </div>
</section>
<?php } //endif ?>
<?php }//endfunction ?>





<?php function iLanguage() {?>
<section class="pbox">
  <header data-kerkere='.languagePanel' data-kerkere-icon='close'><?php echo T_("Language"); ?></header>
  <div class="body languagePanel" data-kerkere-content='hide'>
    <label for="language"><?php echo T_("You can publish in another language"); ?></label>
    <select name="language" class="select22">
      <option value=""><i><?php echo T_("Please select one item"); ?></i></option>

      <?php foreach (\dash\language::all(true) as $key => $value) {?>


        <option value="<?php echo $key; ?>" <?php if(\dash\data::dataRow_language() == $key || (!\dash\data::dataRow_language() && \dash\language::currentAll() == $key)) {echo 'selected';} ?>><?php echo $value; ?></option>

      <?php } //endfor ?>

    </select>
  </div>
</section>
<?php }//endfunction ?>



<?php function galleryImporter() {?>
<section class="pbox">
  <header data-kerkere='.addGalleryPanel' data-kerkere-icon='close'><?php echo T_("Add to gallery"); ?></header>
  <div class="body addGalleryPanel" data-kerkere-content='hide'>
    <div class="dropzone">
      <h4><?php echo T_("Add to gallery"); ?></h4>
      <label for='gallery' class="btn light"><?php echo T_("Choose or Drop file here"); ?></label>
      <input id="gallery" type="file" name="gallery" multiple>
      <div class="progress shadow" data-percent='30'>
        <div class="bar"></div>
        <div class="detail"></div>
      </div>
      <small><?php echo T_("Maximum file size"); ?> <b><?php echo \dash\data::maxUploadSize(); ?></b></small>
    </div>

  </div>
</section>
<?php }//endfunction ?>




<?php function iSEO() {?>

  <?php $myFirstURL = ''; ?>

<?php if(\dash\data::dataRow_type() == 'help') {?>
  <?php $myFirstURL = 'support/' ?>
<?php } ?>


  <section class="cbox">
    <div class="seoPreview">
      <a target="_blank" href="<?php echo \dash\url::kingdom(); ?>/<?php echo $myFirstURL. \dash\data::dataRow_url(); ?>">
        <h3><?php if(\dash\data::dataRow_seotitle()) { echo \dash\data::dataRow_seotitle(); } else { echo \dash\data::dataRow_title();} ?> | <?php echo \dash\data::site_title(); ?></h3>
        <cite><span><?php echo \dash\url::kingdom(); ?>/<?php echo $myFirstURL; ?></span><?php echo \dash\data::dataRow_url(); ?></cite>
      </a>
      <div class="f">
        <div class="c s12">
          <div class="desc">
            <?php if(\dash\data::dataRow_type() === 'post') {?>

            <time class="publishdate" datetime="<?php echo \dash\data::dataRow_publishdate(); ?>"><?php echo \dash\fit::date(\dash\data::dataRow_publishdate()); ?></time>

            <?php } ?>
            <p><?php echo \dash\data::dataRow_excerpt(); ?></p>
          </div>
        </div>
        <div class="cauto os s12">
          <img src="<?php echo \dash\url::siftal(); ?>/images/logo/google.png" alt='<?php echo T_("Google"); ?>'>
        </div>
      </div>
    </div>
    <div class="txtL">
      <div class="btn white" data-kerkere='.seoData'><?php echo T_("Customize for SEO"); ?></div>
    </div>

    <div class="seoData" data-kerkere-content='hide'>
      <div class="mT10">
        <div>
          <label for='seoTitle'><?php echo T_("SEO Title"); ?> <small><?php echo T_("Recommended being more than 40 character and appear at the beginning of page content"); ?></small></label>
          <div class="input">
            <input type="text" name="seotitle" id="seoTitle" placeholder='<?php if(!\dash\data::dataRow_seotitle()) { echo \dash\data::dataRow_title();}?>' value="<?php echo \dash\data::dataRow_seotitle(); ?>"  maxlength='200' minlength="1" pattern=".{1,200}">
            <label class="addon"> | <?php echo \dash\data::site_title(); ?></label>
          </div>
        </div>

        <?php if(\dash\data::dataRow_type() === 'page' || \dash\data::dataRow_type() === 'help') {?>


        <div>
          <label for="parent"><?php echo T_("Parent"); ?> <small><?php echo T_("Choose parent for this page to create related url as tree"); ?></small></label>
          <select name="parent" class="select22">
            <option value=""><i><?php echo T_("Choose Parent"); ?></i></option>
            <option value="0"><i><?php echo T_("Without Parent"); ?></i></option>
            <?php foreach (\dash\data::pageList() as $key => $value) {?>

              <?php if(isset($value['id']) && $value['id'] == \dash\dataRow_id()) {}else{?>

                <option value="<?php echo $value['id']; ?>" <?php if(\dash\data::dataRow_parent() == $value['id']) { echo 'selected';} ?>><?php echo substr($value['title'], 0, 50); ?></option>
              <?php } //endif ?>

        <?php } //endfor ?>
          </select>
        </div>

      <?php } //endif ?>


        <div>
          <label for="seoSlug"><?php echo T_("Slug"); ?> <small><?php echo T_("End part of your post url."); ?></small></label>
          <div class="input ltr mB10">
            <input type="text" name="slug" id="seoSlug" placeholder='<?php echo T_("Slug"); ?>' value="<?php echo \dash\data::dataRow_slug_raw(); ?>" maxlength='100' minlength="1" pattern=".{1,100}">
          </div>
        </div>

        <div>
          <label for='seoDesc'><?php echo T_("SEO Description"); ?> <small><?php echo T_("If leave it empty we are generate it automatically"); ?></small></label>
          <textarea class="txt mB10" name="excerpt" id="seoDesc" placeholder='<?php echo T_("Excerpt used for social media and search engines"); ?> *' maxlength='300' minlength="1" rows='3'><?php echo \dash\data::dataRow_excerpt(); ?></textarea>
        </div>
      </div>
    </div>

  </section>
<?php }//endfunction ?>




<?php function iGalleryShow() {?>
<?php
$dataRow = \dash\data::dataRow();
$myFirstURL = '';
?>

<?php if(isset($dataRow['meta']['gallery']['files']) && is_array($dataRow['meta']['gallery']['files'])) {?>

<div class="cbox">
  <h2><?php echo T_("Gallery"); ?></h2>
  <div class="normal f">
    <?php foreach ($dataRow['meta']['gallery']['files'] as $key => $value) {?>

      <div class="vcard mA10">
        <?php $myUrl = \dash\get::index($value, 'path'); ?>

        <?php if(in_array(substr($myUrl, -4), ['.jpg', '.png', '.gif'])) {?>


        <img src="<?php echo $myUrl; ?>">
        <div class="content"></div>

        <?php }elseif(in_array(substr($myUrl, -4), ['.mp4'])) {?>

        <video>
          <source src="<?php echo $myUrl; ?>" type="video/mp4">
        </video>
        <div class="content"><a href="<?php echo $myUrl; ?>" title='<?php echo T_("Click to download"); ?>'><?php echo T_("Video"); ?></a></div>
        <div class="content"></div>

        <?php }elseif(in_array(substr($myUrl, -4), ['.mp3'])) {?>

        <audio controls>
          <source src="<?php echo $myUrl; ?>" type="audio/mpeg">
        </audio>
        <div class="content"><a href="<?php echo $myUrl; ?>" title='<?php echo T_("Click to download"); ?>'><?php echo T_("MP3"); ?></a></div>
        <?php }elseif(in_array(substr($myUrl, -4), ['.pdf'])) {?>

          <div class="content title"><a href="<?php echo $myUrl; ?>" title='<?php echo T_("Click to download"); ?>'><?php echo T_("PDF"); ?></a></div>
        <?php }else{ ?>

        <div class="content title"><a href="<?php echo $myUrl; ?>" title='<?php echo T_("Click to download"); ?>'><?php echo T_("Without preview"); ?></a></div>
        <?php } ?>
        <div class="footer f">
          <button class="btn block secondary" data-ajaxify data-data='{"type" : "remove_gallery", "fileid": "<?php echo \dash\get::index($value, 'id'); ?>"}' data-method='post'><?php echo T_("Remove"); ?></button>
        </div>
      </div>
    <?php } //endfor ?>
  </div>
</div>
<?php } //endif ?>
<?php }//endfunction ?>



<?php function iIcon() {?>
<?php if(\dash\data::dataRow_type() === 'help') {?>
<section class="pbox">
  <header data-kerkere='.iconPanel' data-kerkere-icon='close'><?php echo T_("Icon"); ?></header>
  <div class="body iconPanel" data-kerkere-content='hide'>

<div class="ui fluid selection dropdown search fs12">
<input type="hidden" name="icon" value="<?php $meta = \dash\data::dataRow_meta(); echo \dash\get::index($meta, 'icon'); ?>">
<i class="dropdown icon"></i>
<div class="default text"><?php echo T_("Choose icon"); ?></div>
<div class="menu">
<div class="item" data-value="angle-down"><i class="floatRa sf-angle-down"></i><code>angle-down</code></div>
<div class="item" data-value="angle-left"><i class="floatRa sf-angle-left"></i><code>angle-left</code></div>
<div class="item" data-value="angle-right"><i class="floatRa sf-angle-right"></i><code>angle-right</code></div>
<div class="item" data-value="angle-up"><i class="floatRa sf-angle-up"></i><code>angle-up</code></div>
<div class="item" data-value="bell"><i class="floatRa sf-bell"></i><code>bell</code></div>
<div class="item" data-value="bell-o"><i class="floatRa sf-bell-o"></i><code>bell-o</code></div>
<div class="item" data-value="bell-slash"><i class="floatRa sf-bell-slash"></i><code>bell-slash</code></div>
<div class="item" data-value="bell-slash-o"><i class="floatRa sf-bell-slash-o"></i><code>bell-slash-o</code></div>
<div class="item" data-value="bug"><i class="floatRa sf-bug"></i><code>bug</code></div>
<div class="item" data-value="bolt"><i class="floatRa sf-bolt"></i><code>bolt</code></div>
<div class="item" data-value="check"><i class="floatRa sf-check"></i><code>check</code></div>
<div class="item" data-value="chain-broken"><i class="floatRa sf-chain-broken"></i><code>chain-broken</code></div>
<div class="item" data-value="cc-paypal"><i class="floatRa sf-cc-paypal"></i><code>cc-paypal</code></div>
<div class="item" data-value="cc-visa"><i class="floatRa sf-cc-visa"></i><code>cc-visa</code></div>
<div class="item" data-value="cloud-download"><i class="floatRa sf-cloud-download"></i><code>cloud-download</code></div>
<div class="item" data-value="cloud-upload"><i class="floatRa sf-cloud-upload"></i><code>cloud-upload</code></div>
<div class="item" data-value="cloud"><i class="floatRa sf-cloud"></i><code>cloud</code></div>
<div class="item" data-value="comment"><i class="floatRa sf-comment"></i><code>comment</code></div>
<div class="item" data-value="comment-o"><i class="floatRa sf-comment-o"></i><code>comment-o</code></div>
<div class="item" data-value="commenting"><i class="floatRa sf-commenting"></i><code>commenting</code></div>
<div class="item" data-value="clone"><i class="floatRa sf-clone"></i><code>clone</code></div>
<div class="item" data-value="commenting-o"><i class="floatRa sf-commenting-o"></i><code>commenting-o</code></div>
<div class="item" data-value="comments"><i class="floatRa sf-comments"></i><code>comments</code></div>
<div class="item" data-value="comments-o"><i class="floatRa sf-comments-o"></i><code>comments-o</code></div>
<div class="item" data-value="cog"><i class="floatRa sf-cog"></i><code>cog</code></div>
<div class="item" data-value="desktop"><i class="floatRa sf-desktop"></i><code>desktop</code></div>
<div class="item" data-value="envelope-o"><i class="floatRa sf-envelope-o"></i><code>envelope-o</code></div>
<div class="item" data-value="envelope"><i class="floatRa sf-envelope"></i><code>envelope</code></div>
<div class="item" data-value="ellipsis-v"><i class="floatRa sf-ellipsis-v"></i><code>ellipsis-v</code></div>
<div class="item" data-value="ellipsis-h"><i class="floatRa sf-ellipsis-h"></i><code>ellipsis-h</code></div>
<div class="item" data-value="crop"><i class="floatRa sf-crop"></i><code>crop</code></div>
<div class="item" data-value="crosshairs"><i class="floatRa sf-crosshairs"></i><code>crosshairs</code></div>
<div class="item" data-value="bar-chart"><i class="floatRa sf-bar-chart"></i><code>bar-chart</code></div>
<div class="item" data-value="balance-scale"><i class="floatRa sf-balance-scale"></i><code>balance-scale</code></div>
<div class="item" data-value="arrows-h"><i class="floatRa sf-arrows-h"></i><code>arrows-h</code></div>
<div class="item" data-value="arrows-v"><i class="floatRa sf-arrows-v"></i><code>arrows-v</code></div>
<div class="item" data-value="arrows-alt"><i class="floatRa sf-arrows-alt"></i><code>arrows-alt</code></div>
<div class="item" data-value="arrows"><i class="floatRa sf-arrows"></i><code>arrows</code></div>
<div class="item" data-value="android"><i class="floatRa sf-android"></i><code>android</code></div>
<div class="item" data-value="align-right"><i class="floatRa sf-align-right"></i><code>align-right</code></div>
<div class="item" data-value="align-left"><i class="floatRa sf-align-left"></i><code>align-left</code></div>
<div class="item" data-value="align-justify"><i class="floatRa sf-align-justify"></i><code>align-justify</code></div>
<div class="item" data-value="align-center"><i class="floatRa sf-align-center"></i><code>align-center</code></div>
<div class="item" data-value="bullhorn"><i class="floatRa sf-bullhorn"></i><code>bullhorn</code></div>
<div class="item" data-value="asterisk"><i class="floatRa sf-asterisk"></i><code>asterisk</code></div>
<div class="item" data-value="bookmark-o"><i class="floatRa sf-bookmark-o"></i><code>bookmark-o</code></div>
<div class="item" data-value="bookmark"><i class="floatRa sf-bookmark"></i><code>bookmark</code></div>
<div class="item" data-value="caret-right"><i class="floatRa sf-caret-right"></i><code>caret-right</code></div>
<div class="item" data-value="caret-left"><i class="floatRa sf-caret-left"></i><code>caret-left</code></div>
<div class="item" data-value="caret-down"><i class="floatRa sf-caret-down"></i><code>caret-down</code></div>
<div class="item" data-value="caret-up"><i class="floatRa sf-caret-up"></i><code>caret-up</code></div>
<div class="item" data-value="file-code-o"><i class="floatRa sf-file-code-o"></i><code>file-code-o</code></div>
<div class="item" data-value="file-audio-o"><i class="floatRa sf-file-audio-o"></i><code>file-audio-o</code></div>
<div class="item" data-value="file-archive-o"><i class="floatRa sf-file-archive-o"></i><code>file-archive-o</code></div>
<div class="item" data-value="file-excel-o"><i class="floatRa sf-file-excel-o"></i><code>file-excel-o</code></div>
<div class="item" data-value="file"><i class="floatRa sf-file"></i><code>file</code></div>
<div class="item" data-value="file-pdf-o"><i class="floatRa sf-file-pdf-o"></i><code>file-pdf-o</code></div>
<div class="item" data-value="file-powerpoint-o"><i class="floatRa sf-file-powerpoint-o"></i><code>file-powerpoint-o</code></div>
<div class="item" data-value="file-text"><i class="floatRa sf-file-text"></i><code>file-text</code></div>
<div class="item" data-value="file-text-o"><i class="floatRa sf-file-text-o"></i><code>file-text-o</code></div>
<div class="item" data-value="file-word-o"><i class="floatRa sf-file-word-o"></i><code>file-word-o</code></div>
<div class="item" data-value="files-o"><i class="floatRa sf-files-o"></i><code>files-o</code></div>
<div class="item" data-value="film"><i class="floatRa sf-film"></i><code>film</code></div>
<div class="item" data-value="file-video-o"><i class="floatRa sf-file-video-o"></i><code>file-video-o</code></div>
<div class="item" data-value="floppy-o"><i class="floatRa sf-floppy-o"></i><code>floppy-o</code></div>
<div class="item" data-value="file-image-o"><i class="floatRa sf-file-image-o"></i><code>file-image-o</code></div>
<div class="item" data-value="file-o"><i class="floatRa sf-file-o"></i><code>file-o</code></div>
<div class="item" data-value="flag"><i class="floatRa sf-flag"></i><code>flag</code></div>
<div class="item" data-value="flag-checkered"><i class="floatRa sf-flag-checkered"></i><code>flag-checkered</code></div>
<div class="item" data-value="flag-o"><i class="floatRa sf-flag-o"></i><code>flag-o</code></div>
<div class="item" data-value="gavel"><i class="floatRa sf-gavel"></i><code>gavel</code></div>
<div class="item" data-value="heart"><i class="floatRa sf-heart"></i><code>heart</code></div>
<div class="item" data-value="heart-o"><i class="floatRa sf-heart-o"></i><code>heart-o</code></div>
<div class="item" data-value="history"><i class="floatRa sf-history"></i><code>history</code></div>
<div class="item" data-value="home"><i class="floatRa sf-home"></i><code>home</code></div>
<div class="item" data-value="hourglass"><i class="floatRa sf-hourglass"></i><code>hourglass</code></div>
<div class="item" data-value="hourglass-end"><i class="floatRa sf-hourglass-end"></i><code>hourglass-end</code></div>
<div class="item" data-value="hourglass-half"><i class="floatRa sf-hourglass-half"></i><code>hourglass-half</code></div>
<div class="item" data-value="hourglass-o"><i class="floatRa sf-hourglass-o"></i><code>hourglass-o</code></div>
<div class="item" data-value="info"><i class="floatRa sf-info"></i><code>info</code></div>
<div class="item" data-value="industry"><i class="floatRa sf-industry"></i><code>industry</code></div>
<div class="item" data-value="graduation-cap"><i class="floatRa sf-graduation-cap"></i><code>graduation-cap</code></div>
<div class="item" data-value="globe"><i class="floatRa sf-globe"></i><code>globe</code></div>
<div class="item" data-value="glass"><i class="floatRa sf-glass"></i><code>glass</code></div>
<div class="item" data-value="line-chart"><i class="floatRa sf-line-chart"></i><code>line-chart</code></div>
<div class="item" data-value="github-square"><i class="floatRa sf-github-square"></i><code>github-square</code></div>
<div class="item" data-value="github-alt"><i class="floatRa sf-github-alt"></i><code>github-alt</code></div>
<div class="item" data-value="github"><i class="floatRa sf-github"></i><code>github</code></div>
<div class="item" data-value="language"><i class="floatRa sf-language"></i><code>language</code></div>
<div class="item" data-value="laptop"><i class="floatRa sf-laptop"></i><code>laptop</code></div>
<div class="item" data-value="quote-left"><i class="floatRa sf-quote-left"></i><code>quote-left</code></div>
<div class="item" data-value="quote-right"><i class="floatRa sf-quote-right"></i><code>quote-right</code></div>
<div class="item" data-value="spinner"><i class="floatRa sf-spinner"></i><code>spinner</code></div>
<div class="item" data-value="star"><i class="floatRa sf-star"></i><code>star</code></div>
<div class="item" data-value="star-half"><i class="floatRa sf-star-half"></i><code>star-half</code></div>
<div class="item" data-value="star-half-o"><i class="floatRa sf-star-half-o"></i><code>star-half-o</code></div>
<div class="item" data-value="star-o"><i class="floatRa sf-star-o"></i><code>star-o</code></div>
<div class="item" data-value="sort-amount-asc"><i class="floatRa sf-sort-amount-asc"></i><code>sort-amount-asc</code></div>
<div class="item" data-value="sort-alpha-desc"><i class="floatRa sf-sort-alpha-desc"></i><code>sort-alpha-desc</code></div>
<div class="item" data-value="sort-alpha-asc"><i class="floatRa sf-sort-alpha-asc"></i><code>sort-alpha-asc</code></div>
<div class="item" data-value="sort-amount-desc"><i class="floatRa sf-sort-amount-desc"></i><code>sort-amount-desc</code></div>
<div class="item" data-value="sort-numeric-desc"><i class="floatRa sf-sort-numeric-desc"></i><code>sort-numeric-desc</code></div>
<div class="item" data-value="sort-numeric-asc"><i class="floatRa sf-sort-numeric-asc"></i><code>sort-numeric-asc</code></div>
<div class="item" data-value="rss"><i class="floatRa sf-rss"></i><code>rss</code></div>
<div class="item" data-value="windows"><i class="floatRa sf-windows"></i><code>windows</code></div>
<div class="item" data-value="unlock"><i class="floatRa sf-unlock"></i><code>unlock</code></div>
<div class="item" data-value="unlock-alt"><i class="floatRa sf-unlock-alt"></i><code>unlock-alt</code></div>
<div class="item" data-value="youtube-play"><i class="floatRa sf-youtube-play"></i><code>youtube-play</code></div>
<div class="item" data-value="user-plus"><i class="floatRa sf-user-plus"></i><code>user-plus</code></div>
<div class="item" data-value="user"><i class="floatRa sf-user"></i><code>user</code></div>
<div class="item" data-value="user-md"><i class="floatRa sf-user-md"></i><code>user-md</code></div>
<div class="item" data-value="user-secret"><i class="floatRa sf-user-secret"></i><code>user-secret</code></div>
<div class="item" data-value="users"><i class="floatRa sf-users"></i><code>users</code></div>
<div class="item" data-value="user-times"><i class="floatRa sf-user-times"></i><code>user-times</code></div>
<div class="item" data-value="volume-up"><i class="floatRa sf-volume-up"></i><code>volume-up</code></div>
<div class="item" data-value="volume-off"><i class="floatRa sf-volume-off"></i><code>volume-off</code></div>
<div class="item" data-value="volume-down"><i class="floatRa sf-volume-down"></i><code>volume-down</code></div>
<div class="item" data-value="wrench"><i class="floatRa sf-wrench"></i><code>wrench</code></div>
<div class="item" data-value="thumbs-down"><i class="floatRa sf-thumbs-down"></i><code>thumbs-down</code></div>
<div class="item" data-value="thumbs-o-down"><i class="floatRa sf-thumbs-o-down"></i><code>thumbs-o-down</code></div>
<div class="item" data-value="thumbs-o-up"><i class="floatRa sf-thumbs-o-up"></i><code>thumbs-o-up</code></div>
<div class="item" data-value="thumbs-up"><i class="floatRa sf-thumbs-up"></i><code>thumbs-up</code></div>
<div class="item" data-value="thumb-tack"><i class="floatRa sf-thumb-tack"></i><code>thumb-tack</code></div>
<div class="item" data-value="trello"><i class="floatRa sf-trello"></i><code>trello</code></div>
<div class="item" data-value="tachometer"><i class="floatRa sf-tachometer"></i><code>tachometer</code></div>
<div class="item" data-value="recycle"><i class="floatRa sf-recycle"></i><code>recycle</code></div>
<div class="item" data-value="graph-bar"><i class="floatRa sf-graph-bar"></i><code>graph-bar</code></div>
<div class="item" data-value="graph-horizontal"><i class="floatRa sf-graph-horizontal"></i><code>graph-horizontal</code></div>
<div class="item" data-value="check-1"><i class="floatRa sf-check-1"></i><code>check-1</code></div>
<div class="item" data-value="monitor"><i class="floatRa sf-monitor"></i><code>monitor</code></div>
<div class="item" data-value="wrench-1"><i class="floatRa sf-wrench-1"></i><code>wrench-1</code></div>
<div class="item" data-value="widget"><i class="floatRa sf-widget"></i><code>widget</code></div>
<div class="item" data-value="thumbnails"><i class="floatRa sf-thumbnails"></i><code>thumbnails</code></div>
<div class="item" data-value="save"><i class="floatRa sf-save"></i><code>save</code></div>
<div class="item" data-value="chart-pie"><i class="floatRa sf-chart-pie"></i><code>chart-pie</code></div>
<div class="item" data-value="chart-line"><i class="floatRa sf-chart-line"></i><code>chart-line</code></div>
<div class="item" data-value="chart-bar"><i class="floatRa sf-chart-bar"></i><code>chart-bar</code></div>
<div class="item" data-value="chart-area"><i class="floatRa sf-chart-area"></i><code>chart-area</code></div>
<div class="item" data-value="chat"><i class="floatRa sf-chat"></i><code>chat</code></div>
<div class="item" data-value="flow-tree"><i class="floatRa sf-flow-tree"></i><code>flow-tree</code></div>
<div class="item" data-value="gauge"><i class="floatRa sf-gauge"></i><code>gauge</code></div>
<div class="item" data-value="flight"><i class="floatRa sf-flight"></i><code>flight</code></div>
<div class="item" data-value="graph"><i class="floatRa sf-graph"></i><code>graph</code></div>
<div class="item" data-value="grid"><i class="floatRa sf-grid"></i><code>grid</code></div>
<div class="item" data-value="dzone"><i class="floatRa sf-dzone"></i><code>dzone</code></div>
<div class="item" data-value="enter"><i class="floatRa sf-enter"></i><code>enter</code></div>
<div class="item" data-value="pinboard"><i class="floatRa sf-pinboard"></i><code>pinboard</code></div>
<div class="item" data-value="share"><i class="floatRa sf-share"></i><code>share</code></div>
<div class="item" data-value="out"><i class="floatRa sf-out"></i><code>out</code></div>
<div class="item" data-value="signout"><i class="floatRa sf-signout"></i><code>signout</code></div>
<div class="item" data-value="sign-out"><i class="floatRa sf-sign-out"></i><code>sign-out</code></div>
<div class="item" data-value="lock"><i class="floatRa sf-lock"></i><code>lock</code></div>
<div class="item" data-value="info-circle"><i class="floatRa sf-info-circle"></i><code>info-circle</code></div>
<div class="item" data-value="question"><i class="floatRa sf-question"></i><code>question</code></div>
<div class="item" data-value="question-circle"><i class="floatRa sf-question-circle"></i><code>question-circle</code></div>
<div class="item" data-value="plus-circle"><i class="floatRa sf-plus-circle"></i><code>plus-circle</code></div>
<div class="item" data-value="plus"><i class="floatRa sf-plus"></i><code>plus</code></div>
<div class="item" data-value="search"><i class="floatRa sf-search"></i><code>search</code></div>
<div class="item" data-value="times-circle"><i class="floatRa sf-times-circle"></i><code>times-circle</code></div>
<div class="item" data-value="times"><i class="floatRa sf-times"></i><code>times</code></div>
<div class="item" data-value="filter"><i class="floatRa sf-filter"></i><code>filter</code></div>
<div class="item" data-value="clipboard"><i class="floatRa sf-clipboard"></i><code>clipboard</code></div>
<div class="item" data-value="at"><i class="floatRa sf-at"></i><code>at</code></div>
<div class="item" data-value="instagram"><i class="floatRa sf-instagram"></i><code>instagram</code></div>
<div class="item" data-value="archive"><i class="floatRa sf-archive"></i><code>archive</code></div>
<div class="item" data-value="print"><i class="floatRa sf-print"></i><code>print</code></div>
<div class="item" data-value="tags"><i class="floatRa sf-tags"></i><code>tags</code></div>
<div class="item" data-value="tag"><i class="floatRa sf-tag"></i><code>tag</code></div>
<div class="item" data-value="bars"><i class="floatRa sf-bars"></i><code>bars</code></div>
<div class="item" data-value="cogs"><i class="floatRa sf-cogs"></i><code>cogs</code></div>
<div class="item" data-value="tasks"><i class="floatRa sf-tasks"></i><code>tasks</code></div>
<div class="item" data-value="analytics-chart-graph"><i class="floatRa sf-analytics-chart-graph"></i><code>analytics-chart-graph</code></div>
<div class="item" data-value="chart"><i class="floatRa sf-chart"></i><code>chart</code></div>
<div class="item" data-value="database"><i class="floatRa sf-database"></i><code>database</code></div>
<div class="item" data-value="whatsapp"><i class="floatRa sf-whatsapp"></i><code>whatsapp</code></div>
<div class="item" data-value="linkedin-square"><i class="floatRa sf-linkedin-square"></i><code>linkedin-square</code></div>
<div class="item" data-value="linkedin"><i class="floatRa sf-linkedin"></i><code>linkedin</code></div>
<div class="item" data-value="twitter-square"><i class="floatRa sf-twitter-square"></i><code>twitter-square</code></div>
<div class="item" data-value="twitter"><i class="floatRa sf-twitter"></i><code>twitter</code></div>
<div class="item" data-value="retweet"><i class="floatRa sf-retweet"></i><code>retweet</code></div>
<div class="item" data-value="refresh"><i class="floatRa sf-refresh"></i><code>refresh</code></div>
<div class="item" data-value="load-c"><i class="floatRa sf-load-c"></i><code>load-c</code></div>
<div class="item" data-value="trophy"><i class="floatRa sf-trophy"></i><code>trophy</code></div>
<div class="item" data-value="ribbon-b"><i class="floatRa sf-ribbon-b"></i><code>ribbon-b</code></div>
<div class="item" data-value="ribbon-a"><i class="floatRa sf-ribbon-a"></i><code>ribbon-a</code></div>
<div class="item" data-value="edit-write"><i class="floatRa sf-edit-write"></i><code>edit-write</code></div>
<div class="item" data-value="building"><i class="floatRa sf-building"></i><code>building</code></div>
<div class="item" data-value="pencil-square-o"><i class="floatRa sf-pencil-square-o"></i><code>pencil-square-o</code></div>
<div class="item" data-value="pencil-square"><i class="floatRa sf-pencil-square"></i><code>pencil-square</code></div>
<div class="item" data-value="pencil"><i class="floatRa sf-pencil"></i><code>pencil</code></div>
<div class="item" data-value="bold"><i class="floatRa sf-bold"></i><code>bold</code></div>
<div class="item" data-value="crop-1"><i class="floatRa sf-crop-1"></i><code>crop-1</code></div>
<div class="item" data-value="align-center-1"><i class="floatRa sf-align-center-1"></i><code>align-center-1</code></div>
<div class="item" data-value="align-justify-1"><i class="floatRa sf-align-justify-1"></i><code>align-justify-1</code></div>
<div class="item" data-value="align-left-1"><i class="floatRa sf-align-left-1"></i><code>align-left-1</code></div>
<div class="item" data-value="indent"><i class="floatRa sf-indent"></i><code>indent</code></div>
<div class="item" data-value="outdent"><i class="floatRa sf-outdent"></i><code>outdent</code></div>
<div class="item" data-value="superscript"><i class="floatRa sf-superscript"></i><code>superscript</code></div>
<div class="item" data-value="subscript"><i class="floatRa sf-subscript"></i><code>subscript</code></div>
<div class="item" data-value="align-right-1"><i class="floatRa sf-align-right-1"></i><code>align-right-1</code></div>
<div class="item" data-value="font"><i class="floatRa sf-font"></i><code>font</code></div>
<div class="item" data-value="list"><i class="floatRa sf-list"></i><code>list</code></div>
<div class="item" data-value="pencil-square-1"><i class="floatRa sf-pencil-square-1"></i><code>pencil-square-1</code></div>
<div class="item" data-value="text-height"><i class="floatRa sf-text-height"></i><code>text-height</code></div>
<div class="item" data-value="trash"><i class="floatRa sf-trash"></i><code>trash</code></div>
<div class="item" data-value="trash-o"><i class="floatRa sf-trash-o"></i><code>trash-o</code></div>
<div class="item" data-value="ban"><i class="floatRa sf-ban"></i><code>ban</code></div>
<div class="item" data-value="minus-circle"><i class="floatRa sf-minus-circle"></i><code>minus-circle</code></div>
<div class="item" data-value="minus-square"><i class="floatRa sf-minus-square"></i><code>minus-square</code></div>
<div class="item" data-value="link"><i class="floatRa sf-link"></i><code>link</code></div>
<div class="item" data-value="link-external"><i class="floatRa sf-link-external"></i><code>link-external</code></div>
<div class="item" data-value="tools"><i class="floatRa sf-tools"></i><code>tools</code></div>
<div class="item" data-value="wrench-2"><i class="floatRa sf-wrench-2"></i><code>wrench-2</code></div>
<div class="item" data-value="power-off"><i class="floatRa sf-power-off"></i><code>power-off</code></div>
<div class="item" data-value="credit-card"><i class="floatRa sf-credit-card"></i><code>credit-card</code></div>
<div class="item" data-value="user-7"><i class="floatRa sf-user-7"></i><code>user-7</code></div>
<div class="item" data-value="user-6"><i class="floatRa sf-user-6"></i><code>user-6</code></div>
<div class="item" data-value="user-4"><i class="floatRa sf-user-4"></i><code>user-4</code></div>
<div class="item" data-value="user-3"><i class="floatRa sf-user-3"></i><code>user-3</code></div>
<div class="item" data-value="user-5"><i class="floatRa sf-user-5"></i><code>user-5</code></div>
<div class="item" data-value="forum-user"><i class="floatRa sf-forum-user"></i><code>forum-user</code></div>
<div class="item" data-value="file-1"><i class="floatRa sf-file-1"></i><code>file-1</code></div>
<div class="item" data-value="folder"><i class="floatRa sf-folder"></i><code>folder</code></div>
<div class="item" data-value="folder-1"><i class="floatRa sf-folder-1"></i><code>folder-1</code></div>
<div class="item" data-value="medal"><i class="floatRa sf-medal"></i><code>medal</code></div>
<div class="item" data-value="network"><i class="floatRa sf-network"></i><code>network</code></div>
<div class="item" data-value="save-1"><i class="floatRa sf-save-1"></i><code>save-1</code></div>
<div class="item" data-value="star-1"><i class="floatRa sf-star-1"></i><code>star-1</code></div>
<div class="item" data-value="display"><i class="floatRa sf-display"></i><code>display</code></div>
<div class="item" data-value="dollar"><i class="floatRa sf-dollar"></i><code>dollar</code></div>
<div class="item" data-value="euro"><i class="floatRa sf-euro"></i><code>euro</code></div>
<div class="item" data-value="pound"><i class="floatRa sf-pound"></i><code>pound</code></div>
<div class="item" data-value="money-banknote"><i class="floatRa sf-money-banknote"></i><code>money-banknote</code></div>
<div class="item" data-value="male-rounded-1"><i class="floatRa sf-male-rounded-1"></i><code>male-rounded-1</code></div>
<div class="item" data-value="female-rounded-1"><i class="floatRa sf-female-rounded-1"></i><code>female-rounded-1</code></div>
<div class="item" data-value="female"><i class="floatRa sf-female"></i><code>female</code></div>
<div class="item" data-value="male"><i class="floatRa sf-male"></i><code>male</code></div>
<div class="item" data-value="arrows-out"><i class="floatRa sf-arrows-out"></i><code>arrows-out</code></div>
<div class="item" data-value="print-1"><i class="floatRa sf-print-1"></i><code>print-1</code></div>
<div class="item" data-value="zoom-out"><i class="floatRa sf-zoom-out"></i><code>zoom-out</code></div>
<div class="item" data-value="earth"><i class="floatRa sf-earth"></i><code>earth</code></div>
<div class="item" data-value="building-o"><i class="floatRa sf-building-o"></i><code>building-o</code></div>
<div class="item" data-value="briefcase"><i class="floatRa sf-briefcase"></i><code>briefcase</code></div>
<div class="item" data-value="interface-windows"><i class="floatRa sf-interface-windows"></i><code>interface-windows</code></div>
<div class="item" data-value="angle-double-down"><i class="floatRa sf-angle-double-down"></i><code>angle-double-down</code></div>
<div class="item" data-value="angle-double-left"><i class="floatRa sf-angle-double-left"></i><code>angle-double-left</code></div>
<div class="item" data-value="angle-double-right"><i class="floatRa sf-angle-double-right"></i><code>angle-double-right</code></div>
<div class="item" data-value="angle-double-up"><i class="floatRa sf-angle-double-up"></i><code>angle-double-up</code></div>
<div class="item" data-value="arrow-circle-down"><i class="floatRa sf-arrow-circle-down"></i><code>arrow-circle-down</code></div>
<div class="item" data-value="arrow-circle-left"><i class="floatRa sf-arrow-circle-left"></i><code>arrow-circle-left</code></div>
<div class="item" data-value="arrow-circle-o-down"><i class="floatRa sf-arrow-circle-o-down"></i><code>arrow-circle-o-down</code></div>
<div class="item" data-value="area-chart"><i class="floatRa sf-area-chart"></i><code>area-chart</code></div>
<div class="item" data-value="arrow-circle-o-left"><i class="floatRa sf-arrow-circle-o-left"></i><code>arrow-circle-o-left</code></div>
<div class="item" data-value="arrow-circle-o-right"><i class="floatRa sf-arrow-circle-o-right"></i><code>arrow-circle-o-right</code></div>
<div class="item" data-value="arrow-circle-o-up"><i class="floatRa sf-arrow-circle-o-up"></i><code>arrow-circle-o-up</code></div>
<div class="item" data-value="arrow-circle-right"><i class="floatRa sf-arrow-circle-right"></i><code>arrow-circle-right</code></div>
<div class="item" data-value="arrow-circle-up"><i class="floatRa sf-arrow-circle-up"></i><code>arrow-circle-up</code></div>
<div class="item" data-value="arrow-down"><i class="floatRa sf-arrow-down"></i><code>arrow-down</code></div>
<div class="item" data-value="arrow-left"><i class="floatRa sf-arrow-left"></i><code>arrow-left</code></div>
<div class="item" data-value="arrow-right"><i class="floatRa sf-arrow-right"></i><code>arrow-right</code></div>
<div class="item" data-value="arrow-up"><i class="floatRa sf-arrow-up"></i><code>arrow-up</code></div>
<div class="item" data-value="battery-empty"><i class="floatRa sf-battery-empty"></i><code>battery-empty</code></div>
<div class="item" data-value="battery-full"><i class="floatRa sf-battery-full"></i><code>battery-full</code></div>
<div class="item" data-value="battery-half"><i class="floatRa sf-battery-half"></i><code>battery-half</code></div>
<div class="item" data-value="battery-quarter"><i class="floatRa sf-battery-quarter"></i><code>battery-quarter</code></div>
<div class="item" data-value="battery-three-quarters"><i class="floatRa sf-battery-three-quarters"></i><code>battery-three-quarters</code></div>
<div class="item" data-value="barcode"><i class="floatRa sf-barcode"></i><code>barcode</code></div>
<div class="item" data-value="at-1"><i class="floatRa sf-at-1"></i><code>at-1</code></div>
<div class="item" data-value="bed"><i class="floatRa sf-bed"></i><code>bed</code></div>
<div class="item" data-value="binoculars"><i class="floatRa sf-binoculars"></i><code>binoculars</code></div>
<div class="item" data-value="bold-1"><i class="floatRa sf-bold-1"></i><code>bold-1</code></div>
<div class="item" data-value="book"><i class="floatRa sf-book"></i><code>book</code></div>
<div class="item" data-value="bus"><i class="floatRa sf-bus"></i><code>bus</code></div>
<div class="item" data-value="calculator"><i class="floatRa sf-calculator"></i><code>calculator</code></div>
<div class="item" data-value="calendar"><i class="floatRa sf-calendar"></i><code>calendar</code></div>
<div class="item" data-value="calendar-check-o"><i class="floatRa sf-calendar-check-o"></i><code>calendar-check-o</code></div>
<div class="item" data-value="calendar-minus-o"><i class="floatRa sf-calendar-minus-o"></i><code>calendar-minus-o</code></div>
<div class="item" data-value="camera"><i class="floatRa sf-camera"></i><code>camera</code></div>
<div class="item" data-value="camera-retro"><i class="floatRa sf-camera-retro"></i><code>camera-retro</code></div>
<div class="item" data-value="car"><i class="floatRa sf-car"></i><code>car</code></div>
<div class="item" data-value="cart-plus"><i class="floatRa sf-cart-plus"></i><code>cart-plus</code></div>
<div class="item" data-value="cc-mastercard"><i class="floatRa sf-cc-mastercard"></i><code>cc-mastercard</code></div>
<div class="item" data-value="check-circle"><i class="floatRa sf-check-circle"></i><code>check-circle</code></div>
<div class="item" data-value="check-circle-o"><i class="floatRa sf-check-circle-o"></i><code>check-circle-o</code></div>
<div class="item" data-value="check-square"><i class="floatRa sf-check-square"></i><code>check-square</code></div>
<div class="item" data-value="check-square-o"><i class="floatRa sf-check-square-o"></i><code>check-square-o</code></div>
<div class="item" data-value="chevron-down"><i class="floatRa sf-chevron-down"></i><code>chevron-down</code></div>
<div class="item" data-value="chevron-left"><i class="floatRa sf-chevron-left"></i><code>chevron-left</code></div>
<div class="item" data-value="chevron-right"><i class="floatRa sf-chevron-right"></i><code>chevron-right</code></div>
<div class="item" data-value="chevron-up"><i class="floatRa sf-chevron-up"></i><code>chevron-up</code></div>
<div class="item" data-value="child"><i class="floatRa sf-child"></i><code>child</code></div>
<div class="item" data-value="chrome"><i class="floatRa sf-chrome"></i><code>chrome</code></div>
<div class="item" data-value="circle-o-notch"><i class="floatRa sf-circle-o-notch"></i><code>circle-o-notch</code></div>
<div class="item" data-value="code"><i class="floatRa sf-code"></i><code>code</code></div>
<div class="item" data-value="code-fork"><i class="floatRa sf-code-fork"></i><code>code-fork</code></div>
<div class="item" data-value="coffee"><i class="floatRa sf-coffee"></i><code>coffee</code></div>
<div class="item" data-value="compress"><i class="floatRa sf-compress"></i><code>compress</code></div>
<div class="item" data-value="copyright"><i class="floatRa sf-copyright"></i><code>copyright</code></div>
<div class="item" data-value="css3"><i class="floatRa sf-css3"></i><code>css3</code></div>
<div class="item" data-value="diamond"><i class="floatRa sf-diamond"></i><code>diamond</code></div>
<div class="item" data-value="eject"><i class="floatRa sf-eject"></i><code>eject</code></div>
<div class="item" data-value="exchange"><i class="floatRa sf-exchange"></i><code>exchange</code></div>
<div class="item" data-value="eur"><i class="floatRa sf-eur"></i><code>eur</code></div>
<div class="item" data-value="exclamation"><i class="floatRa sf-exclamation"></i><code>exclamation</code></div>
<div class="item" data-value="exclamation-circle"><i class="floatRa sf-exclamation-circle"></i><code>exclamation-circle</code></div>
<div class="item" data-value="exclamation-triangle"><i class="floatRa sf-exclamation-triangle"></i><code>exclamation-triangle</code></div>
<div class="item" data-value="expand"><i class="floatRa sf-expand"></i><code>expand</code></div>
<div class="item" data-value="expeditedssl"><i class="floatRa sf-expeditedssl"></i><code>expeditedssl</code></div>
<div class="item" data-value="external-link"><i class="floatRa sf-external-link"></i><code>external-link</code></div>
<div class="item" data-value="eyedropper"><i class="floatRa sf-eyedropper"></i><code>eyedropper</code></div>
<div class="item" data-value="fast-backward"><i class="floatRa sf-fast-backward"></i><code>fast-backward</code></div>
<div class="item" data-value="fast-forward"><i class="floatRa sf-fast-forward"></i><code>fast-forward</code></div>
<div class="item" data-value="fax"><i class="floatRa sf-fax"></i><code>fax</code></div>
<div class="item" data-value="firefox"><i class="floatRa sf-firefox"></i><code>firefox</code></div>
<div class="item" data-value="flask"><i class="floatRa sf-flask"></i><code>flask</code></div>
<div class="item" data-value="folder-o"><i class="floatRa sf-folder-o"></i><code>folder-o</code></div>
<div class="item" data-value="folder-2"><i class="floatRa sf-folder-2"></i><code>folder-2</code></div>
<div class="item" data-value="folder-open"><i class="floatRa sf-folder-open"></i><code>folder-open</code></div>
<div class="item" data-value="folder-open-o"><i class="floatRa sf-folder-open-o"></i><code>folder-open-o</code></div>
<div class="item" data-value="font-1"><i class="floatRa sf-font-1"></i><code>font-1</code></div>
<div class="item" data-value="frown-o"><i class="floatRa sf-frown-o"></i><code>frown-o</code></div>
<div class="item" data-value="gift"><i class="floatRa sf-gift"></i><code>gift</code></div>
<div class="item" data-value="gratipay"><i class="floatRa sf-gratipay"></i><code>gratipay</code></div>
<div class="item" data-value="google-plus"><i class="floatRa sf-google-plus"></i><code>google-plus</code></div>
<div class="item" data-value="google"><i class="floatRa sf-google"></i><code>google</code></div>
<div class="item" data-value="git-square"><i class="floatRa sf-git-square"></i><code>git-square</code></div>
<div class="item" data-value="git"><i class="floatRa sf-git"></i><code>git</code></div>
<div class="item" data-value="hand-peace-o"><i class="floatRa sf-hand-peace-o"></i><code>hand-peace-o</code></div>
<div class="item" data-value="header"><i class="floatRa sf-header"></i><code>header</code></div>
<div class="item" data-value="headphones"><i class="floatRa sf-headphones"></i><code>headphones</code></div>
<div class="item" data-value="heartbeat"><i class="floatRa sf-heartbeat"></i><code>heartbeat</code></div>
<div class="item" data-value="hourglass-start"><i class="floatRa sf-hourglass-start"></i><code>hourglass-start</code></div>
<div class="item" data-value="html5"><i class="floatRa sf-html5"></i><code>html5</code></div>
<div class="item" data-value="indent-1"><i class="floatRa sf-indent-1"></i><code>indent-1</code></div>
<div class="item" data-value="inbox"><i class="floatRa sf-inbox"></i><code>inbox</code></div>
<div class="item" data-value="internet-explorer"><i class="floatRa sf-internet-explorer"></i><code>internet-explorer</code></div>
<div class="item" data-value="italic"><i class="floatRa sf-italic"></i><code>italic</code></div>
<div class="item" data-value="linux"><i class="floatRa sf-linux"></i><code>linux</code></div>
<div class="item" data-value="lightbulb-o"><i class="floatRa sf-lightbulb-o"></i><code>lightbulb-o</code></div>
<div class="item" data-value="life-ring"><i class="floatRa sf-life-ring"></i><code>life-ring</code></div>
<div class="item" data-value="level-down"><i class="floatRa sf-level-down"></i><code>level-down</code></div>
<div class="item" data-value="level-up"><i class="floatRa sf-level-up"></i><code>level-up</code></div>
<div class="item" data-value="list-ol"><i class="floatRa sf-list-ol"></i><code>list-ol</code></div>
<div class="item" data-value="list-ul"><i class="floatRa sf-list-ul"></i><code>list-ul</code></div>
<div class="item" data-value="location-arrow"><i class="floatRa sf-location-arrow"></i><code>location-arrow</code></div>
<div class="item" data-value="magic"><i class="floatRa sf-magic"></i><code>magic</code></div>
<div class="item" data-value="map-marker"><i class="floatRa sf-map-marker"></i><code>map-marker</code></div>
<div class="item" data-value="map"><i class="floatRa sf-map"></i><code>map</code></div>
<div class="item" data-value="meh-o"><i class="floatRa sf-meh-o"></i><code>meh-o</code></div>
<div class="item" data-value="map-pin"><i class="floatRa sf-map-pin"></i><code>map-pin</code></div>
<div class="item" data-value="mars"><i class="floatRa sf-mars"></i><code>mars</code></div>
<div class="item" data-value="microphone"><i class="floatRa sf-microphone"></i><code>microphone</code></div>
<div class="item" data-value="microphone-slash"><i class="floatRa sf-microphone-slash"></i><code>microphone-slash</code></div>
<div class="item" data-value="mobile"><i class="floatRa sf-mobile"></i><code>mobile</code></div>
<div class="item" data-value="money"><i class="floatRa sf-money"></i><code>money</code></div>
<div class="item" data-value="moon-o"><i class="floatRa sf-moon-o"></i><code>moon-o</code></div>
<div class="item" data-value="motorcycle"><i class="floatRa sf-motorcycle"></i><code>motorcycle</code></div>
<div class="item" data-value="mouse-pointer"><i class="floatRa sf-mouse-pointer"></i><code>mouse-pointer</code></div>
<div class="item" data-value="music"><i class="floatRa sf-music"></i><code>music</code></div>
<div class="item" data-value="paint-brush"><i class="floatRa sf-paint-brush"></i><code>paint-brush</code></div>
<div class="item" data-value="picture-o"><i class="floatRa sf-picture-o"></i><code>picture-o</code></div>
<div class="item" data-value="phone-square"><i class="floatRa sf-phone-square"></i><code>phone-square</code></div>
<div class="item" data-value="phone"><i class="floatRa sf-phone"></i><code>phone</code></div>
<div class="item" data-value="paper-plane"><i class="floatRa sf-paper-plane"></i><code>paper-plane</code></div>
<div class="item" data-value="paper-plane-o"><i class="floatRa sf-paper-plane-o"></i><code>paper-plane-o</code></div>
<div class="item" data-value="pie-chart"><i class="floatRa sf-pie-chart"></i><code>pie-chart</code></div>
<div class="item" data-value="play"><i class="floatRa sf-play"></i><code>play</code></div>
<div class="item" data-value="play-circle-o"><i class="floatRa sf-play-circle-o"></i><code>play-circle-o</code></div>
<div class="item" data-value="plug"><i class="floatRa sf-plug"></i><code>plug</code></div>
<div class="item" data-value="plus-square"><i class="floatRa sf-plus-square"></i><code>plus-square</code></div>
<div class="item" data-value="plus-square-o"><i class="floatRa sf-plus-square-o"></i><code>plus-square-o</code></div>
<div class="item" data-value="power-off-1"><i class="floatRa sf-power-off-1"></i><code>power-off-1</code></div>
<div class="item" data-value="registered"><i class="floatRa sf-registered"></i><code>registered</code></div>
<div class="item" data-value="repeat"><i class="floatRa sf-repeat"></i><code>repeat</code></div>
<div class="item" data-value="rocket"><i class="floatRa sf-rocket"></i><code>rocket</code></div>
<div class="item" data-value="rss-square"><i class="floatRa sf-rss-square"></i><code>rss-square</code></div>
<div class="item" data-value="scissors"><i class="floatRa sf-scissors"></i><code>scissors</code></div>
<div class="item" data-value="safari"><i class="floatRa sf-safari"></i><code>safari</code></div>
<div class="item" data-value="search-plus"><i class="floatRa sf-search-plus"></i><code>search-plus</code></div>
<div class="item" data-value="search-minus"><i class="floatRa sf-search-minus"></i><code>search-minus</code></div>
<div class="item" data-value="sellsy"><i class="floatRa sf-sellsy"></i><code>sellsy</code></div>
<div class="item" data-value="server"><i class="floatRa sf-server"></i><code>server</code></div>
<div class="item" data-value="share-alt"><i class="floatRa sf-share-alt"></i><code>share-alt</code></div>
<div class="item" data-value="share-alt-square"><i class="floatRa sf-share-alt-square"></i><code>share-alt-square</code></div>
<div class="item" data-value="share-square"><i class="floatRa sf-share-square"></i><code>share-square</code></div>
<div class="item" data-value="share-square-o"><i class="floatRa sf-share-square-o"></i><code>share-square-o</code></div>
<div class="item" data-value="shield"><i class="floatRa sf-shield"></i><code>shield</code></div>
<div class="item" data-value="shopping-cart"><i class="floatRa sf-shopping-cart"></i><code>shopping-cart</code></div>
<div class="item" data-value="sign-in"><i class="floatRa sf-sign-in"></i><code>sign-in</code></div>
<div class="item" data-value="signal"><i class="floatRa sf-signal"></i><code>signal</code></div>
<div class="item" data-value="sitemap"><i class="floatRa sf-sitemap"></i><code>sitemap</code></div>
<div class="item" data-value="slack"><i class="floatRa sf-slack"></i><code>slack</code></div>
<div class="item" data-value="sliders"><i class="floatRa sf-sliders"></i><code>sliders</code></div>
<div class="item" data-value="sort"><i class="floatRa sf-sort"></i><code>sort</code></div>
<div class="item" data-value="smile-o"><i class="floatRa sf-smile-o"></i><code>smile-o</code></div>
<div class="item" data-value="sort-asc"><i class="floatRa sf-sort-asc"></i><code>sort-asc</code></div>
<div class="item" data-value="sort-desc"><i class="floatRa sf-sort-desc"></i><code>sort-desc</code></div>
<div class="item" data-value="soundcloud"><i class="floatRa sf-soundcloud"></i><code>soundcloud</code></div>
<div class="item" data-value="space-shuttle"><i class="floatRa sf-space-shuttle"></i><code>space-shuttle</code></div>
<div class="item" data-value="stack-overflow"><i class="floatRa sf-stack-overflow"></i><code>stack-overflow</code></div>
<div class="item" data-value="sun-o"><i class="floatRa sf-sun-o"></i><code>sun-o</code></div>
<div class="item" data-value="superscript-1"><i class="floatRa sf-superscript-1"></i><code>superscript-1</code></div>
<div class="item" data-value="table"><i class="floatRa sf-table"></i><code>table</code></div>
<div class="item" data-value="tablet"><i class="floatRa sf-tablet"></i><code>tablet</code></div>
<div class="item" data-value="taxi"><i class="floatRa sf-taxi"></i><code>taxi</code></div>
<div class="item" data-value="television"><i class="floatRa sf-television"></i><code>television</code></div>
<div class="item" data-value="terminal"><i class="floatRa sf-terminal"></i><code>terminal</code></div>
<div class="item" data-value="text-height-1"><i class="floatRa sf-text-height-1"></i><code>text-height-1</code></div>
<div class="item" data-value="text-width"><i class="floatRa sf-text-width"></i><code>text-width</code></div>
<div class="item" data-value="th"><i class="floatRa sf-th"></i><code>th</code></div>
<div class="item" data-value="th-large"><i class="floatRa sf-th-large"></i><code>th-large</code></div>
<div class="item" data-value="th-list"><i class="floatRa sf-th-list"></i><code>th-list</code></div>
<div class="item" data-value="trademark"><i class="floatRa sf-trademark"></i><code>trademark</code></div>
<div class="item" data-value="tree"><i class="floatRa sf-tree"></i><code>tree</code></div>
<div class="item" data-value="undo"><i class="floatRa sf-undo"></i><code>undo</code></div>
<div class="item" data-value="underline"><i class="floatRa sf-underline"></i><code>underline</code></div>
<div class="item" data-value="umbrella"><i class="floatRa sf-umbrella"></i><code>umbrella</code></div>
<div class="item" data-value="tty"><i class="floatRa sf-tty"></i><code>tty</code></div>
<div class="item" data-value="trophy-1"><i class="floatRa sf-trophy-1"></i><code>trophy-1</code></div>
<div class="item" data-value="upload"><i class="floatRa sf-upload"></i><code>upload</code></div>
<div class="item" data-value="usd"><i class="floatRa sf-usd"></i><code>usd</code></div>
<div class="item" data-value="venus"><i class="floatRa sf-venus"></i><code>venus</code></div>
<div class="item" data-value="wheelchair"><i class="floatRa sf-wheelchair"></i><code>wheelchair</code></div>
<div class="item" data-value="weixin"><i class="floatRa sf-weixin"></i><code>weixin</code></div>
<div class="item" data-value="video-camera"><i class="floatRa sf-video-camera"></i><code>video-camera</code></div>
<div class="item" data-value="wifi"><i class="floatRa sf-wifi"></i><code>wifi</code></div>
<div class="item" data-value="wordpress"><i class="floatRa sf-wordpress"></i><code>wordpress</code></div>
<div class="item" data-value="youtube"><i class="floatRa sf-youtube"></i><code>youtube</code></div>
<div class="item" data-value="pin"><i class="floatRa sf-pin"></i><code>pin</code></div>
<div class="item" data-value="anchor"><i class="floatRa sf-anchor"></i><code>anchor</code></div>
<div class="item" data-value="alarm"><i class="floatRa sf-alarm"></i><code>alarm</code></div>
<div class="item" data-value="instagram-1"><i class="floatRa sf-instagram-1"></i><code>instagram-1</code></div>
<div class="item" data-value="heart-1"><i class="floatRa sf-heart-1"></i><code>heart-1</code></div>
<div class="item" data-value="task"><i class="floatRa sf-task"></i><code>task</code></div>
<div class="item" data-value="broadcast"><i class="floatRa sf-broadcast"></i><code>broadcast</code></div>
<div class="item" data-value="bug-1"><i class="floatRa sf-bug-1"></i><code>bug-1</code></div>
<div class="item" data-value="star-2"><i class="floatRa sf-star-2"></i><code>star-2</code></div>
<div class="item" data-value="mark-github"><i class="floatRa sf-mark-github"></i><code>mark-github</code></div>
<div class="item" data-value="flag-1"><i class="floatRa sf-flag-1"></i><code>flag-1</code></div>
<div class="item" data-value="bug-2"><i class="floatRa sf-bug-2"></i><code>bug-2</code></div>
<div class="item" data-value="android-1"><i class="floatRa sf-android-1"></i><code>android-1</code></div>
<div class="item" data-value="bluetooth"><i class="floatRa sf-bluetooth"></i><code>bluetooth</code></div>
<div class="item" data-value="heart-2"><i class="floatRa sf-heart-2"></i><code>heart-2</code></div>
<div class="item" data-value="hashtag"><i class="floatRa sf-hashtag"></i><code>hashtag</code></div>
<div class="item" data-value="windows-1"><i class="floatRa sf-windows-1"></i><code>windows-1</code></div>
<div class="item" data-value="barcode-1"><i class="floatRa sf-barcode-1"></i><code>barcode-1</code></div>
<div class="item" data-value="glass-1"><i class="floatRa sf-glass-1"></i><code>glass-1</code></div>
<div class="item" data-value="tags-1"><i class="floatRa sf-tags-1"></i><code>tags-1</code></div>
<div class="item" data-value="tag-1"><i class="floatRa sf-tag-1"></i><code>tag-1</code></div>
<div class="item" data-value="skype"><i class="floatRa sf-skype"></i><code>skype</code></div>
<div class="item" data-value="yang-ying"><i class="floatRa sf-yang-ying"></i><code>yang-ying</code></div>
<div class="item" data-value="address-book"><i class="floatRa sf-address-book"></i><code>address-book</code></div>
<div class="item" data-value="alert"><i class="floatRa sf-alert"></i><code>alert</code></div>
<div class="item" data-value="adjust"><i class="floatRa sf-adjust"></i><code>adjust</code></div>
<div class="item" data-value="code-1"><i class="floatRa sf-code-1"></i><code>code-1</code></div>
<div class="item" data-value="basket"><i class="floatRa sf-basket"></i><code>basket</code></div>
<div class="item" data-value="attach"><i class="floatRa sf-attach"></i><code>attach</code></div>
<div class="item" data-value="globe-1"><i class="floatRa sf-globe-1"></i><code>globe-1</code></div>
<div class="item" data-value="lamp"><i class="floatRa sf-lamp"></i><code>lamp</code></div>
<div class="item" data-value="left-quote"><i class="floatRa sf-left-quote"></i><code>left-quote</code></div>
<div class="item" data-value="headphones-1"><i class="floatRa sf-headphones-1"></i><code>headphones-1</code></div>
<div class="item" data-value="moon-stroke"><i class="floatRa sf-moon-stroke"></i><code>moon-stroke</code></div>
<div class="item" data-value="moon-fill"><i class="floatRa sf-moon-fill"></i><code>moon-fill</code></div>
<div class="item" data-value="mic"><i class="floatRa sf-mic"></i><code>mic</code></div>
<div class="item" data-value="home-1"><i class="floatRa sf-home-1"></i><code>home-1</code></div>
<div class="item" data-value="chat-alt-fill"><i class="floatRa sf-chat-alt-fill"></i><code>chat-alt-fill</code></div>
<div class="item" data-value="bolt-1"><i class="floatRa sf-bolt-1"></i><code>bolt-1</code></div>
<div class="item" data-value="right-quote"><i class="floatRa sf-right-quote"></i><code>right-quote</code></div>
<div class="item" data-value="right-quote-alt"><i class="floatRa sf-right-quote-alt"></i><code>right-quote-alt</code></div>
<div class="item" data-value="pin-1"><i class="floatRa sf-pin-1"></i><code>pin-1</code></div>
<div class="item" data-value="atom"><i class="floatRa sf-atom"></i><code>atom</code></div>
<div class="item" data-value="celcius"><i class="floatRa sf-celcius"></i><code>celcius</code></div>
<div class="item" data-value="thermometer"><i class="floatRa sf-thermometer"></i><code>thermometer</code></div>
<div class="item" data-value="sun-black"><i class="floatRa sf-sun-black"></i><code>sun-black</code></div>
<div class="item" data-value="sun"><i class="floatRa sf-sun"></i><code>sun</code></div>
<div class="item" data-value="card"><i class="floatRa sf-card"></i><code>card</code></div>
<div class="item" data-value="edit"><i class="floatRa sf-edit"></i><code>edit</code></div>
<div class="item" data-value="pencil-1"><i class="floatRa sf-pencil-1"></i><code>pencil-1</code></div>
<div class="item" data-value="plane"><i class="floatRa sf-plane"></i><code>plane</code></div>
<div class="item" data-value="bag"><i class="floatRa sf-bag"></i><code>bag</code></div>
<div class="item" data-value="new-sign"><i class="floatRa sf-new-sign"></i><code>new-sign</code></div>
<div class="item" data-value="sell-sign"><i class="floatRa sf-sell-sign"></i><code>sell-sign</code></div>
<div class="item" data-value="load-a"><i class="floatRa sf-load-a"></i><code>load-a</code></div>
<div class="item" data-value="load-d"><i class="floatRa sf-load-d"></i><code>load-d</code></div>
<div class="item" data-value="load-b"><i class="floatRa sf-load-b"></i><code>load-b</code></div>
<div class="item" data-value="spin-alt"><i class="floatRa sf-spin-alt"></i><code>spin-alt</code></div>
<div class="item" data-value="pull-request"><i class="floatRa sf-pull-request"></i><code>pull-request</code></div>
<div class="item" data-value="network-1"><i class="floatRa sf-network-1"></i><code>network-1</code></div>
<div class="item" data-value="merge"><i class="floatRa sf-merge"></i><code>merge</code></div>
<div class="item" data-value="fork-repo"><i class="floatRa sf-fork-repo"></i><code>fork-repo</code></div>
<div class="item" data-value="publish"><i class="floatRa sf-publish"></i><code>publish</code></div>
<div class="item" data-value="facebook-square"><i class="floatRa sf-facebook-square"></i><code>facebook-square</code></div>
<div class="item" data-value="facebook-official"><i class="floatRa sf-facebook-official"></i><code>facebook-official</code></div>
<div class="item" data-value="pinterest-square"><i class="floatRa sf-pinterest-square"></i><code>pinterest-square</code></div>
<div class="item" data-value="pinterest-p"><i class="floatRa sf-pinterest-p"></i><code>pinterest-p</code></div>
<div class="item" data-value="skype-1"><i class="floatRa sf-skype-1"></i><code>skype-1</code></div>
<div class="item" data-value="model-s"><i class="floatRa sf-model-s"></i><code>model-s</code></div>
<div class="item" data-value="vcard"><i class="floatRa sf-vcard"></i><code>vcard</code></div>
<div class="item" data-value="clock-o"><i class="floatRa sf-clock-o"></i><code>clock-o</code></div>
<div class="item" data-value="calendar-o"><i class="floatRa sf-calendar-o"></i><code>calendar-o</code></div>
<div class="item" data-value="arrow-vertical"><i class="floatRa sf-arrow-vertical"></i><code>arrow-vertical</code></div>
<div class="item" data-value="arrow-horizontal"><i class="floatRa sf-arrow-horizontal"></i><code>arrow-horizontal</code></div>


  </div>
</div>


  </div>
</section>
<?php } //endif ?>
<?php }//endfunction ?>
