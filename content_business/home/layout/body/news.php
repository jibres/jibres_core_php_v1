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
  if($template  == 'simple')
  {
?>

  <div class="jBlog1">
    <div class="avand-md">
      <?php foreach ($postList as $key => $post) { ?>
        <article>
          <header>
            <h2><a href="<?php echo a($post, 'link'); ?>"><?php echo a($post, 'title'); ?></a></h2>
            <div class="meta txtRa">
              <time datetime="<?php echo a($post, 'publishdate'); ?>"><?php echo \dash\fit::date_human(a($post, 'publishdate')); ?></time>
            </div>
          </header>
          <section>
            <p><?php echo a($post, 'excerpt'); ?></p>
            <div class="more"><a href="<?php echo a($post, 'link'); ?>"><?php echo T_("Keep Reading"); ?> <span class="sf-angle-double-left"></span></a></div>
          </section>
        </article>
      <?php } // end foreach ?>
    </div>
  </div>

<?php }else{?>

  <div class="avand-md">
    <?php foreach ($postList as $key => $value) {?>
      <a class="overlay"<?php if(a($value, 'link')) { echo ' href="'.  a($value, 'link'). '"'; if(a($value, 'target')) { echo ' target="_blank"'; }} ?>>
        <figure>
          <img src="<?php echo \lib\filepath::fix(a($value, 'meta','thumb')); ?>" alt="<?php echo a($value, 'title'); ?>">
          <figcaption><h2><?php echo a($value, 'title'); ?></h2></figcaption>
        </figure>
      </a>
    <?php } //endfor ?>
  </div>
 <?php } //endif ?>
<?php } //endif ?>