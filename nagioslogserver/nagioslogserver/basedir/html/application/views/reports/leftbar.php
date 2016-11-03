        <script>
        $(document).ready(function() {

            var elastic_report_query = function() {
                $.post(site_url + 'api/user/get_reports', function(data) {
                    $.each(data, function(index, value) {
                        $('#reports').append('<li><a href="' + site_url + 'reports/report#/dashboard/report/' + value.id + '">' + value.title + '</a></li>');
                    });
                }, 'json');
            }

            elastic_report_query();

        });
        </script>
        <div class="lside config-editor-side">
            <div class="well">
                <ul class="nav nav-list" id="reports">
                    <li class="nav-header"><?php echo _("Reports"); ?></li>
                    <?php if ($tab == "backup") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('reports/backup'); ?>"><?php echo _("Backup"); ?></a></li>
                    <?php if ($tab == "maintenance") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('reports/maintenance'); ?>"><?php echo _("Maintenance"); ?></a></li>
                    <?php if ($tab == "security") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('reports/security'); ?>"><?php echo _("Security"); ?></a></li>
                    <?php if ($tab == "jobs") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('reports/jobs'); ?>"><?php echo _("Jobs"); ?></a></li>
                    <?php if ($tab == "poller") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('reports/poller'); ?>"><?php echo _("Poller"); ?></a></li>
                    <?php if ($tab == "info") { echo '<li class="active">'; } else { echo '<li>'; } ?><a href="<?php echo site_url('reports/info'); ?>"><?php echo _("Info"); ?></a></li>
                
                <li class="nav-header"><?php echo _("Saved Reports"); ?></li>
                
                </ul>
            </div>

        </div>