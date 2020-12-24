<?php
$blockData = \dash\app\posts\load::template($line_detail);

echo \lib\app\website\generator\datablock::html($line_detail, $blockData);


$postList    = a($blockData, 'list');

if($postList && is_array($postList)) {?>

  <section class="<?php echo a($line_detail, 'value', 'avand'); ?> puzzle imgLine" data-mode='<?php echo a($line_detail, 'value', 'type'); ?>' data-design='<?php echo a($line_detail, 'value', 'design'); ?>'>
   <?php echo \lib\app\website\generator\title::html($line_detail, a($blockData, 'line_link')); ?>


   <div class="row padMore2">
<?php foreach ($postList as $key => $value) {?>
<?php $myPuzzle = \lib\app\website\puzzle::layout($key, $line_detail); ?>
    <div class="<?php echo a($myPuzzle, 'class'); ?>">
<?php if( a($value, 'gallery_array', 0, 'path') && a($myPuzzle, 'playMode') === 'video') { ?>
     <video controls preload='meta'<?php if(a($value, 'poster')) { echo " poster='". \lib\filepath::fix(a($value, 'poster')). "'";} ?>>
      <source type="<?php echo a($value, 'gallery_array', 0, 'mime'); ?>" src="<?php echo \lib\filepath::fix(a($value, 'gallery_array', 0, 'path')); ?>">
     </video>
<?php } elseif( a($value, 'gallery_array', 0, 'path') && a($myPuzzle, 'playMode') === 'audio') { ?>
     <audio controls preload='meta'>
      <source type="<?php echo a($value, 'gallery_array', 0, 'mime'); ?>" src="<?php echo \lib\filepath::fix(a($value, 'gallery_array', 0, 'path')); ?>">
     </audio>
<?php } elseif (a($value, 'thumb')) { ?>
     <a<?php if(a($value, 'link')) { echo ' href="'.  a($value, 'link'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
      <img src="<?php echo \lib\filepath::fix(a($value, 'thumb')); ?>" alt="<?php echo a($value, 'title'); ?>">
     </a>
<?php } ?>

     <a<?php if(a($value, 'link')) { echo ' href="'.  a($value, 'link'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
      <figure>
       <figcaption><h2><?php echo a($value, 'title'); ?></h2></figcaption>
      </figure>
     </a>
    </div>
<?php } //endfor ?>
   </div>
  </section>

<?php } //endif ?>