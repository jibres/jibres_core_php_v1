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
      <select name="creator" class="select22">
        <option></option>
        <?php foreach (\dash\data::postAdder() as $key => $value) {?>
          <option <?php if(\dash\data::dataRow_user_id() == $value['id']) { echo 'selected';}  ?> value="<?php echo $value['id']; ?>">
            <?php echo \dash\get::index($value, 'displayname'); ?> - <?php echo \dash\get::index($value, 'mobile'); ?>
          </option>
        <?php } //endfor ?>
      </select>

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
            <?php if(!is_array($postCat)) { $postCat = [];} ?>
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

  $postTag = \dash\app\term::load_tag_html(["post_id" => \dash\request::get('id') , "title" => true, "type" => $myTagType]);
  $tagCount = 0;

  if($postTag && is_array($postTag))
  {
    $tagCount = count($postTag);
  }


?>

<section class="pbox">
  <header data-kerkere='.tagPanel' data-kerkere-icon='close'><?php echo T_("Keywords"); ?><span class="badge floatRa"><?php echo \dash\fit::number($tagCount); ?></span></header>
  <div class="body tagPanel" data-kerkere-content='hide'>
    <div class="tagDetector">



        <div class="mB10">
          <label for='tag'><?php echo T_("Tag"); ?></label>
          <select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">

            <?php foreach ($postTag as $key => $value) {?>

              <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>

            <?php } //endfor ?>

          </select>
        </div>

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
    <select class="select22" name="subtype">
      <option></option>
        <option value="standard" <?php if(\dash\data::dataRow_subtype() == 'standard') { echo 'selected'; } ?> ><?php echo T_("Standard"); ?></div>
        <option value="image" <?php if(\dash\data::dataRow_subtype() == 'image') { echo 'selected'; } ?> > <?php echo T_("Image"); ?></div>
        <option value="gallery" <?php if(\dash\data::dataRow_subtype() == 'gallery') { echo 'selected'; } ?> ><?php echo T_("Gallery"); ?></div>
        <option value="video" <?php if(\dash\data::dataRow_subtype() == 'video') { echo 'selected'; } ?> ><?php echo T_("Video"); ?></div>
        <option value="audio" <?php if(\dash\data::dataRow_subtype() == 'audio') { echo 'selected'; } ?> > <?php echo T_("Audio"); ?></div>

    </select>


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
        <h3><?php if(\dash\data::dataRow_seotitle()) { echo \dash\data::dataRow_seotitle(); } else { echo \dash\data::dataRow_title();} ?> | <?php echo \dash\face::site(); ?></h3>
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
            <label class="addon"> | <?php echo \dash\face::site(); ?></label>
          </div>
        </div>

        <?php if(\dash\data::dataRow_type() === 'page' || \dash\data::dataRow_type() === 'help') {?>


        <div>
          <label for="parent"><?php echo T_("Parent"); ?> <small><?php echo T_("Choose parent for this page to create related url as tree"); ?></small></label>
          <select name="parent" class="select22">
            <option value=""><i><?php echo T_("Choose Parent"); ?></i></option>
            <option value="0"><i><?php echo T_("Without Parent"); ?></i></option>
            <?php foreach (\dash\data::pageList() as $key => $value) {?>

              <?php if(isset($value['id']) && $value['id'] == \dash\data::dataRow_id()) {}else{?>

                <option value="<?php echo $value['id']; ?>" <?php if(\dash\data::dataRow_parent() == $value['id']) { echo 'selected';} ?>><?php echo $value['title']; ?></option>
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
    <div class="input ltr mB10">
      <?php $icon = \dash\data::dataRow_meta(); if(isset($icon['icon'])){$icon = $icon['icon'];}else{$icon = null;} ?>
      <input type="text" name="icon" id="icon" placeholder='<?php echo T_("Icon"); ?>' value="<?php echo $icon; ?>" maxlength='100' minlength="1" pattern=".{1,100}">
    </div>
  </div>
</section>
<?php } //endif ?>
<?php }//endfunction ?>
