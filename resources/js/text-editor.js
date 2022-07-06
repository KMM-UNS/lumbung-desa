function initCKeditor() {
    $('.text-editor').each(function () {
        var ts = Date.now();
        var preId = 'text-editor-' + ts;
        $(this).attr('id', preId);

        CKEDITOR.replace(`${preId}`);
    })
}

$(document).on('DOMContentLoaded', function () {
    setTimeout(() => {
        initCKeditor();
    }, 1000);
})