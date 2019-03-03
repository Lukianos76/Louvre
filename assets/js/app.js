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
    autoclose:true,
    daysOfWeekDisabled: '2',
    startDate: 'today',
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








