import React, {Component} from 'react'
import {StyleSheet, View, Image, Button,Text, Alert} from 'react-native'
import {TouchableOpacity,Platform,StatusBar} from 'react-native'
import {Actions} from 'react-native-router-flux'
import {CheckBox} from 'react-native-elements'
import axios from 'axios'

class SensorAD extends Component{
    constructor(props){
        super(props)
        this.state={
            isChecked:true,
            isChecked2:false,
            sensor_type:'',
            sensor_data:{
                temperature:'c',
                humidity:'',
                rainfall:'',
                gps:'',
                speed:'',
                location:'',
                thingname:''
            },
            tempState: true,
            humState: true,
            rainState: true,
            gpsState: true,
            speedState:true,
            tempState2: false,
            humState2: false,
            rainState2: false,
            gpsState2: false,
            speedState2:false,
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
        }))
    }

    createSensorA(sensor){
        return sensor.map((name=>{
            if(name.edgestation_id==this.props.machine_id)
            {
                this.state.sensor_type=name.sensor_type
                return(
                    <CheckBox 
                    checked = {(name.sensor_type=='temperature')?this.state.tempState:
                                ((name.sensor_type=='humidity')?this.state.humState:
                                ((name.sensor_type=='rainfall')?this.state.rainState:
                                ((name.sensor_type=='gps')?this.state.gpsState:
                                this.state.speedState
                                )))}
                        value = {this.state.isChecked}
                        uncheckedIcon='circle-o' 
                        checkedIcon='dot-circle-o' 
                        className="add" 
                        checkedColor="#acd385"
                        uncheckedColor="#acd385"
                        onPress={()=>{if(name.sensor_type=='temperature'){
                                            if(this.state.tempState==false){
                                                this.state.tempState=!this.state.tempState
                                                this.state.tempState2=!this.state.tempstate2
                                                this.forceUpdate()
                                            }
                                        }else if(name.sensor_type=='humidity'){
                                            if(this.state.humState==false){
                                                this.state.humState=!this.state.humState
                                                this.state.humState2=!this.state.humState2
                                                this.forceUpdate()
                                            }
                                        }else if(name.sensor_type=='rainfall'){
                                            if(this.state.rainState==false){
                                                this.state.rainState=!this.state.rainState
                                                this.state.rainState2=!this.state.rainState2
                                                this.forceUpdate()
                                            }
                                        }else if(name.sensor_type=='gps'){
                                            if(this.state.gpsState==false){
                                                this.state.gpsState=!this.state.gpsState
                                                this.state.gpsState2=!this.state.gpsState2
                                                this.forceUpdate()
                                            }
                                        }else if(name.sensor_type=='speed'){
                                            if(this.state.speedState==false){
                                                this.state.speedState=!this.state.speedState
                                                this.state.speedState2=!this.state.speedState2
                                                this.forceUpdate()
                                            }
                                        }
                                    }
                                } 
                        center 
                        style={styles.SensorDesStyle}/>
                
                ) 
            }
        }))
    }
    createSensorD(sensor){
        return sensor.map((name=>{
            if(name.edgestation_id==this.props.machine_id)
            {
                this.state.sensor_type=name.sensor_type
                
                return(
                    <CheckBox 
                        checked = {(name.sensor_type=='temperature')?this.state.tempState2:
                                    ((name.sensor_type=='humidity')?this.state.humState2:
                                    ((name.sensor_type=='rainfall')?this.state.rainState2:
                                    ((name.sensor_type=='gps')?this.state.gpsState2:
                                    this.state.speedState2
                                    )))}
                        value = {this.state.isChecked2}
                        uncheckedIcon='circle-o' 
                        checkedIcon='dot-circle-o' 
                        className="delete"
                        checkedColor="#acd385"
                        uncheckedColor="#acd385" 
                        onPress={()=>{if(name.sensor_type=='temperature'){
                                        if(this.state.tempState2==false){
                                            this.state.tempState=!this.state.tempState
                                            this.state.tempState2=!this.state.tempstate2
                                            this.forceUpdate()
                                        }
                                        }else if(name.sensor_type=='humidity'){
                                            if(this.state.humState2==false){
                                                this.state.humState=!this.state.humState
                                                this.state.humState2=!this.state.humState2
                                                this.forceUpdate()
                                            }
                                        }else if(name.sensor_type=='rainfall'){
                                            if(this.state.rainState2==false){
                                                this.state.rainState=!this.state.rainState
                                                this.state.rainState2=!this.state.rainState2
                                                this.forceUpdate()
                                            }
                                        }else if(name.sensor_type=='gps'){
                                            if(this.state.gpsState2==false){
                                                this.state.gpsState=!this.state.gpsState
                                                this.state.gpsState2=!this.state.gpsState2
                                                this.forceUpdate()
                                            }
                                        }else if(name.sensor_type=='speed'){
                                            if(this.state.speedState2==false){
                                                this.state.speedState=!this.state.speedState
                                                this.state.speedState2=!this.state.speedState2
                                                this.forceUpdate()
                                            }
                                        }
                    }
                } 
                        center
                        style={styles.SensorDesStyle}/>
                ) 
            }
        }))
    }
    callPut(){
        // alert("Changes saved")
        // Actions.views()
        if(this.state.tempState){
            this.state.sensor_data["temperature"]='add'
        }else this.state.sensor_data["temperature"]='delete'
        if(this.state.humState){
            this.state.sensor_data["humidity"]='add'
        }else this.state.sensor_data["humidity"]='delete'
        if(this.state.rainState){
            this.state.sensor_data["rainfall"]='add'
        }else this.state.sensor_data["rainfall"]='delete'
        if(this.state.gpsState){
            this.state.sensor_data["gps"]='add'
        }else this.state.sensor_data["gps"]='delete'
        if(this.state.speedState){
            this.state.sensor_data["speed"]='add'
        }else this.state.sensor_data["speed"]='delete'
        this.state.sensor_data.location=this.props.machine_loc
        this.state.sensor_data.thingname=this.props.machine_name
        console.log(this.state.sensor_data["temperature"])
        axios({
            url: 'http://54.161.132.160:5555/configure_edgestation',
            method: 'put',
            data: this.state.sensor_data
        })
        .then(res=>{
            console.log(res.data)
            alert("Changes saved")
            Actions.views()
        })
        .catch(err=>{
           console.log(err)
           
        })
    }

    componentWillUnmount(){}
    render(){
        return(
            <View>
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
                        Add
                </Text>
                    {this.createSensorA(this.state.sensor)}
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                        Delete
                    </Text>
                    {this.createSensorD(this.state.sensor)}
                </View>
            </View>
            <Button color="#1e2d0f" 
            title="save changes" 
            onPress={this.callPut.bind(this)}></Button>
            </View>
        )
    }
}

export default class Configure extends Component {
    constructor(props){
        super(props)
        this.state={
            isChecked:true,
            isChecked2:false
        }
    }
    
    handleLog(){
        Alert.alert(
            'logging out..',
            'Are you sure you want to log out?',
            [
                {text:'No',onPress:()=>console.warn('NO Pressed'),style:'cancel'},
                {text:'Yes',onPress:()=>Actions.View()},
            ],
        );
    }
    handleAgri(){
        Actions.views();
    }
    render(){
        console.log(this.props.data.edgestation_name)
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
        padding: 20,
        fontSize: 12,
        color : '#356109',
        backgroundColor:'#acd385'
    },
    SensorTextStyle: {
        padding: 27,
        fontSize: 15,
        color : '#FFF',
        backgroundColor:'#1e2d0f'    

    },
    SensorTextStyle2: {
        paddingLeft: 27,
        paddingRight: 27,
        fontSize: 15,
        color : '#345243'
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
        color:'white',
        backgroundColor: 'grey',
        height:20,
        width:80
    },
    agriButton:{
        
        color : '#345243',
        fontWeight:'500'
       
    },
    logout:{
        textAlign: 'center',
        color : 'black',
        margin : 'auto'
    },
    imagec:{
        width:75,
        height:75
    }
})