#!/usr/bin/python
import RPi.GPIO as GPIO
import time
import datetime
import MySQLdb

conn = MySQLdb.connect(host= "localhost",user= "root",passwd="denizq",db="SENSOR")
c=conn.cursor()
def dhtreading_witesql():

 try:
      GPIO.setmode(GPIO.BOARD)

      PIN_TRIGGER = 7
      PIN_ECHO = 11

      GPIO.setup(PIN_TRIGGER, GPIO.OUT)
      GPIO.setup(PIN_ECHO, GPIO.IN)

      GPIO.output(PIN_TRIGGER, GPIO.LOW)

      print "Waiting for sensor to settle"

      time.sleep(2)
      unix = int(time.time())
      date = str(datetime.datetime.fromtimestamp(unix).strftime('%Y-%m-%d %H:%M:%S'))             
      print "Calculating distance"
      GPIO.output(PIN_TRIGGER, GPIO.HIGH)

      time.sleep(0.00001)

      GPIO.output(PIN_TRIGGER, GPIO.LOW)

      while GPIO.input(PIN_ECHO)==0:
            pulse_start_time = time.time()
      while GPIO.input(PIN_ECHO)==1:
            pulse_end_time = time.time()

      pulse_duration = pulse_end_time - pulse_start_time
      distance = round(pulse_duration * 17150, 2)
      print "Distance:",distance,"cm"
      amount=(8.9-distance)*5*5     
      amnt=str("%.3f"%(amount*0.001));
      print "Amount:",amnt,"Liter" 
      dist=str(distance)+"cm"     
      c.execute("INSERT INTO fuel (Time, Level, Amount) VALUES (%s, %s, %s)",(date, dist, amnt))
      conn.commit()
 
 finally:
      GPIO.cleanup()


for i in range(1):
     dhtreading_witesql()

c.close
conn.close()