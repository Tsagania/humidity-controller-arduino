# -*- coding: utf-8 -*-
"""

"""

import mysql.connector      #το κατέβασα γράφωντας στο cmd την εντολή: pip install mysql-connector-python
import time
import serial               #το κατέβασα γράφωντας στο CDM την εντολή: pip install pyserial και εγκαταστάθηκε μόνο του
from datetime import datetime             



data=[]  #Αρχικοποίηση λίστας


#Συνάρτηση υπολογισμού μέσου όρου τιμών
def Average():
    total = 0
    alist=[]
    mycursor = mydb.cursor()                                              
    mycursor.execute("SELECT `value` FROM `arduino`") #όλες οι τιμές υγρασίας που ανέβηκαν στη βάση
    myresult = mycursor.fetchall()
    mydb.commit()
    for i in myresult:                                #περνάω όλες τιμές σε μια λίστα
        alist.append(int(i[0]))
    
    for i in alist:                                   #βρίσκω το άθροισμα της λίστας
        total += int(i)
    average = total/len(alist)
    
    mycursor1 = mydb.cursor()
    mycursor1.execute("DELETE FROM `arduino`")        #Διαγράφω όλες τις ημερίσιες τιμές υγρασίας
    mydb.commit()
    
    return average



#1 Συνδέω το παρόν πρόγραμμα με το arduino (που είναι ενεργό και συνδεδεμένο με USB)
    #η πρώτη μεταβλητή πρέπει να έχει το δικό μας PORT, το οποίο βρίσκεται κάτω δεξιά στο Arduino IDE Sketch(είτε Εργαλεία-Θύρα) 

ser = serial.Serial('COM3', 9600)
time.sleep(2)                                      #delay για να προλάβει ο αισθητήρας να μετρήσει υγρασία?



#2 Συνδέω το πρόγραμμα με τη βάση δεδομένων μου
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="myarduinoDB")  



while True: #μέσα στην δομή επανάληψης while εκτελείται όλος ο κώδικας κάθε 6ώρες
    

    #4 Διαβάζω δεδομένα από το arduino και τα βάζω στη λίστα data
    for i in range (10):'καθε 6 ωρες 10 τιμες, 20 τιμες στο 12ωρο'
        value = ser.readline()              #Αποθήκευση της κάθε μέτρησης που λαμβάνεται, στην μεταβλητή value
        tempStr = value.decode()            #Αποκωδικοποίηση της τιμής και μετατροπής της σε integer
        value = int(tempStr.rstrip())
        data.append(value)                  #Αποθήκευση των τιμών σε μία λίστα
        time.sleep(0.3)                     #Αναμονή 0.1 δευτερολέπτων για την λήψη της επόμενης τιμής υγρασίας
    
    
    #5 Εισάγω τα δεδομένα της λίστας στη βάση
    for i in range len(data)
        mycursor = mydb.cursor()
        now = datetime.now()                #Λήψη της τρέχουσας ώρας-ημερομηνίας
        formatted_date = now.strftime('%Y-%m-%d %H:%M:%S') #Μετατροπή ώρας-ημερομηνίας σε εμφανίσιμη μορφή
        val = value
        mycursor.execute("INSERT INTO arduino (value,time1) VALUES (%s, %s)", (val, formatted_date)) #Εκτέλεση του SQL query για εισαγωγή των τιμών στη Βάση Δεδομένων 
        mydb.commit()
    
  
    
    #6 Υπολογίζω το average 
    timeNow= str(datetime.now())[11:13] #αν η ώρα είναι 18:30 εκχωρείται το 18
    if timeNow>17:   #αν η ώρα είναι μετά τις 18(εξι το απόγευμα) μπαίνει στην if για να υπολογιστεί ο μεσος όρος
    
    
        #Βλέπω αν έχω ήδη υπολογίσει μέσο όρο για σήμερα   
        todayDate= str(datetime.now())[0:10]                                    #η σημερινή ημερομηνία YYYY-MM-DD
        
        mycursor = mydb.cursor()                                                #για να φτιάξω καινούργιο sql command
        mycursor.execute("SELECT day FROM average ORDER BY day DESC LIMIT 1")   #παίρνω από το time1 τη μεγαλύτερη τιμή, δηλαδή την τελευταία ημερομηνία
        myresult = mycursor.fetchall()
        lastAvgDate= str((myresult[0][0]))                                      #τα επεστρεψε μπερδεμένα οπότε έκανα μορφοποίηση για να έρθει στη μορφή YYYY-MM-DD
        
        if  lastAvgDate<todayDate: #επειδή έβαλα να παίρνει τιμές κάθε 6 ώρες και θέλω να υπολογίζει μέσο όρο μόνο αν αλλάξει η μέρα
            avg = Average()
            print(avg)
            #7 Εισάγω το average στη βάση
            sql2 = "INSERT INTO average (average) VALUES (%s)"
            mycursor.execute(sql2 % avg)
            mydb.commit()
        
   
     time.sleep(21600)   #3 ώρες αναμονή, συνολικά 6 ώρες για κάθε ανέβασμα τιμών στη βάση






