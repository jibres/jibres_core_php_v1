<?php

$html = '';

$currentPageDetail = $dataRow = \dash\data::currentPageDetail();
\dash\data::dataRow($dataRow);
$coverUrl = a($currentPageDetail, 'cover');


// homepage id
$is_homepage = false;
$homepage_id = \content_site\homepage::code();

if(\dash\request::get('id') === $homepage_id)
{
  $is_homepage = true;
}

$html .= "<div class='mb-6'>";
{
  if($is_homepage)
  {
    $html .= "<div class='btn-danger block w-full disabled'>";
    {
      $html .= T_('Is home page');
    }
    $html .= '</div>';

  }
  elseif(\dash\permission::check('manageHomepage'))
  {
    $set_as_homepage = json_encode(['set_as_homepage' => 'set_as_homepage']);
    $set_as_homepage_title = T_('Are you sure to set this page as homepage?');
    $set_as_homepage_msg = T_('After setting as the homepage, the current changes of your page will be saved and published');
    $html .= "<div class='btn-outline-primary w-full' data-confirm data-data='$set_as_homepage' data-title='$set_as_homepage_title' data-msg='$set_as_homepage_msg' >";
    {
      $html .= T_('Set as home page');
    }
    $html .= '</div>';
  }
}
$html .= '</div>';

$html .= "<form method='post' autocomplete='off' data-patch>";
{
  $html .= "<input type='hidden' name='seosettings' value='1'>";

  $html .= "<input type='hidden' name='set_title' value='1'>";
  $html .= "<label for='pagetitle'>". T_('Page title'). "</label>";
  $html .= "<div class='input'>";
  {
    $html .= "<input type='text' name='title' value='". a($currentPageDetail, 'title'). "' id='". T_('Page title'). "'>";
  }
  $html .= "</div>";
  if ($is_homepage)
  {
    $html .= '<div class="fc-mute text-sm">';
    {
      $html .= T_("This is the homepage and this title only use in admin panel");
    }
    $html .= '</div>';
  }
}
$html .= "</form>";

$html .= "<form method='post' autocomplete='off'>";
{
  $html .= "<input type='hidden' name='seosettings' value='1'>";

  $fill = null;

  if($coverUrl)
  {
    $fill =  'data-fill';
  }

  $html .= "<div class='action' data-uploader data-name='cover' ". \dash\data::ratioHtml(). ' '. $fill . " data-final='#finalImageThumb' data-autoSend data-file-max-size='". \dash\data::maxFileSize() ."' data-type='featureImage'>";
  {
    $html .= "<input type='hidden' name='runaction_setthumb' value='1'>";
    $html .= "<input type='file' accept='image/jpeg, image/png' id='image1thumb'>";

    $html .= "<label for='image1thumb'>". T_('Page cover'). "</label>";

    if($coverUrl)
    {
      $html .= "<label for='image1thumb'><img src='". \dash\fit::img($coverUrl, 460). "' alt='". T_('Page cover'). "' id='finalImageThumb'></label>";
      $html .= "<span class='imageDel' data-confirm data-data='{'remove_cover' : 'remove_cover'}'></span>";
    }
  }
  $html .= "</div>";
}
$html .= "</form>";

echo $html;

?>

