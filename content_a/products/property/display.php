<?php
$propertyList   = \dash\data::propertyList();
$storData       = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();

?>
  <div class="avand-xl">
    <section class="box">
      <form method="post" autocomplete="off" id="form1">
        <input type="hidden" name="addmode" value="1">
      <header><h2><?php echo T_("Property"); ?></h2></header>
      <div class="body">
        <p class="msg"><?php echo T_("Set product property"); ?></p>
        <div class="row">
          <div class="c-4">
            <?php if(!\dash\data::catList()) {?>
              <div class="input">
                <input type="text" name="cat" placeholder="<?php echo T_("Group"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index(\dash\data::dataRow(), 'cat'); ?>">
              </div>
            <?php }else{ ?>
              <div>
                <select name="cat" class="select22" data-model='tag' data-placeholder="<?php echo T_("Group"); ?>" >
                  <option></option>
                  <?php foreach (\dash\data::catList() as $key => $value) {?>
                    <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index(\dash\data::dataRow(), 'cat')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                  <?php } //endfor ?>
                </select>
              </div>
            <?php } //endif ?>
          </div>
          <div class="c-4">
            <?php if(!\dash\data::keyList()) {?>
              <div class="input">
                <input type="text" name="key" placeholder="<?php echo T_("Type"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index(\dash\data::dataRow(), 'key'); ?>">
              </div>
            <?php }else{ ?>
              <div>
                <select name="key" class="select22" data-model='tag' data-placeholder="<?php echo T_("Type"); ?>" >
                  <option></option>
                  <?php foreach (\dash\data::keyList() as $key => $value) {?>
                    <option value="<?php echo $value; ?>" <?php if($value == \dash\get::index(\dash\data::dataRow(), 'key')) { echo 'selected'; } ?> ><?php echo $value; ?></option>
                  <?php } //endfor ?>
                </select>
              </div>
            <?php } //endif ?>
          </div>
          <div class="c-4">
            <div class="input">
              <input type="text" name="value" placeholder="<?php echo T_("Value"); ?>" id="title" maxlength="100" value="<?php echo \dash\get::index(\dash\data::dataRow(), 'value'); ?>">
            </div>
          </div>
        </div>
      </div>
      <footer class="txtRa">
        <?php if(\dash\data::editMode()) {?>
          <div class="f">
            <div class="cauto"><a href="<?php echo \dash\url::that(). '?id='. \dash\request::get('id') ?>" class="secondary outline btn"><?php echo T_("Cancel") ?></a></div>
            <div class="c"></div>
            <div class="cauto"><button class="master btn"><?php echo T_("Edit") ?></button></div>
          </div>

        <?php }else{ ?>
          <button class="master btn"><?php echo T_("Add") ?></button>
        <?php } //endif ?>
      </footer>
    </form>
    </section>



<?php

