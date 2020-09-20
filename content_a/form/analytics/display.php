<?php if(!\dash\data::formDetail_analyze()) {?>
  <div class="welcome">
    <p><?php echo T_("Create now"); ?></p>
    <h2><?php echo T_("Create form view"); ?></h2>

    <div class="buildBtn">
      <a class="btn xl master" data-data='{"create": "create"}' data-confirm ><?php echo T_("Buil it now"); ?></a>
    </div>
  </div>
<?php }else{ ?>

<div class="avand-md">

<nav class="items">
 <ul>
      <li><a class="f item" href="<?php echo \dash\url::that(). '/table?id='. \dash\request::get('id'); ?>"><i class="sf-table"></i><div class="key"><?php echo T_("Show all result");?></div><div class="go"></div></a></li>
 </ul>
</nav>

<?php if(\dash\data::allFilter()) {?>
  <nav class="items">
 <ul>
  <?php foreach (\dash\data::allFilter() as $key => $value) {?>
      <li><a class="f item" href="<?php echo \dash\url::that(). '/filter?id='. \dash\request::get('id'). '&fid='. \dash\get::index($value, 'id'); ?>"><i class="sf-filter"></i><div class="key"><?php echo \dash\get::index($value, 'title');?></div><div class="go"></div></a></li>
    <?php } //endif ?>
 </ul>
</nav>
  <?php } //endif ?>



<nav class="items">
 <ul>
  <li>
    <a class="f" href="<?php echo \dash\url::that(). '/addfilter?id='. \dash\request::get('id') ?>">
     <div class="go plus ok"></div>
     <div class="key"><?php echo T_("Add new filter") ?></div>
   </a>
  </li>
 </ul>
</nav>
</div>

<?php } //endif ?>
