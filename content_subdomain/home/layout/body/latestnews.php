
<?php

$postList = \dash\app\posts::get_post_list(['limit' => 5]);

if($postList && is_array($postList))
{
?>


  <div class="jBlog1">
      <div class="avand-sm">

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
<?php } //endif ?>

