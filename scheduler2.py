#!/usr/bin/python
import urllib2
import re
import sys
import subprocess
import random

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
		


with open("query.txt") as f:
	courses = []
        fwrite1 = open('newschedule.txt', 'w')
#	fwrite2 = open('oldschedule.sql', 'w')
        for line in f:
		words = line.split('; ')
		numDays =  int(words[14])
		newcourse = course(numDays)
		newcourse.title = words[0]
		if(numDays == 1):
			newcourse.days.append(words[4])				
			newcourse.starttimes = words[10]
			newcourse.endtime = words[12]
                if(numDays == 2):
                        newcourse.days.append(words[4])
			newcourse.days.append(words[6])
                        newcourse.starttime = words[10]
                        newcourse.endtime = words[12]
                if(numDays == 3):
                        newcourse.days.append(words[4])
                        newcourse.days.append(words[6])
			newcourse.days.append(words[8])
                        newcourse.starttime = float(words[10]) 
                        newcourse.endtime = float(words[12])
		newcourse.crn = words[16]
		newcourse.sectionnumber = words[18]
		courses.append(newcourse)
	#for tempcourse in courses:
	#	print tempcourse.days
	#	print tempcourse.starttime
	#	print tempcourse.endtime
	#	print tempcourse.crn
	#	print tempcourse.sectionnumber	
	

	titles = []
	uniqueclasses = 0
	titlefound = 0
	print titles
	for xcourse in courses:
		titlefound = 0

		for temp in titles:

			if(xcourse.title == temp):
				titlefound = 1
#	                        print xcourse.title
#                        	print temp
#	                       	print "XXXXX"
		if(titlefound == 0):
			uniqueclasses = uniqueclasses + 1
			titles.append(xcourse.title)
		
	print uniqueclasses	

	schedule = []
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
					works = 1
					for pcourse in schedule:
						for day1 in tempcourse.days:
							for day2 in pcourse.days:
								if(day1 == day2):
									if ( (tempcourse.starttime > pcourse.starttime) and (tempcourse.endtime > pcourse.endtime) ): 
										print "StartTime1", tempcourse.starttime
                                                                                print "EndTime1", tempcourse.endtime
                                                                                print "StartTime2", pcourse.starttime
                                                                                print "EndTime2", pcourse.endtime
										print "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
										works = 0
										break
									if( (tempcourse.starttime < pcourse.endtime) and (tempcourse.endtime > pcourse.endtime) ):
                                                                                print "StartTime1", tempcourse.starttime
                                                                                print "EndTime1", tempcourse.endtime
                                                                                print "StartTime2", pcourse.starttime
                                                                                print "EndTime2", pcourse.endtime
                                                                                print "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
                                                                                works = 0
                                                                                break
									if( (tempcourse.starttime < pcourse.starttime) and (tempcourse.endtime < pcourse.endtime) ):
                                                                                print "StartTime1", tempcourse.starttime
                                                                                print "EndTime1", tempcourse.endtime
                                                                                print "StartTime2", pcourse.starttime
                                                                                print "EndTime2", pcourse.endtime
                                                                                print "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
                                                                                works = 0
                                                                                break
									if( (tempcourse.starttime > pcourse.starttime) and (tempcourse.endtime < pcourse.endtime) ):
                                                                                print "StartTime1", tempcourse.starttime
                                                                                print "EndTime1", tempcourse.endtime
                                                                                print "StartTime2", pcourse.starttime
                                                                                print "EndTime2", pcourse.endtime
                                                                                print "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"
                                                                                works = 0
                                                                                break 
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
					 			
