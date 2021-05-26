<?php
$propertyList   = \dash\data::propertyList();
$storData       = \dash\data::store_store_data();
$productDataRow = \dash\data::productDataRow();
require_once(root. 'content_a/products/productName.php');
?>
<div class="avand-xl">
<nav class="items">
  <ul>
    <li>
      <a class="item f" href="<?php echo \dash\url::this(). '/property/add?id='. \dash\request::get('id');?>">
        <div class="key"><?php echo T_("Add new property") ?></div>
        <div class="go plus ok"></div>
      </a>
    </li>
  </ul>
</nav>

<?php
  if(\dash\data::propertyList())
  {
    $have_any_id = false;
    ?>
    <form method="post" id="form1" data-patch autocomplete="off">
          <?php $i=0; $XI = 1; foreach (\dash\data::propertyList() as $property => $cat) { $i++; ?>
            <div class="msg info2">
              <?php if($i === 1) {echo '<div class="font-14">'. $cat['title']. '</div>';}else{ ?>
                 <a class="font-14" href="<?php echo \dash\url::that(). '/edit'. \dash\request::full_get(['group' => $cat['title'] ]) ?>">
                    <?php echo $cat['title']; ?>
                  </a>
                <?php } //endif ?>
            </div>
              <nav class="items">
                <ul data-sortable>
            <?php foreach ($cat['list'] as $key => $value) { $XI++; ?>
                  <li>
                    <div class="item f">
                      <div class="key">
                        <div class="row">
                          <?php if((a($value, 'value') || a($value, 'value') == '0') && !a($value, 'lock')) {?>
                            <div class="cauto handle" data-handle><i class="sf-sort"></i></div>
                          <?php }elseif(!a($value, 'sortable')){ ?>
                            <!-- <i class="sf-sort disabled"></i> -->
                          <?php } //endif ?>
                            <div class="c"><?php echo $value['key']; ?></div>
                            <input type="hidden" name="sort[]" value="<?php if(a($value, 'id')) { echo a($value, 'id'); }else{ echo 'tid_'. $XI; } ?>">

                        </div>
                      </div>
                      <div class="value">
                        <?php if(a($value, 'link')) { ?>
                          <a href="<?php echo a($value, 'link') ?>"><?php echo $value['value']; ?></a>
                        <?php }elseif(a($value, 'lock')){ echo $value['value']; }else{ ?>
                          <?php if(!a($value, 'field_name')) {?>
                            <input type="hidden" name="tid_<?php echo $XI; ?>" value="<?php echo $XI; ?>">
                            <input type="hidden" name="rid_<?php echo $XI; ?>" value="<?php echo a($value, 'id') ?>">
                            <input type="hidden" name="cat_<?php echo $XI; ?>" value="<?php echo a($cat, 'title') ?>">
                            <input type="hidden" name="key_<?php echo $XI; ?>" value="<?php echo a($value, 'key') ?>">
                          <?php } //endif ?>
                          <?php if(a($value, 'field_name') === 'unit') {?>
                            <div>
                             <label for='unit'><?php echo T_("Unit"); ?></label>
                              <select name="unit" id="unit" class="select22" data-model='tag' data-placeholder='<?php echo T_("like Qty, kg, etc"); ?>' <?php if(\dash\data::productDataRow_parent()) echo 'disabled'; ?> >
                                  <option value=""><?php echo T_("like Qty, kg, etc"); ?></option>
                                <?php if(\dash\data::productDataRow_unit_id()) {?>
                                  <option value="0"><?php echo T_("Without unit"); ?></option>
                                <?php } //endif ?>
                                  <?php foreach (\dash\data::listUnits() as $key => $value) {?>
                                  <option value="<?php echo $value['title']; ?>" <?php if($value['id'] == \dash\data::productDataRow_unit_id()) { echo 'selected'; } ?> ><?php echo $value['title']; ?></option>
                                  <?php } //endfor ?>
                              </select>
                            </div>
                          <?php }else{ ?>
                          <div class="input">
                            <input type="text" name="<?php if(a($value, 'field_name')){ echo a($value, 'field_name');}else{echo 'val_'. $XI;} ?>" <?php if(a($value, 'placeholder')) { echo "placeholder='". a($value, 'placeholder'). "'";} ?> value="<?php echo $value['value'] ?>">
                            <button class="hide addon btn"><i class="sf-save"></i></button>
                          </div>
                          <?php } //endif ?>
                        <?php } //endif ?>
                      </div>
                      <?php if(a($value, 'id') && !a($value, 'outstanding')) {?>
                        <div class="go detail" data-ajaxify data-action="<?php echo \dash\url::pwd(); ?>" data-method='post' data-data='{"outstanding": "outstanding", "type": "set", "pid": "<?php echo a($value, 'id'); ?>"}'>
                        </div>
                      <?php } //endif ?>
                      <?php if(a($value, 'id') && a($value, 'outstanding')) {?>
                        <div class="go detail ok" data-ajaxify data-action="<?php echo \dash\url::pwd(); ?>" data-method='post' data-data='{"outstanding": "outstanding", "type": "unset", "pid": "<?php echo a($value, 'id'); ?>"}'>
                        </div>
                      <?php } //endif ?>
                      <?php if(!a($value, 'id')) {?>
                        <div class="go detail"></div>
                      <?php } //endif ?>
                    </div>
                  </li>
          <?php  } // endfor ?>
                </ul>
              </nav>
        <?php  } // end for category ?>
      <?php if($have_any_id) {?>
        <p class="mA10-f">
          <?php echo T_("By click on ") ?><i class="sf-check-circle fc-mute fs12"></i>
          <?php echo T_("You can set one property as outstanding property or unset it") ?>
        </p>
      <?php } //endif ?>
  <?php } ?>
</form>
</div>