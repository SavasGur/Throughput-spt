import os
import re
import subprocess
import time
import MySQLdb
import sys
import datetime
import mysql.connector
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from string import Template

print "Starting..."
time.sleep(10)

#How many throughput measurements do you want?
kere=2

#Time between measurements.(Seconds)
ara=5

mysql.connector.connect(host='localhost',database='SENSOR',user='root',password='denizq')



def TPut():
    response = subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read()
    download = re.findall('Download:\s(.*?)\s', response, re.MULTILINE)
    dwn1 = float(download[0])

    upload = re.findall('Upload:\s(.*?)\s', response, re.MULTILINE)
    up1 = float(upload[0])

    ping = re.findall('Ping:\s(.*?)\s', response, re.MULTILINE)
    ping1 = float(ping[0])

    print "---------/----------/---------"
    print "*Download Speed 1*=>",dwn1,"mb/s"
    print "*Upload Speed 1*=>",up1,"mb/s"
    print "*Latency 1*=>",ping1,"ms"
    print "---------/----------/---------"
    
    response = subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read()

    download = re.findall('Download:\s(.*?)\s', response, re.MULTILINE)
    dwn2 = float(download[0])

    upload = re.findall('Upload:\s(.*?)\s', response, re.MULTILINE)
    up2 = float(upload[0])

    ping = re.findall('Ping:\s(.*?)\s', response, re.MULTILINE)
    ping2 = float(ping[0])

    print "*Download Speed 2*=>",dwn2,"mb/s"
    print "*Upload Speed 2*=>",up2,"mb/s"
    print "*Latency 2*=>",ping2,"ms"
    print "---------/----------/---------"

    response = subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read()

    download = re.findall('Download:\s(.*?)\s', response, re.MULTILINE)
    dwn3 = float(download[0])

    upload = re.findall('Upload:\s(.*?)\s', response, re.MULTILINE)
    up3 = float(upload[0])

    ping = re.findall('Ping:\s(.*?)\s', response, re.MULTILINE)
    ping3 = float(ping[0])

    print "*Download Speed 3*=>",dwn3,"mb/s"
    print "*Upload Speed 3*=>",up3,"mb/s"
    print "*Latency 3*=>",ping3,"ms"
    print "---------/----------/---------"

    ping = re.findall('Ping:\s(.*?)\s', subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read(), re.MULTILINE)
    ping4 = float(ping[0])
    print "*Latency 4*=>",ping4,"ms"
    print "---------/----------/---------"

    ping[0] = ping[0].replace(',', '.')
    download[0] = download[0].replace(',', '.')
    upload[0] = upload[0].replace(',', '.')
    dar = [dwn1,dwn2,dwn3]
    dtop=0
    avgDwn=0
    for x in dar:
        dtop += x
    avgDwn=dtop/3

    uar = [dwn1,dwn2,dwn3]
    utop=0
    avgUp=0
    for x in uar:
        utop += x
    avgUp=utop/3

    lar = [ping1,ping2,ping3]
    ltop=0
    avgLat=0
    for x in lar:
        ltop += x
    avgLat=ltop/3

    par = [ping1,ping2,ping3,ping4]
    i=0
    jtop=0
    while i<3:
        x1 = par[i]
        x2 = par[i+1]
        jtop += abs(x1-x2)
        i+=1
    jit=jtop/5
    jit=str(jit)

    unix = int(time.time())
    date = str(datetime.datetime.fromtimestamp(unix).strftime('%d/%m/%Y - %H:%M:%S'))

    print "***Date:***=>",date
    print "***Download:***=>",avgDwn,"mb/s"
    print "***Upload:***=>",avgUp,"mb/s"
    print "***Latency:***=>",avgLat,"ms"
    print "***Jitter:***=>",jit,"ms"
    print "---------/----------/---------"

    #try:
    #    if os.stat('/home/pi/speedtest/speedtest.csv').st_size == 0:
    #        print 'Date,Time,Ping (ms),Download (Mbit/s),Upload (Mbit/s)'
    #except:
    #    pass
    #print '{},{},{},{},{}'.format(time.strftime('%m/%d/%y'), time.strftime('%H:%M'), ping[0], download[0], upload[0])


    try:
       connection = mysql.connector.connect(host='localhost',
                                 database='SENSOR',
                                 user='root',
                                 password='denizq')
       sql_insert_query = """ INSERT INTO `kpidata` (`Time`, `Download`, `Upload`, `Latency`,`Jitter`) VALUES ('%s','%s','%s','%s','%s')"""


       cursor = connection.cursor()
       result  = cursor.execute(sql_insert_query % (date,download[0],upload[0],ping[0],jit))
       connection.commit()
       print ("Record inserted successfully into data table")
    except mysql.connector.Error as error :
        connection.rollback() #rollback if any exception occured
        print("Failed inserting record into python_users table {}".format(error))
    finally:
        #closing database connection.
        if(connection.is_connected()):
            cursor.close()
            connection.close()

meas=0

while meas<kere:
    TPut()
    time.sleep(ara)
    meas += 1