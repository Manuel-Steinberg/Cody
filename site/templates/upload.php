<?php snippet('header') ?>

  <main class="main" role="main">

    <div class="text">
      <?php echo $page->text()->kirbytext() ?>
    </div>

    <hr>
    
    <form action="<?php echo $page->url(); ?>" method="post" enctype="multipart/form-data">
        <label for="file">Datei:</label>
        <input id="file" type="file" name="file" />
        <input type="submit" name="submit" value="Upload" />
    </form>
    
		<?php var_dump($page->getErrors()); ?>
		<br>
    <?php echo $log ?>
    <p>Debug Informationen:
    <pre>
        <?php print_r($file); ?>
    </pre>
    </p>

  </main>

<?php snippet('footer') ?>