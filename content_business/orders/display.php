<div class="avand">
	<div class="row">
		<div class="c-xs-0 c-sm-0 c-lg-4 d-lg-block c-xl-3">
			  <?php require_once(root. 'content_business/profile/display-menu.php'); ?>
		</div>
		<div class="c-xs-12 c-sm-12 c-lg-8 c-xl-9">
			<?php
			if(\dash\data::dataTable())
			{
			?>

			   <table class="tbl1 v6 fs12 txtC">
    <thead>
      <tr class="fs08">
      	<th class="collapsing">#</th>
        <th><?php echo T_("Items") ?></th>
        <th><?php echo T_("Qty") ?></th>

        <th><?php echo T_("Total") ?></th>
        <th><?php echo T_("Date") ?></th>
        <th><?php echo T_("Status") ?></th>


      </tr>

    </thead>
    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>

        <tr>
          <th class="collapsing"><a href="<?php echo \dash\url::this(). '/view?id='. \dash\get::index($value, 'id_code'); ?>"><code class="btn link"><?php echo \dash\get::index($value, 'id_code') ?></code></a></th>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?itemequal=<?php echo \dash\get::index($value, 'item'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'item')); ?></a></td>
          <td class="s0"><a href="<?php echo \dash\url::this(); ?>?qtyequal=<?php echo \dash\get::index($value, 'qty'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'qty')); ?></a></td>

          <td ><a href="<?php echo \dash\url::this(); ?>?subtotal=<?php echo \dash\get::index($value, 'subtotal'); ?><?php echo $andType; ?>"><?php echo \dash\fit::number(\dash\get::index($value, 'subtotal')); ?></a></td>
          <td class="collapsing">
            <div class="f">
              <div class="c fs09"><?php echo \dash\fit::date_time(\dash\get::index($value, 'date')); ?>
              <div class="cauto os txtB pRa10"><?php echo \dash\fit::date_human(\dash\get::index($value, 'date')); ?></div>
            </div>
          </td>
          <td><?php echo T_(\dash\get::index($value, 'status')); ?></td>
        </tr>
      <?php } //endfor ?>
    </tbody>
  </table>
			<?php
			\dash\utility\pagination::html();
			}
			else
			{
			?>

			<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?> <?php echo T_("No orders found"); ?></p>

			<?php
			} //endif
			?>

		</div>
	</div>
</div>