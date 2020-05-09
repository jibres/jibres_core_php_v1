

<?php if(\dash\data::bodyLineList()) {?>
<nav class="items">
  <ul>
  <?php foreach (\dash\data::bodyLineList() as $key => $value) {?>

     <li>
        <a href="<?php echo \dash\url::that(). '/'. \dash\get::index($value,'key') .'?key='. \dash\get::index($value, 'saved_detail', 'line_key'); ?>" class="f">
          <div class="key">
            <div class="f">
              <?php echo \dash\get::index($value, 'title')?>
            </div>
          </div>
          <div class="go"></div>
        </a>
     </li>
  <?php } //endfor ?>
  </ul>
</nav>
<?php } //endif ?>

