<div class="avand-lg">
  <form method="post" autocomplete="off">
    <div class="box">
      <header><h2><?php echo T_("Route static file verification");?></h2></header>
      <div class="pad">
        <p>
          <?php echo T_("You can set some file to route in your domain") ?>
        </p>
        <div class="row align-end">
          <div class="c-xs-12 c">
            <label for="filename"><?php echo T_("File name"); ?> <span class="fc-red">* <?php echo T_("Required") ?></span></label>
            <div class="input mB0-f ltr">
              <input placeholder="For example: 123456.html" type="text" name="filename" id="filename" <?php \dash\layout\autofocus::html() ?> required maxlength='50' minlength="1" >
            </div>
          </div>
          <div class="c-xs-12 c">
            <label for="filecontent"><?php echo T_("file content"); ?> <span class="fc-red">* <?php echo T_("Required") ?></span></label>
            <div class="input mB0-f ltr">
              <input type="text" name="filecontent" id="filecontent" <?php \dash\layout\autofocus::html() ?> maxlength='200' minlength="1"  >
            </div>

          </div>
          <div class="c-xs-12 c-auto">
            <button  class="btn master" ><?php echo T_("Add"); ?></button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <?php if(\dash\data::fileList()) {?>
    <table class="tbl1 v1">
      <thead>
        <tr>
          <th><?php echo T_("File name") ?></th>
          <th><?php echo T_("File content") ?></th>
          <th class="collapsing"><?php echo T_("Remove") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach (\dash\data::fileList() as $key => $value) {?>
          <tr>
            <td><a target="_blank" href="<?php echo \lib\store::url(). '/'. $key; ?>"><i class="sf-link-external compact"></i> </a><?php echo $key; ?></td>
            <td><?php echo $value; ?></td>
            <td><div class="btn linkDel" data-confirm data-data='{"remove": "file", "name": "<?php echo $key; ?>", "content" : "<?php echo $value; ?>"}'><i class="sf-trash fc-red fs14"></i></div></td>
          </tr>
        <?php } //endfor ?>
      </tbody>
    </table>
  <?php } // endif ?>
</div>


