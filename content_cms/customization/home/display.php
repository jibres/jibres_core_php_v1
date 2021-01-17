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


<section class="f" data-option='cms-comment-defualt'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default post comment");?></h3>
      <div class="body">
        <p><?php echo T_("In this section, you specify the default status of the comment");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_defaultcomment" value="1">
      <div class="action">
         <select class="select22" name="defaultcomment" data-placeholder='<?php echo T_("Please choose an item") ?>'>
          <option value=""><?php echo T_("Please choose an item") ?></option>
          <option value="open" <?php if(\dash\data::cmsSettingSaved_defaultcomment() == 'open') { echo 'selected'; } ?> ><?php echo T_("Open"); ?></option>
          <option value="closed" <?php if(\dash\data::cmsSettingSaved_defaultcomment() == 'closed') { echo 'selected'; } ?> ><?php echo T_("Closed"); ?></option>
        </select>
      </div>
  </form>
</section>



<section class="f" data-option='cms-show-writer-default'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default show writer");?></h3>
      <div class="body">
        <p><?php echo T_("In this section, you specify the default status of the show writer");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_defaultshowwriter" value="1">
      <div class="action">
         <select class="select22" name="defaultshowwriter" data-placeholder='<?php echo T_("Please choose an item") ?>'>
          <option value=""><?php echo T_("Please choose an item") ?></option>
          <option value="visible" <?php if(\dash\data::cmsSettingSaved_defaultshowwriter() == 'visible') { echo 'selected'; } ?> ><?php echo T_("Visible"); ?></option>
          <option value="hidden" <?php if(\dash\data::cmsSettingSaved_defaultshowwriter() == 'hidden') { echo 'selected'; } ?> ><?php echo T_("Hidden"); ?></option>
        </select>
      </div>
  </form>
</section>


<section class="f" data-option='cms-show-date-default'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default show date");?></h3>
      <div class="body">
        <p><?php echo T_("In this section, you specify the default status of the show date");?></p>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_defaultshowdate" value="1">
      <div class="action">
         <select class="select22" name="defaultshowdate" data-placeholder='<?php echo T_("Please choose an item") ?>'>
          <option value=""><?php echo T_("Please choose an item") ?></option>
          <option value="visible" <?php if(\dash\data::cmsSettingSaved_defaultshowdate() == 'visible') { echo 'selected'; } ?> ><?php echo T_("Visible"); ?></option>
          <option value="hidden" <?php if(\dash\data::cmsSettingSaved_defaultshowdate() == 'hidden') { echo 'selected'; } ?> ><?php echo T_("Hidden"); ?></option>
        </select>
      </div>
  </form>
</section>