<div class="avand-md">
  <div class="box">
   <div class="body">
      <p><?php echo T_("Create sitemap automatically by click on this page"); ?></p>

      <?php if(!\dash\data::siteMapFile_sitemap() && !\dash\data::siteMapFile_base()) {?>
       <div class="btn txtC xl success" data-confirm data-data='{"run" : "yes"}'><?php echo T_("Create sitemap now!"); ?> </div>
      <?php } //endif ?>

   </div>
   <footer class="f">
      <?php if(\dash\data::siteMapFile_base()) {?>
        <div class="cauto">
          <a class="btn" target="_blank" href="<?php echo \dash\url::base(); ?>/sitemap.xml"><?php echo T_("Base Sitemap"); ?></a>
        </div>
      <?php } //endif ?>
    <div class="c"></div>
    <div class="cauto">
      <div data-confirm data-data='{"run" : "yes"}' class="btn floatRa secondary" ><?php echo T_("Create it Again"); ?></div>
    </div>

   </footer>


  </div>

  <?php if(\dash\data::siteMapFile_base()) {?>
  <div class="box">
    <div class="body">
      <?php echo T_("Remove all  sitemap files"); ?>
    </div>
    <footer class="txtRa">
      <div class="btn danger" data-confirm data-data='{"remove": "remove"}'><?php echo T_("Remove all  sitemap files"); ?></div>
    </footer>
  </div>
  <?php } //endif ?>



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

</div>
