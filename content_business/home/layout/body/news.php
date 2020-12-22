<?php
$template = 'special';
if(isset($line_detail['value']['news']['template']) && $line_detail['value']['news']['template'] && is_string($line_detail['value']['news']['template']))
{
  $template = $line_detail['value']['news']['template'];
}

$post_detail = \dash\app\posts\load::template($line_detail);

$postList = a($post_detail, 'list');

if($postList && is_array($postList))
{
?>
  <section class="avand-lg puzzle imgLine" data-theme='simple' data-mode='news'>
<?php echo \lib\app\website\generator\title::html($line_detail, a($post_detail, 'line_link')); ?>
    <div class="row padMore2">
      <div class="row">
        <?php foreach ($postList as $key => $value) {?>
          <div <?php echo \lib\app\website\puzzle::layout($key, $line_detail); ?>>
            <a class="overlay"<?php if(a($value, 'link')) { echo ' href="'.  a($value, 'link'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
              <figure>
                <img src="<?php echo \lib\filepath::fix(a($value, 'thumb')); ?>" alt="<?php echo a($value, 'title'); ?>">
                <figcaption><h2><?php echo a($value, 'title'); ?></h2></figcaption>
              </figure>
            </a>
          </div>
        <?php } //endfor ?>
      </div>
    </div>
  </section>
<?php } //endif ?>