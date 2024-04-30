function fDateFix() {
        $('.wpcf7-form').find('input.wpcf7-date[type="date"]').each(function () {
            $(this).datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: new Date($(this).attr('min')),
                maxDate: new Date($(this).attr('max')),
                changeMonth: true,
                changeYear: true,
                yearRange: '100:+0'
            });
        });
    }