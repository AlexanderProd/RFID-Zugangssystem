#include <ESP8266WiFi.h>

const char* ssid     = "FRITZ!Box 7430 BZ";
const char* password = "56330553737990937936";

const char* host = "alexander-productions.de";

void setup() {
  Serial.begin(115200);
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

int value = 0;

void loop() {
  delay(5000);
  ++value;

  Serial.print("connecting to ");
  Serial.println(host);

  /// Important Stuff
  String a = "123456"; //ID 
  String b = "TestVorname"; // Vorname werden in finaler Version evtl. nicht gebraucht 
  String c = "TestNachmame"; // Nachname ""
  String data = "value1=" + a + "&value2=" + b + "&value3=" + c;
  ///

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
}
