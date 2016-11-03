<?php if ($rss_result): ?>
<ul>
    <?php $x = 0; foreach ($rss_result->items as $item): ?>
    <?php if ($x++ > 3) { break; } ?>
    <li><?php echo $item['description'] ?></li>
    <?php endforeach; ?>
</ul>
<?php else: ?>
<p><?php echo _("An error occurred while trying to fetch the Nagios Core feed.  Stay on top of what's happening by visiting"); ?> <a href='http://www.nagios.org/' target='_blank'>http://www.nagios.org/</a>.</p>
<?php endif; ?>