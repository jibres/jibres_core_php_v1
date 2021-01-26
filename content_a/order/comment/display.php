<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-9">

    <form method="post" autocomplete="off">
      <input type="hidden" name="editdesc" value="editdesc">
      <div class="box">
        <div class="pad">
          <label for='idesc'><?php echo T_("Description") ?> <small><?php echo T_("This is the text that the customer has registered in the order.") ?></small></label>
          <textarea name="desc" class="txt" id="idesc" rows="3"><?php echo a($orderDetail, 'factor', 'desc'); ?></textarea>
        </div>
        <footer class="txtRa">
          <button class="btn master"><?php echo T_("Save") ?></button>
        </footer>
      </div>
    </form>


    <form method="post" autocomplete="off">
      <div class="box">
        <header><h2><?php echo T_("Add comment to this order") ?></h2></header>
        <div class="body padLess">
          <input type="hidden" name="orderaction" value="comment">
          <div class="mB20">
            <textarea id="desc" name="cdesc" class="txt" rows="3" placeholder="<?php echo T_("Anything about this order") ?>"></textarea>
          </div>
          <div class="fc-mute font-12 mB10">
            <?php echo T_("Enter anything such as payment method, tracking number, additional details, customer conversations, and anything related to this order in this field.") ?>
          </div>

          <div class="showAttachment" data-kerkere-content='hide'>

            <div class="box" data-uploader data-name='file' data-ratio-free>
              <input type="file"  id="file1">
              <label for="file1"><?php echo T_('Drag &amp; Drop your files or Browse'); ?></label>
            </div>
          </div>
        </div>
        <footer class="f">
          <div class="cauto"><i data-kerkere='.showAttachment' class="sf-attach fs14"></i></div>
          <div class="c"></div>
          <div class="cauto"><button class="btn success"><?php echo T_("Add comment") ?></button></div>

        </footer>
      </div>
    </form>

    <?php  if(a($orderDetail, 'action')) {?>
      <div class="tblBox font-12">
        <table class="tbl1 v4">
          <tbody>
          <?php foreach (a($orderDetail, 'action') as $key => $value) { if(a($value, 'category') !== 'notes') {continue;} ?>
            <tr>
              <td>
                <?php echo a($value, 'desc') ?>
              </td>
              <td class="">
                <?php if(a($value, 'file')) {?>
                  <a target="_blank" class="" href="<?php echo a($value, 'file') ?>"> <i class="sf-attach"></i> <?php echo T_("Attachment") ?></a>
                <?php } //endif ?>

              </td>
              <td class="collapsing fc-mute"><?php echo \dash\fit::date_time(a($value, 'datecreated')) ?></td>
              <td class="collapsing">
                  <div class="productDel font-14" data-confirm data-data='{"removeaction": "removeaction", "actionid" : "<?php echo a($value, 'id') ?>"}' title='<?php echo T_("Delete") ?>'><i class="sf-trash-o"></i></div>
              </td>
            </tr>
          <?php } //endfor ?>
          </tbody>
        </table>
      </div>

    <?php } //endif ?>

  </div>
</div>
