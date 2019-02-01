var $collectionHolder;

// setup an "add a tag" link
var $addTicketButton = $('<button type="button" class="add_ticket_link btn btn-success"><i class="fas fa-plus"></i> Ajouter un ticket</button>');
var $newLinkLi = $('<li></li>').append($addTicketButton);

$(function() {
    // Get the ul that holds the collection of tags
    $collectionHolder = $('ul.tickets');

    $collectionHolder.find('li').each(function() {
        addTicketFormDeleteLink($(this));
    });

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTicketButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addTicketForm($collectionHolder, $newLinkLi);
    });
});

function addTicketForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);


    addTicketFormDeleteLink($newFormLi);
    $('.datepickerBirthDate').datepicker({
        format: 'dd-mm-yyyy',
        language: 'fr-FR',
        autoclose:true,
        endDate: 'today',
        startDate: '01-01-1900',
        templates: {
            leftArrow: '<i class="fas fa-arrow-left"></i>',
            rightArrow: '<i class="fas fa-arrow-right"></i>'
        },
        weekStart: '1',
    });
}

function addTicketFormDeleteLink($tagFormLi) {
    var $removeFormButton = $('<button type="button" class="btn btn-danger"><i class="fas fa-minus"></i> Supprimer ce ticket</button>')
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}
