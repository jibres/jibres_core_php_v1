<form method="post" autocomplete="off" id='form1'>
  <div class="row">
    <div class="c-8 c-xs-12 c-sm-12 c-lg-8">
      <section class="box">
        <div class="body">
          <label for="icatname"><?php echo T_("Title"); ?></label>
          <div class="input">
            <input type="text" name="title" id="icatname" placeholder='<?php echo T_("Tag name"); ?>' value="<?php echo \dash\data::dataRow_title(); ?>" <?php \dash\layout\autofocus::html() ?> maxlength='50' minlength="1" required>
          </div>
          <label for="desc"><?php echo T_("Description"); ?></label>
          <textarea  class="txt mB10" id='desc' name="desc" rows="4" placeholder='<?php echo T_("Description"); ?>' maxlength='5000' rows="2"><?php echo \dash\data::dataRow_desc(); ?></textarea>
           <div class="switch1 mT10">
              <input type="checkbox" name="showonwebsite" id="showonwebsite"  <?php if(\dash\data::dataRow_showonwebsite()) {echo 'checked';}?> >
              <label for="showonwebsite" data-on="<?php echo T_("Yes") ?>" data-off="<?php echo T_("No") ?>"></label>
              <label for="showonwebsite"><?php echo T_("Is displayed on the site tags screen?"); ?> <small><a target="_blank" href="<?php echo \lib\store::url(). '/tag'; ?>"><?php echo T_("Show tag page") ?></a></small></label>
            </div>
        </div>
      </section>
      <section class="box">
        <header data-kerkere='.seoData' data-kerkere-icon><h2><?php echo T_("Customize for SEO"); ?></h2></header>
        <div class="body">
          <div class="seoPreview">
            <a target="_blank" href="<?php echo \dash\data::dataRow_url(); ?>">
              <cite><span><?php echo \dash\data::dataRow_url(); ?></span></cite>
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
              <label for="icatslug"><?php echo T_("Slug"); ?> <small><?php echo T_("End part of your tag url."); ?></small></label>
              <div class="input ltr">
                <input type="text" class="ltr" name="slug" id="icatslug" placeholder='<?php echo T_("Tag slug"); ?>' value="<?php echo \dash\data::dataRow_slug(); ?>" maxlength='50' minlength="1">
              </div>
            </div>
            <div>
              <label for='seoDesc'><?php echo T_("SEO Description"); ?> <small><?php echo T_("If leave it empty we are generate it automatically"); ?></small></label>
              <textarea class="txt" name="seodesc" id="seoDesc" maxlength='300' rows='3' placeholder='<?php echo T_("Excerpt used for social media and search engines"); ?>'><?php echo \dash\data::dataRow_seodesc(); ?></textarea>
            </div>
          </div>
        </div>
      </section>

       <section class="box">
        <header><h2><?php echo T_("General property"); ?></h2></header>
        <div class="body">
          <p>
            <?php echo T_("If the products in this tag have similar attributes, you can enter the group and title of the attributes here to enter only the values ​​of each one when completing the product specifications faster."); ?>
          </p>

          <?php if(\dash\data::propertyGroup() && is_array(\dash\data::propertyGroup())) {?>
              <?php foreach (\dash\data::propertyGroup() as $key => $value) {?>
            <div class="msg minimal">
                <span class="txtB fc-black "><?php echo $key ?></span>
                <span><?php echo implode(T_(", "), $value) ?></span>
            </div>
              <?php } // endfor ?>
        <?php } //endif ?>

        </div>
        <footer class="txtRa">
          <a class="btn link" href="<?php echo \dash\url::this(). '/property?id='. \dash\data::dataRow_id(); ?>"><?php echo T_("Set product general property") ?></a>
        </footer>
      </section>

      <section class="hide">
      <div class="pad mB50">
        <label for="productid"><?php echo T_("Choose product to add product to this Tag"); ?></label>
        <div>
          <select name="add_product_id" class="select22" data-model='html'  <?php \dash\layout\autofocus::html() ?> data-default data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::here(). '/sale'; ?>?json=true' data-placeholder='<?php echo T_("Search in products"); ?>'>
              </select>
        </div>
      </div>
      <footer class="f">
        <div class="cauto">
          <a class="btn link" href="<?php echo \dash\url::here(); ?>/products?tagid=<?php echo \dash\data::dataRow_id(); ?>">
              <span class="ltr"><?php echo \dash\fit::number(\dash\data::dataRow_count()) ?></span>
              <?php echo T_("Product founded by this tag"); ?>
            </a>

        </div>
        <div class="c"></div>
        <div class="cauto"><button class="btn master" name="add_product" value="add_product"><?php echo T_("Add"); ?></button></div>

      </footer>
    </section>


    </div>
    <div class="c-xs-12 c-sm-12 c-lg-4">
      <section class="box">
        <header><h2><?php echo T_("Tag image"); ?></h2></header>
        <div class="body2">
          <div data-uploader data-name='file' data-final='#finalImage' data-file-max-size='<?php echo \dash\data::maxFileSize() ?>' <?php if(\dash\data::dataRow_file()) { echo "data-fill";}?>>
            <input type="file" accept="image/jpeg, image/png" id="image1">
            <label for="image1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
            <?php if(\dash\data::dataRow_file()) {?>
              <?php $myExt = substr(\dash\data::dataRow_file(), -3); ?>
              <?php if(in_array($myExt, ['png', 'jpg', 'gif'])) {?>
                <label for="image1"><img id="finalImage" src="<?php echo \dash\data::dataRow_file(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>"></label>
                <span class="imageDel" data-confirm data-data='{"deletefile" : 1}'></span>
              <?php }//endif ?>
            <?php } else {//endif ?>
              <label for="image1"><img id="finalImage" alt="<?php echo \dash\data::dataRow_title(); ?>"></label>
            <?php }//endif ?>
          </div>
        </div>
      </section>


       <section class="box">
          <div class="pad">
            <?php if(!\dash\data::dataRow_count() && !\dash\data::dataRow_have_child()) {?>
            <p><?php echo T_("You can delete this tag because we are not found any product in that."); ?></p>
            <?php }else{ ?>
              <p><?php echo T_("You can delete this tag and merge all product in this tag by another tag."); ?></p>
            <?php }//endif ?>
          </div>
          <footer>
            <?php if(!\dash\data::dataRow_count() && !\dash\data::dataRow_have_child()) {?>
              <div class="txtRa"><span data-confirm data-data='{"delete" : "delete"}' class="btn linkDel" ><?php echo T_("Remove tag"); ?></span></div>
            <?php }else{ ?>
              <div class="txtRa"><a href="<?php echo \dash\url::this(). '/remove?'. \dash\request::fix_get() ?>" class="btn linkDel" ><?php echo T_("Remove tag"); ?></a></div>
            <?php }//endif ?>
          </footer>
        </section>
    <nav class="items long">
      <ul>
          <li>
            <a class="f item" href="<?php echo \dash\url::here(); ?>/products?tagid=<?php echo \dash\data::dataRow_id(); ?>">
              <div class="key"><?php echo T_("Show products by this tag"); ?></div>
              <div class="value"><?php echo \dash\fit::number(\dash\data::dataRow_count()) ?></div>
              <div class="go"></div>
            </a>
          </li>
      </ul>
    </nav>

    </div>
  </div>
</form>
