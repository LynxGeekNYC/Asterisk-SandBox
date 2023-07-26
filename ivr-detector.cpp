//dialplan
//[ivr-detection]
//exten => s,1,NoOp(IVR detection started)
// same => n,Answer()
// same => n,AGI(your_ivr_detection_script)
// same => n,Hangup()

//Set the AGI Script in Asterisk
//In your Asterisk configuration file (agi.conf), define the AGI script:

//[general]
//enabled = yes

//[your_ivr_detection]
//command = /path/to/your_ivr_detection

#include <iostream>
#include <string>
#include <pjsua-lib/pjsua.h> // Asterisk C API header
using namespace std;

int main(int argc, char* argv[]) {
    // Initialize Asterisk AGI
    cout << "ANSWER" << endl; // Answer the call
    cout.flush();

    string ivrResponse;
    // Assume the IVR plays a prompt and expects a DTMF response
    cout << "STREAM FILE ivr_prompt" << endl; // Replace 'ivr_prompt' with the actual file name
    cout.flush();

    // Wait for the DTMF response from the user
    cin >> ivrResponse;

    // Perform IVR detection logic based on the response
    if (ivrResponse == "1") {
        cout << "SAY ALPHA Thank you for choosing option 1" << endl;
    } else if (ivrResponse == "2") {
        cout << "SAY ALPHA Thank you for choosing option 2" << endl;
    } else {
        cout << "SAY ALPHA Invalid option" << endl;
    }

    cout << "HANGUP" << endl; // Hang up the call
    cout.flush();

    return 0;
}
