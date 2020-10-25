<?php if(\dash\request::get('print')) {?>

   <div class="printArea" data-size='A4'>
      <div class="msg info2 txtL ltr txtB font-12">
      <div class="f">
        <div class="cauto">
          <span><?php echo T_("Answer ID") ?></span>
          <span><code class="compact txtB"><?php echo \dash\request::get('id'). '_'.\dash\request::get('aid'); ?></code></span>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <a class="font-14 p0" href="<?php echo \dash\url::current(). \dash\request::full_get(['print' => null]) ?>"><?php echo T_("Back") ?></a>
        </div>
      </div>


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
<?php }else{ ?>

<div class="row">
   <div class="c-xs-12 c-sm-12 c-md-6">
    <div class="msg info2 txtL ltr txtB font-12">
      <div class="f">
        <div class="cauto">
          <span><?php echo T_("Answer ID") ?></span>
          <span><code class="compact txtB"><?php echo \dash\request::get('id'). '_'.\dash\request::get('aid'); ?></code></span>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <a class="font-14" href="<?php echo \dash\url::current(). \dash\request::full_get(['print' => 1]) ?>"><i class="sf-print"></i></a>
        </div>
      </div>


    </div>
  <table class="tbl1 v6">
    <tbody class="font-12">
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
        <tr>
          <th class=""><?php echo \dash\get::index($value, 'item_title'); ?></th>
          <td class=""><?php echo \dash\get::index($value, 'answer'); ?><?php echo \dash\get::index($value, 'textarea'); ?></td>
        </tr>
<?php } //endif ?>
    </tbody>
  </table>
  </div>
  <?php \dash\utility\pagination::html(); ?>

  <div class="c-xs-12 c-sm-12 c-md-6">

    <form method="post" id="form1">
      <input type="hidden" name="addtag" value="addtag">
      <div class="box">
        <div class="pad">
           <div>
          <div class="row align-center">
            <div class="c"><label for='tag'><?php echo T_("Tag"); ?></label></div>
            <div class="c-auto os"><a class="font-12"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?> href="<?php echo \dash\url::here(). '/form/tag'. \dash\request::full_get() ?>"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
          </div>
          <select name="tag[]" id="tag" class="select22" data-model="tag" multiple="multiple">
            <?php foreach (\dash\data::allTagList() as $key => $value) {?>
              <option value="<?php echo $value['title']; ?>" <?php if(in_array($value['title'], \dash\data::tagsSavedTitle())) { echo 'selected';} ?>><?php echo $value['title']; ?></option>
            <?php } //endfor ?>
          </select>
        </div>
        </div>
        <footer class="txtRa">
          <button class="btn master"><?php echo T_("Save") ?></button>
        </footer>
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
          <div class="cauto hide"><i data-kerkere='.showAttachment' class="sf-attach fs14"></i></div>
          <div class="c"></div>
          <div class="cauto"><button class="btn success"><?php echo T_("Add comment") ?></button></div>
        </footer>
      </div>
    </form>

    <?php if(\dash\data::commentList()) {?>
      <div class="box">
        <header><h2><?php echo T_("Answer comment") ?></h2></header>
        <div class="pad">
          <div class="tblBox">
            <table class="tbl1 v4">
              <thead>
                <tr>
                  <th><?php echo T_("Comment") ?></th>
                  <th class="collapsing"><?php echo T_("Privacy") ?></th>
                  <th class="collapsing"><?php echo T_("Date") ?></th>
                  <th class="collapsing"></th>
                </tr>
              </thead>
              <tbody>

              <?php foreach (\dash\data::commentList() as $key => $value) {?>
                  <tr>
                    <td><?php echo \dash\get::index($value, 'content'); ?></td>
                    <td class="collapsing"><?php echo T_(ucfirst(\dash\get::index($value, 'privacy'))); ?></td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated'));?></td>
                    <td class="collapsing"><div data-confirm data-data='{"removecomment" : "removecomment", "id" : "<?php echo \dash\get::index($value, 'id') ?>"}' class=""><i class="sf-trash fc-red"></i></div></td>
                  </tr>
              <?php } //endfor ?>

              </tbody>
            </table>
          </div>
        </div>

      </div>


  <?php } //endif ?>
  </div>
</div>
<?php } //endif ?>
