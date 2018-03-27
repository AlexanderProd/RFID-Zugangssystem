#include <WiFi.h>
#include <SPI.h>

char ssid[] = "myNetwork";     //  your network SSID (name)
char pass[] = "myPassword";   // your network password

int status = WL_IDLE_STATUS;
char servername[]="alexander-productions.de/mysql";  // remote server we will connect to

// Initialize the client library
WiFiClient client;

byte mac[] = { 0x00, 0xAA, 0xBB, 0xCC, 0xDE, 0x01 }; // RESERVED MAC ADDRESS

void setup() {
	Serial.begin(115200);
	Serial.println("Attempting to connect to WPA network...");
  Serial.print("SSID: ");
  Serial.println(ssid);

  status = WiFi.begin(ssid, pass);
  if ( status != WL_CONNECTED) {
    Serial.println("Couldn't get a wifi connection");
    delay(2000);
		return; // Might be an infinite loop 
  }
}

void loop(){

	t = "TestID";
	h = "TestNachmame";

	data = "temp1=" + t + "&hum1=" + h;

	if (client.connect("www.*****.*************.com",80)) { // REPLACE WITH YOUR SERVER ADDRESS
		client.println("POST /add.php HTTP/1.1");
		client.println("Host: *****.*************.com"); // SERVER ADDRESS HERE TOO
		client.println("Content-Type: application/x-www-form-urlencoded");
		client.print("Content-Length: ");
		client.println(data.length());
		client.println();
		client.print(data);
	}

	if (client.connected()) {
		client.stop();	// DISCONNECT FROM THE SERVER
	}

	delay(10000); // WAIT FIVE MINUTES BEFORE SENDING AGAIN
}
