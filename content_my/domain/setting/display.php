<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>

<div class="f fs14 mT10 mB20">
 <div class="c6 pRa5">
  <div class="panel">
    <table class="tbl1 v4 mB0">
     <tr>
      <th><?php echo T_('Domain') ?></th>
      <td class="ltr txtL txtB"><?php echo \dash\data::domainDetail_name(); ?></td>
     </tr>
     <tr>
      <th><?php echo T_('Registered on') ?></th>
      <td class="ltr txtL"><?php echo \dash\fit::date(\dash\data::domainDetail_dateregister()); ?></td>
     </tr>
     <tr>
      <th><?php echo T_('Expired on') ?></th>
      <td class="ltr txtL"><?php echo \dash\fit::date(\dash\data::domainDetail_dateexpire()); ?></td>
     </tr>
     <tr>
      <th><?php echo T_('Transfer lock') ?></th>
      <td class="txtL"><a href="<?php echo \dash\url::that(). '/transfer?domain='. \dash\request::get('domain'); ?>" class="ibtn wide"><?php
if(\dash\data::domainDetail_lock())
{
 echo '<div class="fc-green"><span>'.T_("Locked"). '</span>'. '<i class="sf-lock"></i></div>';
}
else
{
 echo '<div class="fc-red"><span>'.T_("Unlocked"). '</span>'. '<i class="sf-unlock"></i></div>';
}?></a></td>
     </tr>
     <tr>
      <th><?php echo T_('Auto Renew');
if(\dash\data::domainDetail_autorenew())
{
 echo "<span class='link pLa10' data-confirm data-data='{\"myaction\" : \"autorenew\", \"op\" :\"unset\"}'>". T_('Disable'). "</span>";
}
else
{
 echo "<span class='link pLa10' data-confirm data-data='{\"myaction\" : \"autorenew\", \"op\" :\"set\"}'>". T_('Enable'). "</span>";
}
      ?></th>
      <td class="txtL"><?php
if(\dash\data::domainDetail_autorenew())
{
 echo "<div class='ibtn wide fc-blue'><span>". T_('Automatic'). "</span><i class='sf-refresh'></i></div>";
}
else
{
 echo "<div class='ibtn wide fc-red'><span>". T_('Disabled'). "</span><i class='sf-times'></i></div>";
}
?></td>
     </tr>
    </table>
  </div>
 </div>

 <div class="c6 pLa5">
  <div class="panel">
    <table class="tbl1 v4 mB0">
     <tr>
      <td><?php echo T_('Name Servers'). ' - '. T_("DNS #1") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ns1() ?></td>
     </tr>
     <tr>
      <td><?php echo T_('Name Servers'). ' - '. T_("DNS #2") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ns2() ?></td>
     </tr>

     <?php if(\dash\data::domainDetail_ns3()) {?>
     <tr>
      <td><?php echo T_('Name Servers'). ' - '. T_("DNS #3") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ns3() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ns4()) {?>
     <tr>
      <td><?php echo T_('Name Servers'). ' - '. T_("DNS #4") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ns4() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ip1()) {?>
     <tr>
      <td><?php echo T_("IP #1") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ip1() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ip2()) {?>
     <tr>
      <td><?php echo T_("IP #2") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ip2() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ip3()) {?>
     <tr>
      <td><?php echo T_("IP #3") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ip3() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ip4()) {?>
     <tr>
      <td><?php echo T_("IP #4") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ip4() ?></td>
     </tr>
     <?php } //endif ?>

    </table>
  </div>

  <div class="panel mT20">
    <table class="tbl1 v4 mB0 mT10">
     <tr>
      <td><?php echo T_("IRNIC holder") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_holder(); ?></td>
     </tr>
     <tr>
      <td><?php echo T_("IRNIC admin") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_admin(); ?></td>
     </tr>
     <tr>
      <td><?php echo T_("IRNIC billing") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_bill(); ?></td>
     </tr>
     <tr>
      <td><?php echo T_("IRNIC technical") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_tech(); ?></td>
     </tr>
    </table>
  </div>

 </div>
</div>

