<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>

<div class="f fs14 mT10 mb-4">
 <div class="c6 s12 pRa5">

  <div class="panel mB10">
    <table class="tbl1 v4 mB0">
     <tr>
      <th><?php echo T_('Domain') ?> <a class="link mLa5" target="_blank" rel="nofollow" href="http://<?php echo \dash\data::domainDetail_name(); ?>"><i class=" mRa5 sf-link"></i></a></th>
      <td class="ltr txtRa font-bold"><?php echo \dash\data::domainDetail_name(); ?></td>
     </tr>
     <tr>
      <th><?php echo T_('Status & Validity') ?></th>
        <td class="ltr txtRa">
        <?php echo \dash\data::domainDetail_status_html(); ?>
        <?php echo a(\dash\data::domainDetail(), 'other_status'); ?>
      </td>
     </tr>
     <?php if(\dash\permission::supervisor()) {?>

      <?php if(\dash\data::domainDetail_nicstatus_array() && count(\dash\data::domainDetail_nicstatus_array()) === 2 && in_array('ok', \dash\data::domainDetail_nicstatus_array()) && in_array('irnicRegistered', \dash\data::domainDetail_nicstatus_array())) {?>
     <tr>
      <th><?php echo T_('Status & Validity') ?></th>
        <td class="ltr txtRa">
        <div class="ibtn wide fc-green"><i class="sf-check"></i><span><?php echo T_("Enable"); ?></span></div>
      </td>
     </tr>
        <?php
          }else
          {
            if(\dash\data::domainDetail_nicstatus_array())
            {
              foreach (\dash\data::domainDetail_nicstatus_array() as $key => $value)
              {
                echo '<tr>';
                if($key === 0)
                {
                  echo '<th rowspan='. count(\dash\data::domainDetail_nicstatus_array()).'>'. T_('Status & Validity'). '</th>';
                }

                echo '<td class="ltr txtRa">';
                echo '<div class="badge mLa10 light">'. T_($value). ' '. $value. '</div>';
                echo '</td></tr>';
              }
            }
          }
        ?>
     <?php }//endif supervisor ?>
     <tr>
      <th><?php echo T_('Registrar') ?></th>
      <td class="ltr txtRa"><?php echo T_(\dash\data::domainDetail_registrar()); ?></td>
     </tr>
     <tr>
      <th><?php echo T_('Registered on') ?></th>
      <td class="ltr txtRa"><?php echo \dash\fit::date(\dash\data::domainDetail_dateregister()); ?></td>
     </tr>
     <tr>
      <th><?php echo T_('Expired on') ?>
      <?php if(\dash\data::domainDetail_can_renew()) {?>
      <a class="link mLa5" href="<?php echo \dash\url::this(). '/renew?domain='. \dash\request::get('domain'); ?>"><?php echo T_('Renew domain'); ?></a>
      <?php } //endif ?>
      </th>
      <td class="ltr txtRa"><?php echo \dash\fit::date(\dash\data::domainDetail_dateexpire()); ?></td>
     </tr>
<?php if(\dash\data::domainDetail_datemodified()) {?>
     <tr>
      <th><?php echo T_('Last activity') ?></th>
      <td class="ltr txtRa"><?php echo \dash\fit::date(\dash\data::domainDetail_datemodified()); ?></td>
     </tr>
<?php }?>
     <tr>
      <th><?php echo T_('Transfer lock') ?> <a class="mLa5 hide" href="<?php echo \dash\url::that(). '/transfer?domain='. \dash\request::get('domain'); ?>"><?php echo T_('Manage'); ?></a></th>
      <td class="txtRa"><div class="ibtn wide"><?php
if(\dash\data::domainDetail_lock())
{
 echo '<div class="fc-green"><span>'.T_("Locked"). '</span>'. '<i class="sf-lock"></i></div>';
}
else
{
 echo '<div class="fc-red"><span>'.T_("Unlocked"). '</span>'. '<i class="sf-unlock"></i></div>';
}?></div></td>
     </tr>
     <tr>
      <th><?php echo T_('Auto Renew');
if(\dash\data::domainDetail_autorenew())
{
 echo "<span class='link mLa5' data-confirm data-data='{\"myaction\" : \"autorenew\", \"op\" :\"unset\"}'>". T_('Click to disable'). "</span>";
}
else
{
 echo "<span class='link mLa5' data-confirm data-data='{\"myaction\" : \"autorenew\", \"op\" :\"set\"}'>". T_('Click to enable'). "</span>";
}
      ?></th>
      <td class="txtRa collapsing"><?php
