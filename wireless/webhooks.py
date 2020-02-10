########################################
#          Matthew Vaughan             #
#     Webhooks for Twilio in Flask     #
# My first non-trivial python program! #
########################################
# imports 
import os
import requests

# more specific imports (I'm wondering about style)
from flask import Flask, request
from twilio.twiml.voice_response import VoiceResponse
from twilio.rest import Client

# we will assume that my account SID and auth token are in the env
account_sid = os.envirn.get('ACCOUNT_SID')
auth_token  = os.envirn.get('AUTH_TOKEN')
# restful client 
client = Client( account_sid, auth_token )

app = Flask(__name__)

@app.route("/answer", methods=['POST'])
def answer_call():
    resp = VoiceResponse()
    resp.say("Twilio's always there when you call!")
    return str(resp)

@app.route("/call-status-change", methods=['POST'])
def callStatusChange():

    request = request.get_json()
    body = "";
    for key in request.keys():
        if ( body == "" ):
            body = key + " is " + request[ key ]
        else:
            body += "\n" + key + " is " + request[ key ]
    

    message = client.messages.create(
        to="+16173345281", from_"+16173345281",
        body=body )

    call = client.calls.create(
        to="+16173345281",
        from_="+19783879792",
        twiml="<response><say>Impressive. Now release your anger</say></response>"
    )

    print( message.sid )
    print( call.sid )
    
    return



if __name__ == "__main__":
    app.run()
