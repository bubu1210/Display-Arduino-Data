#include <WiFi.h>
#include <HTTPClient.h>

#define LED 2
#define SENSOR 4

// Replace with your network credentials
const char* ssid = "Wokwi-GUEST";
const char* password = "";

// Database settings
const char* serverName = "iotsensorr.000webhostapp.com";
const int serverPort = 80; // replace with your server's port
const char* userName = "id20523381_root";
const char* passwordDB = "srC^X//2Bld&v&=S";
const char* dbName = "id20523381_iotsensorr";

// Analog input pin for the sensor
const int sensorPin = 4;

// Digital output pin for the LED
const int ledPin = 2;

int led_status = 0;

int sensor_status = 0;

void setup() {
  Serial.begin(115200);

  // Connect to Wi-Fi network
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }

  Serial.println("Connected to WiFi");


  pinMode(SENSOR, INPUT);
  pinMode(LED, INPUT);
  pinMode(LED, OUTPUT);
}

void loop() {
  sensor_status = digitalRead(SENSOR);
  led_status = digitalRead(LED);
  Serial.print("Sensor_status: ");
  Serial.println(sensor_status);
  Serial.print("Led_status: ");
  Serial.println(led_status);
  if (sensor_status == 1) {
    digitalWrite(LED, HIGH);
  } else {
    digitalWrite(LED, LOW);
  }
  // delay(5000); // Wait for 1000 millisecond(s)


  // Send the data to the database
  HTTPClient http;
  http.begin(String("http://") + serverName + ":" + serverPort + "/insert_data.php");
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  String postData = "sensor_status=" + String(sensor_status) + "&led_status=" + String(led_status);
  int httpResponseCode = http.POST(postData);

  if (httpResponseCode > 0) {
    Serial.println("Data sent to database");
  } else {
    Serial.println("Error sending data to database");
  }



  http.end();

  delay(5000); // wait 5 seconds before sending next data
}
