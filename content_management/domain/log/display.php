<div class="f">
      <a href="<?php echo \dash\url::current(); ?>" class="dcard x1 <?php if(!\dash\request::get('type')) { echo ' active';} ?>" >
         <div class="statistic">
          <div class="value"><?php echo \dash\fit::number(array_sum(array_column(\dash\data::groupByType(), 'count'))); ?></div>
          <div class="label"><?php echo T_("All"); ?></div>
         </div>
        </a>
<?php foreach (\dash\data::groupByType() as $key => $value) {?>
        <div class="c s6">
        <a href="<?php echo \dash\url::current(). '?type='. $value['type']; ?>" class="dcard x1 <?php if(\dash\request::get('type') == $value['type']) { echo ' active';} ?>" >
         <div class="statistic">
          <div class="value"><?php echo \dash\fit::number($value['count']); ?></div>
          <div class="label"><?php echo T_($value['type']); ?></div>
         </div>
        </a>
    </div>
<?php } // endfor ?>
</div>


<div class="f">
      <a href="<?php echo \dash\url::current(); ?>" class="dcard x1 <?php if(!\dash\request::get('result_code')) { echo ' active';} ?>" >
         <div class="statistic">
          <div class="value"><?php echo \dash\fit::number(array_sum(array_column(\dash\data::groupByCode(), 'count'))); ?></div>
          <div class="label"><?php echo T_("All"); ?></div>
         </div>
        </a>
<?php foreach (\dash\data::groupByCode() as $key => $value) {?>
        <div class="c s6">
        <a href="<?php echo \dash\url::current(). '?result_code='. $value['result_code']; ?>" class="dcard x1 <?php if(\dash\request::get('result_code') == $value['result_code']) { echo ' active';} ?>" >
         <div class="statistic">
          <div class="value"><?php echo \dash\fit::number($value['count']); ?></div>
          <div class="label">Code: <?php echo T_($value['result_code']); ?></div>
         </div>
        </a>
    </div>
<?php } // endfor ?>
</div>

<?php
if(\dash\data::dataTable())
{
    if(\dash\data::isFiltered())
    {
        htmlSearchBox();
        htmlTable();
        htmlFilter();
    }
    else
    {
        htmlSearchBox();
        htmlTable();
    }

}
else
{
    if(\dash\data::isFiltered())
    {
        htmlSearchBox();

        htmlFilter();
    }
    else
    {
        htmlStartAddNew();
    }
}
?>







<?php function htmlSearchBox() {?>
<div class="fs12">
    <form method="get" autocomplete="off" class="mB20" action="<?php echo \dash\url::that(); ?>">
        <div class="input search">
            <input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\request::get('q'); ?>">
            <button class="btn addon success"><?php echo T_("Search"); ?></button>
        </div>
    </form>
</div>
<?php } //endfunction ?>


<?php function htmlTable() {?>
<?php $sortLink = \dash\data::sortLink(); ?>

<div class="fs12">
    <table class="tbl1 v1 responsive">
        <thead>
            <tr class="fs09">
                <th class="collapsing">#</th>
                <th><?php echo T_("User"); ?></th>
                <th><?php echo T_("Type"); ?></th>
                <th><?php echo T_("Domain"); ?></th>
                <th><?php echo T_("IRNIC id"); ?></th>

                <th><?php echo T_("Resutl code"); ?></th>
                <th><?php echo T_("Date send"); ?></th>
                <th><?php echo T_("Date response"); ?></th>

            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr>
                <td class="collapsing"><a href="<?php echo \dash\url::that(). '/view?id='. \dash\get::index($value, 'id'); ?>"><i class="sf-rain-1"></i></a></td>
                <td>

                  <img src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>" class="avatar">
                    <?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?>
                    <div class="badge light"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
                </td>

                <td class="collapsing "><code><?php echo \dash\get::index($value, 'type'); ?></code></td>
                <td class="collapsing "><code><?php echo \dash\get::index($value, 'domain'); ?></code></td>
                <td class="collapsing "><code><?php echo \dash\get::index($value, 'nic_id'); ?></code></td>


                <td class="collapsing "><code><?php echo \dash\get::index($value, 'result_code'); ?></code></td>


                <td class="collapsing ">
                    <?php echo \dash\fit::date_time(\dash\get::index($value, 'datesend')); ?>
                    <br>
                    <small class="fc-mute"><?php echo \dash\fit::date_human(\dash\get::index($value, 'datesend')); ?></small>
                </td>

                <td class="collapsing ">
                    <?php if(\dash\get::index($value, 'dateresponse')) { ?>
                        <?php echo \dash\fit::date_time(\dash\get::index($value, 'dateresponse')); ?>
                        <br>
                        <small class="fc-mute"><?php echo \dash\fit::date_human(\dash\get::index($value, 'dateresponse')); ?></small>
                    <?php } //endif ?>
                </td>


            </tr>
            <?php } //endfor ?>
        </tbody>
    </table>
</div>
<?php \dash\utility\pagination::html(); ?>

<?php } //endfunction ?>




<?php function htmlFilter() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::this(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>


</div>

<?php } //endfunction ?>

