<?php
function lastModified($_key)
{
  $data = \dash\data::cmsSettingSaved();
  if(isset($data[$_key. '_lastmodified']))
  {
    return \dash\generate\option::lastModified($data[$_key. "_lastmodified"]);
  }
}
?>
<section class="f" data-option='cms-thumb-ratio'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("An aspect ratio of Featured image for standard post");?></h3>
      <div class="body">
        <p><?php echo T_("Specify the aspect ratio of the featured image");?></p>
        <?php echo lastModified('thumbratiostandard'); ?>
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
      <h3><?php echo T_("An aspect ratio of Featured image for gallery");?></h3>
      <div class="body">
        <p><?php echo T_("Specify the aspect ratio of the featured image");?></p><?php echo lastModified('thumbratiogallery'); ?>
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
      <h3><?php echo T_("An aspect ratio of  Featured image for video");?></h3>
      <div class="body">
        <p><?php echo T_("Specify the aspect ratio of the featured image");?></p><?php echo lastModified('thumbratiovideo'); ?>
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
      <h3><?php echo T_("An aspect ratio of  Featured image for podcast");?></h3>
      <div class="body">
        <p><?php echo T_("Specify the aspect ratio of the featured image");?></p><?php echo lastModified('thumbratiopodcast'); ?>
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
        <p><?php echo T_("In this section, you specify the default status of the comment");?></p><?php echo lastModified('defaultcomment'); ?>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_defaultcomment" value="1">
      <div class="action">
        <div class="switch1">
          <input id="idefaultcomment" type="checkbox" name="defaultcomment" <?php if(\dash\data::cmsSettingSaved_defaultcomment() == 'open') { echo 'checked'; } ?>>
          <label for="idefaultcomment"></label>
        </div>
      </div>
  </form>
</section>



<section class="f" data-option='cms-show-writer-default'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default show writer");?></h3>
      <div class="body">
        <p><?php echo T_("In this section, you specify the default status of the show writer");?></p><?php echo lastModified('defaultshowwriter'); ?>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_defaultshowwriter" value="1">
      <div class="action">
        <div class="switch1">
          <input id="idefaultshowwriter" type="checkbox" name="defaultshowwriter" <?php if(\dash\data::cmsSettingSaved_defaultshowwriter() == 'visible') { echo 'checked'; } ?>>
          <label for="idefaultshowwriter"></label>
        </div>
      </div>
  </form>
</section>


<section class="f" data-option='cms-show-date-default'>
  <div class="c8 s12">
    <div class="data">
      <h3><?php echo T_("Default show date");?></h3>
      <div class="body">
        <p><?php echo T_("In this section, you specify the default status of the show date");?></p><?php echo lastModified('defaultshowdate'); ?>
      </div>
    </div>
  </div>
  <form class="c4 s12" method="post" data-patch>
    <input type="hidden" name="set_defaultshowdate" value="1">
      <div class="action">
        <div class="switch1">
          <input id="idefaultshowdate" type="checkbox" name="defaultshowdate" <?php if(\dash\data::cmsSettingSaved_defaultshowdate() == 'visible') { echo 'checked'; } ?>>
          <label for="idefaultshowdate"></label>
        </div>
      </div>
  </form>
</section>