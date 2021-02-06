<?php require_once(root. 'content_cms/posts/postDetail.php'); ?>
<?php
$dataRow = \dash\data::dataRow();
$myFirstURL = '';
?>
<div class="avand-sm zero">
  <form method="post" autocomplete="off" id="formPublishdate">
    <div class="box">
      <div class="pad">
        <p><?php echo T_("A website redirect points your old URL to a new page. When anyone types in or clicks on that original URL they’ll be taken to the page you set the redirect up to instead. It ensures visitors don’t end up on a 404 page and instead find something relevant to what they were originally looking for.") ?></p>
        <p><?php echo T_("If you want your post to be automatically redirected to a new page, enter the URL of the new page here."); ?></p>
        <label for="redirecturl"><?php echo T_("Redirect URL") ?></label>
        <div class="input">
          <input type="url" name="redirecturl"  value="<?php echo a(\dash\data::dataRow(), 'redirecturl'); ?>" id="redirecturl" placeholder="https://somewhere.com">
        </div>
      </div>
      <footer class="f">
        <div class="cauto">
          <?php if(a(\dash\data::dataRow(), 'redirecturl')) {?>
            <a href="<?php echo a(\dash\data::dataRow(), 'redirecturl') ?>" target='_blank' class='btn link'><?php echo T_("Visit link") ?></a>
          <?php } //endif ?>

        </div>
        <div class=""></div>
        <div class="cauto">
          <button class="btn master"><?php echo T_("Save") ?></button>
        </div>
      </footer>
    </div>
  </form>
</div>