<?php $myID = '?id='. \dash\request::get('id'); ?>
  <nav class="items">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/glance'. $myID;?>">
          <img src="<?php echo \dash\data::dataRowMember_avatar() ?>">
          <div class="key"><?php echo \dash\data::dataRowMember_displayname();?></div>
          <div class="value"><?php echo T_(\dash\data::dataRowMember_status());?></div>
          <div class="value"><?php echo \dash\fit::mobile(\dash\data::dataRowMember_mobile());?></div>
          <div class="go check ok"></div>

        </a>
      </li>
    </ul>
  </nav>

