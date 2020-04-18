<div class="f justify-center">
  <div class="c6 m8 s12">

    <form method="post" autocomplete="off" class="box impact">
      <header><h2><?php echo T_("Your domain ready to register"); ?></h2></header>

      <div class="body zeroPad">
        <table class="tbl1 v4">
          <tbody>
            <tr>
              <td><?php echo T_("Domain") ?></td>
              <td class="ltr floatL txtB"><code><?php echo \dash\data::dataRow_name(); ?></code></td>
            </tr>
            <tr>
              <td><?php echo T_("IRNIC Admin") ?></td>
              <td class="ltr floatL"><code><?php echo \dash\data::dataRow_admin(); ?></code></td>
            </tr>
            <tr>
              <td><?php echo T_("IRNIC Billing") ?></td>
              <td class="ltr floatL"><code><?php echo \dash\data::dataRow_bill(); ?></code></td>
            </tr>
            <tr>
              <td><?php echo T_("IRNIC Technical") ?></td>
              <td class="ltr floatL"><code><?php echo \dash\data::dataRow_tech(); ?></code></td>
            </tr>
            <tr>
              <td><?php echo T_("IRNIC Holder") ?></td>
              <td class="ltr floatL"><code><?php echo \dash\data::dataRow_holder(); ?></code></td>
            </tr>

            <?php if(\dash\data::dataRow_ns1()) {?>
              <tr>
                <td><?php echo T_("DNS #1") ?></td>
                <td class="ltr floatL"><code><?php echo \dash\data::dataRow_ns1(); ?></code></td>
              </tr>
            <?php } //endif ?>

            <?php if(\dash\data::dataRow_ns2()) {?>
              <tr>
                <td><?php echo T_("DNS #2") ?></td>
                <td class="ltr floatL"><code><?php echo \dash\data::dataRow_ns2(); ?></code></td>
              </tr>
            <?php } //endif ?>

            <?php if(\dash\data::dataRow_ns3()) {?>
              <tr>
                <td><?php echo T_("DNS #3") ?></td>
                <td class="ltr floatL"><code><?php echo \dash\data::dataRow_ns3(); ?></code></td>
              </tr>
            <?php } //endif ?>

            <?php if(\dash\data::dataRow_ns4()) {?>
              <tr>
                <td><?php echo T_("DNS #4") ?></td>
                <td class="ltr floatL"><code><?php echo \dash\data::dataRow_ns4(); ?></code></td>
              </tr>
            <?php } //endif ?>

            <?php $period = null; ?>
            <tr>
              <td><?php echo T_("Period") ?></td>
              <td class="ltr floatL"><?php if(\dash\data::dataRowAction_period() == '12') { echo T_("1 Year"); $period = '1year'; }elseif(\dash\data::dataRowAction_period() == '60'){echo T_("5 Year"); $period = '5year'; }else{echo T_("Unknown");} ?></td>
            </tr>

            <?php if($period) {?>
              <tr>
                <td><?php echo T_("Price") ?></td>
                <td class="ltr floatL"><?php echo \lib\app\nic_domain\price::register_string($period); ?> </td>
              </tr>
            <?php } // endif ?>




          </tbody>
        </table>

      </div>

      <footer class="txtRa">
        <button class="btn success"><?php echo T_("Register domain"); ?></button>
      </footer>
    </form>
  </div>
</div>