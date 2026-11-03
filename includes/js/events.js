$(function () {

   

	/* initialize the calendar
	 -----------------------------------------------------------------*/
	//Date for the calendar events (dummy data)
	var date = new Date();
	var d = date.getDate(),
		m = date.getMonth(),
		y = date.getFullYear();
		$('#calendar').fullCalendar({
			eventClick: function(calEvent, jsEvent, view) {
				var url = baseUrl + '/detail/' + calEvent.id;
				console.log(url);
				window.location.href = url;
			},
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			buttonText: {
				today: 'today',
				month: 'month',
				week: 'week',
				day: 'day'
			},
			//Random default events
			events: myEvents,
			draggable: false,
			editable: false,
			droppable: false // this allows things to be dropped onto the calendar !!!
	  /*
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
	  */
    });

    
  });