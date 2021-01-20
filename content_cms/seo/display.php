
<div class="box">
  <div class="pad">
    <div class="f font-18">
      <div class="cauto">
        <?php echo T_("Average post SEO rank") ?>
        <span><?php echo \dash\fit::number(a(\dash\data::dashboardDetail(), 'avg_seorank')). ' '. T_("%") ?></span>
      </div>
      <div class="c"></div>
      <div class="cauto"><?php echo a(\dash\data::dashboardDetail(), 'seostar_html') ?></div>
    </div>
  </div>
</div>

<h6><?php echo T_("Top post SEO rank") ?></h6>
<nav class="items">
  <ul>
    <?php foreach (\dash\data::dataTable() as $key => $value) {?>
     <li>
      <a class="f align-center" href="<?php echo \dash\url::here(). '/posts/seo?id='.  a($value, 'id') ?>">
        <?php echo '<img src="'. a($value, 'thumb'). '" alt="'. T_("Post image"). '">'; ?>
        <div class="key"><?php echo a($value, 'title'); ?></div>
        <div class="value ltr"><?php if(a($value, 'seorank')) { echo \dash\fit::number(a($value, 'seorank')) . ' '. T_("%"); } ?></div>
        <div class="go <?php echo $value['icon_list'] ?>"></div>
      </a>
     </li>
    <?php } //endfor ?>
  </ul>
</nav>
<?php \dash\utility\pagination::html(); ?>