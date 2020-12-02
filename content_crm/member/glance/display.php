<?php
$myID = '?id='. \dash\request::get('id');
$dashboardDetail = \dash\data::dashboardDetail();


?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-4">

    <nav class="items long">
      <ul>
        <li>
          <a class="item f">
            <div class="key"><?php echo T_('Account Create Date');?></div>
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
          <a class="item f disabled" href="<?php echo \dash\url::that(). '/logins?id='. \dash\request::get('id');?>">
            <div class="key"><?php echo T_('Last login at');?></div>
            <div class="value"><?php echo \dash\fit::date_time(\dash\get::index($dashboardDetail, 'last_login'));?></div>
            <div class="go detail"></div>
          </a>
        </li>
         <li>
<?php if(\dash\get::index($dashboardDetail, 'last_ip')) {?>
          <a class="item f" target="_blank" href="<?php echo \dash\url::kingdom(). '/ip/'. \dash\get::index($dashboardDetail, 'last_ip');?>">
            <div class="key"><?php echo T_('Last IP');?></div>
            <code class="value"><?php echo \dash\get::index($dashboardDetail, 'last_ip');?></code>
            <div class="go surveillance"></div>
          </a>
<?php } else {?>
          <a class="item f">
            <div class="key"><?php echo T_('Last IP');?></div>
            <div class="value"><?php echo T_("Not logged in yet!");?></div>
            <div class="go surveillance"></div>
          </a>
<?php }?>
        </li>
      </ul>
    </nav>


    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_('Last order');?></div>
            <div class="value"><?php echo \dash\fit::date_time(\dash\get::index($dashboardDetail, 'last_order'));?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_('Total payed');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardDetail, 'total_paid'));?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_('Average order pay');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardDetail, 'average_order_pay'));?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_('Balance');?></div>
            <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardDetail, 'balance'));?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">

  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items long">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <img src="<?php echo \dash\data::dataRowMember_avatar() ?>">
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
            <div class="value"><?php echo \dash\fit::number(\dash\get::index($dashboardDetail, 'cart_count')) ?></div>
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
          <a class="item f disabled" href="<?php echo \dash\url::pwd();?>">
            <div class="key"><?php echo T_("Payments") ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f disabled" href="<?php echo \dash\url::pwd();?>">
            <div class="key"><?php echo T_("Tickets") ?></div>
            <div class="go"></div>
          </a>
        </li>

        <li>
          <a class="item f disabled" href="<?php echo \dash\url::pwd();?>">
            <div class="key"><?php echo T_("Messages") ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

    <nav class="items long">
      <ul>
        <li>
          <a class="item f disabled" href="<?php echo \dash\url::pwd();?>">
            <div class="key"><?php echo T_("Sessions") ?></div>
            <div class="go"></div>
          </a>
        </li>

         <li>
          <a class="item f disabled" href="<?php echo \dash\url::pwd();?>">
            <div class="key"><?php echo T_("Customer Logs History") ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

  </div>
</div>
