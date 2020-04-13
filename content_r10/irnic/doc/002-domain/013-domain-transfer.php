<div class="box">
  <header>
    <h2 class="f" data-kerkere='#domain-transfer' data-kerkere-icon='open'>
      <span class="cauto pRa10"><span class="badge primary">POST</span></span>
      <span class="c"><?php echo T_("Transfer domain"); ?></span>
    </h2>
  </header>
  <div class="body" id="domain-transfer">
      <div>

        <div class="msg url ltr txtL">
          <i class="method">POST</i>
          <span><?php echo \dash\data::IRNICApiURL(); ?><b>domain/transfer</b></span>
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
               <span><?php echo T_("Domain to transfer"); ?></span>
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
                <div class="txtB">pin</div>
                <i>String</i>
              </td>
              <td>
               <span><?php echo T_("Domain pin"); ?></span>
               <br>
               <i><code>abc123</code></i>

              </td>
              <td>
                <div class="fc-red"><i><?php echo T_("Required"); ?></i></div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>


        <h3><?php echo T_("cURL"); ?> <small><?php echo T_("example"); ?></small></h3>
<pre>
curl <?php if(\dash\url::isLocal()) { echo '-k '; } ?>-X POST '<?php echo \dash\data::IRNICApiURL(); ?>domain/transfer' \
-H 'appkey: <?php echo \dash\data::myAppKey(); ?>' \
-H 'apikey: <?php echo \dash\data::myApiKey(); ?>' \
-H 'Content-Type: application/json' \
--data-raw '{"agree" : 1, "domain": "rezamohiti.ir", "nic_id" : "ex66-irnic", "pin": "abc123"}'
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

