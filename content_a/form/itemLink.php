

<nav class="items">
 <ul>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/edit?id='. \dash\request::get('id'); ?>"><i class="sf-info-circle"></i><div class="key"><?php echo T_("Glance");?></div><div class="go"></div></a></li>
 </ul>
</nav>


<nav class="items">
 <ul>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/setting?id='. \dash\request::get('id'); ?>"><i class="sf-pencil-square-o"></i><div class="key"><?php echo T_("Edit form");?></div><div class="go"></div></a></li>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/thankyou?id='. \dash\request::get('id'); ?>"><i class="sf-heart-o"></i><div class="key"><?php echo T_("Thank you message");?></div><div class="go"></div></a></li>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/status?id='. \dash\request::get('id'); ?>"><i class="sf-plug"></i><div class="key"><?php echo T_("Status");?></div><div class="go"></div></a></li>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/sorting?id='. \dash\request::get('id'); ?>"><i class="sf-sort"></i><div class="key"><?php echo T_("Sort items");?></div><div class="go"></div></a></li>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/tag?id='. \dash\request::get('id'); ?>"><i class="sf-tag"></i><div class="key"><?php echo T_("Tags");?></div><div class="go"></div></a></li>
 </ul>
</nav>

<nav class="items">
 <ul>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/answer?id='. \dash\request::get('id'); ?>"><i class="sf-file"></i><div class="key"><?php echo T_("Answers");?></div><div class="go"></div></a></li>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/report?id='. \dash\request::get('id'); ?>"><i class="sf-pie-chart"></i><div class="key"><?php echo T_("Reports");?></div><div class="go"></div></a></li>
 </ul>
</nav>



<nav class="items">
 <ul>
      <li><a class="f item" href="<?php echo \dash\url::this(). '/analytics?id='. \dash\request::get('id'); ?>"><i class="sf-atom"></i><div class="key"><?php echo T_("Analyze answers");?></div><div class="go"></div></a></li>
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

<form method="post" action="<?php echo \dash\url::this() ?>">
  <div class="box">
    <div class="pad">
      <input type="hidden" name="findanswerid" value="findanswerid">
      <label for="aid"><?php echo T_("Find answer detail by id") ?></label>
      <div class="input">
        <input type="number" name="aid" placeholder="<?php echo T_("Answer id") ?>" id="aid">
      </div>
    </div>
    <footer class="txtRa">
      <button class="btn"><?php echo T_("Go") ?></button>
    </footer>
  </div>
</form>

