import datetime
import time
import subprocess
import smtplib
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText
from string import Template
from email import encoders
from email.mime.base import MIMEBase

#Reciever emails should be added here
receivers = ["savasgur98@hotmail.com","cagmel1999@gmail.com","kpidatakktcell@gmail.com"]
msg = MIMEMultipart()

#Message
message = """
    Troughput data file.
    """
msg['From'] = "Raspberry Pi"
tolar = ', '.join(receivers)
msg['To'] = tolar
msg['Subject'] = "KPI Data M."


print "Please wait..."

f= open("/home/pi/Desktop/datakpif.txt","w+")


subprocess.Popen('python /home/pi/projeCopya/sensors/kpidatafiledemo.py', shell=True, stdout=f)
time.sleep(410)
f.close() 

msg.attach(MIMEText(message, 'plain'))

filename = "datakpif.txt"
attachment = open("/home/pi/Desktop/datakpif.txt", "rb")
p = MIMEBase('application', 'octet-stream')
p.set_payload((attachment).read())
encoders.encode_base64(p) 
   
p.add_header('Content-Disposition', "attachment; filename= %s" % filename)

msg.attach(p) 


mayil = "kpidatakktcell@gmail.com"
pword = "kktcell12uc"

try:
    server = smtplib.SMTP('smtp.gmail.com:587')
    server.ehlo()
    server.starttls()
    server.login(mayil, pword)
    server.sendmail(mayil, receivers, msg.as_string())
    print "Emails sent."
except:
    print 'Failed to send email.'