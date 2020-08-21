
<?php

$template = 'special';
if(isset($line_detail['value']['news']['template']) && $line_detail['value']['news']['template'] && is_string($line_detail['value']['news']['template']))
{
  $template = $line_detail['value']['news']['template'];
}

$cat_id = null;
if(isset($line_detail['news']['cat_id']) && $line_detail['news']['cat_id'] && is_numeric($line_detail['news']['cat_id']))
{
  $cat_id = intval($line_detail['news']['cat_id']);
}

$postList = \dash\app\posts::get_post_list(['limit' => 5, 'cat_id' => $cat_id]);

if($postList && is_array($postList))
{
?>

<?php if($template  == 'simple') {?>

  <div class="jBlog1">
      <div class="avand-md">

<?php foreach ($postList as $key => $post) { ?>


<article>
  <header>
    <h2><a href="<?php echo \dash\get::index($post, 'link'); ?>"><?php echo \dash\get::index($post, 'title'); ?></a></h2>
    <div class="meta txtRa">
      <time datetime="<?php echo \dash\get::index($post, 'publishdate'); ?>"><?php echo \dash\fit::date_human(\dash\get::index($post, 'publishdate')); ?></time>
    </div>
  </header>
  <section>
    <p><?php echo \dash\get::index($post, 'excerpt'); ?></p>
    <div class="more"><a href="<?php echo \dash\get::index($post, 'link'); ?>"><?php echo T_("Keep Reading"); ?> <span class="sf-angle-double-left"></span></a></div>
  </section>
</article>

<?php } // end foreach ?>

      </div>
    </div>

<?php }else{?>

<div class="avand">
  <div class="row roundedBox">
        <?php foreach ($postList as $key => $value) {?>
          <div class="row">
              <div class="c-3">
                <a class="overlay"<?php if(\dash\get::index($value, 'url')) { echo ' href="'.  \dash\get::index($value, 'url'). '"'; if(\dash\get::index($value, 'target')) { echo ' target="_blank"'; }} ?>>
                  <figure>
                    <img src="<?php echo \lib\filepath::fix(\dash\get::index($value, 'meta','thumb')); ?>" alt="<?php echo \dash\get::index($value, 'title'); ?>">
                    <figcaption><h2><?php echo \dash\get::index($value, 'title'); ?></h2></figcaption>
                  </figure>
                </a>
              </div>
          </div>
        <?php } //endfor ?>
  </div>
</div>
<?php } //endif ?>
<?php } //endif ?>