if(\dash\data::domainDetail_autorenew())
{
 echo "<div class='ibtn wide fc-blue'><span>". T_('Automatic'). "</span><i class='sf-refresh'></i></div>";
}
else
{
 echo "<div class='ibtn wide fc-red'><span>". T_('Off'). "</span><i class='sf-times'></i></div>";
}
?></td>
     </tr>
    </table>
  </div>
 </div>

 <div class="c6 s12 pLa5">
  <div class="panel mB10">
    <table class="tbl1 v4 mB0">
     <tr>
      <td>
        <?php if(\dash\data::domainDetail_verify()) {?>
        <a href="<?php echo \dash\url::that(). '/dns?domain='. \dash\request::get('domain'); ?>"><?php echo T_('Name Servers'). ' - DNS' ?></a>
        <?php }else{ echo T_('Name Servers'). ' - DNS'; } ?>
      </td>
      <td class="txtRa"><a rel="nofollow" target="_blank" class="btn-secondary sm outline" href="https://intodns.com/<?php echo \dash\data::domainDetail_name(); ?>"><?php echo T_("check DNS server and mail server health"); ?></a></td>
     </tr>
     <?php if(\dash\data::domainDetail_ns1()) {?>
     <tr>
      <td class="ltr txtLa"><?php echo \dash\data::domainDetail_ns1() ?></td>
      <td class="ltr txtRa"><?php echo \dash\data::domainDetail_ip1() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ns2()) {?>
     <tr>
       <td class="ltr txtLa"><?php echo \dash\data::domainDetail_ns2() ?></td>
       <td class="ltr txtRa"><?php echo \dash\data::domainDetail_ip2() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ns3()) {?>
     <tr>
      <td class="ltr txtLa"><?php echo \dash\data::domainDetail_ns3() ?></td>
      <td class="ltr txtRa"><?php echo \dash\data::domainDetail_ip3() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ns4()) {?>
     <tr>
      <td class="ltr txtLa"><?php echo \dash\data::domainDetail_ns4() ?></td>
      <td class="ltr txtRa"><?php echo \dash\data::domainDetail_ip4() ?></td>
     </tr>
     <?php } //endif ?>
    </table>
  </div>

  <div class="panel mB10">
    <table class="tbl1 v4 mB0">
     <tr>
      <td>
        <?php if(\dash\data::domainDetail_verify()) {?>
        <a href="<?php echo \dash\url::that(). '/holder?domain='. \dash\request::get('domain'); ?>"><?php echo T_("IRNIC holder") ?></a>
        <?php }else{ echo T_("IRNIC holder"); } ?>
      </td>
      <td class="txtRa ltr"><?php echo \dash\data::domainDetail_holder(); ?></td>
     </tr>
     <tr>
      <td>
        <?php if(\dash\data::domainDetail_verify()) {?>
        <a href="<?php echo \dash\url::that(). '/holder?domain='. \dash\request::get('domain'); ?>"><?php echo T_("IRNIC admin") ?></a>
        <?php }else{ echo T_("IRNIC admin"); } ?>
      </td>
      <td class="txtRa ltr"><?php echo \dash\data::domainDetail_admin(); ?></td>
     </tr>
     <tr>
      <td>
        <?php if(\dash\data::domainDetail_verify()) {?>
        <a href="<?php echo \dash\url::that(). '/holder?domain='. \dash\request::get('domain'); ?>"><?php echo T_("IRNIC billing") ?></a>
        <?php }else{ echo T_("IRNIC billing"); } ?>
      </td>
      <td class="txtRa ltr"><?php echo \dash\data::domainDetail_bill(); ?></td>
     </tr>
     <tr>
      <td>
        <?php if(\dash\data::domainDetail_verify()) {?>
        <a href="<?php echo \dash\url::that(). '/holder?domain='. \dash\request::get('domain'); ?>"><?php echo T_("IRNIC technical") ?></a>
        <?php }else{ echo T_("IRNIC technical"); } ?>
      </td>
      <td class="txtRa ltr"><?php echo \dash\data::domainDetail_tech(); ?></td>
     </tr>
    </table>
  </div>


  <?php if(\dash\data::domainDetail_status() === 'disable') {?>
  <div class="panel mB10">
    <table class="tbl1 v4 mB0">
     <tr>
      <td>
        <?php echo T_("Remove this domain from your account"); ?>
      </td>
      <td class="txtRa ltr"><div data-confirm data-data='{"status" : "remove"}' class="btn-danger "><?php echo T_("Remove") ?></div></td>
     </tr>


    </table>
  </div>
<?php } //endif ?>




 </div>
</div>

