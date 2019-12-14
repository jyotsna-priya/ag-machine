import argparse
import subprocess

def add_args(parser):
    """ Supports the command-line arguments listed below."""

    parser.add_argument('--edge_station_id',
                        required=True,
                        action='store',
                        help='Edge station ID')
    parser.add_argument('--sensor_list',
                        required=True,
                        action='store',
                        help='List of sensor data to generate')
    parser.add_argument('--location',
                        required=True,
                        action='store',
                        help='Location of edge station')

# Start program
if __name__ == "__main__":
    parser = argparse.ArgumentParser(description='Arguments for sensor data generation tool')
    add_args(parser)
    args = parser.parse_args()
    subprocess.check_call(["sh", "/Users/avdas/robot_ws/NCP-porting/sit_tools/run_generate.sh", "{}".format(args.sensor_list), "{}".format(args.location), "{}".format(args.edge_station_id)])
