<?php
$dataRow = \dash\data::dataRow();
$myFirstURL = '';


$type   = \dash\data::dataRow_type();

$myID = '?id='. \dash\request::get('id');

$isPage = ($type === 'page');
$isPost = ($type === 'post');
$isHelp = ($type === 'help');

$myIcon = 'check';

switch (\dash\data::dataRow_status())
{
  case 'publish' :  $myIcon = 'check ok'; break;
  case 'draft' :    $myIcon = 'detail'; break;
  case 'deleted' :  $myIcon = 'stop nok'; break;
}
?>
<?php if(\dash\data::dataRow_status() !== 'publish' || a(\dash\data::dataRow(), 'will_be_published_on_future') || a(\dash\data::dataRow(), 'meta', 'redirect')) {?>
  <nav class="items long">
    <ul>

      <?php if(\dash\data::dataRow_status() !== 'publish') {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/setting'. \dash\request::full_get();?>">
            <div class="key"><?php echo T_("To change post status Click here") ?></div>
            <div class="value"><?php echo T_(\dash\data::dataRow_status());?></div>
            <div class="go <?php echo $myIcon ?>"></div>
          </a>
        </li>
      <?php } //endif ?>

      <?php if(a(\dash\data::dataRow(), 'will_be_published_on_future')) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/publishdate'. \dash\request::full_get();?>">
            <div class="key s0"><?php echo T_("Time left until published") ?></div>
            <div class="value"><?php echo a(\dash\data::dataRow(), 'will_be_published_on_future', 'time_human') ?></div>

            <div class="go detail"></div>
          </a>
        </li>
      <?php } //endif ?>

      <?php if(a(\dash\data::dataRow(), 'meta', 'redirect')) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/redirecturl'. \dash\request::full_get();?>">
            <div class="key"><?php echo T_("This post automatically redirected to new page") ?></div>
            <div class="value s0"><?php echo a(\dash\data::dataRow(), 'meta', 'redirect');?></div>
            <div class="go detail"></div>
          </a>
        </li>
      <?php } //endif ?>
    </ul>
  </nav>

<?php } //endif ?>


