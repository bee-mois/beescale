import json
import os
import paho.mqtt.client as mqtt

def send_measurement(yun, Timestamp, CountPerMinute, GammaRadiation):

    # The MQTT host
    mqtt_host = 'swarm.hiveeyes.org'

    mqtt_port = 1883
    mqtt_user = 'xxxxxxxx'
    mqtt_pass = 'xxxxxxxx'

    # The MQTT topic
    # See also: https://hiveeyes.org/docs/system/vendor/hiveeyes-one/topology.html#rationale
    mqtt_topic = u'{realm}/{network}/{gateway}/{node}/message-json'.format(
        realm   = 'hiveeyes',                                   # Kollektiv
        network = '27041c2a-8afd-4a1e-b3ae-44233fa1f06b',       # Imker-ID
        gateway = 'mois',                                       # Standort
        node    = 'yun'                                         # Beute
    )

    # Define measurement
    measurement = {
        'Timestamp':        Timestamp,
        'CountPerMinute':   CountPerMinute,
        'GammaRadiation':   GammaRadiation,
    }

    # Serialize data as JSON
    payload = json.dumps(measurement)

    # Publish to MQTT
    pid = os.getpid()
    client_id = '{}:{}'.format('hiverize', str(pid))
    backend = mqtt.Client(client_id=client_id, clean_session=True)
    backend.username_pw_set(mqtt_user, mqtt_pass)
    backend.connect(mqtt_host, mqtt_port)
    backend.publish(mqtt_topic, payload)
    backend.disconnect()
