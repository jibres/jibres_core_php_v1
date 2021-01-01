<section class="f" data-option='cms-thumb-ratio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Featured image of standard post");?></h3>
      <div class="body">
        <p><?php echo T_("Specify the aspect ratio of the featured image");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_thumbratiostandard" value="1">
      <div class="action">
        <select class="select22" name="thumbratiostandard">
        	<?php echo \lib\ratio::select_html(\dash\data::cmsSettingSaved_thumbratiostandard()); ?>
        </select>
      </div>
  </form>
</section>


<section class="f" data-option='cms-gallery-ratio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Featured image of gallery post");?></h3>
      <div class="body">
        <p><?php echo T_("Specify the aspect ratio of the featured image");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_thumbratiogallery" value="1">
      <div class="action">
        <select class="select22" name="thumbratiogallery">
          <?php echo \lib\ratio::select_html(\dash\data::cmsSettingSaved_thumbratiogallery()); ?>
        </select>
      </div>
  </form>
</section>


<section class="f" data-option='cms-video-ratio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Featured image of video post");?></h3>
      <div class="body">
        <p><?php echo T_("Specify the aspect ratio of the featured image");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_thumbratiovideo" value="1">
      <div class="action">
        <select class="select22" name="thumbratiovideo">
          <?php echo \lib\ratio::select_html(\dash\data::cmsSettingSaved_thumbratiovideo()); ?>
        </select>
      </div>
  </form>
</section>

<section class="f" data-option='cms-podcast-ratio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Featured image of podcast post");?></h3>
      <div class="body">
        <p><?php echo T_("Specify the aspect ratio of the featured image");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_thumbratiopodcast" value="1">
      <div class="action">
        <select class="select22" name="thumbratiopodcast">
          <?php echo \lib\ratio::select_html(\dash\data::cmsSettingSaved_thumbratiopodcast()); ?>
        </select>
      </div>
  </form>
</section>



<section class="f" data-option='cms-sitemap'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Sitemap");?></h3>
      <div class="body">
      </div>
    </div>
  </div>
  <div class="c4 s12">
    <div class="action">
      <a class="btn master" href="<?php echo \dash\url::here(). '/sitemap' ?>"><?php echo T_("View sitemap") ?></a>
    </div>
  </div>
</section>