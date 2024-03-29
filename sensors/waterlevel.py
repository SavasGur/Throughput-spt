import RPi.GPIO as GPIO
import time
import MySQLdb
import datetime
import sys


# change these as desired - they're the pins connected from the
# SPI port on the ADC to the Cobbler
SPICLK = 11
SPIMISO = 9
SPIMOSI = 10
SPICS = 8

# photoresistor connected to adc #0
photo_ch =1

#port init
conn = MySQLdb.connect(host= "localhost",user= "root",passwd="denizq",db="SENSOR")
c=conn.cursor()
def dhtreading_witesql():
 def init():
         GPIO.setwarnings(False)
         GPIO.cleanup()			#clean up at the end of your script
         GPIO.setmode(GPIO.BCM)		#to specify whilch pin numbering system
         # set up the SPI interface pins
         GPIO.setup(SPIMOSI, GPIO.OUT)
         GPIO.setup(SPIMISO, GPIO.IN)
         GPIO.setup(SPICLK, GPIO.OUT)
         GPIO.setup(SPICS, GPIO.OUT)
         
#read SPI data from MCP3008(or MCP3204) chip,8 possible adc's (0 thru 7)
 def readadc(adcnum, clockpin, mosipin, misopin, cspin):
        if ((adcnum > 7) or (adcnum < 0)):
                return -1
        GPIO.output(cspin, True)	

        GPIO.output(clockpin, False)  # start clock low
        GPIO.output(cspin, False)     # bring CS low

        commandout = adcnum
        commandout |= 0x18  # start bit + single-ended bit
        commandout <<= 3    # we only need to send 5 bits here
        for i in range(5):
                if (commandout & 0x80):
                        GPIO.output(mosipin, True)
                else:
                        GPIO.output(mosipin, False)
                commandout <<= 1
                GPIO.output(clockpin, True)
                GPIO.output(clockpin, False)

        adcout = 0
        # read in one empty bit, one null bit and 10 ADC bits
        for i in range(12):
                GPIO.output(clockpin, True)
                GPIO.output(clockpin, False)
                adcout <<= 1
                if (GPIO.input(misopin)):
                        adcout |= 0x1

        GPIO.output(cspin, True)
        
        adcout >>= 1       # first bit is 'null' so drop it
        return adcout

 def main():   
         init()
         time.sleep(2)
         unix = int(time.time())
         date = str(datetime.datetime.fromtimestamp(unix).strftime('%Y-%m-%d %H:%M:%S'))
         print"will start detec water level\n"          
         adc_value=readadc(photo_ch, SPICLK, SPIMOSI, SPIMISO, SPICS)                                    
         print"water level:"+str("%.0f"%(adc_value/1024.*100))+"%\n"
         
         #print "adc_value= " +str(adc_value)+"\n"
         #sys.exit(1)                  
         level=str("%.0f"%(adc_value/1024.*100))
         c.execute("INSERT INTO flood (Time, Level) VALUES (%s, %s)",(date, level))
         conn.commit()

                  

 if __name__ == '__main__':
         try:
                  main()
                 
         except KeyboardInterrupt:
                  pass
 GPIO.cleanup()

for i in range(1):
           dhtreading_witesql()

c.close
conn.close()




