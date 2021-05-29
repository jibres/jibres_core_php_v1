<div class="avand-md">
  <nav class="items long">
    <ul>
       <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/me">
          <i class="sf-bell"></i>
          <div class="key"><?php echo T_('My notifications');?></div>
          <div class="go search"></div>
        </a>
      </li>
    </ul>
  </nav>
  <nav class="items long">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/datalist">
          <i class="sf-bell"></i>
          <div class="key"><?php echo T_('All notifications');?></div>
          <div class="go search"></div>
        </a>
      </li>


    </ul>
  </nav>
  <nav class="items long">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/send">
          <i class="sf-out"></i>
          <div class="key"><?php echo T_('Send notifications to customer');?></div>
          <div class="go"></div>
        </a>
      </li>
      <li>
        <a class="item f" href="<?php echo \dash\url::this();?>/sendgroup">
          <i class="sf-users"></i>
          <div class="key"><?php echo T_('Group sending notification');?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>
</div>