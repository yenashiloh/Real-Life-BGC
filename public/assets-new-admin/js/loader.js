$(document).ready(function() {
    $('#loading-spinner').show();
    $('.main-panel').css('opacity', '0').hide();

    setTimeout(function() {
        $('#loading-spinner').hide();
        $('.main-panel').show().css('opacity', '1');
    }, 1000);
});
