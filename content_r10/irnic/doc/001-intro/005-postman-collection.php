<div class="box">
  <header>
    <h2 class="f" data-kerkere='#postman-collection' data-kerkere-icon='open'>
     	<?php echo T_("Postman Collection JSON"); ?>
    </h2>
  </header>
  <div class="body" id="postman-collection">
    <p><?php echo T_("If you use from postman for api, can import this collection to get all request in postman"); ?></p>
    <a class="btn success" data-direct href="<?php echo \dash\url::cdn(). '/api/Jibres_Domain_API_r10.postman_collection.json'; ?>" download><?php echo T_("Download Postman Collection"); ?></a>
  </div>
</div>


