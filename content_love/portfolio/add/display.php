
<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">


        <label><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title"  value="<?php echo \dash\data::dataRow_title(); ?>" >
        </div>

        <label><?php echo T_("Industry"); ?></label>
        <div class="input">
          <input type="text" name="industry"  value="<?php echo \dash\data::dataRow_industry(); ?>" >
        </div>

        <label><?php echo T_("Description"); ?></label>
        <textarea class="txt" rows="3" data-placeholder='<?php echo T_("Title") ?>'  name="html"><?php echo \dash\data::dataRow_title(); ?></textarea>

        <label><?php echo T_("Sort"); ?></label>
        <div class="input">
          <input type="tel" name="sort"  value="<?php echo \dash\data::dataRow_sort(); ?>" >
        </div>

        <label><?php echo T_("URL"); ?></label>
        <div class="input">
          <input type="url" name="url" value="<?php echo \dash\data::dataRow_url(); ?>">
        </div>

        <label><?php echo T_("Tag"); ?></label>
        <select name="tag[]" id="tag" class="select22 mb-4" data-model="tag" multiple="multiple">
          <?php foreach (\dash\data::listPortfolioTag() as $key => $value) {?>
            <option value="<?php echo $value; ?>" <?php if(is_array(\dash\data::currentTag()) && in_array($value, \dash\data::currentTag())) {echo 'selected'; } ?>><?php echo $value; ?></option>
          <?php } //endfor ?>
        </select>


      </div>
      <footer>
        <div class="row">
          <div class="c-auto">
            <?php if(\dash\data::editMode()) {?>
              <div class="btn-outline-danger" data-confirm data-data='{"remove":"remove"}'><?php echo T_("Remove") ?></div>
            <?php } //endif ?>
          </div>
          <div class="c"></div>
          <div class="c-auto">
            <?php if(\dash\data::editMode()) {?>
              <button class="btn-primary"><?php echo T_("Edit") ?></button>
            <?php }else{ ?>
              <button class="btn-success"><?php echo T_("Add") ?></button>
            <?php } //endif ?>
          </div>

        </div>
      </footer>
    </div>
  </form>
</div>

