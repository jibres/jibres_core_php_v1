<?php $giftCode = 0; ?>


<div class="f">
  <div class="c4 s12 pRa10">

    <div class="stat">
     <h3><?php echo \dash\data::myActionTitle();?></h3>
     <div class="val ltr"><?php echo \dash\data::dataRow_name(); ?></div>
    </div>

    <nav class="items">
     <ul>
      <li>
       <div class="f item">
        <div class="key"><?php echo T_('Domain Period');?></div>
        <div class="value ltr txtB"><?php if(\dash\data::myPeriod() == '1year') { echo T_("1 Year"); }elseif(\dash\data::myPeriod() == '5year'){echo T_("5 Year");}else{echo T_("Unknown");} ?></div>
        <div class="go detail"></div>
       </div>
      </li>
     </ul>
    </nav>

<?php if (\dash\request::get('type') === 'register'): ?>

    <nav class="items">
     <ul>
      <li>
       <div class="f item">
        <div class="key"><?php echo T_('Domain Holder');?></div>
        <code class="value ltr"><?php echo \dash\data::dataRow_holder(); ?></code>
       </div>
      </li>
      <li>
       <div class="f item">
        <div class="key"><?php echo T_('Domain Admin');?></div>
        <code class="value ltr"><?php echo \dash\data::dataRow_admin(); ?></code>
       </div>
      </li>
      <li>
       <div class="f item">
        <div class="key"><?php echo T_('Domain Technical');?></div>
        <code class="value ltr"><?php echo \dash\data::dataRow_tech(); ?></code>
       </div>
      </li>
      <li>
       <div class="f item">
        <div class="key"><?php echo T_('Domain Billing');?></div>
        <code class="value ltr"><?php echo \dash\data::dataRow_bill(); ?></code>
       </div>
      </li>
     </ul>
    </nav>


    <nav class="items">
     <ul>

      <li>
       <div class="f item">
        <div class="key"><?php echo T_('DNS #1');?></div>
<?php if(\dash\data::dataRow_ns1()) {?>
        <code class="value ltr"><?php echo \dash\data::dataRow_ns1(); ?></code>
<?php } else { ?>
        <code class="value ltr">-</code>
<?php } //endif ?>
       </div>
      </li>

      <li>
       <div class="f item">
        <div class="key"><?php echo T_('DNS #2');?></div>
<?php if(\dash\data::dataRow_ns2()) {?>
        <code class="value ltr"><?php echo \dash\data::dataRow_ns2(); ?></code>
<?php } else { ?>
        <code class="value ltr">-</code>
<?php } //endif ?>
       </div>
      </li>

<?php if(\dash\data::dataRow_ns3()) {?>
      <li>
       <div class="f item">
        <div class="key"><?php echo T_('DNS #3');?></div>
        <code class="value ltr"><?php echo \dash\data::dataRow_ns3(); ?></code>
       </div>
      </li>
<?php } //endif ?>

<?php if(\dash\data::dataRow_ns4()) {?>
      <li>
       <div class="f item">
        <div class="key"><?php echo T_('DNS #4');?></div>
        <code class="value ltr"><?php echo \dash\data::dataRow_ns4(); ?></code>
       </div>
      </li>
<?php } //endif ?>


     </ul>
   </nav>
<?php endif ?>

  </div>
  <div class="c s12">

    <?php if(\dash\data::nicMaybeError()) {?>

        <div class="msg warn fs14">
          <p>
            <?php echo T_("We can not detect the reseller or billing contact of this account"); ?>
            <br>
            <?php echo T_("If you are administrator of this domain Your must go to nic.ir and set billing holder of this domain on 'ji128-irnic' "); ?>
            <br>
            <?php echo T_("Your request maybe rejected from IRNIC!"); ?>
          </p>

        </div>
    <?php } //endif ?>

    <div class="box impact">
      <div class="body">
        <form method="get" autocomplete="off" action="<?php echo \dash\url::that(); ?>">
          <input type="hidden" name="id" value="<?php echo \dash\request::get('id'); ?>">
          <input type="hidden" name="type" value="<?php echo \dash\request::get('type'); ?>">
          <label for="gift"><?php echo T_("If you have gift cart enter here") ?> 🎁</label>
          <div class="input ltr">
            <input type="text" name="gift"  value="<?php echo \dash\request::get('gift'); ?>" id="gift" maxlength="50" placeholder='<?php echo T_("Gift code") ?>'>
            <button class="btn primary addon"><?php echo T_("Check"); ?></button>
          </div>
        </form>

