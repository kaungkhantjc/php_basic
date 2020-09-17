<?php if (count($errors) > 0 || isset($_SESSION['message'])) : ?>
    <div class="w3-animate-opacity w3-panel w3-leftbar w3-rightbar w3-pale-red w3-border-red">

        <?php foreach ($errors as $error) : ?>
            <h5><?php echo $error ?></h5>
        <?php endforeach ?>

        <?php if (isset($_SESSION['message'])) : ?>
            <h5><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></h5>
        <?php endif ?>

    </div>
<?php endif ?>