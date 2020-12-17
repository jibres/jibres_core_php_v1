<?php
  $commentList = \dash\app\comment::get_post_comment();
  if($commentList)
  {
    foreach ($commentList as $key => $value)
    {
?>
  <div class="msg mT10">
    <div class="f">
      <div class="c s12">
        <img src="<?php echo a($value, 'avatar'); ?>" class="avatar">
        <span class="badge"><?php echo a($value, 'displayname'); ?></span>
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
?>