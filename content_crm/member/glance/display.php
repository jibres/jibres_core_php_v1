<?php $myID = '?id='. \dash\request::get('id'); ?>
<div class="row">
  <div class="c-xs-12 c-sm-12 c-md-4">
    <nav class="items">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <img src="<?php echo \dash\data::dataRowMember_avatar() ?>">
            <div class="key"><?php echo \dash\data::dataRowMember_displayname();?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/mobile'. $myID;?>">
            <div class="key"><?php echo T_("Mobile") ?></div>
            <div class="value"><?php echo \dash\fit::mobile(\dash\data::dataRowMember_mobile());?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/email'. $myID;?>">
            <div class="key"><?php echo T_("Email") ?></div>
            <div class="value"><?php echo \dash\data::dataRowMember_email(); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/permission'. $myID;?>">
            <div class="key"><?php echo T_("Permission") ?></div>
            <div class="value"><?php echo \dash\data::dataRowMember_permission() === 'admin' ? T_("Admin") : \dash\data::dataRowMember_permission(); ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/status'. $myID;?>">
            <div class="key"><?php echo T_("Status") ?></div>
            <div class="value"><?php echo T_(\dash\data::dataRowMember_status()); ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>
    <nav class="items">
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
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">
     <nav class="items">
      <ul>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/description'. $myID;?>">
            <div class="key"><?php echo T_("Notes") ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/address'. $myID;?>">
            <div class="key"><?php echo T_("Addresses") ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>

    <nav class="items">
      <ul>
        <li>
          <a class="item f disabled" href="<?php echo null; // \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_("Transactions") ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f disabled" href="<?php echo null; // \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_("Orders") ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f disabled" href="<?php echo null; // \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_("Tickets") ?></div>
            <div class="go"></div>
          </a>
        </li>

        <li>
          <a class="item f disabled" href="<?php echo null; // \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_("Logins") ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f disabled" href="<?php echo null; // \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_("Cart") ?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f disabled" href="<?php echo null; // \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_("Logs") ?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f disabled" href="<?php echo null; // \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_("Notifications") ?></div>
            <div class="go"></div>
          </a>
        </li>
      </ul>
    </nav>
  </div>
  <div class="c-xs-12 c-sm-12 c-md-4">

    <nav class="items">
      <ul>
        <li>
          <a class="item f">
            <div class="key"><?php echo T_('Create user at');?></div>
            <div class="value"><?php echo \dash\fit::date_time(\dash\data::dataRowMember_datecreated());?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f">
            <div class="key"><?php echo T_('Modified at');?></div>
            <div class="value"><?php echo \dash\fit::date_time(\dash\data::dataRowMember_datemodified());?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::that(). '/logins?id='. \dash\request::get('id');?>">
            <div class="key"><?php echo T_('Last login at');?></div>
            <div class="value"><?php echo \dash\fit::date_time(date("Y-m-d H:i:s"));?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_('Last order');?></div>
            <div class="value"><?php echo \dash\fit::date_time(date("Y-m-d H:i:s"));?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_('Total payed');?></div>
            <div class="value"><?php echo \dash\fit::number(rand());?></div>
            <div class="go"></div>
          </a>
        </li>
        <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_('Average order pay');?></div>
            <div class="value"><?php echo \dash\fit::number(rand());?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_('Balance');?></div>
            <div class="value"><?php echo \dash\fit::number(rand());?></div>
            <div class="go"></div>
          </a>
        </li>
         <li>
          <a class="item f" href="<?php echo \dash\url::this(). '/detail'. $myID;?>">
            <div class="key"><?php echo T_('Last IP');?></div>
            <div class="value"><?php echo \dash\fit::text('192.168.1.1');?></div>
            <div class="go"></div>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</div>
