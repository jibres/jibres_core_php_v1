<?php

$editMode     = \dash\data::editMode();
$addChildMode = \dash\data::addChildMode();


?>

<div class="avand-md">
  <form method="post" class="box" autocomplete="off">
    <header><h2><?php echo \dash\face::title() ?></h2></header>
      <div class="body">
        <label for="title"><?php echo T_("Title"); ?></label>
        <div class="input">
          <input type="text" name="title" id="title" value="<?php echo \dash\data::dataRow_title() ?>" maxlength="50" required <?php \dash\layout\autofocus::html() ?>>
        </div>

        <div class="mB10">
          <label for="pointer"><?php echo T_("Hint to") ?></label>
          <select name="pointer" class="select22">
            <option value=""><?php echo T_("Please select an item") ?></option>
            <option value="homepage" <?php if(\dash\data::dataRow_pointer() === 'homepage') {echo 'selected';} ?>><?php echo T_("Home page") ?></option>
            <option value="products" <?php if(\dash\data::dataRow_pointer() === 'products') {echo 'selected';} ?>><?php echo T_("Products") ?></option>
            <option value="posts" <?php if(\dash\data::dataRow_pointer() === 'posts') {echo 'selected';} ?>><?php echo T_("Posts") ?></option>
            <option value="tags" <?php if(\dash\data::dataRow_pointer() === 'tags') {echo 'selected';} ?>><?php echo T_("Tag of posts") ?></option>
            <option value="hashtag" <?php if(\dash\data::dataRow_pointer() === 'hashtag') {echo 'selected';} ?>><?php echo T_("Hashtag of products") ?></option>
            <option value="socialnetwork" <?php if(\dash\data::dataRow_pointer() === 'socialnetwork') {echo 'selected';} ?>><?php echo T_("Social network") ?></option>
            <option value="other" <?php if(\dash\data::dataRow_pointer() === 'other') {echo 'selected';} ?>><?php echo T_("Something else") ?></option>
          </select>
        </div>

       <div data-response='pointer' data-response-where='products' <?php if(\dash\data::dataRow_pointer() === 'products'){}else{ echo 'data-response-hide';} ?>>
          <select name="product_id" class="select22" id="productSearch"  data-model='html'  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::here(). '/products/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Search in product"); ?>'>
            <?php if(\dash\data::dataRow_related_id()) {?>
              <option value="<?php echo \dash\data::dataRow_related_id() ?>" selected><?php echo \dash\data::productTitle() ?></option>
            <?php } //endif ?>
            </select>
        </div>


       <div data-response='pointer' data-response-where='posts' <?php if(\dash\data::dataRow_pointer() === 'posts'){}else{ echo 'data-response-hide';} ?>>
          <select name="post_id" class="select22" id="postSearch"  data-model='html'  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::kingdom(). '/cms/posts/api'; ?>?json=true' data-shortkey-search data-placeholder='<?php echo T_("Search in posts"); ?>'>
            <?php if(\dash\data::dataRow_related_id()) {?>
              <option value="<?php echo \dash\coding::encode(\dash\data::dataRow_related_id()) ?>" selected><?php echo \dash\data::postTitle() ?></option>
            <?php } //endif ?>
            </select>
        </div>


       <div data-response='pointer' data-response-where='tags' <?php if(\dash\data::dataRow_pointer() === 'tags'){}else{ echo 'data-response-hide';} ?>>
          <select name="tag_id" class="select22" id="tagSearch"  data-model='html'  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::kingdom(). '/cms/tag/api'; ?>?json=true&getid=1' data-shortkey-search data-placeholder='<?php echo T_("Search in tags"); ?>'>
            <?php if(\dash\data::dataRow_related_id()) {?>
              <option value="<?php echo \dash\coding::encode(\dash\data::dataRow_related_id()) ?>" selected><?php echo \dash\data::tagTitle() ?></option>
            <?php } //endif ?>
            </select>
        </div>

        <div data-response='pointer' data-response-where='hashtag' <?php if(\dash\data::dataRow_pointer() === 'hashtag'){}else{ echo 'data-response-hide';} ?>>
          <select name="hashtag_id" class="select22" id="hashtagSearch"  data-model='html'  data-ajax--delay="250" data-ajax--url='<?php echo \dash\url::kingdom(). '/a/tag/api'; ?>?json=true&getid=1' data-shortkey-search data-placeholder='<?php echo T_("Search in hashtag"); ?>'>
            <?php if(\dash\data::dataRow_related_id()) {?>
              <option value="<?php echo \dash\data::dataRow_related_id() ?>" selected><?php echo \dash\data::hashtagTitle() ?></option>
            <?php } //endif ?>
            </select>
        </div>

        <div data-response='pointer' data-response-where='socialnetwork' <?php if(\dash\data::dataRow_pointer() === 'socialnetwork'){}else{ echo 'data-response-hide';} ?>>
          <?php $social = \lib\store::social(); if(!is_array($social)){ $social = []; } ?>
          <select name="socialnetwork" class="select22">
            <option value=""><?php echo T_("Select social network") ?></option>
            <?php foreach ($social as $key => $value) {?>
              <option value="<?php echo $key ?>" <?php if(\dash\data::dataRow_socialnetwork() === $key) {echo 'selected';} ?>><?php echo T_(ucfirst($key)); ?></option>
            <?php } //endfor ?>
          </select>
          <a class="btn link" href="<?php echo \dash\url::kingdom(). '/a/setting/social' ?>"><?php echo T_("Manage social network") ?></a>
        </div>


        <div data-response='pointer' data-response-where='other' <?php if(\dash\data::dataRow_pointer() === 'other'){}else{ echo 'data-response-hide';} ?>>
          <label for="url"><?php echo T_("Url"); ?></label>
          <div class="input ltr">
            <input type="text" name="url" id="url" value="<?php echo \dash\data::dataRow_url(); ?>" >
          </div>
          <div class="switch1 mB5">
            <input type="checkbox" name="target" id="target" <?php if(\dash\data::dataRow_target()) { echo 'checked';} ?>>
            <label for="target"></label>
            <label for="target"><?php echo T_("Open in New tab"); ?><small></small></label>
          </div>
        </div>

    </div>
    <footer>
      <div class="row">
        <div class="c-auto"><?php if($editMode){ ?><div class="btn linkDel" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove") ?></div><?php } //endif ?></div>
        <div class="c"></div>
        <div class="c-auto"><button class="btn <?php if($editMode) { echo 'primary'; }else{ echo 'success';} ?>"><?php if($editMode) { echo T_("Edit");}else{ echo T_("Add");} ?></button></div>
       </div>
    </footer>
  </form>
</div>