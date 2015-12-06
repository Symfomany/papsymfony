$(document).ready(function(){

    // Init plugins for ".calendar-widget"
    // plugins: FullCalendar
    //
    $('#calendar-widget').fullCalendar({
        // contentHeight: 397,
        editable: true,
        events: [{
            title: 'Sony Meeting',
            start: '2015-05-1',
            end: '2015-05-3',
            className: 'fc-event-success',
        }, {
            title: 'Conference',
            start: '2015-05-11',
            end: '2015-05-13',
            className: 'fc-event-warning'
        }, {
            title: 'Lunch Testing',
            start: '2015-05-21',
            end: '2015-05-23',
            className: 'fc-event-primary'
        },
        ],
        eventRender: function(event, element) {
            // create event tooltip using bootstrap tooltips
            $(element).attr("data-original-title", event.title);
            $(element).tooltip({
                container: 'body',
                delay: {
                    "show": 100,
                    "hide": 200
                }
            });
            // create a tooltip auto close timer
            $(element).on('show.bs.tooltip', function() {
                var autoClose = setTimeout(function() {
                    $('.tooltip').fadeOut();
                }, 3500);
            });
        }
    });


});