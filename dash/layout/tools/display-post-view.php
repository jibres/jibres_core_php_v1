<?php

$dataRow = \dash\data::dataRow();
$meta = \dash\data::dataRow_meta();

?>
<article>
  <section>
<?php if(\dash\data::dataRow_thumb()) {?>
  <a href="<?php echo \dash\data::dataRow_link(); ?>" class="thumb">
      <img src="<?php echo \dash\data::dataRow_thumb(); ?>" alt="<?php echo \dash\data::dataRow_title(); ?>">
  </a>
<?php } //endif ?>

  <div><?php echo \dash\data::dataRow_content(); ?></div>

  <?php
  if(isset($dataRow['gallery_array']) && is_array($dataRow['gallery_array']))
  {
    echo '<div class="gallery" id="lightgallery">';
    foreach ($dataRow['gallery_array'] as $key => $myUrl)
    {
      if(isset($myUrl['path']))
      {
        $endUrl = substr($myUrl['path'], -4);
        if(in_array($endUrl, ['.jpg', '.png', '.gif']))
        {
          echo '<a data-action href="'. $myUrl['path'].'"><img src="'. $myUrl['path']. '" alt="'. \dash\data::dataRow_title(). '"></a>';
        }
      }
    }
    echo '</div>';

    echo '<div class="gallery2">';
    foreach ($dataRow['gallery_array'] as $key => $myUrl)
    {
      if(isset($myUrl['path']))
      {
        $endUrl = substr($myUrl['path'], -4);
        if(in_array($endUrl, ['.mp4']))
        {
          echo '<video controls><source src="'. $myUrl['path']. '" type="video/mp4"></video>';
        }
        elseif(in_array($endUrl, ['.mp3']))
        {
          echo '<audio controls><source src="'. $myUrl['path'] .'" type="audio/mpeg"></audio>';
        }
        elseif(in_array($endUrl, ['.pdf']))
        {
          echo '<a href="'. $myUrl['path'] .'" class="btn lg mT25 primary">'. T_("Download"). ' '. T_("PDF"). '</a>';
        }
      }
    }
    echo '</div>';
  }
  ?>


  <?php
  if(\dash\data::dataRow_type() === 'post' && \dash\data::dataRow_datemodified())
  {
  ?>
  <div class='msg simple f mT20'>
    <div class="c"><time class="ltr compact" datetime="<?php echo \dash\data::dataRow_datemodified(); ?>"><?php echo \dash\fit::date_time(\dash\data::dataRow_publishdate()); ?></time></div>
    <div class="cauto os"><a data-copy='<?php echo \dash\url::kingdom(). '/n/'. \dash\data::dataRow_id(); ?>' href="<?php echo \dash\url::kingdom(). '/n/'. \dash\data::dataRow_id(); ?>" title='<?php echo T_("For share via social networks"); ?>'><?php echo T_("Short Code"); ?> <span class="txtB"><?php echo \dash\data::dataRow_id(); ?></span></a></div>
  </div>

  <?php
  } // endif
  ?>

  <?php if(a($dataRow, 'tags') && is_array(a($dataRow, 'tags'))) {?>
  <div class="tagBox msg simple">
    <?php
    foreach ($dataRow['tags'] as $key => $value)
    {
      echo "<span class='btn'>";
      echo a($value, 'title');
      echo "</span> ";
    } //endfor
    ?>
  </div>
  <?php } //endif

  $myPostSimilar = []; // \dash\app\posts\get::get_post_list['mode' => 'similar', 'post_id' => \dash\data::dataRow_id()]);
  if($myPostSimilar)
  {
    echo '<nav class="msg">';
    echo '<h4 class="mB20-f">'. T_("Recommended for you"). '</h4>';
    foreach ($myPostSimilar as $key => $value)
    {
      echo '<a class="block" href="'. \dash\url::kingdom().'/n/'. \dash\data::dataRow_id().'">'. $value['title']. '</a>';
    }
    echo '</nav>';
  }

if(\dash\data::dataRow_comment() === 'open')
{
  require_once('display-add-comment.php');
}
require_once('display-comment-list.php');
?>
  </section>
</article>