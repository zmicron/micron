<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?= LANG?>" dir="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<?= $g_config['charset']?>" />

        <title><?= $g_title?></title>
        <?php if ( ! empty($g_description)):?>
            <meta name="description" content="<?= $g_description?>" />
        <?php endif?>
        <?php if ( ! empty($g_keywords)):?>
            <meta name="keywords" content="<?= $g_keywords?>" />
        <?php endif?>

        <link rel="icon" href="<?= Root('favicon.ico')?>" type="image/x-icon" />
        <link rel="shortcut icon" href="<?= Root('favicon.ico')?>" type="image/x-icon" />

        <link rel="stylesheet" type="text/css" href="<?= Root('i/css/normalize.css')?>" />
        <link rel="stylesheet" type="text/css" href="<?= Root('i/css/dev/funcs.css')?>" />
        <!-- extraPacker -->
    </head>
    <body>
        <?= $content?>
        <head>
            <link rel="stylesheet" type="text/css" href="<?= Root('i/css/main.css')?>" />
        </head>
    </body>
</html>