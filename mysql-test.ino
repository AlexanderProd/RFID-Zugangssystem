#include <WiFi.h>
#include <SPI.h>

char ssid[] = "myNetwork";     //  your network SSID (name)
char pass[] = "myPassword";   // your network password

int status = WL_IDLE_STATUS;

// Initialize the client library
WiFiClient client;

//Defining Variables
String data;

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
  } else {
		Serial.println("Connection established");
	}
}

void loop(){

	// int a = 00001;
	// int b = 99999;
	String a = "TestID";
	String b = "TestNachmame";

	data = "value1=" + a + "&value2=" + b;

	if (client.connect("www.alexander-productions.de/mysql",80)) { // REPLACE WITH YOUR SERVER ADDRESS
		client.println("POST /add.php HTTP/1.1");
		client.println("Host: alexander-productions.de/mysql"); // SERVER ADDRESS HERE TOO
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
