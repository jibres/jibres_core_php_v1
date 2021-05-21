
 <div class="avand impact">
  <h3><?php echo T_("Jibres Domain Pricing Comparison"); ?></h3>
  <table class="tbl1 v5">
    <thead>
      <tr>
        <td><?php echo ""; ?></td>
        <td><?php echo T_(".ir 1 year"); ?></td>
        <td><?php echo T_(".ir 5 Year"); ?></td>
        <td><?php echo T_(".com 1 year"); ?></td>
        <td><?php echo T_("Auto Renew"); ?></td>
        <td><?php echo T_("Beautiful Panel"); ?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo T_("Jibres"); ?></td>
        <td><?php echo \dash\fit::number(\dash\data::domainPrice_ir1year()); ?></td>
        <td><?php echo \dash\fit::number(\dash\data::domainPrice_ir5year()); ?></td>
        <td><?php echo \dash\fit::number(\dash\data::domainPrice_com1year()); ?></td>
        <td>✔️</td>
        <td>✔️</td>
      </tr>
      <tr>
        <td>ایران سرور</td>
        <td><?php echo \dash\fit::number("6000"); ?></td>
        <td><?php echo \dash\fit::number("15000"); ?></td>
        <td>-</td>
        <td>❌</td>
        <td>❌</td>
      </tr>
      <tr>
        <td>پارس پک</td>
        <td><?php echo \dash\fit::number("7000"); ?></td>
        <td><?php echo \dash\fit::number("20000"); ?></td>
        <td>-</td>
        <td>❌</td>
        <td>❌</td>
      </tr>
      <tr>
        <td>آذر آنلاین</td>
        <td><?php echo \dash\fit::number("7900"); ?></td>
        <td><?php echo \dash\fit::number("29000"); ?></td>
        <td>-</td>
        <td>❌</td>
        <td>❌</td>
      </tr>
      <tr>
        <td>هاست ایران</td>
        <td><?php echo \dash\fit::number("12000"); ?></td>
        <td><?php echo \dash\fit::number("36000"); ?></td>
        <td>-</td>
        <td>❌</td>
        <td>❌</td>
      </tr>
      <tr>
        <td>ایران هاست</td>
        <td><?php echo \dash\fit::number("16000"); ?></td>
        <td><?php echo \dash\fit::number("48000"); ?></td>
        <td>-</td>
        <td>❌</td>
        <td>❌</td>
      </tr>

    </tbody>
  </table>
 </div>