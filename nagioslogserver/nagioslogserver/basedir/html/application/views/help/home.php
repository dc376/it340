<?php echo $header; ?>

<ul class="breadcrumb">
    <li class="active"><?php echo _('Help'); ?></li>
</ul>

<div class="container">
    <div class="row-fluid">
    	<div class="span12 configure-layout">
            <?php echo $leftbar; ?>
            <div class="rside">
                <div class="row-fluid">
                    <div class="span12">
                        <h2><?php echo _('Help'); ?></h2>
                        <p><?php echo _('Use this help section to learn how to navigate, configure, and effectively use Nagios Log Server to monitor logs across your network. Use the Helpful Resources section in the navigation pane to get more help from Nagios Support or to access the Nagios wiki and library.'); ?></p>
                        <h4><?php echo _('Getting Started'); ?></h4>
                        <p><?php echo _('The video playlists below will help with the initial setup and how to start recieving logs in Nagios Log Server. Before continuing through the help section watch this video:'); ?></p>
                        <?php if($is_admin) { ?>
                        <div class="row-fluid">
                            <div class="tab-content span12">
                                <ul class="nav nav-tabs" style="padding-left:20px;">
                                    <li class="active"><a href="#users" data-toggle="tab"><i class="fa fa-user" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Users"); ?></a></li>
                                    <li><a href="#admins" data-toggle="tab"><i class="fa fa-wrench" style="color:#4d89f9;margin-right:3px;"></i><?php echo _("Administrators"); ?></a></li>
                                </ul>
                                <div class="tab-pane active" id="users">
                                    <div>
                                        <h3><?php echo _('User Videos'); ?></h3>
                                        <iframe width="853" height="480" src="//www.youtube.com/embed/videoseries?list=PLN-ryIrpC_mBBszH4bXeA6rf9hoJGBXyA&showinfo=1&rel=0&vq=hd720&hd=1" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="tab-pane" id="admins">
                                    <div>
                                        <h3><?php echo _('Admin Videos'); ?></h3>
                                        <iframe width="853" height="480" src="//www.youtube.com/embed/videoseries?list=PLN-ryIrpC_mAW-Oc0YBp0mBOhWMBW1brG&showinfo=1&rel=0&vq=hd720&hd=1" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="row-fluid">
                            <div class="span12">
                                <h3><?php echo _('User Videos'); ?></h3>
                                <iframe width="853" height="480" src="//www.youtube.com/embed/videoseries?list=PLN-ryIrpC_mBBszH4bXeA6rf9hoJGBXyA&showinfo=1&rel=0&vq=hd720&hd=1" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <?php }; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $footer; ?>