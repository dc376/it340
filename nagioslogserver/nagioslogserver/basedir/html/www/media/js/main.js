$(document).ready(function() {
    
    // Dismiss trial notice
    $('#close_trial').click(function() {
        $.post(site_url + 'api/system/dismiss_trial', { }, function(data) {
            // Dismissed
        });
        $('#close_trial').parent().parent().toggle();
    });

    // Resize the navbar on the config editor pages
    var resize_cfg_navbar = function() {
        if ($('.config-editor-side').length) {
            var height = $(window).height() - 250;
            $('.config-editor-side').css('height', height+"px");
        }
    }
    
    var resize_admin_navbar = function() {
        if ($('.admin-leftbar').length) {
            var height = $(window).height() - 250;
            $('.admin-leftbar').css('height', height+"px");
            var well_height = $('.admin-leftbar').height() - 52 - $('.admin-leftbar .well:first').height();
            $('.admin-leftbar .well:last').css('height', well_height+"px");
        }
    }

    // Get the status of the server and check every minute after
    get_server_status();
    setInterval(get_server_status, 1*60*1000);

    // Resize the configure menu sidebar
    resize_cfg_navbar();
    resize_admin_navbar();
    $(window).resize(function() {
        resize_cfg_navbar();
        resize_admin_navbar();
    });
    
    // Select all in select-all class boxes
    $('.select-all').click(function() {
        $(this).select();
    });
    
    ////////////////////////////////////////
    //  Navbar Search Redirection
    ////////////////////////////////////////
    $('.navbar-search').submit(function (e) {
        e.preventDefault(); //STOP default action
        querystring=$(this).serialize().replace(/\+/g,'%20');
        window.location.replace($(this).attr('action') + "?" + querystring);
    });

    $('.ls-tooltip').tooltip();

    jQuery.fn.extend({
        //use example: $('textarea').insertAtCaret( 'some string of characters' );
        insertAtCaret: function(myValue){
          return this.each(function(i) {
            if (document.selection) {
              //For browsers like Internet Explorer
              this.focus();
              var sel = document.selection.createRange();
              sel.text = myValue;
              this.focus();
            }
            else if (this.selectionStart || this.selectionStart == '0') {
              //For browsers like Firefox and Webkit based
              var startPos = this.selectionStart;
              var endPos = this.selectionEnd;
              var scrollTop = this.scrollTop;
              this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
              this.focus();
              this.selectionStart = startPos + myValue.length;
              this.selectionEnd = startPos + myValue.length;
              this.scrollTop = scrollTop;
            } else {
              this.value += myValue;
              this.focus();
            }
          });
        }    
    });

    // Confirgure text box coolness
    $(".box-wrapper").on('keydown', 'textarea', function(e) { 
        var keyCode = e.keyCode || e.which;
        if (keyCode == 9) {
            e.preventDefault();
            $(this).insertAtCaret('    '); // Inserts a "tab" made of spaces...
        } 
    });

    // Configure advanced settings
    $(".nodes-toggle-advanced").click(function() {
        if ($(this).find('i').hasClass('fa-caret-up')) {
            $(this).find('i').removeClass('fa-caret-up');
            $(this).find('i').addClass('fa-caret-down');
            $('.nodes').show();
        } else {
            $(this).find('i').removeClass('fa-caret-down');
            $(this).find('i').addClass('fa-caret-up');
            $('.nodes').hide();
        }
    });

    // Activate all tooltips
    // - Not actually sure why we are doing this... we don't want all
    //   titles to be yucky jquery-ui tooltips -JO
    //
    //$('body').tooltip({
    //    selector: '[rel=tooltip]'
    //});
    //$("[rel=tooltip]").click(function(e) {
    //    e.preventDefault();
    //});

    // Make page not scroll when modal is open
    $(".modal").on("show", function () {
        $("body").addClass("modal-open");
    }).on("hidden", function () {
        $("body").removeClass("modal-open");
    });

    // Remove panel-container on homepage
    if ($('.home-container').length > 0) {
        $('.home-container').find('.panel-extra').css('border', 'none');
    }
    
        
    ////////////////////////////////////////
    //  Index Management
    //////////////////////////////////////// 
    // close open index
    $('.close-index').click(function(e) {
        var index = e.target.id;
        var conf = confirm("Are you sure you want to close index " + index + "?");
        if (conf == true && index.indexOf("logstash") > -1) {
            $.post(site_url + 'api/backend/' + index + '/_close', {}, function(data) {
                if (data.success == 0) {
                    alert(data.errormsg);
                } else {
                    window.location.href = window.location.href;
                }
            }, 'json');
        }
    });
    
    // open closed index
    $('.open-index').click(function(e) {
        var index = e.target.id;
        var conf = confirm("Are you sure you want to open index " + index + "?");
        if (conf == true && index.indexOf("logstash") > -1) {
            $.post(site_url + 'api/backend/' + index + '/_open', {}, function(data) {
                if (data.success == 0) {
                    alert(data.errormsg);
                } else {
                    window.location.href = window.location.href;
                }
            }, 'json');
        }
    });
    
    // delete index
    $('.delete-index').click(function(e) {
        var index = $(this).children().first().val();
        var conf = confirm("Are you sure you want to PERMANENTLY DELETE index " + index + "?");
        if (conf == true && index.indexOf("logstash") > -1) {
            $.ajax({
                url: site_url + 'api/backend/' + index + '/',
                type: 'DELETE',
                success: function(data) {
                    if (data.success == 0) {
                        alert(data.errormsg);
                    } else {
                        window.location.href = window.location.href;
                    }
                }
            });
        }
    });
    
    ////////////////////////////////////////
    //  Backup Management
    //////////////////////////////////////// 
    // delete repository
    $('.delete-repository').click(function(e) {
        var repo = $(this).children().first().val();
        var conf = confirm("Are you sure you want to PERMANENTLY DELETE repository " + repo + "?");
        if (conf == true && (typeof(repo) !== 'undefined') && (repo.length > 0)) {
            $.ajax({
                url: site_url + 'api/backend/_snapshot/' + repo,
                type: 'DELETE',
                success: function(data) {
                    if (data.success == 0) {
                        alert(data.errormsg);
                    } else {
                        window.location.href = window.location.href;
                    }
                }
            });
        }
    });
    
    // Restore snapshot modal
    $('.restore-snapshot').click(function() {
        var repo = $(this).data('repo');
        var snapshot = $(this).data('snapshot');
        var created_date = $(this).data('created');

        $('.restore-sh').html(snapshot);
        $('.restore-created').html(created_date);
        $('.restore-indices').html('');
        $('.restore-repo').val(repo);

        $.get(site_url + 'api/backend/_snapshot/' + repo + '/' + snapshot, {}, function(data) {

            if (data.snapshots[0].indices.length > 0) {
                $(data.snapshots[0].indices).each(function(k, v) {
                    $('.restore-indices').append('<tr><td style="width: 20px; text-align: right;"><input type="checkbox" value="'+v+'" class="rsi"></td><td>'+v+'</td></tr>');
                });
            
                // Check everything
                $('#checkall').prop('checked', false);
                $('#checkall').click();

                $('#restore-modal').modal('show');
            } else {
                alert('Could not find indices in snapshot.');
            }

        });
    });

    $('.restore-indices').on('click', 'tr', function(e) {
        if ($(e.target).hasClass('rsi')) { return; }
        if ($(this).find('.rsi').is(':checked')) {
            $(this).find('.rsi').prop('checked', false);
        } else {
            $(this).find('.rsi').prop('checked', true);
        }
    });

    $('#checkall').click(function() {
        if ($(this).is(':checked')) {
            $('.rsi').prop('checked', true);
        } else {
            $('.rsi').prop('checked', false);
        }
    });

    $('#do-restore').click(function() {
        var repo = $('.restore-repo').val();
        var snapshot = $('.restore-sh').text();

        // Grab all checkboxes
        var indices = $('.rsi:checked').map(function() { return $(this).val(); }).get();

        // Do actual restore
        restore_snapshot(repo, snapshot, indices);
        $(this).button('loading');
    });
    
    // delete snapshot
    $('.delete-snapshot').click(function(e) {
        var snapshot = $('input[name="snapshot"]', this).val();
        var repo = $('input[name="repository"]', this).val();
        var conf = confirm("Are you sure you want to PERMANENTLY DELETE " + snapshot + " from " + repo + "?");
        if (conf == true && (typeof(repo) !== 'undefined') && (repo.length > 0)) {
            $.ajax({
                url: site_url + 'api/backend/_snapshot/' + repo + "/" + snapshot,
                type: 'DELETE',
                success: function(data) {
                    if (data.acknowledged != true) {
                        alert(data.error);
                    } else {
                        window.location.href = window.location.href;
                    }
                }
            });
        }
    });
    
});

