<?php if(\dash\data::groupByPrice() && is_array(\dash\data::groupByPrice())) {?>
<div class="f">
    <?php foreach (\dash\data::groupByPrice() as $key => $value): ?>
        <div class="c pRa5">
            <a class="stat x70" >
                <h3><?php echo T_(ucfirst($key)); ?> <small><?php echo \lib\currency::unit(); ?></small></h3>
                <div class="val"><?php echo \dash\fit::number($value); ?></div>
            </a>
        </div>
    <?php endforeach ?>
</div>
<?php } //endif ?>



<?php if(\dash\data::groupByAction() && is_array(\dash\data::groupByAction())) {?>
<div class="f">
    <?php foreach (\dash\data::groupByAction() as $key => $value): ?>
        <div class="c pRa5">
            <a href="<?php echo \dash\url::that(); if($key === 'All'){}else{echo '?action='. $key; } ?>" class="stat x70 <?php if($key==='All'){if(!\dash\request::get('action')) { echo ' active';}}else{ if(\dash\request::get('action') == $key) { echo ' active';}} ?>" >
                <h3><?php echo T_(ucfirst($key)); ?></h3>
                <div class="val"><?php echo \dash\fit::number($value); ?></div>
            </a>
        </div>
    <?php endforeach ?>
</div>
<?php } //endif ?>




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
    <form method="get" action="<?php echo \dash\url::that(); ?>">
        <div class="input search <?php if(\dash\validate::search_string()) { echo 'apply'; }?>">
            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" data-default data-pass='submit' autocomplete='off' autofocus>
            <button class="addon btn-light3 s0"><i class="sf-search"></i></button>
        </div>
    </form>

<?php } //endfunction ?>


<?php function htmlTable() {?>
<div class="fs14 mt-4">


    <?php if(\dash\data::dataTable()) {?>

    <div class="tblBox">
        <table class="tbl1 v1">
            <thead>
                <th><?php echo T_("Domain"); ?></th>
                <th><?php echo T_("Action"); ?></th>
                <th><?php echo T_("Period"); ?></th>
                <th><?php echo T_("Price"); ?></th>
                <th><?php echo T_("Discount"); ?></th>
                <th><?php echo T_("Final price"); ?></th>
                <th><?php echo T_("Date"); ?></th>
                <th><?php echo T_("User"); ?></th>
            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                    <td><a href="<?php echo \dash\url::this(). '/setting?id='. a($value, 'domain_id'); ?>"><?php echo a($value, 'domain'); ?></a></td>
                    <td><?php echo T_(ucfirst(a($value, 'action'))); ?></td>
                    <td><?php echo a($value, 'period_title'); ?></td>
                    <td><?php if(a($value, 'price')) {?><?php echo \dash\fit::number(a($value, 'price')); ?> <small><?php echo \lib\currency::unit(); ?></small><?php }//endif ?></td>
                    <td><?php if(a($value, 'discount')) {?><?php echo \dash\fit::number(a($value, 'discount')); ?> <small><?php echo \lib\currency::unit(); ?></small><?php }//endif ?></td>
                    <td><?php if(a($value, 'finalprice')) {?><?php echo \dash\fit::number(a($value, 'finalprice')); ?> <small><?php echo \lib\currency::unit(); ?></small><?php }//endif ?></td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></td>
                    <td class="collapsing">
                      <a href="<?php echo \dash\url::this(). '/log?user='. a($value, 'user_id'); ?>" class="f align-center userPack">
                        <div class="c pRa10">
                          <div class="mobile"><?php echo \dash\fit::mobile(a($value, 'user_detail', 'mobile')); ?></div>
                          <div class="name"><?php echo a($value, 'user_detail', 'displayname'); ?></div>
                        </div>
                        <img class="cauto" src="<?php echo a($value, 'user_detail', 'avatar'); ?>">
                      </a>
                    </td>
                </tr>
              <?php }// endfor ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>

      <div class="alert-warning"><?php echo T_("No billing history founded"); ?></div>
    <?php } //endif ?>

<?php \dash\utility\pagination::html(); ?>

</div>


<?php } //endfunction ?>




<?php function htmlFilter() {?>
<p class="f fs14 alert-warning p-2 rounded">
  <span class="c"><?php echo \dash\data::filterBox(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

<div class="alert-info p-4 rounded">
  <p><?php echo T_("Hi!"); ?></p>

</div>

<?php } //endfunction ?>

