<?php
$dataRow    = \dash\data::dataRow();
$myFirstURL = '';
$id         = \dash\request::get('id');

$is_policy_page = \lib\app\setting\policy_page::is_policy_page($id);

$type   = \dash\data::dataRow_type();

$myID = '?id='. $id;

$myIcon = 'check';

switch (\dash\data::dataRow_status())
{
  case 'publish' :  $myIcon = 'check ok'; break;
  case 'draft' :    $myIcon = 'detail'; break;
  case 'deleted' :  $myIcon = 'stop nok'; break;
}
?>
<?php if(\dash\data::dataRow_status() === 'draft' && \dash\permission::check('cmsPostPublisher')) {?>
  <div class="msg info2 font-14a mB10-f row" data-space='zero' data-removeElement>
    <div class="c c-xs-12"><?php echo T_("This post is a draft and not published yet. You must publish it if you want it visible to everyone") ?></div>
    <div class="c-auto c-xs-12 txtRa"><a class="link imageDel" data-ajaxify data-data='{"publishnow": "yes"}'><?php echo T_("Publish Now") ?></a></div>
  </div>
<?php } //endif ?>

<?php if(a(\dash\data::dataRow(), 'will_be_published_on_future') || a(\dash\data::dataRow(), 'redirecturl') || $is_policy_page) {?>
  <nav class="items long">
    <ul>
      <?php if(a(\dash\data::dataRow(), 'will_be_published_on_future')) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/publishdate'. \dash\request::full_get();?>">
            <div class="key s0"><?php echo T_("Time left until published") ?></div>
            <div class="value"><?php echo a(\dash\data::dataRow(), 'will_be_published_on_future', 'time_human') ?></div>

            <div class="go detail"></div>
          </a>
        </li>
      <?php } //endif ?>

      <?php if(a(\dash\data::dataRow(), 'redirecturl')) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/redirecturl'. \dash\request::full_get();?>">
            <div class="key"><?php echo T_("This post automatically redirected to new page") ?></div>
            <div class="value s0"><?php echo a(\dash\data::dataRow(), 'redirecturl');?></div>
            <div class="go detail"></div>
          </a>
        </li>
      <?php } //endif ?>

      <?php if($is_policy_page) {?>
        <li>
          <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/setting/legal'; ?>">
            <div class="key"><?php echo T_("You are editing :page", ['page' => '<b>'. a($is_policy_page, 'title'). '</b>']);  ?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } // endif ?>
    </ul>
  </nav>

<?php } //endif ?>


<form method="post" autocomplete="off" id="formEditPost">
  <div class="box">
    <div class="pad">
      <div class="input mB10">
        <input type="text" name="title" id="title" placeholder='<?php echo T_("Enter title here"); ?> *' value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?> required maxlength='200' minlength="1" pattern=".{1,200}">
      </div>
      <div class="postBlock">
        <div class="text">
          <textarea class="txt" data-editor id='descInput' name="html" placeholder='<?php echo T_("Write post "); ?>' maxlength='100000' rows="10"><?php echo \dash\data::dataRow_content(); ?></textarea>
        </div>
      </div>
    </div>
  </div>



      <div class="box">
        <div class="pad">
          <select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple" data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::here(). '/hashtag/api?json=true'; ?>' data-placeholder="<?php echo T_('Enter your tags and seperate them by comma') ?>">
            <?php foreach (\dash\data::dataRow_tags() as $key => $value) {?>
              <option value="<?php echo $value['title']; ?>" selected><?php echo $value['title']; ?></option>
            <?php } //endfor ?>
          </select>
        </div>
      </div>

  </form>

  <?php require_once('display-gallery.php'); ?>

  <div class="box">
    <div class="pad">
      <div class="seoPreview">
        <a target="_blank" href="<?php echo \dash\data::postViewLink(); ?>">
          <cite><?php echo \dash\data::dataRow_link(); ?></cite>
        </a>
        <div class="f">
          <div class="c s12 pLa10">
            <h3><?php echo \dash\data::dataRow_post_title(); ?></h3>
            <p class="desc"><?php echo a($dataRow,'excerpt'); ?></p>
          </div>
          <div class="cauto os s12">
            <img src="<?php echo \dash\url::siftal(); ?>/images/logo/google.png" alt='<?php echo T_("Google"); ?>'>
          </div>
        </div>
      </div>
    </div>
    <footer>
      <div class="row">
        <div class="c-auto"><a class="link" href="<?php echo \dash\url::this(). '/seo'. \dash\request::full_get() ?>"><?php echo T_("Customize SEO") ?></a></div>
        <div class="c"></div>
      </div>
    </footer>
  </div>

  <div class="box font-16">
    <div class="pad">
      <a class="row align-center" href="<?php echo \dash\url::this(). '/analyze'. \dash\request::full_get(); ?>">
        <div class="c c-xs-12 txtB"><?php
echo T_("SEO content analysis of this post is :val.", ['val' => '<b>'. \dash\fit::text(a(\dash\data::dataRow(), 'seorank')). ' '. T_("%"). '</b>']);
if(a(\dash\data::dataRow(), 'seorank') < 90)
{
  echo " ". T_("Look at our tips and improve your SEO.");
}
        ?></div>
        <div class="c-auto c-xs-12 txtC font-30"><?php echo a(\dash\data::dataRow(), 'seo_rank_star'); ?></div>
      </a>
    </div>
  </div>


  <section class="f" data-option='cms-post-share'>
    <div class="c8 s12">
      <div class="data">
        <h3><?php echo T_("Smart Share");?></h3>
        <div class="body">
          <p><?php echo T_("Grow your audience with Smart Share. Keep them engaged. Do it for free.");?></p>
        </div>
      </div>
    </div>
    <div class="c4 s12">
      <div class="action">
        <a href="<?php echo \dash\url::this(). '/share'. $myID; ?>" class="btn secondary"><?php echo T_("Smart Share") ?></a>
      </div>
    </div>
  </section>