<form method='post' autocomplete='off' id='editFormSEO' data-patch>
  <input type='hidden' name='seosettings' value='1'>
  <input type='hidden' name='set_seo' value='1'>
      <div class='mb-5'>
        <label for='seotitle'><?php echo T_('SEO Title'); ?></label>
        <div class='input'>
          <input type='text' name='seotitle' id='seotitle'  value='<?php echo a($dataRow,'seotitle'); ?>' maxlength='400'>
        </div>
      </div>
      <div class='mb-5'>
        <label for='excerpt'><?php echo T_('SEO Description'); ?> <small><?php echo T_('If leave it empty we are generate it automatically'); ?></small></label>
        <textarea class='txt' name='excerpt' id='excerpt' maxlength='300' rows='3' placeholder='<?php echo T_('Excerpt used for social media and search engines'); ?>'><?php if(a($dataRow, 'autoexcerpt')){ echo null;}else{ echo a($dataRow,'excerpt'); }; ?></textarea>
      </div>

      <div class='mb-5'>
        <div class='txtB mb-5'><?php echo T_('Special Address') ?></div>
        <div class='row'>
          <div class='c-xs-12 c-sm-6 c-md'>
            <div class='radio3'>
              <input type='radio' name='specialaddress' value='independence' id='independence'  <?php if(\dash\data::dataRow_specialaddress() === 'independence') {echo 'checked';} ?>>
              <label for='independence'><?php echo T_('Independence') ?></label>
            </div>
          </div>
          <div class='c-xs-12 c-sm-6 c-md'>
            <div class='radio3'>
              <input type='radio' name='specialaddress' value='special' id='special' <?php if(\dash\data::dataRow_specialaddress() === 'special') {echo 'checked';} ?>>
              <label for='special'><?php echo T_('Special') ?></label>
            </div>
          </div>
          <?php if(\dash\data::dataRow_tags()) {?>
            <div class='c-xs-12 c-sm-6 c-md'>
              <div class='radio3'>
                <input type='radio' name='specialaddress' value='under_tag' id='under_tag' <?php if(\dash\data::dataRow_specialaddress() === 'under_tag') {echo 'checked';} ?>>
                <label for='under_tag'><?php echo T_('Under tag') ?></label>
              </div>
            </div>
          <?php } //endif ?>
          <?php if(\dash\data::parentList()) {?>
            <div class='c-xs-12 c-sm-6 c-md'>
              <div class='radio3'>
                <input type='radio' name='specialaddress' value='under_page' id='under_page' <?php if(\dash\data::dataRow_specialaddress() === 'under_page') {echo 'checked';} ?>>
                <label for='under_page'><?php echo T_('Under page') ?></label>
              </div>
            </div>
        <?php } //endif ?>
        </div>
      </div>
      <?php if($is_homepage) {?><div class="fc-mute text-sm"><?php echo T_("In homepage page url is your domain") ?></div><?php } //endif ?>

      <div class='mT10' data-response='specialaddress' data-response-where-not='independence' <?php if(\dash\data::dataRow_specialaddress() === 'independence') {echo 'data-response-hide';} ?>>
          <label for='seoSlug'><?php echo T_('Url'); ?> <small><?php echo T_('End part of your news url.'); ?></small></label>
          <div class='input ltr'>
            <input type='text' name='slug' id='seoSlug' placeholder='<?php echo T_('Url'); ?>' value='<?php if(a($dataRow,'slug')) { echo a($dataRow,'slug'); }else{ echo 'page-'. mb_strtolower(a($dataRow, 'id'));} ?>' maxlength='100' minlength='1' pattern='.{1,100}'>
          </div>
      </div>

      <div class='mb-5' data-response='specialaddress' data-response-where='under_page' <?php if(\dash\data::dataRow_specialaddress() === 'under_page') {}else{ echo 'data-response-hide';} ?>>
        <div class='mb-5 text-sm'>
          <div class='mb-5'><?php echo T_('You can set this page as a subset of another page') ?></div>
          <div class='fc-mute'><?php echo T_('Only published page can set as page parent') ?></div>
        </div>
        <div class='mb-5'>
          <select class='select22' name='parent' id='parent' data-placeholder='<?php echo T_('Choose a post') ?>'>
            <option value=''><?php echo T_('Choose a post') ?></option>
            <?php foreach (\dash\data::parentList() as $key => $value) {?>
              <option value='<?php echo a($value, 'id'); ?>' <?php if(\dash\data::dataRow_parent() === a($value, 'id')) {echo 'selected';} ?>><?php echo a($value, 'title') ?></option>
            <?php } //endfor ?>
          </select>
        </div>
      </div>

      <div class='mb-5' data-response='specialaddress' data-response-where='under_tag' <?php if(\dash\data::dataRow_specialaddress() === 'under_tag') {}else{ echo 'data-response-hide';} ?>>
        <div class='mb-5'>
          <label for='tagurl'><?php echo T_('Set post address as sub child of tag') ?></label>
          <select class='select22' name='tagurl' id='tagurl' data-placeholder='<?php echo T_('Select tag') ?>'>
            <option value=''><?php echo T_('Select tag') ?></option>
            <?php foreach (\dash\data::dataRow_tags() as $key => $value) {?>
              <option value='<?php echo $value['term_id'] ?>' <?php if(mb_substr(\dash\data::dataRow_url(), 0, mb_strlen($value['url'])) === $value['url']) { echo 'selected';} ?>><?php echo $value['title']; ?></option>
            <?php } //endif ?>
          </select>
        </div>
      </div>
</form>


<?php if(!$is_homepage && \dash\permission::check('removeSiteBuilderPage')) {?>
  <div class='mt-10'>
    <hr class='mb-5'>
    <div class='fc-red'><?php echo T_('Remove page and all section') ?></div>
    <div class='check1'>
      <input type='checkbox' name='readydelete' id='readydelete'>
      <label for='readydelete'><?php echo T_('Are you sure to remove this page?'); ?></label>
    </div>
    <div data-response='readydelete' data-response-hide>
      <button data-confirm data-data='{"remove":"page"}' data-title='<?php echo T_('Are you sure to remove this page?') ?>' data-msg='<?php echo T_('All section on this page will be removed and can not be restore') ?>' class='btn-outline-danger w-full'><?php echo T_('Remove') ?></button>
    </div>
  </div>
<?php } //endif ?>
