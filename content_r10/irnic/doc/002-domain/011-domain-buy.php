<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-buy' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge primary">POST</span></span>
      <span class="c"><?php echo T_("Buy new domain"); ?></span>
    </h2>
  </header>
  <div class="body" id="domain-buy">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">POST</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/buy</b></span>
        </div>

        <?php require(root. 'content_r10/irnic/doc/000-public/header-appkey-apikey.php'); ?>

      <h3 class="mB20"><?php echo T_("Input Body"); ?></h3>

      <div class="tblBox">
        <table class="tbl1 v3">
          <thead>
            <tr>
              <th><?php echo T_("Name"); ?> <small><?php echo T_("type"); ?></small></th>
              <th><?php echo T_("Description"); ?> <small><?php echo T_("example"); ?></small></th>
              <th><?php echo T_("Constraints"); ?></th>
            </tr>
          </thead>
          <tbody>
             <tr>
              <td>
                <div class="txtB">agree</div>
                <i>Boolean</i>
              </td>
              <td>
                <?php
                  echo T_("You have read the :nic and agree to the :terms.",
                    [
                      'nic' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms/irnic">'. T_('IRNIC agreement') .'</a>',
                      'terms' => '<a rel="nofollow" target="_blank" href="'. \dash\url::kingdom(). '/terms">'. T_('Jibres Terms of Service') .'</a>'
                    ])
                ?>
              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="txtB">domain</div>
                <i>String</i>
              </td>
              <td>
               <span><?php echo T_("Domain to buy"); ?></span>
              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              </td>
            </tr>

             <tr>
              <td>
                <div class="txtB">period</div>
                <i>String</i>
              </td>
              <td>
               <span><?php echo T_("Buy for 1 year or 5 year"); ?></span>
               <br>
               <i><code>1year | 5year</code></i>

              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              </td>
            </tr>

             <tr>
              <td>
                <div class="txtB">nic_id</div>
                <i>String</i>
              </td>
              <td>
               <span><?php echo T_("Register holder"); ?></span>
               <br>
               <i><code>ex66-irnic</code></i>

              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
                <div><?php echo T_("The IRNIC handle must be exist in your domain contact list") ?></div>
              </td>
            </tr>


             <tr>
              <td>
                <div class="txtB">irnic_admin</div>
                <i>String</i>
              </td>
              <td>
               <span><?php echo T_("Register admin"); ?></span>
               <br>
               <i><code>ex66-irnic</code></i>
                <div><?php echo T_("Leave null to read from nic_id"); ?></div>
              </td>
              <td>
                <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
              </td>
            </tr>


             <tr>
              <td>
                <div class="txtB">irnic_tech</div>
                <i>String</i>
              </td>
              <td>
               <span><?php echo T_("Register technical"); ?></span>
               <br>
               <i><code>ex66-irnic</code></i>
                <div><?php echo T_("Leave null to read from nic_id"); ?></div>
              </td>
              <td>
                <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
              </td>
            </tr>

            <tr>
              <td>
                <div class="txtB">irnic_bill</div>
                <i>String</i>
              </td>
              <td>
               <span><?php echo T_("Register billing"); ?></span>
               <br>
               <i><code>ex66-irnic</code></i>
                <div><?php echo T_("Leave null to read from nic_id"); ?></div>
              </td>
              <td>
                <div class="fc-green"><i><?php echo T_("Optional"); ?></i></div>
              </td>
            </tr>

            <tr><td><div class="txtB">ns1</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ns2</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ns3</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">ns4</div><i>String</i></td><td></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>
            <tr><td><div class="txtB">dnsid</div><i>Code</i></td><td><?php echo T_("If you want to set dns from your dns list"); ?></td><td><div class="fc-green"><?php echo T_("Optional"); ?></div></td></tr>

          </tbody>
        </table>
      </div>


        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X POST '<?php echo \dash\data::IRNICApiURL(); ?>domain/buy' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
-H 'Content-Type: application/json' \
--data-raw '{"agree" : 1, "domain": "rezamohiti.ir", "period" : "1year", "nic_id" : "ex66-irnic"}'
</pre>

        <h3><?php echo T_("Response"); ?> <small><?php echo T_("example"); ?></small></h3>
<samp>{
  "ok": true,
  "msg": [
    {
      "type": "ok",
      "text": "Pay link https://jibres.ir/pay/36374d92aaa0bfad29994f8afe238a36"
    }
  ],
  "meta": {
    "token": "36374d92aaa0bfad29994f8afe238a36",
    "url": "https://jibres.ir/pay/36374d92aaa0bfad29994f8afe238a36"
  }
}</samp>
    </div>
  </div>
</div>