<form method="post" autocomplete="off" id="formEditPost">
<?php if($isPage || $isHelp) {?>
 <?php if(\dash\data::parentList()) {?>
  <div class="box">
    <div class="pad">
      <p><?php echo T_("You can set this page as parent of another page") ?></p>
      <div>
        <label for="parent"><?php echo T_("Parent") ?></label>
        <select class="select22" name="parent" id="parent">
          <option value="0"><?php echo T_("Without parent") ?></option>
          <?php foreach (\dash\data::parentList() as $key => $value) {?>
            <option value="<?php echo a($value, 'id'); ?>" <?php if(\dash\data::dataRow_parent() === a($value, 'id')) {echo 'selected';} ?>><?php echo a($value, 'title') ?></option>
          <?php } //endfor ?>
        </select>
      </div>
    </div>
  </div>
 <?php } //endif ?>
<?php } //endif ?>


  <div class="box">
    <div class="pad">
      <div class="input mB10">
        <input type="text" name="title" id="title" placeholder='<?php echo T_("Enter title here"); ?> *' value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?> required maxlength='200' minlength="1" pattern=".{1,200}">
        <?php if(\dash\data::dataRow_type() === 'post') {?>
          <span class="addon" data-kerkere='.subTitle' <?php if(\dash\data::dataRow_subtitle()) {?> data-kerkere-icon='open' <?php }else{ ?> data-kerkere-icon <?php }//endif ?>><span class="s0"><?php echo T_("Add Subtitle"); ?></span></span>
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
      <textarea class="txt mB10" data-editor id='descInput' name="content" placeholder='<?php echo T_("Write post "); ?>' maxlength='100000' rows="15"><?php echo \dash\data::dataRow_content(); ?></textarea>
    </div>
  </div>

<?php
  $gallery = \dash\data::dataRow_gallery_array();
  if(!is_array($gallery))
  {
    $gallery = [];
  }
?>
    <div class="box">
      <div class="pad1">
        <?php if(is_array(\dash\data::dataRow_gallery_array()) && count(\dash\data::dataRow_gallery_array()) > 10) {?>
          <div class="msg minimal mB0 warn2"><?php echo T_("Product gallery is full!"); ?></div>
        <?php }else{ ?>
          <div data-uploader data-max-w="1000" data-max-h="1000" data-name='gallery' <?php echo \dash\data::productImageRatioHtml(); ?> <?php if(\dash\url::child() === 'edit') { echo 'data-autoSend'; }?>>
            <input type="file" id="file1">
            <label for="file1"><abbr><?php echo T_('Drag &amp; Drop your files or Browse'); ?></abbr>
              <?php if(count($gallery) >= 3) {?>
                <a href="<?php echo \dash\url::this().'/gallerysort?'. \dash\request::fix_get() ?>" class="link"><?php echo T_("Sort images") ?></a>
              <?php } //endif ?>
            <small class="fc-mute block"><?php echo T_("Maximum file size"). ' '. \dash\data::maxUploadSize(); ?></small></label>

        <?php if(\dash\data::dataRow_gallery_array()) {?>
          <div class="previewList">
            <?php foreach (\dash\data::dataRow_gallery_array() as $key => $value) {?>
                <div class="fileItem" data-removeElement data-type='<?php echo a($value, 'type'); ?>'>
                  <?php if(a($value, 'type') === 'video') {?>
                    <video controls>
                      <source src="<?php echo a($value, 'path'); ?>" type="<?php echo a($value, 'mime'); ?>">
                    </video>
                  <?php } else { ?>
                  <img src="<?php echo a($value, 'path'); ?>" alt="<?php echo a(\dash\data::dataRow(), 'title'); ?>">
                    <?php if($key === 0) {?>
                    <?php }else{ ?>
                      <div class='setFeatureImg' data-ajaxify data-refresh data-data='{"fileaction": "setthumb", "fileid" : "<?php echo a($value, 'id'); ?>"}'><?php echo T_("Set as cover"); ?></div>
                    <?php }// endid ?>
                  <?php } ?>
                  <div>
                    <div class="imageDel" data-ajaxify data-data='{"fileaction": "remove", "fileid" : "<?php echo a($value, 'id'); ?>"}'></div>
                  </div>
                </div>
            <?php } //endfor ?>
          </div>
        <?php } //endif ?>
          </div>
        <?php } //endif ?>
      </div>
    </div>


      <div class="box">
        <div class="pad">
          <div class="seoPreview">
            <a target="_blank" href="<?php echo \dash\data::dataRow_link(); ?>">
              <cite><?php echo \dash\data::dataRow_link(); ?></cite>
            </a>
            <div class="f">
              <div class="c s12 pLa10">
                <h3><?php echo \dash\data::dataRow_title();  ?> | <?php echo \dash\face::site(); ?></h3>
                <p class="desc"><?php echo a($dataRow,'excerpt'); ?></p>
              </div>
              <div class="cauto os s12">
                <img src="<?php echo \dash\url::siftal(); ?>/images/logo/google.png" alt='<?php echo T_("Google"); ?>'>
              </div>
            </div>
          </div>

        </div>
        <footer class="txtRa">
          <a class="link sm" href="<?php echo \dash\url::this(). '/seo'. \dash\request::full_get() ?>"><?php echo T_("Customize SEO") ?></a>
        </footer>
      </div>


      <div class="box">
        <div class="pad">
      <?php if($isPost) {?>
          <div class="mB10">
            <div class="row align-center">
              <div class="c"><label for='cat'><?php echo T_("Category"); ?></label></div>
              <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/terms?type=cat"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
            </div>
            <select name="cat[]" id="cat" class="select22" data-model="tag" multiple="multiple">
              <?php foreach (\dash\data::listCategory() as $key => $value) {?>
                <option value="<?php echo $value['title']; ?>" <?php if(is_array(\dash\data::listSavedCat()) && in_array($value['id'], \dash\data::listSavedCat())) {echo 'selected'; } ?>><?php echo $value['title']; ?></option>
              <?php } //endfor ?>
            </select>
          </div>
    <?php } //endif ?>
          <div>
            <div class="row align-center">
              <div class="c"><label for='tag'><?php echo T_("Tag"); ?></label></div>
              <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/terms?type=tag"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
            </div>
            <select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">
              <?php foreach (\dash\data::allTagList() as $key => $value) {?>
                <option value="<?php echo $value['title']; ?>" <?php if(in_array($value['title'], \dash\data::tagsSavedTitle())) { echo 'selected';} ?>><?php echo $value['title']; ?></option>
              <?php } //endfor ?>
            </select>
          </div>
        </div>
      </div>
</form>

