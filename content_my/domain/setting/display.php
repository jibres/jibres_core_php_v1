<?php require_once (root. 'content_my/domain/setting/pageStep.php'); ?>


<div class="f">

 <div class="c4 s12">
  <div class="dcard x2 mB10">
   <div class="statistic <?php if(\dash\data::domainDetail_lock()) echo 'green'; else echo 'red'; ?>">
     <div class="value"><?php echo \dash\data::domainDetail_name() ?></div>
   </div>
  </div>
 </div>

 <div class="c4 s12">
  <div class="dcard x2">
   <div class="statistic red"><?php
 if(\dash\data::domainDetail_lock())
 {
  echo '<div class="value"><i class="sf-lock fc-green"></i></div>';
  echo '<div class="label">'. T_('Domain is Locked'). '</div>';
 }
 else
 {
  echo '<div class="value"><i class="sf-unlock fc-red"></i></div>';
  echo '<div class="label">'. T_('Domain is Unlocked'). '</div>';
 }

?></div>
  </div>
 </div>

 <div class="c4 s12">
  <div class="dcard x2">
   <div class="statistic red"><?php
 if(\dash\data::domainDetail_autorenew())
 {
  echo '<div class="value"><i class="sf-refresh fc-blue"></i></div>';
  echo '<div class="label">'. T_('Domain is Locked'). '</div>';
 }
 else
 {
  echo '<div class="value"><i class="sf-times fc-red"></i></div>';
  echo '<div class="label">'. T_('Domain is Unlocked'). '</div>';
 }

?></div>
  </div>
 </div>
</div>


<div class="f mT20 fs12">
 <div class="c4 s12">
  <div class="panel2">
   <div class="pad2">
    <table class="tbl1 v6">
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

 <div class="c4 s12">
  <table class="tbl1 v4">
  </table>
 </div>

 <div class="c4 s12">
  <div class="panel">
   <table class="tbl1 v4">
     <tr>
      <td><?php echo T_("DNS #1") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ns1() ?></td>
     </tr>
     <tr>
      <td><?php echo T_("DNS #2") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ns2() ?></td>
     </tr>

     <?php if(\dash\data::domainDetail_ns3()) {?>
     <tr>
      <td><?php echo T_("DNS #3") ?></td>
      <td class="txtL ltr"><?php echo \dash\data::domainDetail_ns3() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ns4()) {?>
     <tr>
      <td><?php echo T_("DNS #4") ?></td>
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
 </div>
</div>




<div class="f">
 <div class="c6 m8 s12">
  <div class="cbox">
   <div class="msg minimal pLR20-f fs16 txtB ltr txtL success"><?php echo \dash\data::domainDetail_name() ?></div>



   <table class="tbl1 v4">

    <tr class="positive">
     <td><?php echo T_("Name") ?></td>
     <td class="txtB txtL ltr"><?php echo \dash\data::domainDetail_name() ?></td>
    </tr>

    <tr>
     <td><?php echo T_("Expire date") ?></td>
     <td class="txtL ltr"><?php echo \dash\fit::date_time(\dash\data::domainDetail_dateexpire()); ?></td>
    </tr>


    <tr>
     <td><div class="ibtn wide"><?php echo '<span>'.T_("Autorenew"). '</span>'; if(\dash\data::domainDetail_autorenew()) { echo '<i class="sf-refresh fc-blue"></i>'; } else{ echo '<i class="sf-times fc-red"></i>'; }?></div></td>
     <td class="txtL ltr">
      <?php  if(\dash\data::domainDetail_autorenew()) {?>
       <div class="btn" data-confirm data-data='{"myaction" : "autorenew", "op" :"unset"}'><?php echo T_("Click To disable autorenew"); ?></div>
      <?php }else{ ?>
       <div class="btn primary2" data-confirm data-data='{"myaction" : "autorenew", "op" :"set"}'><?php echo T_("Click To enable autorenew"); ?></div>
      <?php }// endif ?>
     </td>
    </tr>


    <tr>
     <td><?php echo T_("Domain Lock Status") ?></td>
     <td class="txtL ltr"><div class="ibtn wide"><?php echo '<span>'.T_("Lock"). '</span>'; if(\dash\data::domainDetail_lock()) { echo '<i class="sf-lock fc-green"></i>'; } else{ echo '<i class="sf-unlock fc-red"></i>'; }?></div></td>
    </tr>


   </table>


  </div>
 </div>
</div>


