<?php include_once('../../../setlang.inc.php'); ?>

<?php echo _('The regex query allows you to use regular expressions to match terms in the'); ?> <i>_all</i> <?php echo _('field'); ?>.

<?php echo _('A detailed overview of lucene\'s regex engine is available here'); ?>: <a target="_blank" href="http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/query-dsl-regexp-query.html#regexp-syntax"><?php echo _('Regular expressions in Elasticsearch'); ?></a>

<h5><?php echo _('A note on anchoring'); ?></h5>
<?php echo _('Lucene\'s patterns are always anchored. The pattern provided must match the entire string. For string "abcde"'); ?>:
<p>
<code>ab.*</code> <?php echo _('will match'); ?><br>
<code>abcd</code> <?php echo _('will not match'); ?></br>
</p>