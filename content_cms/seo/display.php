

<div class="avand-md zero">
  <div class="box">
    <div class="pad">
      <div class="seoRank txtC mT20" data-size='hero'>
        <?php echo a(\dash\data::dashboardDetail(), 'seostar_html') ?>
      </div>
      <div class="font-18 txtC">
        <h2><?php echo T_("Average post SEO rank") ?></h2>
        <div class="font-40 txtB ltr"><?php echo \dash\fit::number(a(\dash\data::dashboardDetail(), 'avg_seorank')). ' '. T_("%") ?></div>
      </div>
    </div>
  </div>

  <nav class="items long">
    <ul>
      <li class="">
        <a class="item f" href="<?php echo \dash\url::here();?>/sitemap">
          <i class="sf-sitemap"></i>
          <div class="key"><?php echo T_('Sitemap');?></div>
          <div class="go info"></div>
        </a>
      </li>
    </ul>
  </nav>

</div>


<div class="avand-md zero mT20">
  <h6><?php echo T_("Top post SEO rank") ?></h6>
  <nav class="items">
    <ul>
      <?php foreach (\dash\data::dataTable() as $key => $value) {?>
       <li>
        <a class="item f align-center" href="<?php echo \dash\url::here(). '/posts/seo?id='.  a($value, 'id') ?>">
<?php if(a($value, 'thumb')) {?>
                <img src="<?php echo \dash\fit::url_thumb(a($value, 'thumb')); ?>" alt="Thumb image - <?php echo a($value, 'title'); ?>">
<?php } else {
$type = 'news';
switch (a($value, 'subtype'))
{
  case 'standard':
    $type = 'news';
    break;

  case 'gallery':
    $type = 'picture';
    break;

  case 'video':
    $type = 'film';
    break;

  case 'audio':
    $type = 'music';
    break;

  default:
    break;
}
echo '<i class="sf-'. $type. '"></i>';
}?>
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