// Do ajax request for server status and build the status HTML
function get_server_status() {
    if (!logged_in) { return; }
    
    var subsystems = ['logstash', 'elasticsearch'];
    $.each(subsystems, function(k, subsystem) {
        if ($('.ss-'+subsystem).find('img').length == 0) {
            $('.ss-'+subsystem).html('');
        }
    });

    $.each(subsystems, function(k, subsystem) {
        $.post(site_url + 'api/system/status', { 'subsystem': subsystem }, function(data) {
            if (data.status == "running") {
                html = '<span style="margin-right: 3px;"><img src="'+base_url+'media/icons/accept.png" title="'+data.message+'"></span>';
            } else {
                html = '<span style="margin-right: 3px;"><img src="'+base_url+'media/icons/exclamation.png" title="'+data.message+'"></span>';
            }
            $('.ss-'+subsystem).html(html);
        }, 'json');
    });
}

function restore_snapshot(repo, snapshot, indices)
{
    $.get(site_url + 'api/backend/_cluster/state/metadata/' + snapshot, { }, function(data) {
        if (typeof(data.metadata.indices[snapshot]) !== 'undefined' && data.metadata.indices[snapshot].state != 'close') {
            alert('You cannot restore an opened index');
            return;
        } else {
            if ((typeof(repo) !== 'undefined') && (repo.length > 0) && (typeof(snapshot) !== 'undefined') && (snapshot.length > 0)) {

                var ids = '';
                if (indices.length > 0) {
                    ids = '{ "indices": "' + indices.join(',') + '" }';
                }

                $.ajax({
                    type: 'POST',
                    url: site_url + 'api/backend/_snapshot/' + repo + "/" + snapshot + "/_restore",
                    data: ids,
                    dataType: 'json',
                    contentType: 'text/plain',
                    success: function(data) {
                        if (data == null) {
                            alert('Can not restore index(s). One or more indices selected may already be open.');
                            $('#do-restore').button('reset');
                            return;
                        }
                        if (data.accepted != true) {
                            alert(data.error);
                        } else {
                            window.location.href = window.location.href + '?restoring=' + snapshot;
                        }
                }});
            }
        }
    });
}