<?php foreach (\dash\data::resultAnswer() as $key => $value) {?>
  <div class='printArea pageBreak' data-size='A4' data-height='auto'>
    <table class="tbl1 v6 repeatHead">
      <thead>
        <tr>
          <td colspan="2"><?php echo \dash\data::formDetail_title() ?> <span class="compact txtB"><?php echo \dash\fit::text(\dash\request::get('id')); ?></span></td>
          <td><?php echo T_("Filter ID") ?> <span class="compact txtB"><?php echo \dash\fit::text(\dash\request::get('fid')); ?></span></td>
          <td><?php echo T_("Answer ID") ?> <span class="compact txtB"><?php echo \dash\fit::text($key) ?></span></td>

        </tr>
      </thead>
      <tbody class="font-12">
        <?php $items = \dash\data::fields(); ?>
        <?php $i=0; foreach ($value as $k => $v) { $extra = in_array($v['item_type'], ['descriptive_answer']); if(isset($items[$v['item_id']]['visible']) && $items[$v['item_id']]['visible']) {}else{continue;} $i++;  ?>
        <?php  if(($i % 2) || ($extra)) { echo '<tr>';} ?>

        <th <?php if($extra) { echo 'colspan=""'; }else{echo 'class="w25p"'; } ?>><?php echo \dash\get::index($v, 'item_title'); ?></th>
        <td <?php if($extra) { echo 'colspan="3"'; }else{echo 'class="w25p"'; } ?>><?php echo \dash\get::index($v, 'answer'); ?><?php echo \dash\get::index($v, 'textarea'); ?></td>
        <?php  if(!($i % 2) || ($extra)) { echo '</tr>'; } ?>
      <?php } //endif ?>
    </tbody>
  </table>
</div>
<div class=""></div>
<?php } //endif ?>

<?php \dash\utility\pagination::html() ?>



<div class="avand-lg p0">

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