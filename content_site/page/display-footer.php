  <nav class="settings items w-full mB0-f">
    <ul>
      <li>
        <a class="item f" href="<?php echo \dash\url::this(). '/settings'. \dash\request::full_get() ?>">
          <img class="bg-gray-100 hover:bg-gray-200 p-4" src="<?php echo \dash\utility\icon::url('Settings', 'minor'); ?>">
          <div class="key"><?php echo T_("Page Settings") ?></div>
          <div class="go"></div>
        </a>
      </li>
    </ul>
  </nav>
