#include <Wire.h>
#include <LCD.h>
#include <LiquidCrystal_I2C.h>

LiquidCrystal_I2C lcd(0x3F,2,1,0,4,5,6,7,3,POSITIVE);
void setup()
{

lcd.begin(16, 2);
lcd.clear();
    lcd.setCursor(0,0);
    lcd.print(">AZ-Delivery.de<");
    lcd.setCursor(0,1);
    lcd.print(">16x2 & FC-113!<");
}
void loop() {
    lcd.setBacklight(HIGH);
}
