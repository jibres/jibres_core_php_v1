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
                <th class="collapsing">#</th>
                <th><?php echo T_("IP"); ?></th>
                <th><?php echo T_("Block"); ?></th>
                <th><?php echo T_("Date"); ?></th>
                <th><?php echo T_("Count block"); ?></th>

            </thead>
            <tbody>
              <?php foreach (\dash\data::dataTable() as $key => $value) {?>
                <tr>
                  <td class="collapsing">
                      <code><?php echo a($value, 'id'); ?></code>
                  </td>
                    <td class="fc-blue">
                      <code><?php echo a($value, 'ipv4'); ?></code>
                      <code><?php echo a($value, 'ipv6'); ?></code>
                    </td>
                    <td>
                      <code><?php echo a($value, 'block'); ?></code>
                    </td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?>
                      <?php echo \dash\fit::date_time(a($value, 'datemodified')); ?>
                    </td>
                    <td>
                      <?php echo \dash\fit::number(a($value, 'countblock')); ?>
                    </td>

                </tr>
              <?php }// endfor ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>

      <div class="alert-warning"><?php echo T_("No ip founded"); ?></div>
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

