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
	      	 	                  "start": new Date(year, month, 9,9, 30),
   		                        "end": new Date(year, month, 9, 10, 45),
					"title":"Managerial Economics, 24890, 07"
				},
				{
					"id":2,
                	         	"start": new Date(year, month, 11, 9, 30),
                   	       	 "end": new Date(year, month, 11, 10, 45),
					"title":"Managerial Economics, 24890, 07"
				},
				{
					"id":3,
					"start": new Date(year, month, 8, 12, 30),
					"end": new Date(year, month, 8, 13, 45),
					"title":"Financial Statement Analysis, 29266, 02"
				},
				{
					"id":4,
         		                "start": new Date(year, month, 10, 12, 30),
                   		        "end": new Date(year, month, 10, 13, 45),
					"title":"Financial Statement Analysis, 29266, 02"
				},
				{
					"id":5,
	      	 	                  "start": new Date(year, month, 9,14, 0),
   		                        "end": new Date(year, month, 9, 15, 15),
					"title":"JrRsrch:Foresight Busnss&Socty, 24105, 07"
				},
				{
					"id":6,
                	         	"start": new Date(year, month, 11, 14, 0),
                   	       	 "end": new Date(year, month, 11, 15, 15),
					"title":"JrRsrch:Foresight Busnss&Socty, 24105, 07"
				},
				{
					"id":7,
	      	 	                  "start": new Date(year, month, 9,12, 30),
   		                        "end": new Date(year, month, 9, 13, 45),
					"title":"Entitle Refm: Soc Security me, 29172, 01"
				},
				{
					"id":8,
                	         	"start": new Date(year, month, 11, 12, 30),
                   	       	 "end": new Date(year, month, 11, 13, 45),
					"title":"Entitle Refm: Soc Security me, 29172, 01"
				},
				{
					"id":9,
					"start": new Date(year, month, 8, 8, 0),
					"end": new Date(year, month, 8, 9, 15),
					"title":"Poverty in Developing World, 29171, 01"
				},
				{
					"id":10,
         		                "start": new Date(year, month, 10, 8, 0),
                   		        "end": new Date(year, month, 10, 9, 15),
					"title":"Poverty in Developing World, 29171, 01"
				}
			]
		};
	}
});
