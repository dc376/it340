$(document).ready(function() {
    // Help section: tooltip, Zeroclip and progress bar functions //
    prettyPrint();

    //tooltip fixes
    $(".code-tooltip").tooltip({
        placement: 'top'
    });

    $(".copy-button").click(function() {
        $(this).tooltip('hide');
        $('.copy-success', this).tooltip('show');
    });

    $('.copy-button').hover(
        function() {
            $(this).addClass('copy-hover');
            $(this).tooltip('show');
            $('.copy-success').tooltip('destroy');
        },
        function() {
            $(this).removeClass('copy-hover');
            $(this).tooltip('destroy');
            $('.copy-success').tooltip('destroy');
        }
    );

    function selectElementContents(select_class) {
        if (window.getSelection && document.createRange) {
            // IE 9 and non-IE
            var range = document.createRange();
            range.selectNodeContents(select_class);
            var sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(range);
        } else if (document.body.createTextRange) {
            // IE < 9
            var textRange = document.body.createTextRange();
            textRange.moveToElementText(select_class);
            textRange.select();
        }
    }

    $(".select-button").click(function() {
        selectElementContents(($(this).parent().find('code'))[0]);
        $(this).tooltip('hide');
        $('.select-success', this).tooltip('show');
    });

    $('.select-button').hover(
        function() {
            $(this).addClass('copy-hover');
            $(this).tooltip('show');
            $('.select-success').tooltip('destroy');
        },
        function() {
            $(this).removeClass('copy-hover');
            $(this).tooltip('destroy');
            $('.select-success').tooltip('destroy');
        }
    );
    
    //Zeroclip initialization and tooltip settings
    var clipboard = new ZeroClipboard( $('.copy-button') );

    clipboard.on('ready', function(event) { 
        clipboard.on('copy', function(event) {
            event.clipboardData.setData('text/plain', $(event.target).parent().find('.copy-target').text());
        });
    });

    clipboard.on('error', function(event) {
        console.log( 'ZeroClipboard error of type "' + event.name + '": ' + event.message );
        ZeroClipboard.destroy();
    });
});