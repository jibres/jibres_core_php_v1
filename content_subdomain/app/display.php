
<section class="appBox">
  <div class="fit">
    <div class="f align-center">
      <div class="c8 s12">
        <div class="text">
          <h2><?php echo \dash\data::appDetail_downloadtitle(); ?></h2>
          <p><?php echo \dash\data::appDetail_downloaddesc(); ?></p>
          <div class="dl">

            <a target="_blank" href="" rel="nofollow"><img src="<?php echo \dash\url::cdn(); ?>/img/app/app-dl-googleplay.png" alt='<?php echo \dash\data::appDetail_downloadtitle(). ' - '. T_('Download from Google Play'); ?>'></a>

            <a target="_blank" href="" rel="nofollow"><img src="<?php echo \dash\url::cdn(); ?>/img/app/app-dl-cafebazar.png" alt='<?php echo \dash\data::appDetail_downloadtitle(). ' - '. T_('Download from CafeBazar'); ?>'></a>

			<a data-direct href="<?php echo \dash\url::kingdom(). '/apk'; ?>"><img src="<?php echo \dash\url::cdn(); ?>/img/app/app-dl-direct.png" alt='<?php echo T_('Direct download'). ' - '. \dash\data::appDetail_downloadtitle(); ?>'></a>
            </a>
          </div>
        </div>
      </div>
      <div class="c4 s12">
      	<div class="mobileFrame mT20-f">
      		<iframe src="<?php echo \dash\url::kingdom()?>"></iframe>
      	</div>
      </div>
    </div>
  </div>
</section>
