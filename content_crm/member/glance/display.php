<?php
$inStore = \dash\engine\store::inStore();
$myID = '?id='. \dash\request::get('id');
$dashboardDetail = \dash\data::dashboardDetail();

$dataRowMember = \dash\data::dataRowMember();

if(a($dataRowMember,  'status') === 'ban')
{
  $banMessage = '';
  $banMessage .= '<div class="msg danger2 font-14 "><div class="row align-center">';
  {
    $banMessage .= '<div class="cauto">';
    {
      $banMessage .= T_("This user is banned");
      if(a($dataRowMember, 'ban_expire'))
      {
        $banMessage .= ' '. T_("Expire ban on"). ' '. \dash\fit::date_time(a($dataRowMember, 'ban_expire'));
      }
    }
    $banMessage .='</div>';
    $banMessage .= '<div class="c"></div>';

    $banMessage .= '<div class="cauto">';
    {
      $banMessage .= '<div class="btn success" data-confirm data-data=\'{"resetban": "resetban"}\'>'. T_("Reset user now"). '</div>';
    }
    $banMessage .='</div>';
  }
  $banMessage .='</div></div>';

  echo $banMessage;
}

// business_list
?>



<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-8">
    <?php if($inStore) {?>
    <section class="row">
     <div class="c-xs-6 c-sm-4">
      <a href="<?php echo \dash\url::kingdom(). '/a/order?customer='. \dash\request::get('id'); ?>"  class="stat">
       <h3><?php echo T_("Active Order");?></h3>
       <div class="val"><?php echo \dash\fit::number(a($dashboardDetail, 'active_order'));?></div>
      </a>
     </div>
     <div class="c-xs-6 c-sm-4">
      <a href="<?php echo \dash\url::here(). '/ticket/datalist?user='. \dash\request::get('id') ?>" class="stat">
       <h3><?php echo T_("Tickets");?></h3>
       <div class="val"><?php echo \dash\fit::number(a($dashboardDetail, 'active_ticket'));?></div>
      </a>
     </div>
     <div class="c-xs-12 c-sm-4">
      <a href="<?php echo \dash\url::this(). '/transactions'. $myID ?>" class="stat <?php if(a($dashboardDetail, 'balance')>0) echo " green"; ?>">
       <h3><?php echo T_("Account Balance");?> <small><?php echo \lib\store::currency() ?></small></h3>
       <div class="val"><?php echo \dash\fit::number(a($dashboardDetail, 'balance'));?></div>
      </a>
     </div>
    </section>
  <?php }else{ // in jibres mode ?>
    <section class="row">
      <div class="c-xs-6 c-sm-3">
      <a href="<?php echo \dash\url::kingdom(). '/love/store?user='. \dash\request::get('id'); ?>"  class="stat">
       <h3><?php echo T_("Business Count");?></h3>
       <div class="val"><?php echo \dash\fit::number(a($dashboardDetail, 'business_count'));?></div>
      </a>
     </div>
     <div class="c-xs-6 c-sm-3">
      <a href="<?php echo \dash\url::kingdom(). '/love/domain/all?user='. \dash\request::get('id'); ?>"  class="stat">
       <h3><?php echo T_("Domain Count");?></h3>
       <div class="val"><?php echo \dash\fit::number(a($dashboardDetail, 'domains_count'));?></div>
      </a>
     </div>
     <div class="c-xs-6 c-sm-3">
      <a href="<?php echo \dash\url::here(). '/ticket/datalist?user='. \dash\request::get('id') ?>" class="stat">
       <h3><?php echo T_("Tickets");?></h3>
       <div class="val"><?php echo \dash\fit::number(a($dashboardDetail, 'active_ticket'));?></div>
      </a>
     </div>
     <div class="c-xs-12 c-sm-3">
      <a href="<?php echo \dash\url::this(). '/transactions'. $myID ?>" class="stat <?php if(a($dashboardDetail, 'balance')>0) echo " green"; ?>">
       <h3><?php echo T_("Account Balance");?> <small><?php echo \lib\store::currency() ?></small></h3>
       <div class="val"><?php echo \dash\fit::number(a($dashboardDetail, 'balance'));?></div>
      </a>
     </div>
    </section>
  <?php } //endif ?>


    <div class="row">
      <div class="c-xs-12 c-sm-12 c-md-6">
        <nav class="items long">
          <ul>
            <li>
              <a class="item f">
                <div class="key"><?php echo T_('Registration Date');?></div>
                <div class="value datetime"><?php echo \dash\fit::date_time(\dash\data::dataRowMember_datecreated());?></div>
                <div class="go detail"></div>
              </a>
            </li>
            <li>
              <a class="item f">
                <div class="key"><?php echo T_('Last Updated');?></div>
                <div class="value datetime"><?php echo \dash\fit::date_time(\dash\data::dataRowMember_datecreated());?></div>
                <div class="go detail"></div>
              </a>
            </li>
            <li>
              <a class="item f" href="<?php echo \dash\url::this(). '/sessions?id='. \dash\request::get('id');?>">
                <div class="key"><?php echo T_('Last login at');?></div>
                <div class="value ltr"><?php echo \dash\fit::date_time(a($dashboardDetail, 'last_login'));?></div>
                <div class="go"></div>
              </a>
            </li>
             <li>
