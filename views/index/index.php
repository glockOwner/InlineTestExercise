<?php include 'views/layouts/header.php';?>
        <a href="/downloadData" class="btn btn-primary" type="button">Скачать посты и комментарии</a>
        <?php if ($_SESSION['result']):?>
            <p class="mt-5" style="color: green;"><?php echo $_SESSION['result'];?></p>
            <?php echo "<script>console.log(" . json_encode($_SESSION['result']) . ");</script>";?>
            <a href="/search" class="btn btn-primary" type="button">Форма поиска постов по комментарию</a>
        <?php endif;?>
<?php include 'views/layouts/footer.php';?>