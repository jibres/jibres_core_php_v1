<?php require_once(root. 'content_a/form/answer/pageStep.php') ?>
<?php   htmlSearchBox(); ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <?php
    if(\dash\data::dataTable())
    {
      if(\dash\data::isFiltered())
      {
        htmlTable();
        htmlFilter();
      }
      else
      {
        htmlTable();
      }
    }
    else
    {
      if(\dash\data::isFiltered())
      {
        htmlFilter();
      }
    }
    ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">

    <form method="post" id="form1">
      <input type="hidden" name="addtag" value="addtag">
      <div class="box">
        <div class="pad">
           <div>
          <div class="row align-center">
            <div class="c"><label for='tag'><?php echo T_("Tag"); ?></label></div>
            <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(); ?>/form/tag"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
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

       <form method="post" autocomplete="off">
      <div class="box">
        <header><h2><?php echo T_("Add comment to this answer") ?></h2></header>
        <div class="body padLess">
          <input type="hidden" name="formcomment" value="formcomment">
          <div class="mB20">
            <textarea id="comment" name="comment" class="txt" rows="3"></textarea>
          </div>
          <div class="row">
            <div class="c-xs-6 c-sm-6">
              <div class="radio3">
                <input type="radio" name="privacy" value="public" checked id="privacypublic">
                <label for="privacypublic"><?php echo T_("Public") ?></label>
              </div>
            </div>
            <div class="c-xs-6 c-sm-6">
              <div class="radio3">
                <input type="radio" name="privacy" value="private" id="privacyprivate">
                <label for="privacyprivate"><?php echo T_("Private") ?></label>
              </div>
            </div>
          </div>
          <div class="showAttachment" data-kerkere-content='hide'>
            <div class="box" data-uploader data-name='file'>
              <input type="file"  id="file1">
              <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
            </div>
          </div>
        </div>
        <footer class="f">
          <div class="cauto"><i data-kerkere='.showAttachment' class="sf-attach fs14"></i></div>
          <div class="c"></div>
          <div class="cauto"><button class="btn success"><?php echo T_("Add comment") ?></button></div>
        </footer>
      </div>
    </form>

    <h3 class="hide"><?php echo T_("Answer comment") ?></h3>
    <nav class="items">
      <ul>
        <?php foreach (\dash\data::commentList() as $key => $value) {?>
          <li>
            <a class="f">
              <div class="key"><?php echo \dash\get::index($value, 'content'); ?></div>
              <div class="value"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated'));?></div>
            </a>
          </li>
        <?php } //endfor ?>
      </ul>
    </nav>

  </div>
</div>

<?php function htmlSearchBox() {?>
  <div class="cbox fs12 p0">
    <form method="get" action='<?php echo \dash\url::current(); ?>'>
      <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
      <input type="hidden" name="aid" value="<?php echo \dash\request::get('aid') ?>">
      <div class="input">
        <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>
        <button class="addon btn "><i class="sf-search"></i></button>
        <div class="addon hide btn" data-confirm data-data='{"remove": "answer", "id": "<?php echo \dash\request::get('aid'); ?>"}'><i class="sf-trash fc-red fs14"></i></div>
      </div>
    </form>
  </div>
<?php } //endfunction ?>


<?php function htmlTable() {?>
  <div class="printArea" data-size='A4'>
    <div class="msg info2 txtL ltr txtB">
      <span><?php echo T_("Answer ID") ?></span>
      <span><code class="compact txtB"><?php echo \dash\request::get('id'). '_'.\dash\request::get('aid'); ?></code></span>
     </div>
  <table class="tbl1 v6">
    <tbody class="font-12">
<?php $i=0; foreach (\dash\data::dataTable() as $key => $value) { $i++;  ?>
      <?php  if($i % 2) { ?>
        <tr>
      <?php } //endif ?>
          <th class=""><?php echo \dash\get::index($value, 'item_title'); ?></th>
          <td class=""><?php echo \dash\get::index($value, 'answer'); ?><?php echo \dash\get::index($value, 'textarea'); ?></td>
      <?php  if(!($i % 2)) { ?>
        </tr>
      <?php } //endif ?>
<?php } //endif ?>
    </tbody>
  </table>
  </div>
  <?php \dash\utility\pagination::html(); ?>
<?php } //endif ?>

<?php function htmlFilter() {?>
  <p class="f fs14 msg info2">
    <span class="c"><?php echo \dash\data::filterBox(); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&aid='. \dash\request::get('aid'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>

<?php function htmlFilterNoResult() {?>
  <p class="f fs14 msg warn2">
    <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
    <a class="cauto" href="<?php echo \dash\url::current(). '?id='. \dash\request::get('id'). '&aid='. \dash\request::get('aid'); ?>"><?php echo T_("Clear filters"); ?></a>
  </p>
<?php } //endif ?>