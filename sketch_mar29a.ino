int msensor = A0;
int msvalue = 0;
int led1 = 13;
int led2 = 12;
boolean flag = false;

void setup() {
  Serial.begin(9600);
  pinMode(msensor, INPUT);
  pinMode(led1, OUTPUT);
  pinMode(led2, OUTPUT);
  // put your setup code here, to run once:

}

void loop() {
   msvalue = analogRead(msensor)/10;
   Serial.println(msvalue);

   if(( msvalue>=50) && (flag==false))
   {
    digitalWrite(led1, HIGH);
    digitalWrite(led2, LOW);
    flag = true;
    delay(1000*5);
    }

    if(( msvalue<=49) && (flag==true))
    {
    digitalWrite(led1, LOW);
    digitalWrite(led2, HIGH);
    flag = false;
    delay(1000*5);
    }
    delay(1000*5);
  // put your main code here, to run repeatedly:

}
