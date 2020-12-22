<?php
$post_detail = \dash\app\posts\load::template($line_detail);
$postList    = a($post_detail, 'list');

if($postList && is_array($postList))
{
  var_dump(a($line_detail, 'value', 'play_item'));
?>


  <section class="<?php echo a($line_detail, 'value', 'avand'); ?> puzzle imgLine" data-mode='<?php echo a($line_detail, 'value', 'type'); ?>' data-design='<?php echo a($line_detail, 'value', 'design'); ?>'>
   <?php echo \lib\app\website\generator\title::html($line_detail, a($post_detail, 'line_link')); ?>
   <div class="row padMore2">
<?php foreach ($postList as $key => $value) {?>
<?php $myPuzzle = \lib\app\website\puzzle::layout($key, $line_detail); ?>

    <div class="<?php echo a($myPuzzle, 'class'); ?>">
     <a<?php if(a($value, 'link')) { echo ' href="'.  a($value, 'link'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
      <figure>
       <img src="<?php echo \lib\filepath::fix(a($value, 'thumb')); ?>" alt="<?php echo a($value, 'title'); ?>">
       <figcaption><h2><?php echo a($value, 'title'); ?></h2></figcaption>
      </figure>
     </a>
    </div>
<?php } //endfor ?>
   </div>
  </section>


<?php } //endif ?>