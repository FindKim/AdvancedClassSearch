$(document).ready(function() {
	var $calendar = $('#calendar');
	var id = 10;
	$calendar.weekCalendar({
		timeslotsPerHour : 4,
		allowCalEventOverlap : true,
		firstDayOfWeek : 0,
		businessHours :{start: 7, end: 21, limitDisplay: true },
		daysToShow : 7,
		height : function($calendar) {
			return $(window).height() - $("h1").outerHeight() - 1;
		},
		eventRender : function(calEvent, $event) {
			if (calEvent.end.getTime() < new Date().getTime()) {
				$event.css("backgroundColor", "#aaa");
				$event.find(".wc-time").css({
					"backgroundColor" : "#999",
					"border" : "1px solid #888"
				});
			}
		},
		data : function(start, end, callback) {
			callback(getEventData());
		}
	});
	function resetForm($dialogContent) {
		$dialogContent.find("input").val("");
              $dialogContent.find("textarea").val("");
	}
	function getEventData() {
		var year = new Date().getFullYear();
		var month = new Date().getMonth();
		var day = new Date().getDate();
		return {
			events : [
				{
					"id":1,
                         		"start": new Date(year, month, 12, 16, 05),
           	              	 	 "end": new Date(year, month, 12, 18, 0),
					"title":"General Physics I Laboratory, 21368, 01"
				},
				{
					"id":2,
	      	 	                  "start": new Date(year, month, 9,15, 30),
   		                        "end": new Date(year, month, 9, 16, 20),
					"title":"General Physics I Tutorial, 20752, 04"
				},
				{
					"id":3,
					"start": new Date(year, month, 8, 14, 0),
					"end": new Date(year, month, 8, 14, 50),
					"title":"General Physics I, 20886, 01"
				},
				{
					"id":4,
         		                "start": new Date(year, month, 10, 14, 0),
                   		        "end": new Date(year, month, 10, 14, 50),
					"title":"General Physics I, 20886, 01"
				},
				{
					"id":5,
                         		"start": new Date(year, month, 12, 14, 0),
           	              	 	 "end": new Date(year, month, 12, 14, 50),
					"title":"General Physics I, 20886, 01"
				},
				{
					"id":6,
	      	 	                  "start": new Date(year, month, 9,11, 0),
   		                        "end": new Date(year, month, 9, 12, 15),
					"title":"Ethics of Emerging Weapon Tech, 28897, 01"
				},
				{
					"id":7,
                	         	"start": new Date(year, month, 11, 11, 0),
                   	       	 "end": new Date(year, month, 11, 12, 15),
					"title":"Ethics of Emerging Weapon Tech, 28897, 01"
				},
				{
					"id":8,
	      	 	                  "start": new Date(year, month, 9,9, 30),
   		                        "end": new Date(year, month, 9, 10, 45),
					"title":"Operating System Principles, 20239, 01"
				},
				{
					"id":9,
                	         	"start": new Date(year, month, 11, 9, 30),
                   	       	 "end": new Date(year, month, 11, 10, 45),
					"title":"Operating System Principles, 20239, 01"
				},
				{
					"id":10,
	      	 	                  "start": new Date(year, month, 9,14, 0),
   		                        "end": new Date(year, month, 9, 15, 15),
					"title":"Theory of Computing, 20245, 01"
				},
				{
					"id":11,
                	         	"start": new Date(year, month, 11, 14, 0),
                   	       	 "end": new Date(year, month, 11, 15, 15),
					"title":"Theory of Computing, 20245, 01"
				},
				{
					"id":12,
					"start": new Date(year, month, 8, 10, 30),
					"end": new Date(year, month, 8, 11, 20),
					"title":"Programming Paradigms, 23161, 01"
				},
				{
					"id":13,
         		                "start": new Date(year, month, 10, 10, 30),
                   		        "end": new Date(year, month, 10, 11, 20),
					"title":"Programming Paradigms, 23161, 01"
				},
				{
					"id":14,
                         		"start": new Date(year, month, 12, 10, 30),
           	              	 	 "end": new Date(year, month, 12, 11, 20),
					"title":"Programming Paradigms, 23161, 01"
				}
			]
		};
	}
});
