<div class="jibresBanner">

 <div class="avand">
  <div class="row">
<?php
foreach (\dash\data::specialTLD() as $tld => $value) {
  if(a($value, 'register'))
  {
?>
    <div class="c-2 c-xs-6 c-sm-4 c-md-4 c-lg-2 pA5">
      <div class="cbox mB10-f">
        <div class="tld font-35 txtB"><?php echo $tld ?></div>
        <div class="fc-mute font-16"><?php echo T_("Registeration") ?></div>
        <div class="price font-20 mT10"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'register')); ?></div>
      </div>
    </div>
<?php } } ?>

  </div>
 </div>

 <div class="avand impact">
  <div class="f mB10">
<?php
for ($i=1; $i <= 10; $i++)
{
  $link = \dash\url::that(). '?yr='. $i;
  if($i === 1)
  {
    $link = \dash\url::that();
  }

  $choosenYr = intval(\dash\request::get('yr'));
  if($choosenYr === $i || ($choosenYr === 0 && $i === 1))
  {
    $classList = 'c mA5 btn primary';
  }
  else
  {
    $classList = 'c mA5 btn outline';
  }
    echo '<a class="'. $classList. '" href="'. $link. '">'. \dash\fit::number($i). ' '. T_('Year'). '</a>';
}
?>

  </div>
  <div class="tblBox1 ltr">
    <table class="tbl1 v4" data-datatable="pricing">
      <thead>
        <tr>
          <th class="collapsing txtL"></th>
          <th class="txtL"><?php echo T_("TLD") ?></th>
          <th class="txtL"><?php echo T_("Register") ?></th>
          <th class="txtL"><?php echo T_("Renew") ?></th>
          <th class="txtL"><?php echo T_("Transfer") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0; foreach (\dash\data::dataTable() as $key => $value) { $count++;?>
          <tr>
            <td class="collapsing" data-order="<?php echo $count; ?>"><?php echo \dash\fit::number($count); ?></td>
            <td class="ltr txtL"><?php echo a($value, 'TLD') ?></td>
            <td class="txtB txtL" data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'register')); ?></td>
            <td class="txtB txtL" data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'renew')) ?></td>
            <td class="txtB txtL" data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'transfer')) ?></td>
          </tr>
        <?php } // endfor ?>
      </tbody>
    </table>
  </div>
</div>
</div>
