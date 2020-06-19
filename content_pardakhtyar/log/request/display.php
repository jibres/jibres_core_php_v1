<?php
require_once(root. 'content_pardakhtyar/log/navigationLink.php');
if(\dash\data::dataTable())
{
  if(\dash\data::dataFilter())
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
  if(\dash\data::dataFilter())
  {

    htmlSearchBox();
    htmlFilterNoResult();
  }
  else
  {
    htmlStartAddNew();

  }
}
?>



<?php function htmlSearchBox() {?>
<div class="cbox fs12">
  <form method="get" action='<?php echo \dash\url::that(); ?>' data-action>
    <div class="input">
      <input type="search" name="q" placeholder='<?php echo T_("Search"); ?>' id="q" value="<?php echo \dash\request::get('q') ?>" <?php \dash\layout\autofocus::html() ?> autocomplete='off'>

      <button class="addon btn "><?php echo T_("Search"); ?></button>
    </div>
  </form>
</div>
<?php } //endif ?>


<?php function htmlTable() {?>


<table class="tbl1 v4 cbox fs12">
 <thead>
    <tr>
      <th>id</th>
      <th>trackingNumber</th>
      <th>trackingNumberPsp</th>
      <th>requestRejectionReasons</th>
      <th>success</th>
      <th>datecreated</th>

      <th>send</th>
      <th>response</th>
      <th>url</th>
      <th>Time</th>
      <th>diff</th>

    </tr>
  </thead>
  <tbody>
<?php foreach (\dash\data::dataTable() as $key => $value) {?>
   <tr>
    <td><a href="<?php echo \dash\url::this(); ?>/show?id=<?php echo \dash\get::index($value, 'id'); ?>&table=request" class="btn"><?php echo \dash\get::index($value, 'id'); ?></a></td>
    <td><?php echo \dash\get::index($value, 'trackingNumber'); ?></td>
    <td><?php echo \dash\get::index($value, 'trackingNumberPsp'); ?></td>
    <td><?php echo \dash\get::index($value, 'requestRejectionReasons'); ?></td>
    <td><?php echo \dash\get::index($value, 'success'); ?></td>
    <td>
      <div><?php echo \dash\get::index($value, 'datecreated'); ?></div>
      <div><?php echo \dash\get::index($value, 'datemodified'); ?></div>
    </td>

    <td><?php if(\dash\get::index($value, 'send')) {?><i class="sf-check fc-green"></i> <?php }else{ ?> <i class="sf-times fc-red"></i> <?php } //endif ?></td>
    <td><?php if(\dash\get::index($value, 'response')) {?><i class="sf-check fc-green"></i> <?php }else{ ?> <i class="sf-times fc-red"></i> <?php } //endif ?></td>
    <td><?php echo \dash\get::index($value, 'url'); ?></td>
    <td>
      <div><?php echo \dash\get::index($value, 'sendtime'); ?></div>
      <div><?php echo \dash\get::index($value, 'responsetime'); ?></div>
    </td>
    <td><?php echo \dash\get::index($value, 'diff'); ?></td>
  </tr>
<?php } //endif ?>
  </tbody>
</table>
<?php \dash\utility\pagination::html(); ?>

<?php } //endif ?>


<?php function htmlFilter() {?>
<p class="f fs14 msg info2">
  <span class="c"><?php echo \dash\data::dataFilter(); ?></span>
  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlFilterNoResult() {?>
<p class="f fs14 msg warn2">
  <span class="c"><?php echo T_("Result not found!"); ?> <?php echo T_("Search with new keywords."); ?></span>
  <a class="cauto" href="<?php echo \dash\url::that(); ?>"><?php echo T_("Clear filters"); ?></a>
</p>
<?php } //endif ?>


<?php function htmlStartAddNew() {?>
<p class="fs14 msg dark2 pTB20"><?php echo T_("Hi!"); ?> <?php echo T_("You are not starting yet!"); ?></p>
<?php } //endif ?>

