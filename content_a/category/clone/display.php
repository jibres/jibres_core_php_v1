<?php require_once(root. 'content_a/category/categoryName.php') ?>
<div class="avand-md">
  <form method="post" autocomplete="off" >
    <section class="box">
      <div class="body">
       <div class="mb-4">
          <label for='category'><?php echo T_("Clone category property from"); ?></label>
          <select name="clone" id="category" class="select22" data-model="tag" data-ajax--delay="100" data-ajax--url='<?php echo \dash\url::kingdom(). '/a/category/api'; ?>?json=true&getid=1'></select>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Clone") ?></button>
      </footer>
    </section>
  </form>
</div>