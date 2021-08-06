<?php if(\dash\data::myPostList()) {?>
  <div class="avand">
    <nav class="items">
      <ul>
        <?php foreach (\dash\data::myPostList() as $key => $value) { ?>
          <li>
            <a class="f align-center" href="<?php echo a($value, 'link') ?>">
              <div class="key"><?php echo a($value ,'title'); ?></div>
              <div class="go"></div>
            </a>
          </li>
        <?php } //endfor ?>
      </ul>
    </nav>
  </div>
<?php } //endif ?>