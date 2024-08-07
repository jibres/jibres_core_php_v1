
<section class="appBox">
  <div class="avand">
    <div class="row align-center">
      <div class="c-xs-12 c-sm-12 c-md-8">
        <div class="text dlApp">
          <h2><?php echo \dash\data::appDetail_downloadtitle() ? \dash\data::appDetail_downloadtitle() : \lib\store::detail('title'); ?></h2>
          <p><?php echo \dash\data::appDetail_downloaddesc(); ?></p>
          <div class="dl">


            <?php if(\dash\data::appDetail_googleplay()) {?>
              <a target="_blank" href="<?php echo \dash\data::appDetail_googleplay(); ?>" rel="nofollow">
                <img src="<?php echo \dash\url::cdn(); ?>/img/app/get/googleplay<?php if(\dash\language::current() === 'fa') { echo "-fa"; } ?>.png" alt='<?php echo \dash\data::appDetail_downloadtitle(). ' - '. T_('Download from Google Play'); ?>'></a>
            <?php } //endif ?>

            <?php if(\dash\data::appDetail_cafebazar()) {?>
            <a target="_blank" href="<?php echo \dash\data::appDetail_cafebazar(); ?>" rel="nofollow"><img src="<?php echo \dash\url::cdn(); ?>/img/app/get/cafebazar<?php if(\dash\language::current() === 'fa') { echo "-fa"; } ?>.png" alt='<?php echo \dash\data::appDetail_downloadtitle(). ' - '. T_('Download from CafeBazar'); ?>'></a>
            <?php } //endif ?>

            <?php if(\dash\data::appDetail_myket()) {?>
            <a target="_blank" href="<?php echo \dash\data::appDetail_myket(); ?>" rel="nofollow"><img src="<?php echo \dash\url::cdn(); ?>/img/app/get/myket<?php if(\dash\language::current() === 'fa') { echo "-fa"; } ?>.png" alt='<?php echo \dash\data::appDetail_downloadtitle(). ' - '. T_('Download from Myket'); ?>'></a>
            <?php } //endif ?>

			       <a data-direct href="<?php echo \dash\url::kingdom(). '/apk'; ?>"><img src="<?php echo \dash\url::cdn(); ?>/img/app/get/downloadapk<?php if(\dash\language::current() === 'fa') { echo "-fa"; } ?>.png" alt='<?php echo T_('Direct download'). ' - '. \dash\data::appDetail_downloadtitle(); ?>'></a>


          </div>
        </div>
      </div>
      <div class="c-xs-12 c-sm-12 c-md-4">
      	<div class="mobileFrame mT20-f">
      		<iframe src="<?php echo \dash\url::kingdom()?>"></iframe>
      	</div>
      </div>
    </div>
  </div>
</section>
