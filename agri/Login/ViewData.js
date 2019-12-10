import React, {Component} from 'react'
import {StyleSheet, View, Image, Text,Button} from 'react-native'
import {TouchableOpacity,SafeAreaView,Platform,StatusBar} from 'react-native'
import {Actions} from 'react-native-router-flux'
import {CheckBox} from 'react-native-elements'
import MapView, { Marker } from 'react-native-maps';
import axios from 'axios'

class SensorAD extends Component{
    constructor(props){
        super(props)
        this.state={
            isChecked:true,
            isChecked2:false,
            sensor:[]
        }
    }
    componentDidMount(){
        axios({
            url: 'http://10.250.10.12:3000/sensors',
            method: 'get',
            header: {Accept:"application/json"}
        })
        .then(res=>{
        var array = res.data
        this.setState({
            sensor : array,
        })
        })
        .catch(err=>{
           console.log(err)
        })
    }
    createSensorType(sensor){
        return sensor.map((name=>{
            if(name.edgestation_id==this.props.machine_id)
            {
                return(
                    <Text style={styles.SensorDesStyle}>
                        {name.sensor_type}
                    </Text>
                ) 
            }
            else{return}
        }))
    }
    createSensorID(sensor){
        return sensor.map((name=>{
            if(name.edgestation_id==this.props.machine_id)
            {
                return(
                    <Text style={styles.SensorDesStyle}>
                        {name.sensor_id}
                    </Text>
                ) 
            }
            else{return}
        }))
    }
    machineID(sensor){
        return sensor.map((name=>{
            if(name.edgestation_id==this.props.machine_id)
            {
                return(
                    <Text style={styles.SensorDesStyle}>
                        {name.edgestation_id}
                    </Text>
                ) 
            }
            else{return}
        }))
    }
    isConfigured(sensor){
        return sensor.map((name=>{
            if(name.edgestation_id==this.props.machine_id)
            {
                return(
                    <Text style={styles.SensorDesStyle}>
                        {name.sensor_status}
                    </Text>
                ) 
            }
            else{return}
        }))
    }
    render(){
        return(
            <View style={styles.sensorV}>
                
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                    Sensor Type
                    </Text>
                    {this.createSensorType(this.state.sensor)}
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                    Sensor ID
                    </Text>
                    {this.createSensorID(this.state.sensor)}
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                    Machine ID
                    </Text>
                    {this.machineID(this.state.sensor)}
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                    Status
                    </Text>
                    {this.isConfigured(this.state.sensor)}
                </View>              
                
                
                
            </View>
        )
    }
}


export default class ViewData extends Component {
    constructor(props){
        super(props)
        this.state={
            isChecked:true,
            isChecked2:false,
            latitude:null,
            longitude:null
        }
    }
    handleLog(){
        Actions.Login();
    }
    handleAgri(){
        Actions.views();
    }
        async componentDidMount(){
            axios.get('http://54.161.132.160:5555/get_sensor_data?thingname=edge_station1')
                .then(res=>{
                    var stringed = JSON.stringify(res.data.gps)
                    var unquoted = stringed.replace(/"/g,"")
                    var splitted = unquoted.split(" ")
                    var la1 = parseFloat(splitted[0])
                    var la2 = parseFloat(splitted[1])
                    
                    this.setState({
                        latitude: la1,
                        longitude:la2
                    })
                    console.log(this.state.latitude,this.state.longitude)
                    })
                .catch(err=>{
                    console.log(err)
                })
        }
        
    render(){
        const {latitude,longitude}=this.state
        if(latitude){
            return(    
                <View style={styles.container}>
                     <View style={styles.inner_container1}>
                             
                             <TouchableOpacity onPress={this.handleAgri} style={styles.buttonContainer}>
                             <Image style={styles.imagec}
                             source = {require('../assets/plant2.png')}/>
                         </TouchableOpacity>
                     
                         {/* <TouchableOpacity onPress={this.handleLog} style={styles.buttonContainer2}>
                         <Button color="#982f07" title="Log Out" style={styles.logout}></Button>
                         </TouchableOpacity> */}
                             
                     </View>
                     <SensorAD 
                        machine_name={this.props.data.edgestation_name} 
                        machine_loc={this.props.data.city}
                        machine_id={this.props.data.edgestation_id}/>
                    <View>
                    </View>
                         <MapView style={styles.map}>
                         </MapView>
                        {/* <MapView
                        style={styles.map}
                         initialRegion={{
                         latitude: this.state.latitude,
                         longitude: this.state.longitude,
                         latitudeDelta: 0.0922,
                         longitudeDelta: 0.0421,
                        }}>
                            <Marker
                            coordinate = {{latitude:this.state.latitude,longitude:this.state.longitude}}
                            />
                        </MapView> */}
                        
                    </View>      
         )
        }
        return(
            <View style={styles.container}>
                     <View style={styles.inner_container1}>
                             
                             <TouchableOpacity onPress={this.handleAgri} style={styles.buttonContainer}>
                             <Image style={styles.imagec}
                             source = {require('../assets/plant2.png')}/>
                         </TouchableOpacity>
                     
                         <TouchableOpacity onPress={this.handleLog} style={styles.buttonContainer2}>
                         <Button color="#982f07" title="Log Out" style={styles.logout}></Button>
                         </TouchableOpacity>
                             
                     </View>
                     <SensorAD 
                        machine_name={this.props.data.edgestation_name} 
                        machine_loc={this.props.data.city}
                        machine_id={this.props.data.edgestation_id}/>
                    <View>
                             <Text style={{color:'white'}}>No permission to view map</Text>
                    </View>
            </View>
        )
    }
   
}

const styles = StyleSheet.create({
    container: {
        backgroundColor:'#283437',
        flex:1
    },
    SensorDesStyle: {
        padding: 15,
        fontSize: 12,
        color : '#356109',
        backgroundColor:'#acd385'
    },
    imagec:{
            height:75,
            width:75
    },
    imagem:{
        padding:40,
        height:300,
        width:400
    },
    SensorTextStyle: {
        padding: 17,
        fontSize: 15,
        color : '#FFF',
        backgroundColor:'#1e2d0f'
    },
    SensorTextStyle2: {
        paddingLeft: 15,
        paddingRight: 14,
        fontSize: 13,
        color : 'green'
    },
    sensorVC: {
        backgroundColor:'green',
        flexDirection:'column'
    },
    sensorV: {
        backgroundColor:'green',
        flexDirection:'row'
    },
    inner_container1: {
        backgroundColor:'#283437',
        paddingVertical: 15,
        flexDirection:'row'
    },
    page:{
        backgroundColor: '#345243'
    },
    buttonContainer:{
        paddingHorizontal: 20
    },
    buttonContainer2:{
        marginLeft:'auto',
        paddingRight: 15,
        paddingVertical: 15
    },
   
    buttonContainer3:{
        alignSelf: 'center',
        justifyContent: 'center',
        marginTop: 10,
        backgroundColor: 'green',
        height:20,
        width:80
    },
    agriButton:{
        
        color : '#345243',
        fontWeight:'500'
       
    },
    logout:{
        
    },
    map:{
        flex:1
    }
    
})