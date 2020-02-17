

 <div class="cbox">
  <h2><?php echo T_("Create sitemap automatically by click on this page"); ?></h2>

  <?php if(\dash\data::siteMapFile_base()) {?>

  	 <a class="btn" target="_blank" href="<?php echo \dash\url::base(); ?>/sitemap.xml"><?php echo T_("Base Sitemap"); ?></a>
  <?php } //endif ?>

  <?php if(\dash\data::siteMapFile_sitemap()) {?>

   <a class="btn" target="_blank" href="<?php echo \dash\url::base(); ?>/sitemap"><?php echo T_("Sitemap Directory"); ?></a>
  <?php } //endif ?>

  <?php if(!\dash\data::siteMapFile_sitemap() && !\dash\data::siteMapFile_base()) {?>

   <div class="btn txtC xl success" data-confirm data-data='{"run" : "yes"}'><?php echo T_("Create sitemap now!"); ?> </div>

  <?php }else{ ?>

   <div data-confirm data-data='{"run" : "yes"}' class="btn floatRa secondary" ><?php echo T_("Create it Again"); ?></div>

  <?php } //endif ?>

  <?php if(\dash\data::siteMapFile_base()) {?>


   <p data-kerkere='.removeSiteMapFile' class="mT10 fc-red fs08"><?php echo T_("Remove all  sitemap files"); ?></p>
   <div data-kerkere-content='hide' class="removeSiteMapFile">
    <div class="btn danger" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove all  sitemap files"); ?></div>
   </div>

  <?php } //endif ?>

 </div>


<?php if(\dash\data::sitemapData() && is_array(\dash\data::sitemapData())) {?>
<div class="f justify-center">
	<div class="c6 s12">
		 <div class="cbox">

		   <h3><?php echo T_("Sitemap Result"); ?></h3>

       <?php foreach (\dash\data::sitemapData() as $key => $value) {?>

		   <?php if($value) {?>

		   <div class="msg">
        <div class="f">
          <div class="c"><?php echo $key; ?></div>
          <div class="c">
            <span class="floatL txtB txtC"><?php echo \dash\fit::number($value); ?> <small><?php echo T_("Item"); ?></small></span>
          </div>
        </div>
        </div>
        <?php } //endif ?>
		   <?php } //endfor ?>

         <?php foreach (\dash\data::sitemapData() as $key => $value) {?>

       <?php if(!$value) {?>
       <div class="badge">
        <div class="f">
          <div class="c"><?php echo $key; ?></div>
          <div class="c mLa10">
            <span class="floatL txtB txtC"><?php echo \dash\fit::number($value); ?> <small><?php echo T_("Item"); ?></small></span>
          </div>
        </div>
        </div>
        <?php } //endif ?>
       <?php } //endfor ?>


		 </div>
	</div>
</div>
<?php } //endif ?>

