
<?php
$productline = \lib\app\product\get::website_last_product();


if($productline && is_array($productline)) { ?>
<section class="productLine">
  <div class="avand">


<?php if(isset($line_detail['value']['title'])) {?>
    <h2 class="jTitle1"><?php echo $line_detail['value']['title']; ?></h2>
<?php } //endif ?>
    <?php \lib\website::product_list($productline); ?>
  </div>
</section>

<?php } //endif ?>