<?php if(a($dashboardDetail, 'last_ip')) {?>
              <a class="item f" target="_blank" href="<?php echo \dash\url::kingdom(). '/ip/'. a($dashboardDetail, 'last_ip');?>">
                <div class="key"><?php echo T_('Last IP');?></div>
                <code class="value"><?php echo a($dashboardDetail, 'last_ip');?></code>
                <div class="go external"></div>
              </a>
<?php } else {?>
              <a class="item f">
                <div class="key"><?php echo T_('Last IP');?></div>
                <div class="value"><?php echo T_("Not logged in yet!");?></div>
                <div class="go surveillance"></div>
              </a>
<?php }?>
            </li>
            <?php if(!$inStore) {?>
            <li>
              <a class="item f" href="<?php echo \dash\url::kingdom(). '/love/emails?user='. \dash\request::get('id');?>">
                <div class="key"><?php echo T_('Email count');?></div>
                <div class="value ltr"><?php echo \dash\fit::number(a($dashboardDetail, 'emails_count'));?></div>
                <div class="go"></div>
              </a>
            </li>
          <?php  }//endif ?>
          </ul>
        </nav>
      </div>
      <div class="c-xs-12 c-sm-12 c-md-6">
        <nav class="items long">
          <ul>
            <li>
              <a class="item f" href="<?php echo \dash\url::this(). '/transactions'. $myID ?>">
                <div class="key"><?php echo T_('Last payment');?></div>
                <div class="value"><?php echo \dash\fit::price(a($dashboardDetail, 'last_payment'));?> <?php echo \lib\store::currency() ?></div>
                <div class="go"></div>
              </a>
            </li>
            <li>
              <a class="item f" href="<?php echo \dash\url::this(). '/transactions'. $myID ?>">
                <div class="key"><?php echo T_('Total payed');?></div>
                <div class="value"><?php echo \dash\fit::price(a($dashboardDetail, 'total_paid'));?> <?php echo \lib\store::currency() ?></div>
                <div class="go"></div>
              </a>
            </li>
             <li>
              <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/order?customer='. \dash\request::get('id'); ?>">
                <div class="key"><?php echo T_('Total buy');?></div>
                <div class="value"><?php echo \dash\fit::price(a($dashboardDetail, 'total_order_pay'));?> <?php echo \lib\store::currency() ?></div>
                <div class="go"></div>
              </a>
            </li>
            <li>
              <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/order?customer='. \dash\request::get('id'); ?>">
                <div class="key"><?php echo T_('Average order pay');?></div>
                <div class="value"><?php echo \dash\fit::price(a($dashboardDetail, 'average_order_pay'));?> <?php echo \lib\store::currency() ?></div>
                <div class="go"></div>
              </a>
            </li>
             <?php if(!$inStore) {?>
            <li>
              <a class="item f" href="<?php echo \dash\url::this(). '/business?id='. \dash\request::get('id');?>">
                <div class="key"><?php echo T_('Business limit');?></div>
                <div class="value ltr"><?php if(!a(\dash\data::dataRowMember(), 'businesscount')) {echo T_("Default");}else{ echo \dash\fit::number(a(\dash\data::dataRowMember(), 'businesscount'));}?></div>
                <div class="go"></div>
              </a>
            </li>
          <?php  }//endif ?>
          </ul>
        </nav>
      </div>
    </div>


    <div class="row font-14">
      <div class="c-xs-12 c-sm-12 c-md-6">
        <p class="mB0-f"><?php echo T_("Last orders"); ?></p>
        <?php if(a($dashboardDetail, 'last_5_order')) {?>
        <nav class="items long">
          <ul>
          <?php foreach (a($dashboardDetail, 'last_5_order') as $key => $value) { ?>
             <li>
              <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/order/detail?id='. $value['id']; ?>">
                <div class="key">#<?php echo \dash\fit::text(a($value, 'id'));?></div>
                <div class="value"><?php echo \dash\fit::number(a($value, 'total')) . ' '. \lib\store::currency();?></div>
                <div class="value s0"><?php echo \dash\fit::date_human(a($value, 'datecreated'));?></div>
                <div class="go"></div>
              </a>
            </li>
          <?php } //endfor ?>
         </ul>
        </nav>
        <?php } else { ?>
          <p class="msg"><?php echo T_("Not yet ordered."); ?></p>
        <?php } // endif ?>
      </div>
      <div class="c-xs-12 c-sm-12 c-md-6">
        <p class="mB0-f"><?php echo T_("Last tickets"); ?></p>
        <?php if(a($dashboardDetail, 'last_5_ticket')) {?>
        <nav class="items long">
          <ul>
          <?php  foreach (a($dashboardDetail, 'last_5_ticket') as $key => $value) { ?>
             <li>
              <a class="item f" href="<?php echo \dash\url::here(). '/ticket/view?id='. $value['id'] ?>">
                <div class="key"><?php echo T_("Ticket"). ' #'. \dash\fit::text(a($value, 'id'));?></div>
                <div class="value"><?php echo \dash\fit::date_human(a($value, 'datecreated'));?></div>
                <div class="go"></div>
              </a>
            </li>
          <?php } //endfor ?>
         </ul>
        </nav>
        <?php } else { ?>
          <p class="msg"><?php echo T_("No ticket have been received so far"); ?></p>
        <?php } // endif ?>
      </div>
    </div>

  </div>

  <div class="c-xs-12 c-sm-12 c-md-4 order-xs-first order-sm-first order-md-2">
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <img src="<?php echo \dash\fit::img(\dash\data::dataRowMember_avatar()); ?>">
            <div class="key txtB"><?php echo \dash\data::dataRowMember_displayname();?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/mobile'. $myID;?>">
            <div class="key"><?php echo T_("Mobile") ?></div>
            <div class="value ltr txtB"><?php echo \dash\fit::mobile(\dash\data::dataRowMember_mobile());?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/email'. $myID;?>">
            <div class="key"><?php echo T_("Email") ?></div>
            <div class="value ltr"><?php echo \dash\data::dataRowMember_email(); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/permission'. $myID;?>">
            <div class="key"><?php echo T_("Permission") ?></div>
            <div class="value txtB"><?php echo \dash\data::dataRowMember_permission() === 'admin' ? T_("Admin") : \dash\data::dataRowMember_permission(); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/status'. $myID;?>">
            <div class="key"><?php echo T_("Status") ?></div>
            <div class="value<?php if(\dash\data::dataRowMember_status() == 'active') {echo ' fc-green';} ?>"><?php echo T_(\dash\data::dataRowMember_status()); ?></div>
            <div class="go<?php if(\dash\data::dataRowMember_status() == 'active') {echo ' ok check';} ?>"></div>
          </a>
        </li>
        <?php if(\dash\permission::supervisor()) {?>
        <li>
          <a class="item f" target="_blank" href="<?php echo \dash\url::kingdom(). '/enter?mobile='. \dash\data::dataRowMember_mobile();?>">
            <div class="key"><?php echo T_("Enter by this user") ?></div>
            <div class="go"></div>
          </a>
        </li>
      <?php } //endif ?>

      </ul>
    </nav>
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/identification'. $myID;?>">
            <div class="key"><?php echo T_("Identification detail") ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/legal'. $myID;?>">
            <div class="key"><?php echo T_("Legal information") ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

     <nav class="items long">
      <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/address'. $myID;?>">
          <div class="key"><?php echo T_("Addresses") ?></div>
          <div class="go"></div>
        </a>
       </li>
      </ul>
    </nav>

     <nav class="items long">
      <ul>
         <li>
          <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/order?customer='. \dash\request::get('id');?>">
            <div class="key"><?php echo T_("Orders") ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::kingdom(). '/a/cart/add?user='. \dash\request::get('id');?>">
            <div class="key"><?php echo T_("Cart") ?></div>
            <div class="value"><?php echo \dash\fit::number(a($dashboardDetail, 'cart_count')) ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>


     <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/description'. $myID;?>">
            <div class="key"><?php echo T_("Notes") ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/transactions'. $myID;?>">
            <div class="key"><?php echo T_("Payments") ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/transactions/plus'. $myID;?>">
            <div class="key"><?php echo T_("Increase account recharge") ?></div>
            <div class="go plus ok"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/transactions/minus'. $myID;?>">
            <div class="key"><?php echo T_("Reduce account recharge") ?></div>
            <div class="go minus-circle nok"></div>
          </a>
        </li>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::here(). '/ticket/datalist?user='. \dash\request::get('id') ?>">
            <div class="key"><?php echo T_("Tickets") ?></div>
            <div class="go"></div>
          </a>
        </li>

        <li>
          <a class="item f" href="<?php echo \dash\url::here(). '/notification/datalist?touser='. \dash\request::get('id');?>">
            <div class="key"><?php echo T_("Messages") ?></div>
            <div class="go"></div>
          </a>
        </li>


        <li>
          <a class="item f" href="<?php echo \dash\url::here(). '/notification/send?user='. \dash\request::get('id');?>">
            <div class="key"><?php echo T_("Send message") ?></div>
            <div class="go plus ok"></div>
          </a>
        </li>

        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/sessions'. $myID;?>">
            <div class="key"><?php echo T_("Sessions") ?></div>
            <div class="go"></div>
          </a>
        </li>

         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/log'. $myID;?>">
            <div class="key"><?php echo T_("Customer Logs History") ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

  </div>
</div>
