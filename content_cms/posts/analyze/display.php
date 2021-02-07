<?php $dataRow = \dash\data::dataRow(); ?>

<div class="box">
  <div class="pad">
    <div class="seoPreview">
      <a target="_blank" href="<?php echo \dash\data::postViewLink(); ?>">
        <cite><?php echo \dash\data::dataRow_link(); ?></cite>
      </a>
      <div class="f">
        <div class="c s12 pLa10">
          <h3><?php echo \dash\data::dataRow_post_title(); ?></h3>
          <p class="desc"><?php echo a($dataRow,'excerpt'); ?></p>
        </div>
        <div class="cauto os s12">
          <img src="<?php echo \dash\url::siftal(); ?>/images/logo/google.png" alt='<?php echo T_("Google"); ?>'>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if(\dash\data::seoAnalyze()) { $seoAnalyze = \dash\data::seoAnalyze(); ?>
<div class="box">
  <div class="pad">
    <h6 class="txtB"><?php echo T_("SEO analysis") ?></h6>
    <div class="font-20 mB20">
      <div><?php echo \dash\fit::text(a($seoAnalyze, 'rank')). ' '. T_("%") ?> <?php echo a($seoAnalyze, 'star_html') ?></div>

    </div>
    <?php foreach (a($seoAnalyze, 'list') as $key => $value) {?>
      <a class="checklist fc-black" <?php if(a($value, 'class')) { echo 'data-'. a($value, 'class'); } ?> ><?php echo a($value, 'msg'); ?></a>
    <?php } ?>
  </div>
</div>
<?php } //endif ?>