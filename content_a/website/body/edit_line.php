<form method="post" class="box" autocomplete="off" action="<?php echo \dash\url::that(). '/edit'; ?>">

  <header data-kerkere='.showManageLine' data-kerkere-icon><h2><?php echo T_("Manage this line") ?></h2></header>
  <div class="showManageLine" data-kerkere-content='hide'>

    <input type="hidden" name="key" value="<?php echo \dash\request::get('key'); ?>">

    <div class="body">

     <div class="switch1 mB5">
        <input type="checkbox" name="publish" id="publish" <?php if(\dash\get::index(\dash\data::lineSetting(), 'saved_detail', 'publish')) {echo 'checked';} ?>>
        <label for="publish"></label>
        <label for="publish"><?php echo T_("Publish on website?"); ?><small></small></label>
      </div>


      <label for="title"><?php echo T_("Line title"); ?></label>
      <div class="input">
        <input type="text" name="title" id="title" value="<?php echo \dash\get::index(\dash\data::lineSetting(), 'saved_detail', 'title') ?>"  >
      </div>

      <label for="sort"><?php echo T_("Sort"); ?></label>
      <div class="input">
        <input type="text" name="sort" id="sort" value="<?php echo \dash\get::index(\dash\data::lineSetting(), 'saved_detail', 'sort') ?>"  >
      </div>

    </div>

    <footer class="txtRa">
      <div class="f">
        <div class="cauto">
          <div data-confirm data-data='{"remove": "line"}' class="btn danger"><?php echo T_("Remove"); ?></div>
        </div>
        <div class="c"></div>
        <div class="cauto">
          <button class="btn primary"><?php echo T_("Update"); ?></button>
        </div>
      </div>
    </footer>
  </div>
</form>