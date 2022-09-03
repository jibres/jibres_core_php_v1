<form method="get" autocomplete="off" action="<?php echo \dash\url::current(); ?>">
  <input type="hidden" name="id" value="<?php echo \dash\request::get('id') ?>">
  <input type="hidden" name="fid" value="<?php echo \dash\request::get('fid') ?>">
  <div class="box">
    <header><h2><?php echo \dash\data::filterDetail_title() ?></h2></header>
    <div class="body">
        <div><?php echo T_("Add condition based on"); ?></div>
        <div class="row">
            <div class="c-xs-12 c-sm-6">
                <div class="radio3">
                    <input type="radio" name="tq" value="question" id="tqquestion" checked>
                    <label for="tqquestion"><?php echo T_("Question"); ?></label>
                </div>
            </div>
            <div class="c-xs-12 c-sm-6">
                <div class="radio3">
                    <input type="radio" name="tq" value="tag" id="tqtag">
                    <label for="tqtag"><?php echo T_("Tag"); ?></label>
                </div>
            </div>
        </div>

        <div data-response="tq"  data-response-effect="slide" data-response-where="question">
            <label for="ititle"><?php echo T_("Question") ?></label>
            <select class="select22" name="field" id="ititle">
                <option value=""><?php echo T_("Please select on item") ?></option>
				<?php foreach (\dash\data::fields() as $key => $value) {
					if (a($value, 'field') === 'f_answer_id') {
						continue;
					} ?>
                    <option value="<?php echo a($value, 'field') ?>"><?php echo a($value, 'title'); ?></option>
				<?php } //endfor ?>
            </select>
        </div>
        <div data-response="tq"  data-response-effect="slide" data-response-where="tag" data-response-hide>
            <div class="row align-center">
                <div class="c"><label for='tag'><?php echo T_("Tag"); ?></label></div>
                <div class="c-auto os"><a class="text-sm"<?php if(!\dash\detect\device::detectPWA()) { echo " target='_blank' ";} ?>href="<?php echo \dash\url::here(). '/form/tag'. \dash\request::full_get() ?>"><?php echo T_("Manage"); ?> <i class="sf-link-external"></i></a></div>
            </div>
            <select name="tag" id="tag" class="select22" data-model="tag" data-placeholder="<?php echo T_("Enter new tag or select one tag") ?>">
                <option value="" readonly></option>
				<?php foreach (\dash\data::allTagList() as $key => $value) {?>
                    <option value="<?php echo $value['title']; ?>"><?php echo $value['title']; ?></option>
				<?php } //endfor ?>
            </select>
            <div class="row mt-2">
                <div class="c-xs-12 c-sm-6">
                    <div class="radio3">
                        <input type="radio" name="wtg" value="with" id="withtag" checked>
                        <label for="withtag"><?php echo T_("Answer with this tag"); ?></label>
                    </div>
                </div>
                <div class="c-xs-12 c-sm-6">
                    <div class="radio3">
                        <input type="radio" name="wtg" value="without" id="witouttag" >
                        <label for="witouttag"><?php echo T_("Answer without this tag"); ?></label>
                    </div>
                </div>
            </div>
        </div>

  </div>
  <footer class="f">
    <div class="c"></div>
    <div class="cauto"><button class="btn master"><?php echo T_("Next") ?></button></div>
  </footer>
</div>
</form>