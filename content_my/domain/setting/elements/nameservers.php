<section class="f" data-option='domain-nameservers'>
<?php if(\dash\data::domainDetail_verify()){ ?>
  <div class="c8 s12">
<?php } else {?>
  <div class="c12">
<?php } ?>
    <div class="data">
      <h3><?php echo T_("Nameservers");?></h3>
      <div class="body">
        <p><?php echo T_("Nameservers define your domain's current DNS provider. With Jibres, you can either use our Free DNS or DNS provided with domain registration and hosting services.");?></p>
      </div>
    </div>
  </div>
<?php if(\dash\data::domainDetail_verify()){ ?>
  <div class="c4 s12">
    <div class="action">
      <a class="btn primary" href="<?php echo \dash\url::that(). '/dns?domain='. \dash\request::get('domain') ?>"><?php echo T_("Update Name Servers") ?></a>
    </div>
  </div>
<?php } ?>
<?php
$ns1 = a(\dash\data::domainDetail(), 'ns1');
$ns2 = a(\dash\data::domainDetail(), 'ns2');
$ns3 = a(\dash\data::domainDetail(), 'ns3');
$ns4 = a(\dash\data::domainDetail(), 'ns4');

$jibresNameServers = ['h.ns.arvancdn.com', 'p.ns.arvancdn.com'];

if($ns1 || $ns2 || $ns3 || $ns4)
{
?>
  <table class="tbl1 minimal ltr">
    <tbody>
<?php if($ns1) {?>
      <tr>
        <th class="s0">Nameserver 1</th>
        <td><?php echo $ns1;?></td>
        <td class="collapsing pLa10-f"><?php
          if(in_array($ns1, $jibresNameServers)) { echo '<img class="mRa10" src="'. \dash\url::logo(). '" alt="'. T_("Jibres"). '">'; }
          if(a(\dash\data::domainDetail(), 'ip1')) { echo ' '. a(\dash\data::domainDetail(), 'ip1');}
        ?></td>
      </tr>
<?php }?>
<?php if($ns2) {?>
      <tr>
        <th class="s0">Nameserver 2</th>
        <td><?php echo $ns2;?></td>
        <td class="collapsing pLa10-f"><?php
          if(in_array($ns2, $jibresNameServers)) { echo '<img class="mRa10" src="'. \dash\url::logo(). '" alt="'. T_("Jibres"). '">'; }
          if(a(\dash\data::domainDetail(), 'ip2')) { echo ' '. a(\dash\data::domainDetail(), 'ip2');}
        ?></td>
      </tr>
<?php }?>
<?php if($ns3) {?>
      <tr>
        <th class="s0">Nameserver 3</th>
        <td><?php echo $ns3;?></td>
        <td class="collapsing pLa10-f"><?php
          if(in_array($ns3, $jibresNameServers)) { echo '<img class="mRa10" src="'. \dash\url::logo(). '" alt="'. T_("Jibres"). '">'; }
          if(a(\dash\data::domainDetail(), 'ip3')) { echo ' '. a(\dash\data::domainDetail(), 'ip3');}
        ?></td>
      </tr>
<?php }?>
<?php if($ns4) {?>
      <tr>
        <th class="s0">Nameserver 4</th>
        <td><?php echo $ns4;?></td>
        <td class="collapsing pLa10-f"><?php
          if(in_array($ns4, $jibresNameServers)) { echo '<img class="mRa10" src="'. \dash\url::logo(). '" alt="'. T_("Jibres"). '">'; }
          if(a(\dash\data::domainDetail(), 'ip4')) { echo ' '. a(\dash\data::domainDetail(), 'ip4');}
        ?></td>
      </tr>
<?php }?>
    </tbody>
  </table>
<?php } ?>
</section>
