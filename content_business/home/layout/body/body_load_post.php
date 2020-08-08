
<div class="avand">


<div class="blogEx box">
<?php

if(\dash\data::mydatarow_type() === 'post' || \dash\data::mydatarow_type() === 'page')
{
  loadPostTemplate();
}
else
{
  loadTermsTemplate();
}
?>
</div>

</div>


<?php
function loadPostTemplate()
{
?>


<article>
  <section>

  <?php
  $meta = \dash\data::mydatarow_meta();
  if(isset($meta['thumb']))
  {
  ?>

  <a href="<?php echo \dash\data::mydatarow_link(); ?>" class="thumb">
      <img src="<?php echo $meta['thumb']; ?>" alt="<?php echo \dash\data::mydatarow_title(); ?>">
  </a>

  <?php
  }  // endif
  ?>

  <div><?php echo \dash\data::mydatarow_content(); ?></div>

  <?php
  if(isset($meta['gallery']) && is_array($meta['gallery']))
  {
    echo '<div class="gallery" id="lightgallery">';
    foreach ($meta['gallery'] as $key => $myUrl)
    {
      $endUrl = substr($myUrl, -4);
      if(in_array($endUrl, ['.jpg', '.png', '.gif']))
      {
        echo '<a data-action href="'. $myUrl.'"><img src="'. $myUrl. '" alt="'. \dash\data::mydatarow_title(). '"></a>';
      }
    }
    echo '</div>';

    echo '<div class="gallery2">';
    foreach ($meta['gallery'] as $key => $myUrl)
    {
      $endUrl = substr($myUrl, -4);
      if(in_array($endUrl, ['.mp4']))
      {
        echo '<video controls><source src="'. $myUrl. '" type="video/mp4"></video>';
      }
      elseif(in_array($endUrl, ['.mp3']))
      {
        echo '<audio controls><source src="'. $myUrl .'" type="audio/mpeg"></audio>';
      }
      elseif(in_array($endUrl, ['.pdf']))
      {
        echo '<a href="'. $myUrl .'" class="btn lg mT25 primary">'. T_("Download"). ' '. T_("PDF"). '</a>';
      }
    }
    echo '</div>';
  }
  ?>


  <?php
  if(\dash\data::mydatarow_type() === 'post' && \dash\data::mydatarow_datemodified())
  {
  ?>
  <div class='msg simple f mT20'>
    <div class="c"><time datetime="<?php echo \dash\data::mydatarow_datemodified(); ?>"><?php echo \dash\fit::date(\dash\data::mydatarow_publishdate()); ?></time></div>
    <div class="cauto os"><a href="<?php echo \dash\url::base(). '/n/'. \dash\data::mydatarow_id(); ?>" title='<?php echo T_("For share via social networks"); ?>'><?php echo T_("News Code"); ?> <span class="txtB"><?php echo \dash\data::mydatarow_id(); ?></span></a></div>
  </div>

  <?php
  } // endif
  ?>

  <div class="tagBox msg simple">
    <?php \dash\app\term::load_tag_html(['format' => 'html']); ?>
  </div>

    <div class="msg"><?php //require_once ('shareBox.php');?></div>

    <?php
      $myPostSimilar = \dash\app\posts::get_post_list(['mode' => 'similar', 'post_id' => \dash\data::mydatarow_id()]);
      if($myPostSimilar)
      {
        echo '<nav class="msg">';
        echo '<h4 class="mB20-f">'. T_("Recommended for you"). '</h4>';
        foreach ($myPostSimilar as $key => $value)
        {
          echo '<a class="block" href="'. \dash\url::kingdom().'/n/'. \dash\data::mydatarow_id().'">'. $value['title']. '</a>';
        }
        echo '</nav>';
      }
    ?>


<?php
if(\dash\data::mydatarow_comment() === 'open')
{
  addNewComment();
}
  showCommentList();
?>

  </section>
</article>

<?php
} // end function
?>






