<?php include_once('../../../setlang.inc.php'); ?>

<?php echo _('The topN query uses an'); ?> <a target="_blank" href="http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/search-facets-terms-facet.html"><?php echo _('Elasticsearch terms facet'); ?></a> <?php echo _('to find the most common terms in a field and build queries from the result'); ?>. <?php echo _('The topN query uses'); ?> <a target="_blank" href='http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/query-dsl-query-string-query.html#query-string-syntax'><?php echo _('LUCENE query string syntax'); ?></a>

<h4><?php echo _('Parameters'); ?></h4>
<ul>
  <li>
    <strong><?php echo _('Field'); ?></strong> / <?php echo _('The field to facet on. Fields with a large number of unique terms will'); ?> <a target="_blank" href="http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/search-facets-terms-facet.html#_memory_considerations_2"><?php echo _('use more memory'); ?></a> <?php echo _('to calculate'); ?>.
  </li>
  <li>
    <strong><?php echo _('Count'); ?></strong> / <?php echo _('How many queries to generate. The resulting queries will use brightness variations on the original query\'s color for their own.'); ?>
  </li>
  <li>
    <strong><?php echo _('Union'); ?></strong> / <?php echo _('The relation the generated queries have to the original. For example, if your field was set to "extension", your original query was "user:B.Awesome" and your union was AND. Kibana might generate the following example query'); ?>: <code>extension:"html" AND (user:B.Awesome)</code>
  </li>
</ul>