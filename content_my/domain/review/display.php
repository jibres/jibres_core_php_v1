<div class="avand">

<?php require_once(core. 'layout/tools/stepGuide.php'); ?>

<?php $giftCode = 0; ?>


<div class="f">
  <div class="c4 s12 pRa10">

    <div class="stat">
     <h3><?php echo \dash\data::myActionTitle();?></h3>
     <div class="val ltr"><?php echo \dash\data::dataRow_name(); ?></div>
    </div>

    <?php if(\dash\data::myPeriodTitle()) {?>
    <nav class="items">
     <ul>
      <li>
       <div class="f item">
        <div class="key"><?php echo T_('Domain Period');?></div>
        <div class="value ltr font-bold"><?php echo \dash\data::myPeriodTitle(); ?></div>
        <div class="go detail"></div>
       </div>
      </li>
     </ul>
    </nav>
  <?php } //endif ?>

<?php if (\dash\request::get('type') === 'register'): ?>

    <?php if(\dash\data::internationalDomain()) { /* nothing  */ }else{?>

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
  <?php } //endif ?>


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
    <?php if(\dash\data::MustSetReseller()) {?>
        <div class="alert-warning fs14">
          <?php  echo  T_("To make full use of jibres domain services, please go to nic.ir and set domain reseller on 'ji128-irnic'"); ?>
        </div>
    <?php }//endif ?>

    <?php if(\dash\data::nicMaybeError()) {?>

        <div class="alert-danger fs14">
          <p><?php
            echo
            T_("We can not detect the reseller or billing contact of this account"). '. '.
            T_("If you are administrator of this domain Your must go to nic.ir and set billing holder of this domain on 'ji128-irnic' ") .' '.
            T_("Your request maybe rejected from IRNIC!"); ?>
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
            <button class="btn-primary addon"><?php echo T_("Apply"); ?></button>
          </div>
        </form>

<?php if(\dash\request::get('gift')) {?>
  <?php if(\dash\data::giftDetail_msgsuccess()) {?>
            <div class="alert-success"><?php echo nl2br(\dash\data::giftDetail_msgsuccess()); ?></div>
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
    echo '<div class="alert-danger f align-center">';
      echo '<div class="c" id="giftcardmessageerror">';
      if(\dash\data::gitfErrorMessage())
      {
        echo \dash\data::gitfErrorMessage();
      }
      else
      {
        echo T_("Invalid gift code"). ' 😔';
      }
      echo '</div>';
    echo '</div>';
  }
?>
<?php } // endif ?>
      </div>
    </div>


    <form method="post" autocomplete="off" data-timeout="0">
    <div class="box impact">
     <div class="body">
        <table class="tbl1 v5">
          <tbody>
<?php if($giftCode || \dash\data::userBudget()) {?>
           <tr data-price='<?php echo \dash\data::myPrice(); ?>'>
            <th><?php echo T_("Domain Price") ?></th>

            <td class="txtRa"><?php echo \dash\fit::number(\dash\data::myPrice()); ?> <?php echo T_("Toman") ?></td>


           </tr>
<?php } // endif ?>

<?php if($giftCode) {?>
           <tr data-gift='<?php echo $giftCode; ?>'>
            <th><?php echo T_("Your Gift") ?>
                <?php
                if(\dash\data::giftDetail_type() === 'percent')
                {
                  echo '(';
                  echo \dash\fit::number(\dash\data::giftDetail_giftpercent());
                  echo T_("%");
                  echo ')';
                }
                ?>
            </th>
            <td class="txtRa">
              <span><?php echo \dash\fit::number($giftCode);?></span>
              <span class="text-gray-400 mLa5"><?php echo \lib\currency::unit();?></span>
            </td>

           </tr>
<?php } // endif ?>
<?php $mypayedprice = \dash\data::myPrice() - $giftCode;  if($mypayedprice < 0) { $mypayedprice = 0; } ?>

<?php if(\dash\data::userBudget() && $mypayedprice) {?>
           <tr data-budget='<?php echo \dash\data::userBudget(); ?>'>
            <th>
              <div><?php echo T_("Account Balance") ?></div>
              <div class="check1">
                <input type="checkbox" name="usebudget" id="budget" >
                <label for="budget"><?php echo T_("Pay from my account balance"); ?></label>
              </div>
            </th>
            <td class="txtRa">
              <span><?php echo \dash\fit::number(\dash\data::userBudget());?></span>
              <span class="text-gray-400 mLa5"><?php echo \lib\currency::unit();?></span>
            </td>
           </tr>
<?php } //endif ?>

           <tr data-payable>
            <th><?php echo T_("Amount payable") ?></th>
            <td class="txtRa collapsing">
              <span class="font-bold fs20" id='domainPayablePrice'><?php echo \dash\fit::number($mypayedprice) ?></span>
              <span class="text-gray-400 mLa5"><?php echo \lib\currency::unit();?></span>
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
        <button class="btn-success"><?php echo \dash\data::buttonTitle(); ?></button>
      </div>
    </footer>
    </div>
      </form>



  </div>
</div>

</div>