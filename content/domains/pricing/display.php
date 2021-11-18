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
        <div class="tld font-35 font-bold ltr txtLa"><?php echo $tld ?></div>
        <div class="fc-mute font-16"><?php echo T_("Registration") ?></div>
        <div class="price font-20 mT10"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'register')); ?></div>
      </div>
    </div>
<?php } } ?>

  </div>
 </div>

 <div class="avand impact">
  <div class="row mB10">
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
    $classList = 'btn block primary';
  }
  else
  {
    $classList = 'btn block outline';
  }
    echo '<div class="c-xs-4 c-sm-3 c-md pA5">';
    echo '<a class="'. $classList. '" href="'. $link. '">'. \dash\fit::number($i). ' '. T_('Year'). '</a>';
    echo '</div>';
}
?>

  </div>
  <div class="tblBox1">
    <table class="tbl1 v4" data-datatable="pricing">
      <thead>
        <tr>
          <th><?php echo T_("TLD") ?></th>
          <th><?php echo T_("Register") ?></th>
          <th><?php echo T_("Renew") ?></th>
          <th><?php echo T_("Transfer") ?></th>
        </tr>
      </thead>
      <tbody>
        <?php $count = 0; foreach (\dash\data::dataTable() as $key => $value) { $count++;?>
          <tr>
            <td class="ltr font-bold"><?php echo a($value, 'TLD') ?></td>
            <td data-order="<?php echo a($value, 'register'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'register'), true); ?></td>
            <td data-order="<?php echo a($value, 'renew'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'renew'), true) ?></td>
            <td data-order="<?php echo a($value, 'transfer'); ?>"><?php echo \content\domains\pricing\controller::priceEl(a($value, 'transfer'), true) ?></td>
          </tr>
        <?php } // endfor ?>
      </tbody>
    </table>
  </div>
</div>
</div>