if(\dash\data::propertyList_saved())
{
   $have_any_id = false;
?>
  <div class="box productInfo">
    <table class="tbl1 responsive v5">
<?php foreach (\dash\data::propertyList_saved() as $property => $cat) { ?>
      <tr class="group">
        <th colspan="5"><?php echo $cat['title']; ?></th>
      </tr>
<?php foreach ($cat['list'] as $key => $value) {?>
      <tr>
         <td class="collapsing">
          <?php if(\dash\get::index($value, 'id') && !\dash\get::index($value, 'outstanding')) {?><div class="" data-ajaxify data-action="<?php echo \dash\url::pwd(); ?>" data-method='post' data-data='{"outstanding": "outstanding", "type": "set", "pid": "<?php echo \dash\get::index($value, 'id'); ?>"}'><i title="<?php echo T_("Set as outstanding property") ?>" class="sf-check-circle fc-mute fs12"></i></div><?php } //endif ?>

          <?php if(\dash\get::index($value, 'id') && \dash\get::index($value, 'outstanding')) {?><div class="lin" data-ajaxify data-action="<?php echo \dash\url::pwd(); ?>" data-method='post' data-data='{"outstanding": "outstanding", "type": "unset", "pid": "<?php echo \dash\get::index($value, 'id'); ?>"}'><i title="<?php echo T_("Unset from outstanding property") ?>" class="sf-check-circle fc-green fs12"></i></div><?php } //endif ?>
        </td>
        <th><?php echo $value['key']; ?></th>
        <td>
          <?php if(\dash\get::index($value, 'link')) {?>
            <a href="<?php echo \dash\get::index($value, 'link') ?>"><?php echo $value['value']; ?></a>
          <?php }else{ ?>
          <?php echo $value['value']; ?>
          <?php } //endif ?>
        </td>

         <td class="collapsing">
          <?php if(\dash\get::index($value, 'id') && \dash\request::get('pid') && \dash\request::get('pid') == \dash\get::index($value, 'id')) {?>
            <small class="fc-mute"><?php echo T_("Please fill the top input and click on Edit to save it") ?></small>
          <?php }else{ ?>
            <?php if(\dash\get::index($value, 'id')) { $have_any_id = true; ?><a href="<?php echo \dash\url::that(). '?id='. \dash\request::get('id'). '&pid='. \dash\get::index($value, 'id') ?>" class="link"><?php echo T_("Edit") ?></div><?php } //endif ?>
          <?php } //endif ?>
        </td>
         <td class="collapsing"><?php if(\dash\get::index($value, 'id')) { $have_any_id = true; ?><div class="linkDel" data-confirm  data-data='{"remove": "remove", "pid": "<?php echo \dash\get::index($value, 'id'); ?>"}'><?php echo T_("Remove") ?></div><?php } //endif ?></td>
      </tr>
  <?php  } // endfor ?>
<?php  } // end for category ?>
    </table>

    <?php if($have_any_id) {?>
      <p class="mA10-f">
        <?php echo T_("By click on ") ?><i class="sf-check-circle fc-mute fs12"></i>
        <?php echo T_("You can set one property as outstanding property or unset it") ?>
      </p>
    <?php } //endif ?>
  </div>

  <?php if(\dash\data::propertyList_category()) {?>
    <form method="post" autocomplete="off">
      <input type="hidden" name="multiproperty" value="multiproperty">
      <div class="box">
        <header><h2><?php echo T_("Property of Category") ?></h2></header>
        <div class="body">
          <table class="tbl1 v5 responsive">
            <thead>
              <tr>
                <th class="collapsing"><?php echo T_("Group") ?></th>
                <th class="collapsing"><?php echo T_("Type") ?></th>
                <th><?php echo T_("Value") ?></th>
              </tr>
            </thead>
            <tbody>

          <?php foreach (\dash\data::propertyList_category() as $cat) {?>
            <?php foreach ($cat['list'] as $key => $value) { $randKey = rand(1, 99999); ?>
            <tr>
              <td class="collapsing">
                  <input type="hidden" name="cat_<?php echo $randKey; ?>" value="<?php echo \dash\get::index($cat, 'title') ?>">
                  <?php echo \dash\get::index($cat, 'title') ?>
              </td>
              <td class="collapsing">
                <input type="hidden" name="key_<?php echo $randKey; ?>" value="<?php echo \dash\get::index($value, 'key') ?>">
                <?php echo \dash\get::index($value, 'key') ?>
              </td>
              <td>
                <div class="input">
                  <input type="text" name="value_<?php echo $randKey; ?>" >
                </div>
              </td>
            </tr>
            <?php } // endfor ?>
          <?php } // endfor ?>
            </tbody>
          </table>
        </div>
        <footer class="txtRa">
          <button type="submit" class="btn primary"><?php echo T_("Save") ?></button>
        </footer>
      </div>
   </form>
  <?php } //endif ?>
<?php } ?>
  </div>

