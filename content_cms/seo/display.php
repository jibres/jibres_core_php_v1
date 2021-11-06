

<div class="avand-md zero">
  <div class="box">
    <div class="pad">
      <div class="seoRank text-center text-3xl" data-size='hero'>
        <?php echo a(\dash\data::dashboardDetail(), 'seostar_html') ?>
      </div>
      <div class="font-18 txtC">
        <h2><?php echo T_("Average post SEO rank") ?></h2>
        <div class="font-40 txtB ltr"><?php echo \dash\fit::number(a(\dash\data::dashboardDetail(), 'avg_seorank')). ' '. T_("%") ?></div>
      </div>
    </div>
  </div>



</div>


<div class="avand-md zero mT20">
  <h6><?php echo T_("Top post SEO rank") ?></h6>
  <nav class="items">
    <ul>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
       <li>
        <a class="item f align-center" href="<?php echo \dash\url::here(). '/posts/seo?id='.  a($value, 'id') ?>">
<?php if(a($value, 'thumb')) {?>
                <img src="<?php echo \dash\fit::img(a($value, 'thumb')); ?>" alt="Thumb image - <?php echo a($value, 'title'); ?>">
<?php } else { echo \dash\app\posts\get::post_icon($value);  }?>
          <div class="key"><?php echo a($value, 'title'); ?></div>
          <div class="value ltr"><?php if(a($value, 'seorank')) { echo \dash\fit::number(a($value, 'seorank')) . ' '. T_("%"); } ?></div>
          <div class="value ltr"><?php if(a($value, 'seorank')) { echo a($value, 'seo_rank_star'); } ?></div>
        </a>


       </li>
      <?php } //endfor ?>
    </ul>
  </nav>
  <?php \dash\utility\pagination::html(); ?>
</div>