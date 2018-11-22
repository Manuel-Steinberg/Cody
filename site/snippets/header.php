<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0">

        <title><?php echo $site->title()->html() ?> | <?php echo $page->title()->html() ?></title>
        <meta name="description" content="<?php echo $site->description()->html() ?>">
        <meta name="keywords" content="<?php echo $site->keywords()->html() ?>">

    </head>
    <body>

        <header class="header" role="banner">
            <h1><?php echo $page->title()->html() ?></h1>
            <?php
            // main menu items
            $items = $pages->visible();

// only show the menu if items are available
            if ($items->count()):
                ?>
                <nav>
                    <ul>
                        <?php foreach ($items as $item): ?>
                            <li><a<?php e($item->isOpen(), ' class="active"') ?> href="<?php echo $item->url() ?>"><?php echo $item->title()->html() ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </nav>
            <?php endif ?>
        </header>