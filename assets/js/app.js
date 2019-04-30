/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
var $ = require('jquery');



require('smartwizard');
require('bootstrap-datepicker');
require('bootstrap-datepicker/dist/locales/bootstrap-datepicker.fr.min.js');
require('../js/collection-manager.js');

require('../css/app.css');

$('.datepickerTicketDate').datepicker({
    format: 'dd-mm-yyyy',
    language: 'fr-FR',
    autoclose: false,
    daysOfWeekDisabled: '2',
    datesDisabled: ['01-05-2019', '01-11-2019', '25-12-2019',
                    '01-05-2020', '01-11-2020', '25-12-2020',
                    '01-05-2021', '01-11-2021', '25-12-2021',
                    '01-05-2022', '01-11-2022', '25-12-2022'],
    disableTouchKeyboard: true,
    startDate: 'today',
    endDate: '+2y',
    templates: {
        leftArrow: '<i class="fas fa-arrow-left"></i>',
        rightArrow: '<i class="fas fa-arrow-right"></i>'
    },
    weekStart: '1',

});

$('#smartwizard').smartWizard({
    selected: 0,  // Initial selected step, 0 = first step
    keyNavigation:false, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
    autoAdjustHeight:false, // Automatically adjust content height
    cycleSteps: false, // Allows to cycle the navigation of steps
    backButtonSupport: true, // Enable the back button support
    useURLhash: false, // Enable selection of the step based on url hash
    showStepURLhash: false,

});








