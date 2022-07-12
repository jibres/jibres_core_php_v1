
<div class="avand-md">
  <form method="post" autocomplete="off">
    <div class="box">
      <div class="pad">


        <label><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title"  value="<?php echo \dash\data::dataRow_title(); ?>" >
        </div>


        <label><?php echo T_("Business"); ?></label>
        <select name="store_id" class="select22"  data-model='html'  data-ajax--url='<?php echo \dash\url::here(); ?>/store/api?json=true' data-shortkey-search data-placeholder='<?php echo T_("Choose Business"); ?>'>
          <?php if(\dash\data::dataRow_store_id()) {?>
            <option value="<?php echo \dash\data::dataRow_store_id() ?>" selected><?php echo \dash\data::selectedStoreTitle(); ?></option>
          <?php } //endif ?>
            </select>


        <label><?php echo T_("URL"); ?></label>
        <div class="input">
          <input type="url" name="url" value="<?php echo \dash\data::dataRow_url(); ?>">
        </div>

        <label><?php echo T_("Industry"); ?></label>
        <select class="select22" name="industry">
          <option value=""></option>
          <?php
          foreach (\lib\app\store\check::industry_list() as $key => $value)
          {
            echo '<option value="'. $key. '"';
            if(\dash\data::dataRow_industry() === $key)
            {
              echo ' selected';
            }
            echo '>'. $value . '</option>';
          }
          ?>
        </select>



        <label><?php echo T_("Sort"); ?></label>
        <div class="input">
          <input type="tel" name="sort"  value="<?php echo \dash\data::dataRow_sort(); ?>" >
        </div>


        <label><?php echo T_("Language"); ?></label>
        <select class="select22" name="language">
          <?php
          foreach (\dash\language::all(true) as $key => $value)
          {
            echo '<option value="'. $key. '"';
            if(\dash\data::dataRow_language() === $key)
            {
              echo ' selected';
            }
            echo '>'. $value . '</option>';
          }
          ?>
        </select>

        <label><?php echo T_("Description"); ?></label>
        <textarea class="txt" rows="3" data-placeholder='<?php echo T_("Title") ?>'  name="desc"><?php echo \dash\data::dataRow_desc(); ?></textarea>



        <label><?php echo T_("Tag"); ?></label>
        <select name="tag[]" id="tag" class="select22 mb-4" data-model="tag" multiple="multiple">
          <?php foreach (\dash\data::listPortfolioTag() as $key => $value) {?>
            <option value="<?php echo $value; ?>" <?php if(is_array(\dash\data::currentTag()) && in_array($value, \dash\data::currentTag())) {echo 'selected'; } ?>><?php echo $value; ?></option>
          <?php } //endfor ?>
        </select>

        <label><?php echo T_("Status"); ?></label>
        <select class="select22" name="status">
          <?php
          foreach (['request','accept','reject','delete'] as $key => $value)
          {
            echo '<option value="'. $value. '"';
            if(\dash\data::dataRow_status() === $value)
            {
              echo ' selected';
            }
            echo '>'. T_($value) . '</option>';
          }
          ?>
        </select>

        <?php if(false) { ?>

          <lable><?php echo T_("Thumb"); ?></lable>
          <div class="body2">
            <div data-uploader data-name='thumb' data-final='#finalImage' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php if(\dash\data::dataRow_thumb()) { echo "data-fill";}?>>
              <input type="file" accept="image/jpeg, image/png" id="image1">
              <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
              <?php if(\dash\data::dataRow_thumb()) {?>
                <?php $myExt = substr(\dash\data::dataRow_thumb(), -3); ?>
                <?php if(in_array($myExt, ['png', 'jpg', 'gif'])) {?>
                  <label for="image1"><img id="finalImage" src="<?php echo \dash\data::dataRow_thumb(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>"></label>
                  <span class="imageDel" data-confirm data-data='{"deletefile" : "thumb"}'></span>
                <?php }//endif ?>
              <?php } else {//endif ?>
                <label for="image1"><img id="finalImage" alt="<?php echo \dash\data::dataRow_title(); ?>"></label>
              <?php }//endif ?>
            </div>
          </div>



          <lable><?php echo T_("Image"); ?></lable>
          <div class="body2">
            <div data-uploader data-name='image' data-final='#finalImage2' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php if(\dash\data::dataRow_image()) { echo "data-fill";}?>>
              <input type="file" accept="image/jpeg, image/png" id="image2">
              <label for="image2"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
              <?php if(\dash\data::dataRow_image()) {?>
                <?php $myExt = substr(\dash\data::dataRow_image(), -3); ?>
                <?php if(in_array($myExt, ['png', 'jpg', 'gif'])) {?>
                  <label for="image2"><img id="finalImage2" src="<?php echo \dash\data::dataRow_image(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>"></label>
                  <span class="imageDel" data-confirm data-data='{"deletefile" : "image"}'></span>
                <?php }//endif ?>
              <?php } else {//endif ?>
                <label for="image2"><img id="finalImage2" alt="<?php echo \dash\data::dataRow_title(); ?>"></label>
              <?php }//endif ?>
            </div>
          </div>


        <?php } // endif ?>


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