<?php if(\dash\request::get('gift')) {?>
  <?php if(\dash\data::giftDetail_msgsuccess()) {?>
            <div class="msg success"><?php echo nl2br(\dash\data::giftDetail_msgsuccess()); ?></div>
  <?php }// endif ?>
<?php
$giftCode = \dash\data::giftDetail_discount();
  if(\dash\data::giftDetail_type() === 'percent')
  {
    // echo T_("Gift percent"). ':';
    // echo \dash\fit::number(\dash\data::giftDetail_giftpercent());
    // echo T_("%");
  }
  elseif(\dash\data::giftDetail_type() === 'amount')
  {
    // echo T_("Gift amount"). ':';
    // echo \dash\fit::number(\dash\data::giftDetail_giftamount());
  }
  else
  {
    echo '<div class="msg danger2 f align-center">';
      echo '<div class="c">';
        echo T_("Invalid gift code"). ' 😔';
      echo '</div>';
    echo '</div>';
  }
?>
<?php } // endif ?>
      </div>
    </div>


    <form method="post" autocomplete="off">
    <div class="box impact">
     <div class="body">
        <table class="tbl1 v5">
          <tbody>

           <tr data-price='<?php echo \dash\data::myPrice(); ?>'>
            <th><?php echo T_("Domain Price") ?></th>
            <?php if(\dash\data::myPeriod()) {?>
            <td class="txtRa"><?php echo \lib\app\nic_domain\price::register_string(\dash\data::myPeriod()); ?></td>
            <?php } else { ?>
            <td class="txtRa">-</td>
            <?php } // endif ?>
           </tr>

<?php if($giftCode) {?>
           <tr data-gift='<?php echo $giftCode; ?>'>
            <th><?php echo T_("Your Gift") ?></th>
            <td class="txtRa">
              <span><?php echo \dash\fit::number($giftCode);?> (
                <?php
                if(\dash\data::giftDetail_type() === 'percent')
                {
                  echo \dash\fit::number(\dash\data::giftDetail_giftpercent());
                  echo T_("%");
                }
                ?> )
              </span>
              <span class="fc-mute mLa5"><?php echo T_("Toman");?></span>
            </td>

           </tr>
<?php } // endif ?>

<?php if(\dash\data::userBudget()) {?>
           <tr data-budget='<?php echo \dash\data::userBudget(); ?>'>
            <th>
              <div><?php echo T_("Account Balance") ?></div>
              <div class="check1">
                <input type="checkbox" name="usebudget" id="budget" checked>
                <label for="budget"><?php echo T_("Pay from my account balance"); ?></label>
              </div>
            </th>
            <td class="txtRa">
              <span><?php echo \dash\fit::number(\dash\data::userBudget());?></span>
              <span class="fc-mute mLa5"><?php echo T_("Toman");?></span>
            </td>
           </tr>
<?php } //endif ?>

           <tr data-payable>
            <th><?php echo T_("Amount payable") ?></th>
            <td class="txtRa collapsing">
              <span class="txtB fs20" id='domainPayablePrice'><?php echo \dash\fit::number(\dash\data::myPrice() - \dash\data::userBudget() - $giftCode) ?></span>
              <span class="fc-mute mLa5"><?php echo T_("Toman");?></span>
            </td>
           </tr>

          </tbody>
        </table>
     </div>
    <footer class="f">
      <div class="cauto">
        <a href="<?php echo \dash\data::backUrl(); ?>" class="btn"><?php echo T_("Cancel") ?></a>
      </div>
      <div class="c"></div>
      <div class="cauto">
        <button class="btn success"><?php echo \dash\data::buttonTitle(); ?></button>
      </div>
    </footer>
    </div>
      </form>



  </div>
</div>
