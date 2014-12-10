#!/usr/bin/python
import urllib2
import re
import sys
import random
from subprocess import call

class course:
	'Common base class for all courses'

	def __init__(self, numDays):
		self.title = ""
		self.days = []
		self.starttime = 0
		self.endtime = 0
		self.numDays = numDays
		self.sectionnumber = ""
		self.crn = ""
		

#call(['rm', '-f', 'demo.js'])
#call(['touch', 'demo.js'])
#call(['chmod', 'a+rxw', 'demo.js']) 
with open("query.txt") as f:
	courses = []
        fwrite = open('demo.js', 'w')
	#fwrite2 = open('oldschedule.sql', 'w')
        for line in f:
		words = line.split('; ')
		numDays =  int(words[7])
		newcourse = course(numDays)
		newcourse.title = words[0]
		if(numDays == 1):
			newcourse.days.append(words[2])				
			newcourse.starttimes = float(words[5])
			newcourse.endtime = words[6]
                if(numDays == 2):
                        newcourse.days.append(words[2])
			newcourse.days.append(words[3])
                        newcourse.starttime = float(words[5])
                        newcourse.endtime = float(words[6])
                if(numDays == 3):
                        newcourse.days.append(words[2])
                        newcourse.days.append(words[3])
			newcourse.days.append(words[4])
                        newcourse.starttime = float(words[5]) 
                        newcourse.endtime = float(words[6])
		newcourse.crn = words[8]
		newcourse.sectionnumber = words[9]
		newcourse.sectionnumber = newcourse.sectionnumber.rstrip()
		courses.append(newcourse)	

	titles = []
	uniqueclasses = 0
	titlefound = 0
	print titles
	for xcourse in courses:
		titlefound = 0

		for temp in titles:

			if(xcourse.title == temp):
				titlefound = 1
		if(titlefound == 0):
			uniqueclasses = uniqueclasses + 1
			titles.append(xcourse.title)
		
	print uniqueclasses	

	schedule = []
	works = 0
	for i in range(0,1000):
		random.shuffle(courses)
		for tempcourse in courses:
			if( len(schedule) == 0 ):
				schedule.append(tempcourse)
				continue
			for excourse in schedule:
				if(tempcourse.title == excourse.title):
					break
				if(excourse.crn == schedule[len(schedule) - 1].crn):
					
					for pcourse in schedule:
						for day1 in tempcourse.days:
							for day2 in pcourse.days:
								if(day1 == day2):
									works = 1
									tempcourse.starttime = float(tempcourse.starttime)
									tempcourse.endtime = float(tempcourse.endtime)
									pcourse.starttime = float(pcourse.starttime)
									pcourse.endtime = float(pcourse.endtime)
									if ((tempcourse.starttime <= pcourse.starttime) and (tempcourse.endtime >= pcourse.endtime)):
										works = 0
										break 
									elif ((tempcourse.starttime <= pcourse.starttime) and (tempcourse.endtime >= pcourse.starttime)):
										works = 0 
										break
									elif ((tempcourse.starttime >= pcourse.starttime) and (tempcourse.starttime <= pcourse.endtime)):
										works = 0
										break
									elif ((tempcourse.starttime >= pcourse.starttime) and (tempcourse.endtime <= pcourse.endtime)):
										works = 0
										break
									else:
										
										print "day 1", day1

							if(works == 0):
								break
						if(works == 0):
							break
					if(works == 1):
						schedule.append(tempcourse)
	
		if(uniqueclasses == len(schedule)):
			break
		else:
			schedule = []	
	for i in schedule:
		print i.title
		print i.days
		print i.starttime
		print i.endtime
					 			
	
	id = 1
	offset = 0
	#functionstring = '$(document).ready(function() {\n'
	pound = "#"
	#calendarstring = "	$('" + pound + "calendar').weekCalendar({\n"
	#eventstring = '		events:[\n'
	#fwrite.write(functionstring)
	#fwrite.write(calendarstring)
	#fwrite.write(eventstring)
	#print calendarstring
	#h1 = "h1"
	line1 = "$(document).ready(function() {\n"
	line2 = "	var $calendar = $('" + pound + "calendar');\n"
	line3 = "	var id = 10;\n"
	line4 = "	$calendar.weekCalendar({\n"
	line5 = "		timeslotsPerHour : 4,\n"
	line6 = "		allowCalEventOverlap : true,\n"
	line7 = "		firstDayOfWeek : 0,\n"
	line8 = "		businessHours :{start: 7, end: 21, limitDisplay: true },\n"
	line9 = "		daysToShow : 7,\n"
	line10 = "		height : function($calendar) {\n"
	line11 = '			return $(window).height() - $("' + 'h1' + '").outerHeight() - 1;\n'
        line12 = "		},\n"
        line13 = "		eventRender : function(calEvent, $event) {\n"
        line14 = "			if (calEvent.end.getTime() < new Date().getTime()) {\n"
        line15 = "				$event.css(" + '"backgroundColor"' +  ', "' + pound + 'aaa"' + ");\n"
        line16 = '				$event.find("' + '.wc-time' + '"' + ").css({\n"
        line17 = '					"backgroundColor"' + ' : "' + pound + '999"'+ ",\n"
        line18 = '					"border"' + ' : "' + "1px solid " + pound + '888"' + "\n"
        line19 = "				});\n"
        line20 = "			}\n"
        line21 = "		},\n"
	line22 = "		data : function(start, end, callback) {\n"
	line23 = "			callback(getEventData());\n"
	line24 = "		}\n"
	line25 = "	});\n"
	line26 = "	function resetForm($dialogContent) {\n"
	line27 = '		$dialogContent.find("' + 'input' + '").val("' + '");\n'
	line28 = '              $dialogContent.find("' + 'textarea' + '").val("' + '");\n'
	line29 = '	}\n'
	line30 = "	function getEventData() {\n"
	line31 = "		var year = new Date().getFullYear();\n"
	line32 = "		var month = new Date().getMonth();\n"
	line33 = "		var day = new Date().getDate();\n"
	#line31 = "             var year = 2015;\n"
        #line32 = "             var month = 1;\n"
        #line33 = "             var day = new Date().getDate();\n"


	line34 = "		return {\n"
	line35 = "			events : [\n"

	fwrite.write(line1)
        fwrite.write(line2)
        fwrite.write(line3)
        fwrite.write(line4)
        fwrite.write(line5)
        fwrite.write(line6)
        fwrite.write(line7)
        fwrite.write(line8)
        fwrite.write(line9)
        fwrite.write(line10)
        fwrite.write(line11)
        fwrite.write(line12)
        fwrite.write(line13)
        fwrite.write(line14)
        fwrite.write(line15)
        fwrite.write(line16)
        fwrite.write(line17)
        fwrite.write(line18)
        fwrite.write(line19)
        fwrite.write(line20)
        fwrite.write(line21)
	fwrite.write(line22)
        fwrite.write(line23)
        fwrite.write(line24)
        fwrite.write(line25)
        fwrite.write(line26)
        fwrite.write(line27)
        fwrite.write(line28)
        fwrite.write(line29)
        fwrite.write(line30)
        fwrite.write(line31)
        fwrite.write(line32)
        fwrite.write(line33)
        fwrite.write(line34)
        fwrite.write(line35)
	count = 1
	events = 0
	for p in schedule:
		events = events + p.numDays
	for k in schedule:

		if(k.numDays == 0):
			break
		for day in k.days:
			ids = str(id)		

			if(day == 'M'):
				offset = -1
			if(day == 'T'):
				offset = 0
                        if(day == 'W'):
                                offset = 1
                        if(day == 'R'):
                                offset = 2
                        if(day == 'F'):
                                offset = 3			

			stimestr = str(k.starttime)
			etimestr = str(k.endtime)
			stime = stimestr.split('.')
			etime = etimestr.split('.')

			stimeint = int(stime[0])
			#if(stimeint > 12):
			#	stimeint = stimeint - 12
			stimehr = str(stimeint)
			print stimehr

			etimeint = int(etime[0])
                        #if(etimeint > 12):
                        #        etimeint = etimeint - 12
                        etimehr = str(etimeint)
			print etimehr			

                        stimemin = stime[1][0:2]
			if(stimemin == '0'):
				stimemin = "0"
                        if(stimemin == '08'):
                                stimemin = "05"
                        if(stimemin == '16'):
                                stimemin = "10"
                        if(stimemin == '25'):
                                stimemin = "15"
                        if(stimemin == '33'):
                                stimemin = "20"
                        if(stimemin == '41'):
                                stimemin = "25"
                        if(stimemin == '5'):
                                stimemin = "30"
                        if(stimemin == '58'):
                                stimemin = "35"
                        if(stimemin == '66'):
                                stimemin = "40"
                        if(stimemin == '75'):
                                stimemin = "45"
                        if(stimemin == '83'):
                                stimemin = "50"
                        if(stimemin == '91'):
                                stimemin = "55"

			etimemin = etime[1][0:2]
                        if(etimemin == '0'):
                                etimemin = "0"
                        if(etimemin == '08'):
                                etimemin = "05"
                        if(etimemin == '16'):
                                etimemin = "10"
                        if(etimemin == '25'):
                                etimemin = "15"
                        if(etimemin == '33'):
                                etimemin = "20"
                        if(etimemin == '41'):
                                etimemin = "25"
                        if(etimemin == '5'):
                                etimemin = "30"
                        if(etimemin == '58'):
                                etimemin = "35"
                        if(etimemin == '66'):
                                etimemin = "40"
                        if(etimemin == '75'):
                                etimemin = "45"
                        if(etimemin == '83'):
                                etimemin = "50"
                        if(etimemin == '91'):
                                etimemin = "55"
            #{
            #   "id":4,
            #   "start": new Date(year, month, day - 1, 8),
            #   "end": new Date(year, month, day - 1, 9, 30),
            #   "title":"Team breakfast"
            #   "readOnly : true
            #}						 
                        idstring = '					"id":'+ids+',\n'
                        id = id + 1
			if(day == 'M'):
				startstring = '					"start": new Date(year, month, 8, ' + stimehr + ', ' + stimemin + '),\n'
                        	endstring = '					"end": new Date(year, month, 8, ' + etimehr + ', ' + etimemin + '),\n'
                        if(day == 'T'):
                                startstring = '	      	 	                  "start": new Date(year, month, 9,' + stimehr + ', ' + stimemin + '),\n'
                                endstring = '   		                        "end": new Date(year, month, 9, ' + etimehr + ', ' + etimemin + '),\n'
                        if(day == 'W'):
                                startstring = '         		                "start": new Date(year, month, 10, ' + stimehr + ', ' + stimemin + '),\n'
                                endstring = '                   		        "end": new Date(year, month, 10, ' + etimehr + ', ' + etimemin + '),\n'
                        if(day == 'R'):
                                startstring = '                	         	"start": new Date(year, month, 11, ' + stimehr + ', ' + stimemin + '),\n'
                                endstring = '                   	       	 "end": new Date(year, month, 11, ' + etimehr + ', ' + etimemin + '),\n'
                        if(day == 'F'):
                                startstring = '                         		"start": new Date(year, month, 12, ' + stimehr + ', ' + stimemin + '),\n'
                                endstring = '           	              	 	 "end": new Date(year, month, 12, ' + etimehr + ', ' + etimemin + '),\n' 
                        titlestring = '					"title":"' + k.title + ', ' + k.crn + ', ' + k.sectionnumber + '"\n'
			fwrite.write('				{\n')
			fwrite.write(idstring)
			fwrite.write(startstring)
			fwrite.write(endstring)
			fwrite.write(titlestring)
			#fwrite.write(readstring)
			if(count == events):
				fwrite.write('				}\n')
			else:
				fwrite.write('				},\n')
			count = count + 1
	eventendstring = '			]\n'
	calendarendstring = '		};\n'
	functionendstring = '	}\n'
	endstring = '});\n'
	fwrite.write(eventendstring)
	fwrite.write(calendarendstring)
	fwrite.write(functionendstring)
	fwrite.write(endstring)
fwrite.close()   	
call(['chmod', 'a+rxw', 'demo.js']) 
