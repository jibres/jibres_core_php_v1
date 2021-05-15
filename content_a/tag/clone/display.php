<?php require_once(root. 'content_a/tag/tagName.php') ?>
<div class="avand-md">
  <form method="post" autocomplete="off" >
    <section class="box">
      <div class="body">
       <div class="mB20">
              <label for='tag'><?php echo T_("Clone tag property from"); ?></label>
            <select name="clone" id="tag" class="select22" data-model="tag" >
              <option value=""></option>
              <?php foreach (\dash\data::listProductTag() as $key => $value) {?>
                <option value="<?php echo $value['id']; ?>"><?php echo $value['title']; ?></option>
              <?php } //endfor ?>
            </select>
          </div>
      </div>
      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Clone") ?></button>
      </footer>
    </section>
  </form>
</div>