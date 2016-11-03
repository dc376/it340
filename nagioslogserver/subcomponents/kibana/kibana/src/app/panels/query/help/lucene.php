<?php include_once('../../../setlang.inc.php'); ?>

<?php echo _('The lucene query type uses'); ?> <a target="_blank" href='http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/query-dsl-query-string-query.html#query-string-syntax'><?php echo _('LUCENE query string syntax'); ?></a> <?php echo _('to find matching documents or events within Elasticsearch'); ?>.

<h4><?php echo _('Examples'); ?></h4>
<ul class="unstyled" type="disc">
  <li class="listitem"><p class="simpara">
  <code class="literal">status</code> <?php echo _('field contains'); ?> <code class="literal">active</code>
  </p><pre class="literallayout">status:active</pre></li>
  <li class="listitem"><p class="simpara">
  <code class="literal">title</code> <?php echo _('field contains'); ?> <code class="literal"><?php echo _('quick'); ?></code> <?php echo _('or'); ?> <code class="literal"><?php echo _('brown'); ?></code>
  </p><pre class="literallayout">title:(<?php echo _('quick brown'); ?>)</pre></li>
  <li class="listitem"><p class="simpara">
  <code class="literal">author</code> <?php echo _('field contains the exact phrase'); ?> <code class="literal">"<?php echo _('john smith'); ?>"</code>
  </p><pre class="literallayout">author:"<?php echo _('John Smith'); ?>"</pre></li>
</ul>

<p><?php echo _('Wildcard searches can be run on individual terms, using'); ?> <code class="literal">?</code> <?php echo _('to replace
a single character, and'); ?> <code class="literal">*</code> <?php echo _('to replace zero or more characters'); ?>:</p>
<pre class="literallayout">qu?ck bro*</pre>

<ul class="unstyled" type="disc">
  <li class="listitem"><p class="simpara">
  <?php echo _('Numbers'); ?> 1..5
  </p><pre class="literallayout">count:[1 TO 5]</pre></li>
  <li class="listitem"><p class="simpara">
  <?php echo _('Tags between'); ?> <code class="literal">alpha</code> <?php echo _('and'); ?> <code class="literal">omega</code>, <?php echo _('excluding'); ?> <code class="literal">alpha</code> <?php echo _('and'); ?> <code class="literal">omega</code>:
  </p><pre class="literallayout">tag:{alpha TO omega}</pre></li>
  <li class="listitem"><p class="simpara">
  <?php echo _('Numbers from 10 upwards'); ?>
  </p><pre class="literallayout">count:[10 TO *]</pre></li>
</ul>
