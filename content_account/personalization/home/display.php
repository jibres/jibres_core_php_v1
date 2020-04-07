

<?php
$arrow = 'sf-chevron-';
if(\dash\data::isLtr())
{
  $arrow .= 'right';
}
else
{
  $arrow .= 'left';
}
?>





<div class="txtC fs14 mTB25">
  <img class="box700 mB20-f" src="<?php echo \dash\url::cdn(); ?>/img/account/personalization-cover.png" alt='<?php echo \dash\face::title(); ?>'>
  <h2><?php echo \dash\face::title(); ?></h2>
  <p><?php echo \dash\face::desc(); ?></p>
</div>

<div class="fs14">
  <section class="mB20">



    <div class="panel">
    <div class="body pad">
      <div class="f">
        <div class="c">
          <h3><?php echo T_("General preferences for the web"); ?></h3>
          <p><?php echo T_("Manage settings for yourself"); ?></p>
        </div>
      </div>
    </div>
    <table class="tbl1 v4 responsive mB0">
      <tr>
        <th><?php echo T_("Language"); ?></th>
        <td><?php echo \dash\data::LnagName(); ?></td>
        <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/language" class="block <?php echo $arrow; ?>"></a></td>
      </tr>
      <tr>
        <th><?php echo T_("Sidebar"); ?></th>
        <td><?php if(\dash\data::userToggleSidebar()) {?><span class="badge fs11 success"><i class="sf-check vltop"></i> <?php echo T_("Show"); ?></span><?php }else{ ?><span class="badge fs11 danger"><i class="sf-times vltop"></i> <?php echo T_("Hide"); ?></span><?php }//endif ?></td>
        <td class="collapsing txtRa"><a href="<?php echo \dash\url::this(); ?>/sidebar" class="block <?php echo $arrow; ?>"></a></td>
      </tr>
    </table>
  </div>



  </section>
</div>
