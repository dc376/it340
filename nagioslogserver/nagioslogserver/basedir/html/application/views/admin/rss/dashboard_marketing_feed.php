<?php if ($rss_result): ?>
    <?php $x = 0; foreach ($rss_result->items as $item): ?>
    <?php if ($x++ > 3) { break; } ?>
    <?php echo $item['description'] ?>
    <?php endforeach; ?>
<?php endif; ?>