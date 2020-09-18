

<nav class="items">
 <ul>
      <li><a class="f" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id'); ?>"><div class="key"><?php echo T_("Glance");?></div><div class="go"></div></a></li>
      <li><a class="f" target="_blank" href="<?php echo \dash\face::btnPreview(); ?>"><div class="key"><?php echo T_("Preview");?></div><div class="go"></div></a></li>
 </ul>
</nav>


<nav class="items">
 <ul>
      <li><a class="f" href="<?php echo \dash\url::this(). '/setting?id='. \dash\request::get('id'); ?>"><div class="key"><?php echo T_("Setting");?></div><div class="go"></div></a></li>
      <li><a class="f" href="<?php echo \dash\url::this(). '/sorting?id='. \dash\request::get('id'); ?>"><div class="key"><?php echo T_("Sort items");?></div><div class="go"></div></a></li>
 </ul>
</nav>




<nav class="items">
 <ul>
	<li>
        <a class="f" href="<?php echo \dash\url::this(). '/item/add?id='. \dash\request::get('id') ?>">
         <div class="go plus ok"></div>
         <div class="key"><?php echo T_("Add new item") ?></div>
        </a>
       </li>
 </ul>
</nav>