<?php if(\dash\data::domainDetail_available() === '1') {?>
<div class="msg danger txtC txtB fs14"><?php echo T_("This domain is available for register!") ?></div>
<?php } //endif ?>
<?php require_once (root. 'content_love/domain/setting/pageStep.php'); ?>


<div class="f fs14 mT10 mB20">
 <div class="c6 s12 pRa5">

  <div class="panel mB10">
    <table class="tbl1 v4 mB0">
     <tr>
      <th><?php echo T_('Domain') ?> <a class="link mLa5" target="_blank" rel="nofollow" href="http://<?php echo \dash\data::domainDetail_name(); ?>"><i class=" mRa5 sf-link"></i></a></th>
      <td class="ltr txtRa txtB"><?php echo \dash\data::domainDetail_name(); ?></td>
     </tr>
     <tr>
      <th><?php echo T_('Status & Validity') ?>
      </th>
        <td class="ltr txtRa">
        <?php echo \dash\data::domainDetail_status_html(); ?>
      </td>
     </tr>
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
elseif(\dash\data::domainDetail_lock() == '0')
{
 echo '<div class="fc-red"><span>'.T_("Unlocked"). '</span>'. '<i class="sf-unlock"></i></div>';
}
else
{
 echo '<div class="fc-red"><span>'.T_("Unknown"). '</span>'. '<i class="sf-question"></i></div>';

}
?></div></td>
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


     <tr class="negative">
      <th><?php echo T_('Verify for this user');
if(\dash\data::domainDetail_verify())
{
 echo "<span class='linkDel mLa5' data-confirm data-data='{\"myaction\" : \"verify\", \"op\" :\"unset\"}'>". T_('Click to disable'). "</span>";
}
else
{
 echo "<span class='link mLa5' data-confirm data-data='{\"myaction\" : \"verify\", \"op\" :\"set\"}'>". T_('Click to enable'). "</span>";
}
      ?></th>
      <td class="txtRa collapsing"><?php
if(\dash\data::domainDetail_verify())
{
 echo "<div class='ibtn wide fc-green'><span>". T_('Yes'). "</span><i class='sf-check'></i></div>";
}
else
{
 echo "<div class='ibtn wide fc-red'><span>". T_('No'). "</span><i class='sf-times'></i></div>";
}
?></td>

    </table>
  </div>

  <form method="post" autocomplete="off">
    <div class="box">
      <header><h2><?php echo T_("Change status force!") ?></h2></header>
      <div class="body">
        <input type="hidden" name="myaction" value="status">
        <div>
          <label for="status"><?php echo T_("Status"); ?></label>
          <select class="select22" name="status">
            <option value="awaiting" <?php if(\dash\data::domainDetail_status() === 'awaiting') {echo 'selected'; } ?>><?php echo T_("Awaiting"). ' - '. 'awaiting'; ?> </option>
            <option value="failed" <?php if(\dash\data::domainDetail_status() === 'failed') {echo 'selected'; } ?>><?php echo T_("Failed"). ' - '. 'failed'; ?> </option>
            <option value="pending" <?php if(\dash\data::domainDetail_status() === 'pending') {echo 'selected'; } ?>><?php echo T_("Pending"). ' - '. 'pending'; ?> </option>
            <option value="enable" <?php if(\dash\data::domainDetail_status() === 'enable') {echo 'selected'; } ?>><?php echo T_("Enable"). ' - '. 'enable'; ?> </option>
            <option value="disable" <?php if(\dash\data::domainDetail_status() === 'disable') {echo 'selected'; } ?>><?php echo T_("Disable"). ' - '. 'disable'; ?> </option>
            <option value="deleted" <?php if(\dash\data::domainDetail_status() === 'deleted') {echo 'selected'; } ?>><?php echo T_("Deleted"). ' - '. 'deleted'; ?> </option>
            <option value="expire" <?php if(\dash\data::domainDetail_status() === 'expire') {echo 'selected'; } ?>><?php echo T_("Expire"). ' - '. 'expire'; ?> </option>
          </select>
        </div>

      </div>
      <footer class="txtRa">
        <button class="btn warn"><?php echo T_("Change status") ?></button>
      </footer>
    </div>
  </form>
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
      <td class="txtRa">
        <a rel="nofollow" target="_blank" class="btn secondary sm outline" href="https://intodns.com/<?php echo \dash\data::domainDetail_name(); ?>"><?php echo T_("check DNS server and mail server health"); ?></a>
        <a target="_blank" class="btn secondary sm outline" href="<?php echo \dash\url::sitelang().'/whois/'. \dash\data::domainDetail_name(); ?>"><?php echo T_("Whois?"); ?></a>
      </td>
     </tr>
     <?php if(\dash\data::domainDetail_ns1()) {?>
     <tr>
      <td class="ltr txtL"><?php echo \dash\data::domainDetail_ip1() ?></td>
      <td class="ltr txtL"><?php echo \dash\data::domainDetail_ns1() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ns2()) {?>
     <tr>
       <td class="ltr txtL"><?php echo \dash\data::domainDetail_ip2() ?></td>
       <td class="ltr txtL"><?php echo \dash\data::domainDetail_ns2() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ns3()) {?>
     <tr>
      <td class="ltr txtL"><?php echo \dash\data::domainDetail_ip3() ?></td>
      <td class="ltr txtL"><?php echo \dash\data::domainDetail_ns3() ?></td>
     </tr>
     <?php } //endif ?>

     <?php if(\dash\data::domainDetail_ns4()) {?>
     <tr>
      <td class="ltr txtL"><?php echo \dash\data::domainDetail_ip4() ?></td>
      <td class="ltr txtL"><?php echo \dash\data::domainDetail_ns4() ?></td>
     </tr>
     <?php } //endif ?>
    </table>
  </div>

  <div class="panel mB10">
    <table class="tbl1 v4 mB0">
      <tr>
        <td colspan="2" ><?php echo T_("This detail was founded in whois answer") ?></td>
      </tr>
     <tr>
      <td><?php echo T_("Email") ?></td>
      <td class="txtRa"><?php echo \dash\data::domainDetail_email() ?></td>
     </tr>

     <tr>
      <td><?php echo T_("Mobile") ?></td>
      <td class="txtRa"><?php echo \dash\fit::mobile(\dash\data::domainDetail_mobile()) ?></td>
     </tr>
     <tr>
      <td><?php echo T_("Last check domain owner with whois") ?></td>
      <td class="txtRa"><?php echo \dash\fit::date_time(\dash\data::domainDetail_ownercheckdate()) ?></td>
     </tr>

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
     <?php if(\dash\data::domainDetail_reseller()) {?>
     <tr class="positive">
      <td>
        <?php echo T_("Reseller") ?>
      </td>
      <td class="txtRa ltr txtB"><?php echo \dash\data::domainDetail_reseller(); ?></td>
     </tr>
   <?php } //endif ?>
    </table>
  </div>


