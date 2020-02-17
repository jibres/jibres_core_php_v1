<?php if(\dash\permission::check('cpPostsView') || \dash\permission::check('cpCategoryView') || \dash\permission::check('cpTagView') || \dash\permission::check('cpPageView')  ) { ?>

  <li>
    <ul>
<?php if(\dash\permission::check('cpPostsView')) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/posts"><i class='fc-mute sf-pinboard'></i> <?php echo T_("News"); ?></a></li>
<?php } //endif ?>
<?php if(\dash\permission::check('cpCategoryView')) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/terms?type=cat"><i class='fc-mute sf-grid'></i> <?php echo T_("Categories"); ?></a></li>
<?php } //endif ?>
<?php if(\dash\permission::check('cpTagView')) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/terms?type=tag"><i class='fc-mute sf-tags'></i> <?php echo T_("Keywords"); ?></a></li>
<?php } //endif ?>
<?php if(\dash\permission::check('cpPageView')) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/posts?type=page"><i class='fc-mute sf-files-o'></i> <?php echo T_("Static Pages"); ?></a></li>
<?php } //endif ?>
    </ul>
  </li>
<?php } //endif ?>




<?php if(\dash\permission::check('cpHelpCenterView') || \dash\permission::check('cpTagHelpAdd') || \dash\permission::check('cpTagHelpEdit')  ) { ?>

  <li>
    <ul>
<?php if(\dash\permission::check('cpHelpCenterView')) {?>
      <li><a href="<?php echo \dash\url::here(); ?>/posts?type=help"><i class='fc-mute sf-info-circle'></i> <?php echo T_("Help Center"); ?></a></li>
<?php } //endif ?>


<?php if(\dash\permission::check('cpTagHelpAdd') || \dash\permission::check('cpTagHelpEdit')   ) { ?>

      <li><a href="<?php echo \dash\url::here(); ?>/terms?type=help_tag"><i class='fc-mute sf-clone'></i> <?php echo T_("Help Center Keywords"); ?></a></li>
<?php } //endif ?>

      </ul>
    </li>
<?php } //endif ?>



<?php if(\dash\permission::check('cpCommentsView')) {?>
  <li>
    <ul>

      <li><a href="<?php echo \dash\url::here(); ?>/comments"><i class='fc-mute sf-comments'></i> <?php echo T_("All Comments"); ?></a></li>

    </ul>
  </li>
<?php } //endif ?>





<?php if(\dash\permission::check('cpPostsView')) {?>
  <li>
    <ul>

        <li><a href="<?php echo \dash\url::here(); ?>/attachment"><i class='fc-mute sf-file-o'></i> <?php echo T_("Library"); ?></a></li>


        <li><a href="<?php echo \dash\url::here(); ?>/attachment/add"><i class='fc-mute sf-plus'></i> <?php echo T_("Add new file"); ?></a></li>

    </ul>
  </li>
<?php } //endif ?>
