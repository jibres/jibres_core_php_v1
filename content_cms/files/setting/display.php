<div class="avand-md">
  <nav class="items">
    <ul>
       <li>
        <a class="f align-center">
          <div class="key"><?php echo T_("Total files") ?></div>
          <div class="value"><?php echo \dash\fit::number(\dash\data::dashboardDetail_totalfiles()); ?></div>
        </a>
       </li>
       <li>
        <a class="f align-center">
          <div class="key"><?php echo T_("Total size") ?></div>
          <div class="value"><?php echo \dash\fit::file_size(\dash\data::dashboardDetail_totalsize()); ?></div>
        </a>
       </li>
    </ul>
  </nav>
</div>