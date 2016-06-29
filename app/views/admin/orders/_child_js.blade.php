<script type="text/javascript">

    // Initialise datepicker inputs
    $('.dp3').datepicker();

    $('input[name="date_of_birth"').change(function() {
        
        dob = new Date($(this).val());
        comparison = new Date('2016-08-03');
        age = comparison.getFullYear() - dob.getFullYear();

        if (dob.getMonth() > comparison.getMonth()
            || (dob.getMonth() == comparison.getMonth()
                && dob.getDate() > comparison.getDate())) {
            age -= 1;  
        }

        if (age < 10) {
            $('#sleepover').prop('checked', false);
            $('#sleepover').prop('disabled', true);
            $('#sleepover_section').addClass('hidden');
        } else {
            $('#sleepover').prop('disabled', false);
            $('#sleepover_section').removeClass('hidden');
        }
        
    });

    $('#dancing').change(function() {
        toggleActivityPrefences(this.checked);
    });

    function toggleActivityPrefences(dancing) {
        if (dancing) $('#activity_preferences').addClass('hidden');
        else $('#activity_preferences').removeClass('hidden');
    }

    $(document).ready(function() {
        toggleActivityPrefences($('#dancing').is(':checked'));
    });

</script>