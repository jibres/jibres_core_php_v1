<div class="avand-sm">
  <form method="post" autocomplete="off" >
    <div class="box">
      <div class="body">

        <div class="mB10">
          <div class="input">
            <input type="text" name="title" id="title" placeholder='<?php echo T_("Enter title here"); ?> *' value="<?php echo a(\dash\data::lineList(), 'post_detail', 'title'); ?>"  <?php \dash\layout\autofocus::html() ?> required maxlength='200' minlength="1" pattern=".{1,200}">
          </div>
        </div>


      </div>

      <footer class="txtRa">
        <button class="btn master"><?php echo T_("Edit"); ?></button>
      </footer>

    </div>
  </form>
</div>
