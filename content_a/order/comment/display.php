<?php $orderDetail = \dash\data::orderDetail(); ?>

<div class="row p0">
  <div class="c-xs-12 c-sm-3">
    <?php require_once(root. '/content_a/order/links.php'); ?>
  </div>
  <div class="c-xs-12 c-sm-9">



    <form method="post" autocomplete="off">
      <div class="box">
        <header><h2><?php echo T_("Add comment to this order") ?></h2></header>
        <div class="body padLess">
          <input type="hidden" name="orderaction" value="comment">
          <div class="mB20">
            <textarea id="desc" name="desc" class="txt" rows="3" placeholder="<?php echo T_("Only admin can see the comments") ?>"><?php echo \dash\data::dataRow_desc(); ?></textarea>
          </div>

          <div class="showAttachment" data-kerkere-content='hide'>

            <div class="box" data-uploader data-name='file'>
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

    <h3><?php echo T_("Order Action list") ?></h3>
    <nav class="items">
      <ul>
        <?php foreach (\dash\get::index($orderDetail, 'action') as $key => $value) {?>
          <li>
            <a class="f">
              <div class="key"><?php if(\dash\get::index($value, 'action') === 'comment'){ echo \dash\get::index($value, 'desc'); }else{ echo \dash\get::index($value, 't_action');}?></div>
              <div class="value"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated'));?></div>
            </a>
          </li>
        <?php } //endfor ?>
      </ul>
    </nav>

  </div>
</div>
