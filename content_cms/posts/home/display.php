<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {
      $date_title = '';
      if(a($value, 'datemodified'))
      {
        $date_title .= T_("Date modified"). ': '. \dash\fit::date_time(a($value, 'datemodified')). "\n";
      }
      if(a($value, 'publishdate'))
      {
        $date_title .= T_("Publish date"). ': '. \dash\fit::date_time(a($value, 'publishdate'));
      }
    ?>
     <li>
      <a class="item f align-center" href="<?php echo \dash\url::this(). '/edit?id='.  a($value, 'id') ?>">
<?php if(a($value, 'thumb')) {?>
        <?php echo '<img src="'. \dash\utility\image::url_thumb(a($value, 'thumb')). '" alt="'. T_("Post image"). '">'; ?>
<?php } else {?>
        <i class="sf-news"></i>
<?php }?>
        <div class="key"><?php echo a($value, 'title'); ?></div>
        <div class="value ltr" title="<?php echo $date_title; ?>"><?php echo \dash\fit::date_time(a($value, 'datecreated')); ?></div>
        <div class="go <?php echo $value['icon_list'] ?>"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>