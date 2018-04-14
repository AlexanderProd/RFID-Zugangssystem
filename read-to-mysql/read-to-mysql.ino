#include <SPI.h>
#include <MFRC522.h>
#include <ESP8266WiFi.h>

const char* ssid     = "FRITZ!Box 7430 BZ";
const char* password = "56330553737990937936";
//const char* ssid     = "Alexanders iPhone";
//const char* password = "123test456";

const char* host = "alexander-productions.de";

#define RST_PIN         D3     // Configurable, see typical pin layout above
#define SS_PIN          D8     // Configurable, see typical pin layout above

MFRC522 mfrc522(SS_PIN, RST_PIN);   // Create MFRC522 instance

//*****************************************************************************************//
void setup() {
  Serial.begin(115200);                                           // Initialize serial communications with the PC
  SPI.begin();                                                  // Init SPI bus
  mfrc522.PCD_Init();                                              // Init MFRC522 card
  Serial.println(F("Read personal data on a MIFARE PICC:"));    //shows in serial that it is ready to read

  delay(10);

  // We start by connecting to a WiFi network
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  /* Explicitly set the ESP8266 to be a WiFi-client, otherwise, it by default,
     would try to act as both a client and an access-point and could cause
     network-issues with your other WiFi-devices on your WiFi-network. */
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

//*****************************************************************************************//
int value = 0;

void loop() {
  delay(500); // Reading Speed (lower value = faster read but might write multiple entries into db)
  ++value;

  //Serial.print("connecting to ");
  //Serial.println(host);

  // Prepare key - all keys are set to FFFFFFFFFFFFh at chip delivery from the factory.
  MFRC522::MIFARE_Key key;
  for (byte i = 0; i < 6; i++) key.keyByte[i] = 0xFF;

  //some variables we need
  byte block;
  byte len;
  MFRC522::StatusCode status;

  //-------------------------------------------

  // Look for new cards
  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;
  }

  // Select one of the cards
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;
  }

  Serial.println(F("**Card Detected:**")); // println(f()) uses the flash memory not the RAM

  //-------------------------------------------

  mfrc522.PICC_DumpDetailsToSerial(&(mfrc522.uid)); //dump some details about the card

  //mfrc522.PICC_DumpToSerial(&(mfrc522.uid));      //uncomment this to see all blocks in hex

  //-------------------------------------------

  //Serial.print(F("Name: "));

  byte buffer1[18]; //it is 18 bytes long. The array has 18 elements

  block = 4;
  len = 18;

  //------------------------------------------- GET FIRST NAME
  status = mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, 4, &key, &(mfrc522.uid)); //line 834 of MFRC522.cpp file
  if (status != MFRC522::STATUS_OK) {
    Serial.print(F("Authentication failed: "));
    Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  status = mfrc522.MIFARE_Read(block, buffer1, &len);
  if (status != MFRC522::STATUS_OK) {
    Serial.print(F("Reading failed: "));
    Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  //String a = String((char*)buffer1);
  //PRINT FIRST NAME
  /*for (uint8_t i = 0; i < 16; i++)
  {
    if (buffer1[i] != 32)
    {
      Serial.write(buffer1[i]);
    }
  }*/
  char aChar[9];
  for (uint8_t i = 0; i < 9; i++) {
    aChar[i] = buffer1[i];
  }
  String a = String((char*)aChar);
  Serial.println("String a: "+ a);
  Serial.print(" ");

  //---------------------------------------- GET LAST NAME

  byte buffer2[18];
  block = 1;

  status = mfrc522.PCD_Authenticate(MFRC522::PICC_CMD_MF_AUTH_KEY_A, 1, &key, &(mfrc522.uid)); //line 834
  if (status != MFRC522::STATUS_OK) {
    Serial.print(F("Authentication failed: "));
    Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  status = mfrc522.MIFARE_Read(block, buffer2, &len);
  if (status != MFRC522::STATUS_OK) {
    Serial.print(F("Reading failed: "));
    Serial.println(mfrc522.GetStatusCodeName(status));
    return;
  }

  //String b = String((char*)buffer2);
  char bChar[5];
  //PRINT LAST NAME
  /*for (uint8_t i = 0; i < sizeof(buffer2); i++) { //i < 16
    Serial.write(buffer2[i] );
  }*/
  for (int i = 0; i < 6; i++) {
    bChar[i] = buffer2[i];
  }
  String b = String((char*)bChar);
  Serial.println("String b: "+ b);


  //---------------------------------------- Send to mysql
  //Serial.println("Vorname: "+ a);
  //Serial.println("Nachname: "+ b);
  //String data = "value1=" + a + "&value2=" + b;
  //String data = "value1=" + a;
  String data = "value1=" + b;

  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) {
    Serial.println("connection failed");
    return;
  } else {
    Serial.println("connection successful");
    client.println("POST /mysql/post.php HTTP/1.1");
    client.println("Host: alexander-productions.de"); // SERVER ADDRESS HERE TOO
    client.println("Content-Type: application/x-www-form-urlencoded");
    client.print("Content-Length: ");
    client.println(data.length());
    client.println();
    client.print(data);
    Serial.println("Sending to Database successful!");
  }

  Serial.println();
  Serial.println("closing connection");


  //----------------------------------------

  Serial.println(F("\n**End Reading**\n"));

  delay(500); //change value if you want to read cards faster

  mfrc522.PICC_HaltA();
  mfrc522.PCD_StopCrypto1();
}
//*****************************************************************************************//
