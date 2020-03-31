
<div class="f justify-center">
 <div class="c8 s12">


  <div class="cms cbox">
      <div class="show <?php echo \dash\data::datarow_type(); ?>">
        <h2 class="txtB txtC mB10"><a href="<?php echo \dash\url::current(); ?>"><?php echo \dash\data::datarow_title(); ?></a></h2>
        <div class="ovh">
        <?php
          $meta = \dash\data::datarow_meta();
          if(isset($meta['thumb']))
          {
            echo "<img src='". $meta['thumb'] ."' alt='". \dash\data::datarow_title(). "' class='wide'>";
          }

          echo \dash\data::datarow_content();

          if(isset($meta['gallery']) && is_array($meta['gallery']))
          {
            echo '<div class="gallery">';
            foreach ($meta['gallery'] as $key => $value)
            {
              $ends_with = substr($value, -4);
              if(in_array($ends_with, ['.jpg', '.png', '.gif']))
              {
                echo "<a data-action href='$value'><img src='$value' alt='". \dash\data::datarow_title()."'></a>";
              }
            }
            echo '</div>';
          }

          if(isset($meta['gallery']) && is_array($meta['gallery']))
          {

            foreach ($meta['gallery'] as $key => $value)
            {
              $ends_with = substr($value, -4);
              if(in_array($ends_with, ['.mp4']))
              {
                echo "<div class='galleryMedia'>
                          <video controls>
                              <source src='$value' type='video/mp4'>
                          </video>
                      </div>";
              }
              elseif(in_array($ends_with, ['.mp3']))
              {
                  echo "<div class='galleryMedia'>
                            <audio controls><source src='$value' type='audio/mpeg'></audio>
                        </div>";
              }
              elseif(in_array($ends_with, ['.pdf']))
              {
                  echo "<div class='galleryMedia'>
                          <a href='$value' class='btn lg mT25 primary'>". T_("Download PDF"). "</a>
                        </div>";
              }
            }

          }
        ?>

        </div>



      <?php
      $tag = \dash\app\term::load_tag_html(['type' => 'help_tag']);
      if($tag)
      {
          echo '<div class="tagBox msg">';
          foreach ($tag as $key => $value)
          {
            echo '<a href="'. \dash\url::kingdom().'/support/tag/'. $value['slug'].'">'. $value['title'].'</a>';
          }
          echo '</div>';
      }
      ?>



      <?php if(\dash\data::datarow_datemodified()) {?>


      <div class='msg simple f mT20'>
        <div class="c"><time datetime="<?php echo \dash\data::datarow_datemodified(); ?>"><?php echo \dash\fit::date(\dash\data::datarow_publishdate()); ?></time></div>
        <div class="cauto os"><a href="<?php echo \dash\url::base(). '/n/'. \dash\data::datarow_id(); ?>" title='<?php echo T_("For share via social networks"); ?>'><?php echo T_("News Code"); ?> <span class="txtB"><?php echo \dash\data::datarow_id(); ?></span></a></div>
      </div>

      <?php } //endif ?>

      </div>
  </div>


    <?php if(\dash\data::subchildPost() && is_array(\dash\data::subchildPost())) {?>

    <div class="cms cbox">
      <h4><?php echo T_("In this section"); ?></h4>
      <?php foreach (\dash\data::subchildPost() as $key => $value)
      {
      ?>
      <div class="msg">
        <?php if(isset($value['meta']['icon'])) {?>
          <span class="sf-<?php echo $value['meta']['icon']; ?> mRa10"></span>
        <?php } //endif ?>
        <a href="<?php echo \dash\url::here(). '/'. $value['slug']; ?>"><?php echo $value['title']; ?></a>
        <a href="#" class="floatRa"><?php echo \dash\get::index($value, 'cat'); ?></a>
      </div>

  <?php } //endfor ?>
    </div>

  <?php } //endif ?>

 </div>
</div>

