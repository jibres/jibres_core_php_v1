<nav class="items pwaMultiLine ltr hide">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f" href="<?php echo \dash\url::this(); ?>/view?id=<?php echo a($value, 'id'); ?>">

        <div class="key">
          <div class="line1">
            <span class="txtB"><?php echo a($value, 'code'); ?></span>
                <?php if(a($value, 'category')) { ?> <span class="fc-mute"><?php echo a($value, 'category') ?></span> <?php } //endif ?>
            </div>
          <div class="line2 f">
          <?php if(isset($value['variants_detail']['stock'])) {?>
            <div class="cauto stockCount"><b><?php echo \dash\fit::number($value['variants_detail']['stock']); ?></b> <?php echo T_("in stock"); ?></div>
          <?php } //endif ?>

          <?php if(a($value, 'giftamount')) {?>
            <div class="c"><?php echo T_("Gift"); ?> <b><?php echo \dash\fit::number(a($value, 'giftamount')). ' '. \lib\currency::unit(); ?></b></div>
          <?php } //endif ?>

          <?php if(a($value, 'giftpercent')) {?>
            <div class="c"><?php echo T_("Gift"). ' '. \dash\fit::number(a($value, 'giftpercent')). ' '. T_("%"); ?></div>
          <?php } //endif ?>
          <?php if(a($value, 'dateexpire')) {?>
          <div class="cauto"><?php echo T_("Expire date"); ?> <time><?php echo a($value, 'dateexpire'); ?></time></div>
            <?php } //endif ?>
          </div>
        </div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="fs09">

                <th><?php echo T_("Code"); ?></th>
                <th class=""><?php echo T_("Category"); ?></th>
                <th class=""><?php echo T_("Status"); ?></th>
                <th><?php echo T_("Amount") ?></th>
                <th><?php echo T_("Percent") ?></th>
                <th><?php echo T_("Expire date") ?></th>
                <th class="collapsing"><?php echo T_("View"); ?></th>

            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr>
                <td>
                    <a href="<?php echo \dash\url::this(); ?>/view?id=<?php echo a($value, 'id'); ?>" class="link"><code><?php echo a($value, 'code'); ?></code></a>
                </td>
                <td class=""><?php echo a($value, 'category'); ?></td>

                <td class=""><?php echo T_(a($value, 'status')); ?></td>
                <td><?php echo \dash\fit::number(a($value, 'giftamount')) ?></td>
                <td><?php if(a($value, 'giftpercent')) { echo \dash\fit::number(a($value, 'giftpercent')). '%';} ?></td>
                <td><?php echo a($value, 'dateexpire') ?></td>

                <td class="collapsing"><a class="btn xs" href="<?php echo \dash\url::this() .'/card?id='. a($value, 'id'); ?>"><?php echo T_("Show gitft card") ?></a></td>


            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php \dash\utility\pagination::html(); ?>
