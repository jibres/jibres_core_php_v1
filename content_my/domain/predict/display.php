<?php if(\dash\data::myPayCalc() && is_array(\dash\data::myPayCalc())) {?>
<div class="f">
    <?php foreach (\dash\data::myPayCalc() as $period => $value) {?>
       <div class="c pRa5">
            <a class="stat x70">
                <h3><?php echo a($value, 'title'); ?></h3>
                <div class="val"><?php echo \dash\fit::number(a($value, 'price')); ?></div>
            </a>
        </div>
    <?php }//endfor ?>

</div>
<?php } ?>





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
            <input type="text" name="q" placeholder='<?php echo T_("Search"); ?>' value="<?php echo \dash\validate::search_string(); ?>">
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
                <th colspan="2" data-sort="<?php echo a($sortLink, 'name', 'order'); ?>" ><a href="<?php echo a($sortLink, 'name', 'link'); ?>"><?php echo T_("Domain"); ?></a></th>

                <th class="" data-sort="<?php echo a($sortLink, 'dateexpire', 'order'); ?>"><a href="<?php echo a($sortLink, 'dateexpire', 'link'); ?>"><?php echo T_("Expire date"); ?></a></th>
                <th><?php echo T_("Renew amount") ?></th>
            </tr>
        </thead>
        <tbody class="fs12">

            <?php foreach (\dash\data::dataTable() as $key => $value) {?>

            <tr <?php  if(a($value, 'status') === 'disable') { echo 'class="negative"'; }?> >
                <td>

                    <!-- <a target="_blank" href="http://<?php echo a($value, 'name'); ?>"><i class="sf-link"></i></a> -->
                    <a href="<?php echo \dash\url::this(); ?>/setting?domain=<?php echo a($value, 'name'); ?>" class="link flex"> <i class="sf-edit"></i> <code><?php echo a($value, 'name'); ?></code></a>
                </td>
                <td class="">
                  <?php if(a($value, 'verify')) {?>
                    <a href="<?php echo \dash\url::this(). '/setting/transfer?domain='. a($value, 'name'); ?>">

                    <div class="ibtn x30 wide"><?php echo '<span>'.T_("Lock"). '</span>'; if(isset($value['lock']) && $value['lock']) { echo '<i class="sf-lock fc-green"></i>'; } else{ echo '<i class="sf-unlock fc-red"></i>'; }?></div>
                    </a>
                  <?php } //endif ?>
                    <a href="<?php echo \dash\url::this(). '/setting?domain='. a($value, 'name'); ?>">
                    <div class="ibtn x30 wide"><?php echo '<span>'.T_("Autorenew"). '</span>'; if(isset($value['autorenew']) && $value['autorenew']) { echo '<i class="sf-refresh fc-blue"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></div>
                    </a>
                </td>

                <td class="  fs09"><?php echo \dash\fit::date(a($value, 'dateexpire')); ?></td>
                <td>
                    <div><?php echo \lib\app\nic_domain\price::register_string(\dash\data::autorenewperiod()); ?></div>


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
  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>

<?php } //endfunction ?>





<?php function htmlStartAddNew() {?>

<div class="fs14 msg info2 pTB20">
  <p><?php echo T_("Hi!"); ?></p>
  <p><?php echo T_("If the domain registered for you enable autorenew of it, you will see it in this list and you will see the amount of renew."); ?></p>

</div>

<?php } //endfunction ?>

