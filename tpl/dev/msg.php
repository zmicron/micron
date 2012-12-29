
    <head>
        <link rel="stylesheet" type="text/css" href="<?= Root('i/css/dev/msg.css')?>" />
    </head>
    <?php IncludeCom('dev/jquery')?>

    <div class="<?= $css?>" onclick="$(this).slideUp('fast')"><?= $message?></div>