$(document).ready(function() {
    $('select').material_select();
    $('.datepicker').pickadate({
        selectMonths: true,
        format: 'dd-mm-yyyy',
        selectYears: 80, 
        max: true,
    });
});