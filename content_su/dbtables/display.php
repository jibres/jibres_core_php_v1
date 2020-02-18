
<?php

if(\dash\data::allTables())
{
?>


<div class="f">
  <?php foreach (\dash\data::allTables() as $key => $value) {?>

  <div class="c2">
    <a class="dcard x1 " href='<?php echo \dash\url::here(); ?>/dbtables?table=<?php echo $key; ?>'>
     <div class="statistic">
      <div class="value"><i class="sf-table"></i></div>
      <div class="label"><?php echo $value; ?></div>
     </div>
    </a>
  </div>
  <?php }//endfif ?>
</div>


<?php
}
elseif (\dash\data::dataTable())
{


if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
  {

    htmlTable();
    htmlFilter();

  }
  else
  {
    htmlTable();
  }
}
else
{
  if(\dash\data::dataFilter())
  {

    htmlFilterNoResult();


  }
  else
  {
    htmlStartAddNew();

  }

}

}
?>




<?php function htmlTable() {?>
<div class="tblBox mB50">

 <div class="fs12">
  <table class="tbl1 v1">
    <thead class="primary">
      <tr>

        <?php foreach (\dash\data::allField() as $key => $value) {?>

          <th><?php echo T_($value); ?></th>

        <?php } ?>

      </tr>
    </thead>

    <tbody>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>

      <tr>
        <?php foreach (\dash\data::allField() as $fkey => $fvalue) {?>

        <?php if(isset($value[$fvalue]) && is_array($value[$fvalue])) {?>

          <td>ARRAY!</td>
        <?php }elseif(isset($value[$fvalue])){ ?>
          <td><?php echo $value[$fvalue]; ?></td>
        <?php }else{?>
          <td></td>
        <?php } ?>
        <?php }//endfor ?>
      </tr>
      <?php }//endfor ?>
    </tbody>
  </table>
  <?php \dash\utility\pagination::html(); ?>
 </div>
</div>
<div class="mB50">&nbsp;</div>
<?php } //endfunction ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">

  <a class="cauto" href="<?php echo \dash\url::here(); ?>/dbtables"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::here(); ?>/dbtables"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endfunction ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg success2 pTB20"><?php echo T_("Hi!"); ?> <a href="<?php echo \dash\url::here(); ?>/dbtables/add"><?php echo T_("Try to start with add new :dbtables!"); ?></a></p>
<?php } //endfunction ?>

