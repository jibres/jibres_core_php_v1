<form method="get" autocomplete="off" action="<?php echo \dash\url::current(); ?>">
  <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
  <input type="hidden" name="fid" value="<?php echo \dash\request::get('fid') ?>">
  <div class="box">
    <header><h2><?php echo \dash\data::filterDetail_title() ?></h2></header>
    <div class="body">
      <label for="ititle"><?php echo T_("Question") ?></label>
      <select class="select22" name="field">
        <option value=""><?php echo T_("Please select on item") ?></option>
        <?php foreach (\dash\data::fields() as $key => $value) { if(\dash\get::index($value, 'field') === 'f_answer_id') {continue;}?>
        <option value="<?php echo \dash\get::index($value, 'field') ?>"><?php echo \dash\get::index($value, 'title') ?></option>
      <?php } //endfor ?>
    </select>
  </div>
  <footer class="f">
    <div class="c"></div>
    <div class="cauto"><button class="btn master"><?php echo T_("Next") ?></button></div>
  </footer>
</div>
</form>