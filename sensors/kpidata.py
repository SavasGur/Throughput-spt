import os
import re
import subprocess
import time
import MySQLdb
import sys
import datetime
import mysql.connector
mysql.connector.connect(host='localhost',database='SENSOR',user='root',password='denizq')



unix = int(time.time())
date = str(datetime.datetime.fromtimestamp(unix).strftime('%d/%m/%Y - %H:%M:%S'))


response = subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read()



ping = re.findall('Ping:\s(.*?)\s', response, re.MULTILINE)
ping1 = float(ping[0])
print "*Ping 1*=>",ping1,"ms"	

ping = re.findall('Ping:\s(.*?)\s', subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read(), re.MULTILINE)
ping2 = float(ping[0])
print "*Ping 2*=>",ping2,"ms"

ping = re.findall('Ping:\s(.*?)\s', subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read(), re.MULTILINE)
ping3 = float(ping[0])
print "*Ping 3*=>",ping3,"ms"

ping = re.findall('Ping:\s(.*?)\s', subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read(), re.MULTILINE)
ping4 = float(ping[0])
print "*Ping 4*=>",ping4,"ms"

ping = re.findall('Ping:\s(.*?)\s', subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read(), re.MULTILINE)
ping5 = float(ping[0])
print "*Ping 5*=>",ping5,"ms"

ping = re.findall('Ping:\s(.*?)\s', subprocess.Popen('speedtest-cli --simple', shell=True, stdout=subprocess.PIPE).stdout.read(), re.MULTILINE)
ping6 = float(ping[0])
print "*Ping 6*=>",ping6,"ms"

download = re.findall('Download:\s(.*?)\s', response, re.MULTILINE)
upload = re.findall('Upload:\s(.*?)\s', response, re.MULTILINE)

ping[0] = ping[0].replace(',', '.')
download[0] = download[0].replace(',', '.')
upload[0] = upload[0].replace(',', '.')

par = [ping1,ping2,ping3,ping4,ping5,ping6]
i=0
top=0
while i<5:
    x1 = par[i]
    x2 = par[i+1]	 
    top += abs(x1-x2)
    i+=1
    print top
jit=top/5
jit=str(jit)

print "***Date:***=>",date
print "***Download:***=>",download[0],"mb/s"
print "***Upload:***=>",upload[0],"mb/s"
print "***Latency:***=>",ping[0],"ms"
print "***Jitter:***=>",jit,"ms"

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
   print ("Record inserted successfully into python_users table")
except mysql.connector.Error as error :
    connection.rollback() #rollback if any exception occured
    print("Failed inserting record into python_users table {}".format(error))
finally:
    #closing database connection.
    if(connection.is_connected()):
        cursor.close()
        connection.close()
