



<form method="post" autocomplete="off" id='form1'>
  <div class="row">
    <div class="c-8 c-xs-12 c-sm-12 c-lg-8">
      <section class="box">
        <div class="body">

          <label for="icatname"><?php echo T_("Title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="icatname" placeholder='<?php echo T_("Category name"); ?>' value="<?php echo \dash\data::dataRow_title(); ?>" autofocus maxlength='50' minlength="1" required>
          </div>

          <?php if(\dash\data::dataRow_parent1() || \dash\data::parentList()) {?>

            <div class="mB10">
              <label for='parent'><?php echo T_("as child of"); ?>
              <?php if(\dash\data::dataRow_have_child()) {?> <small class="fc-mute"><?php echo T_("This category have some child and you can not change parent of it"); ?></small> <?php } //endif ?></label>
              <select name="parent" id="parent" class="select22" data-placeholder='<?php echo T_("Select category parent"); ?>' <?php if(\dash\data::dataRow_have_child()) {?> disabled <?php }//endif ?>>
                <option></option>

                <?php if(\dash\data::dataRow_parent1()) {?>
                  <option value="0"><?php echo T_("Without category"); ?></option>
                <?php } //endif ?>

                <?php foreach (\dash\data::parentList() as $key => $value) {?>

                  <option value="<?php echo \dash\get::index($value, 'id'); ?>" <?php if(isset($value['id']) && $value['id'] == \dash\data::dataRow_last_parent()) { echo 'selected'; } ?>><?php echo \dash\get::index($value, 'full_title'); ?></option>
                <?php }//endfor ?>

              </select>
            </div>
          <?php } //endif ?>

          <label for="desc"><?php echo T_("Description"); ?></label>
          <textarea data-editor  class="txt mB10" id='desc' name="desc" placeholder='<?php echo T_("Description"); ?>' maxlength='5000' rows="2"><?php echo \dash\data::dataRow_desc(); ?></textarea>

        </div>
      </section>



      <section class="box">
        <header><h2><?php echo T_("Category property"); ?></h2></header>
        <div class="body">


          <p class="msg"><?php echo T_("You can create a specification table for a product in this category. You can add group and title of product specification and we are showing them inside product in this category"); ?></p>

          <?php if(\dash\data::parentProperty() && is_array(\dash\data::parentProperty())) {?>
            <?php foreach (\dash\data::parentProperty() as $key => $value) {?>
              <div class="msg">
                <?php echo \dash\get::index($value, 'title'); ?>
                <?php if(is_array(\dash\get::index($value, 'properties'))) {?>
                  <?php foreach (\dash\get::index($value, 'properties') as $k => $v) {?>
                    <span class="btn"><?php echo \dash\get::index($v, 'group'); ?></span>
                    <?php if(is_array(\dash\get::index($v, 'key'))) {?>
                      <?php foreach (\dash\get::index($v, 'key') as $kk => $vv) {?>
                        <span class="badge"><?php echo $vv; ?></span>
                      <?php } //endfor ?>
                    <?php } //endif ?>
                  <?php } //endfor ?>
                <?php } //endif ?>
              </div>
            <?php } //endfor ?>
          <?php } //endif ?>

          <?php
          if(\dash\data::dataRow_properties() && is_array(\dash\data::dataRow_properties()))
          {
            foreach (\dash\data::dataRow_properties() as $key => $value)
            {
              $rand_key = rand(1, 999);
              htmlProperty($rand_key, $value);
            }
          }

          if(\dash\data::countFree() && is_numeric(\dash\data::countFree()))
          {
            for ($i=1; $i <= \dash\data::countFree(); $i++)
            {
              $rand_key = rand(1, 999);
              htmlProperty($rand_key);
            }
          }
          ?>


        </div>
      </section>


      <section class="box">
        <header data-kerkere='.seoData' data-kerkere-icon><h2><?php echo T_("Customize for SEO"); ?></h2></header>
        <div class="body">

          <div class="seoPreview">
            <a target="_blank" href="<?php echo \dash\data::categoryUrl(); ?>">
              <cite><span><?php echo \dash\url::kingdom(); ?>/category/</span><?php echo \dash\data::dataRow_full_slug(); ?></cite>
            </a>
            <div class="f">
              <div class="c s12 pLa10">
                <h3><?php if(\dash\data::dataRow_seotitle()) { echo \dash\data::dataRow_seotitle(); }else{ echo \dash\data::dataRow_title(); } ?></h3>
                <p class="desc"><?php echo \dash\data::dataRow_seodesc(); ?></p>
              </div>
              <div class="cauto os s12">
                <img src="<?php echo \dash\url::siftal(); ?>/images/logo/google.png" alt='<?php echo T_("Google"); ?>'>
              </div>
            </div>
          </div>

          <div class="seoData" data-kerkere-content='hide'>
            <hr>
            <div>
              <label for='seoTitle'><?php echo T_("SEO Title"); ?> <small><?php echo T_("Recommended being more than 40 character."); ?></small></label>
              <div class="input">
                <input type="text" name="seotitle" id="seoTitle" placeholder='<?php if(!\dash\data::dataRow_seotitle()) { echo \dash\data::dataRow_title(); } ?>' value="<?php echo \dash\data::dataRow_seotitle(); ?>"  maxlength='200' minlength="1" pattern=".{1,200}">
                <label class="addon"> | <?php echo \dash\face::site(); ?></label>
              </div>
            </div>


            <div>
              <label for="icatslug"><?php echo T_("Slug"); ?> <small><?php echo T_("End part of your category url."); ?></small></label>
              <div class="input ltr">
                <input type="text" class="ltr" name="slug" id="icatslug" placeholder='<?php echo T_("Category slug"); ?>' value="<?php echo \dash\data::dataRow_slug(); ?>" maxlength='50' minlength="1">
              </div>
            </div>

            <div>
              <label for='seoDesc'><?php echo T_("SEO Description"); ?> <small><?php echo T_("If leave it empty we are generate it automatically"); ?></small></label>
              <textarea class="txt" name="seodesc" id="seoDesc" maxlength='300' rows='3' placeholder='<?php echo T_("Excerpt used for social media and search engines"); ?>'><?php echo \dash\data::dataRow_seodesc(); ?></textarea>
            </div>
          </div>

        </div>
      </section>



    </div>

    <div class="c-4">


      <section class="jbox">
        <header><h2><?php echo T_("Category image"); ?></h2> <?php if(\dash\data::dataRow_file()) {?> <span data-confirm data-data='{"deletefile" : 1}' class="btn link danger floatL"><?php echo T_("Delete file"); ?></span> <?php } // endif ?></header>
        <div class="pad">

          <?php if(\dash\data::dataRow_file()) {?>

            <div class="mediaBox mB20">
              <?php $myExt = substr(\dash\data::dataRow_file(), -3); ?>


              <?php if(in_array($myExt, ['png', 'jpg', 'gif'])) {?>
                <img id="finalImage" src="<?php echo \dash\data::dataRow_file(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>">
              <?php }//endif ?>

            </div>


          <?php }//endif ?>



          <div class="box" data-uploader data-name='file' data-final='#finalImage' >
            <input type="file" accept="image/jpeg, image/png" id="image1">
            <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
          </div>


        </div>
      </section>





      <?php if(!\dash\data::dataRow_count() && !\dash\data::dataRow_have_child()) {?>
        <section class="jbox">
          <header><h2><?php echo T_("Remove category"); ?></h2></header>
          <div class="pad">


            <p><?php echo T_("No product found by this category."); ?>
            <?php echo T_("Your can remove this category"); ?> <span data-confirm data-data='{"delete" : "delete"}' class="btn danger block" ><?php echo T_("Remove category"); ?></span>
          </p>

        </div>
      </section>
    <?php }//endif ?>



  </div>
</div>
</form>














<?php function htmlProperty($key = null, $value = []) {?>

  <div class="row padLess">
    <div class="c-xs-12 c-sm-5 mB10">
      <div class="input">
        <input type="text" name="property_group_<?php echo $key; ?>" placeholder='<?php echo T_("Specification Group"); ?>' value="<?php echo \dash\get::index($value, 'group'); ?>">
      </div>
    </div>

    <div class="c-xs-12 c-sm-7 mB10">
      <div>
        <select name="property_key_<?php echo $key ?>[]"  class="select22" data-model="tag" multiple="multiple" data-placeholder='<?php echo T_("Specification Title"); ?>'>
          <?php if(is_array(\dash\get::index($value, 'key'))) { foreach (\dash\get::index($value, 'key') as $tag) {?>
            <option value="<?php echo $tag; ?>" selected><?php echo $tag; ?></option>
          <?php } } //endfor //endif  ?>
        </select>
      </div>
    </div>
  </div>


<?php } //endif ?>
