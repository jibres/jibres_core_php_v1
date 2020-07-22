<form method="post" autocomplete="off" >
  <div class="avand-lg">
    <section class="box">
      <header><h2><?php echo T_("General property"); ?></h2></header>
      <div class="body">
        <p>
          <?php echo T_("If the products in this category have similar attributes, you can enter the group and title of the attributes here to enter only the values ​​of each one when completing the product specifications faster."); ?>
        </p>

        <div class="row">
          <div class="c-md-6 c-xs-12 c-sm-12">
            <div class="input">
              <input type="text" name="cat" placeholder="<?php echo T_("Group"); ?>" id="title" maxlength="50" <?php \dash\layout\autofocus::html(); ?>>
            </div>
          </div>
          <div class="c-md-6 c-xs-12 c-sm-12">
            <div class="input">
              <input type="text" name="key" placeholder="<?php echo T_("Type"); ?>" id="title" maxlength="50" value="<?php echo \dash\get::index(\dash\data::dataRow(), 'key'); ?>">
            </div>
          </div>
        </div>
      </div>
      <footer class="txtRa">
        <button class="btn master" name="save_default_property" value="save_default_property"><?php echo T_("Add") ?></button>
      </footer>
    </section>

    <?php if(\dash\data::dataRow_properties() && is_array(\dash\data::dataRow_properties())) {?>
      <table class="tbl1 v5 fs12">
        <thead>
          <th><?php echo T_("Group") ?></th>
          <th><?php echo T_("Type") ?></th>
          <th class="collapsing"></th>
        </thead>
        <tbody>
      <?php foreach (\dash\data::dataRow_properties() as $key => $value) {?>
           <tr>
            <td><?php echo \dash\get::index($value, 'group');?></td>
            <td><?php echo \dash\get::index($value, 'key');?></td>
            <td class="collapsing"><i data-confirm data-data='{"remove":"remove", "index": "<?php echo $key; ?>"}' class="sf-trash fc-red fs14"></i></td>
           </tr>
      <?php } // endfor ?>
        </tbody>
      </table>

    <?php } //endif ?>
  </div>
</form>
