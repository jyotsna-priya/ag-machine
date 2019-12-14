from flask import Flask
from flask import jsonify
from flask import request

app = Flask(__name__)

@app.route('/get_sensor_data', methods=['GET'])
def get_data():
    data = {'temperature': 61.92, 'humidity': 0.6, 'precipProbability': 0, 'windSpeed': 1.43, 'timestamp': 1574059921.188755, 'edge_station_id': 'ES1', 'gps': '38.8267,-123.4233'}
    # Add code to get data from shadow
    return jsonify(data)

@app.route('/configure_edgestation', methods=['PUT'])
def update_sensor():
    data = request.get_json()
    # Add code to put data to edgestation
    return jsonify(data)

if __name__ == "__main__":
    app.run(host='0.0.0.0',
            port=5555,
            debug=True,
            use_reloader=False,
            ssl_context='adhoc',
            threaded=True)