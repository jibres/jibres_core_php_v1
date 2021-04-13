<?php if(\dash\data::dataTable()) {?>
  <div class="avand-md">
    <nav class="items">
      <ul>
        <?php foreach (\dash\data::dataTable() as $key => $value) { ?>
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