<?php
function loadTermsTemplate()
{
  $myPostByThisCat = null;
  if(\dash\data::mydatarow_type() === 'cat')
  {
    $myPostByThisCat = \dash\app\posts::get_post_list(['cat' => \dash\data::mydatarow_slug()]);
  }
  elseif(\dash\data::mydatarow_type() === 'tag')
  {
    $myPostByThisCat = \dash\app\posts::get_post_list(['tag' => \dash\data::mydatarow_slug()]);
  }

  if($myPostByThisCat)
  {
    echo "<article class='postListPreview'>";

    foreach ($myPostByThisCat as $key => $value)
    {
      echo "<section class='f'>";
      if(isset($value['meta']['thumb']))
      {
        echo "<div class='cauto s12 pRa10 txtC'><a href='$value[link]'><img src='". $value['meta']['thumb']. "' alt='$value[title]' width='100px'></a></div>";
      }
      echo "<div class='c s12'><h3><a href='$value[link]'>$value[title]</a></h3><p>$value[excerpt]</p></div>";

      echo "</section>";
    }
    echo "</article>";
  }
} // end function
?>



















<?php
function addNewComment()
{
?>

<form  method="post" data-clear autocomplete="off" action="<?php echo \dash\url::kingdom(); ?>/api/comment/add">

  <input type="hidden" name="post_id" class="hide" value="<?php echo \dash\data::mydatarow_id(); ?>">
  <?php
  if(!\dash\user::id())
  {
  ?>
      <div class="f">
        <div class="c pRa5">

          <div class="input">
           <label class="addon" for="name"><?php echo T_("Name"); ?></label>
           <input type="text" name="name" id="name" placeholder='<?php echo T_("Full Name"); ?>' maxlength='40' value="<?php echo \dash\user::detail('displayname'); ?>">
          </div>

        </div>
        <div class="c">
          <div class="input">
           <label class="addon" for="mobile"><?php echo T_("Mobile"); ?></label>
           <input type="tel" name="mobile" id="mobile" placeholder='<?php echo T_("Mobile"); ?>' maxlength="13" autocomplete="off" data-validity='<?php echo T_("Please enter valid mobile number. `:val` is incorrect"); ?>' value="<?php echo \dash\user::detail('mobile'); ?>">
          </div>
        </div>

        <input type="text" name="username" class="hide" value="">
      </div>
  <?php
  } // endif
  ?>

  <label><?php echo T_("Your rate"); ?></label>
  <div class="radioRating togglable">
    <div class="rateBox">
      <input type="radio" name="star" id="star-1" value="1">
      <label for="star-1"></label>
      <input type="radio" name="star" id="star-2" value="2">
      <label for="star-2"></label>
      <input type="radio" name="star" id="star-3" value="3">
      <label for="star-3"></label>
      <input type="radio" name="star" id="star-4" value="4">
      <label for="star-4"></label>
      <input type="radio" name="star" id="star-5" value="5">
      <label for="star-5"></label>
    </div>
  </div>

  <div class="input">
    <textarea name="content" class="txt" rows="5" placeholder='<?php echo T_("Write your comment..."); ?>'></textarea>
  </div>

  <button class="btn primary block mT20"><?php echo T_("Send"); ?></button>
</form>


<?php
} // end function
?>





<?php
function showCommentList()
{
  $commentList = \dash\app\comment::get_post_comment();
  if($commentList)
  {
    foreach ($commentList as $key => $value)
    {


?>

  <div class="msg mT10">
    <div class="f">
      <div class="c s12">
        <img src="<?php echo \dash\get::index($value, 'avatar'); ?>" class="avatar">
        <span class="badge"><?php echo \dash\get::index($value, 'displayname'); ?></span>
        <?php
        if(isset($value['star']) && $value['star'])
        {
          for ($i=1; $i <= $value['star'] ; $i++)
          {
            echo '<i class="sf-star fc-yellow"></i>';
          }
        }
        ?>

      </div>
      <div class="c s12">
        <p><?php echo $value['content']; ?></p>
      </div>
      <div class="c s12">
        <span><?php echo \dash\fit::date($value['datecreated']); ?></span>
      </div>
    </div>
  </div>




<?php
    } // end for
  } // end if
} // endfunction
?>
