<?php if(\dash\data::ipDetail()) {?>


<div class="cbox">
  <div class="f">
    <?php foreach (\dash\data::ipDetail() as $key => $value) {?>

    <div class="msg c3 mL5"><?php echo $key; ?> <span class="floatL"><?php echo $value; ?></span></div>
  <?php } //endfor ?>
  </div>
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
        <div class="input search <?php if(\dash\request::get('q')) { echo 'apply'; }?>">
            <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\validate::search_string(); ?>" data-default data-pass='submit' autocomplete='off' autofocus>
            <button class="addon btn light3 s0"><i class="sf-search"></i></button>
        </div>
    </form>

<?php } //endfunction ?>


<?php function htmlTable() {?>
<div class="fs14 mT20">


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
                      <code><?php echo \dash\get::index($value, 'id'); ?></code>
                  </td>
                    <td class="fc-blue">
                      <code><?php echo \dash\get::index($value, 'ipv4'); ?></code>
                      <code><?php echo \dash\get::index($value, 'ipv6'); ?></code>
                    </td>
                    <td>
                      <code><?php echo \dash\get::index($value, 'block'); ?></code>
                    </td>
                    <td class="collapsing"><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?>
                      <?php echo \dash\fit::date_time(\dash\get::index($value, 'datemodified')); ?>
                    </td>
                    <td>
                      <?php echo \dash\fit::number(\dash\get::index($value, 'countblock')); ?>
                    </td>

                </tr>
              <?php }// endfor ?>
            </tbody>
        </table>
    </div>
    <?php }else{ ?>

      <div class="msg warn2"><?php echo T_("No ip founded"); ?></div>
    <?php } //endif ?>

<?php \dash\utility\pagination::html(); ?>

</div>


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

</div>

<?php } //endfunction ?>

