<nav class="items">
 <ul>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id'); ?>"><i class="sf-info-circle"></i><div class="key"><?php echo T_("Glance");?></div><div class="go"></div></a></li>
      <li><a class="f item" target="_blank" href="<?php echo \dash\face::btnPreview(); ?>"><i class="sf-link-external"></i><div class="key"><?php echo T_("Preview");?></div><div class="go"></div></a></li>
 </ul>
</nav>


<nav class="items">
 <ul>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/setting?id='. \dash\request::get('id'); ?>"><i class="sf-pencil-square-o"></i><div class="key"><?php echo T_("Edit form");?></div><div class="go"></div></a></li>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/thankyou?id='. \dash\request::get('id'); ?>"><i class="sf-heart-o"></i><div class="key"><?php echo T_("Thank you message");?></div><div class="go"></div></a></li>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/status?id='. \dash\request::get('id'); ?>"><i class="sf-plug"></i><div class="key"><?php echo T_("Status");?></div><div class="go"></div></a></li>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/sorting?id='. \dash\request::get('id'); ?>"><i class="sf-sort"></i><div class="key"><?php echo T_("Sort items");?></div><div class="go"></div></a></li>
 </ul>
</nav>

<nav class="items">
 <ul>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/answer?id='. \dash\request::get('id'); ?>"><i class="sf-file-1"></i><div class="key"><?php echo T_("Answers");?></div><div class="go"></div></a></li>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/report?id='. \dash\request::get('id'); ?>"><i class="sf-pie-chart"></i><div class="key"><?php echo T_("Reports");?></div><div class="go"></div></a></li>
 </ul>
</nav>

<nav class="items">
 <ul>
	<li>
    <a class="f" href="<?php echo \dash\url::this(). '/item/add?id='. \dash\request::get('id') ?>">
     <div class="go plus ok"></div>
     <div class="key"><?php echo T_("Add new question") ?></div>
   </a>
  </li>
 </ul>
</nav>