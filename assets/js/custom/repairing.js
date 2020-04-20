//เช็ค ประเภทปัญหา
$(document).ready(function () {
    $('#repairing-type').change(function () {
        if ($(this).val() == 1 || $(this).val() == 2) {
            $('#repairing-serial').prop("disabled", false);
        } else {
            $('#repairing-serial').prop("disabled", true);
        }
    });

});