<?php if(\dash\data::domainDetail_nicstatus_array()) {?>
<div class="panel mB10">
 <table class="tbl1 v4 mB0">
  <?php
   if(\dash\data::domainDetail_nicstatus_array())
    {
      foreach (\dash\data::domainDetail_nicstatus_array() as $key => $value)
      {
        echo '<tr>';

        if(mb_strtolower($value) === 'ok')
        {
          echo "<td>".T_("Domain is OK"). "</td>";
        }
        else
        {
          echo "<td>". T_($value). "</td>";
        }

        if(\dash\language::current() === 'fa')
        {
          echo '<td class="ltr txtRa">' . $value. "</td>";
        }
        echo '</tr>';
      }
    }
  ?>
  </table>
</div>
<?php } //endif ?>




<?php if(\dash\data::NICdomainStatus()) {?>
  <div class="c6 s12 pLa5">
    <div class="panel mB10">
      <table class="tbl1 v4 mB0">
        <thead>
          <th class="collapsing"></th>
          <th class="fs08"><?php echo T_("Status") ?></th>

          <th class="fs08"><?php echo T_("Date created") ?></th>
          <th class="fs08"><?php echo T_("Date modified") ?></th>
        </thead>
        <tbody>
          <?php foreach (\dash\data::NICdomainStatus() as $key => $value) {?>
            <tr <?php if(\dash\get::index($value, 'active')) {echo 'class="positive"';}else{echo 'class="negative"';} ?>>
              <td><?php if(\dash\get::index($value, 'active')) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } ?></td>
              <td><?php echo \dash\get::index($value, 'status'); ?></td>
              <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datecreated')); ?></td>
              <td><?php echo \dash\fit::date_time(\dash\get::index($value, 'datemodified')); ?></td>
            </tr>
          <?php } // endfor ?>

        </tbody>
      </table>
    </div>
  </div>
<?php } //endif ?>





  <?php if(\dash\permission::supervisor()) {?>
  <div class="panel mB10">
    <table class="tbl1 v4 mB0">
      <tr>
      <td>
        <?php echo T_("Available"); ?>
      </td>
      <td class="txtRa ltr"><?php if(\dash\data::domainDetail_available()) {?><i class="sf-check fc-green"></i><?php }else{ ?><i class="sf-times fc-red"></i><?php } ?></td>
     </tr>

      <tr>
      <td>
        <?php echo T_("Status"); ?>
      </td>
      <td class="txtRa ltr"><?php echo T_(\dash\data::domainDetail_status()); ?></td>
     </tr>

      <tr>
      <td>
        <?php echo T_("Last fetch"); ?>
      </td>
      <td class="txtRa ltr"><?php echo \dash\fit::date_human(\dash\data::domainDetail_lastfetch()); ?></td>
     </tr>

     <tr>
      <td>
        <?php echo T_("Remove to check again"); ?>
      </td>
      <td class="txtRa ltr">
        <div data-confirm data-data='{"clean" : "lastfetch"}' class="btn secondary outline"><?php echo T_("Clean fetch") ?></div>
      </td>
     </tr>

    </table>
  </div>
<?php } //endif ?>




 </div>
</div>
