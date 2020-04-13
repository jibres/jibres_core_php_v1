  <div class="f">
   <div class="c pRa5">
    <a href="<?php echo \dash\url::current(); ?>" class="stat x70 <?php if(!\dash\request::get('type')) { echo ' active';} ?>">
     <h3><?php echo T_("All"); ?></h3>
     <div class="val"><?php echo \dash\fit::number(array_sum(array_column(\dash\data::groupByType(), 'count'))); ?></div>
    </a>
   </div>
<?php foreach (\dash\data::groupByType() as $key => $value) {?>
   <div class="c pRa5">
    <a href="<?php echo \dash\url::current(). '?type='. $value['type']; ?>" class="stat x70 <?php if(\dash\request::get('type') == $value['type']) { echo ' active';} ?>" >
     <h3><?php echo T_($value['type']); ?></h3>
     <div class="val"><?php echo \dash\fit::number($value['count']); ?></div>
    </a>
   </div>
<?php } // endfor ?>
  </div>


  <div class="f">
   <div class="c pRa5">
    <a href="<?php echo \dash\url::current(); ?>" class="stat x50 <?php if(!\dash\request::get('result_code')) { echo ' active';} ?>" >
      <h3><?php echo T_("All"); ?></h3>
      <div class="val"><?php echo \dash\fit::number(array_sum(array_column(\dash\data::groupByCode(), 'count'))); ?></div>
    </a>

   </div>
<?php foreach (\dash\data::groupByCode() as $key => $value) {?>
   <div class="c pRa5">
    <a href="<?php echo \dash\url::current(). '?result_code='. $value['result_code']; ?>" class="stat x50 <?php if(\dash\request::get('result_code') == $value['result_code']) { echo ' active';} ?>" >
      <h3>Code: <?php echo T_($value['result_code']); ?></h3>
      <div class="val"><?php echo \dash\fit::number($value['count']); ?></div>
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

<div class="fs12 tblBox">
    <table class="tbl1 v1 minimal">
        <thead>
            <tr>
                <th class="collapsing">#</th>
                <th><?php echo T_("Domain"); ?></th>
                <th><?php echo T_("IRNIC id"); ?></th>
                <th><?php echo T_("Type"); ?></th>
                <th><?php echo T_("Result code"); ?></th>
                <th><?php echo T_("Date"); ?></th>
                <th><?php echo T_("User"); ?></th>
            </tr>
        </thead>
        <tbody>

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>
            <tr>
                <td class="collapsing"><a href="<?php echo \dash\url::that(). '/view?id='. \dash\get::index($value, 'id'); ?>"><i class="sf-info-circle mRa10"></i><?php echo T_("Request"). ' '. \dash\fit::number(\dash\get::index($value, 'id')); ?></a></td>

                <td class="collapsing ltr txtL"><code><?php echo \dash\get::index($value, 'domain'); ?></code></td>
                <td class="collapsing ltr txtL"><code><?php echo \dash\get::index($value, 'nic_id'); ?></code></td>
                <td class="collapsing ltr txtL"><a href="<?php echo \dash\url::that(). '?type='.\dash\get::index($value, 'type'); ?>"><code><?php echo \dash\get::index($value, 'type'); ?></code></a></td>

                <td class="collapsing"><a href="<?php echo \dash\url::that(). '?result_code='.\dash\get::index($value, 'result_code'); ?>"><code><?php echo \dash\get::index($value, 'result_code'); ?></code></a></td>


                <td class="collapsing ltr txtL">
                  <div><?php echo \dash\fit::date_time(\dash\get::index($value, 'datesend')); ?></div>
<?php if(\dash\get::index($value, 'dateresponse                                                   ')) { ?>
                  <div><?php echo \dash\fit::date_time(\dash\get::index($value, 'dateresponse')); ?></div>
<?php } //endif ?>
                </td>

                <td class="collapsing">
                  <a href="<?php echo \dash\url::that(). '?user='.\dash\get::index($value, 'user_id'); ?>" class="f userPack">
                    <div class="c pRa10">
                      <div class="mobile"><?php echo \dash\fit::mobile(\dash\get::index($value, 'user_detail', 'mobile')); ?></div>
                      <div class="name"><?php echo \dash\get::index($value, 'user_detail', 'displayname'); ?></div>
                    </div>
                    <img class="cauto" src="<?php echo \dash\get::index($value, 'user_detail', 'avatar'); ?>">
                  </a>
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

