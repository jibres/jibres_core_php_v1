

  <p class="msg danger"><?php echo T_("You can use our tools"); ?>. <?php echo T_("If you dont know about this page, leave it!"); ?></p>

  <h2><?php echo T_("Database"); ?></h2>
  <div class="f">

   <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::here(); ?>/backup'>
       <div class="statistic">
        <div class="value"><i class="sf-database"></i></div>
        <div class="label"><?php echo T_("Backup"); ?></div>
       </div>
      </a>
   </div>
  <div class="c4 s12">
    <a class="dcard x1" href='<?php echo \dash\url::here(); ?>/dbtables'>
     <div class="statistic">
      <div class="value"><i class="sf-database"></i></div>
      <div class="label"><?php echo T_("Raw table"); ?></div>
     </div>
    </a>
  </div>
  </div>


  <h2><?php echo T_("Server"); ?></h2>
  <div class="f">

   <div class="c4 s12">
      <a class="dcard x1" target="_blank" href='<?php echo \dash\url::here(); ?>/info'>
       <div class="statistic">
        <div class="value"><i class="sf-server"></i></div>
        <div class="label"><?php echo T_("Server information"); ?></div>
       </div>
      </a>
   </div>

    <div class="c4 s12">
      <a class="dcard x1" target="_blank" href='<?php echo \dash\url::here(); ?>/cronjob'>
       <div class="statistic">
        <div class="value"><i class="sf-flight"></i></div>
        <div class="label"><?php echo T_("Cronjob"); ?></div>
       </div>
      </a>
   </div>
  </div>


  <h2><?php echo T_("Git"); ?></h2>
  <div class="f">
   <div class="c4 s12">
      <a class="dcard x1" target="_blank" href='<?php echo \dash\url::here(); ?>/gitstatus'>
       <div class="statistic">
        <div class="value"><i class="sf-github-alt"></i></div>
        <div class="label"><?php echo T_("Git status"); ?></div>
       </div>
      </a>
   </div>
   <div class="c4 s12">
      <a class="dcard x1" target="_blank" href='<?php echo \dash\url::here(); ?>/nano'>
       <div class="statistic">
        <div class="value"><i class="sf-file-text-o"></i></div>
        <div class="label"><?php echo T_("Nano"); ?></div>
       </div>
      </a>
   </div>
  <div class="c4 s12">
      <a class="dcard x1  danger" target="_blank" href='<?php echo \dash\url::here(); ?>/update'>
       <div class="statistic">
        <div class="value"><i class="sf-git-square"></i></div>
        <div class="label"><?php echo T_("Update"); ?></div>
       </div>
      </a>
   </div>
  </div>


  <h2><?php echo T_("Tools"); ?></h2>
  <div class="f">
   <div class="c4 s12">
      <a class="dcard x1" href='<?php echo \dash\url::here(); ?>/tools/permission'>
       <div class="statistic">
        <div class="value"><i class="sf-unlock-alt"></i></div>
        <div class="label"><?php echo T_("Permission"); ?></div>
       </div>
      </a>
   </div>

  <div class="c4 s12">
      <a class="dcard x1" target="_blank" href='<?php echo \dash\url::here(); ?>/log'>
       <div class="statistic">
        <div class="value"><i class="sf-folder"></i></div>
        <div class="label"><?php echo T_("Log"); ?></div>
       </div>
      </a>
   </div>

  </div>


