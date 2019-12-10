import React, {Component} from 'react'
import {StyleSheet, Text, View,Image,Button,Alert} from 'react-native'
import {Header} from 'react-native-elements'
import {TouchableOpacity,SafeAreaView,Platform,StatusBar} from 'react-native'
import {Actions} from 'react-native-router-flux'
import axios from 'axios'

class SensorTab extends Component{
    constructor(props)
    {
        super()
        this.state={
            machines:[],
            machineType: '',
            machineID:'',
            status:'',
            data:''
        }
    }
    componentDidMount(){
        axios({
            url: 'http://10.250.10.12:3000/edge',
            method: 'get',
            header: {Accept:"application/json"}
        })
        .then(res=>{
            this.setState({
                machines: res.data
            })
        })
        .catch(err=>{
           console.log(err)
        })
    }
    createMachineType(machine){
        return machine.map((name)=>{
            return (
                    <Text style={styles.SensorDesStyle}>
                            {name.machine_type}
                    </Text>
                
            )
        })
    }
    createMachineId(machine){
        return machine.map((name)=>{
            return (
                    <Text style={styles.SensorDesStyle}>
                            {name.edgestation_id}
                    </Text>
                
            )
        })
    }
    createActions(machine){
        return machine.map((name)=>{
            return (
            <View>
                    <View style={styles.buttonContainer3}>
                        <TouchableOpacity onPress={()=>{Actions.Configure({data:name})}} >
                                    <Text style={{color:"#acd385"}}>Configure</Text>
                        </TouchableOpacity>
                    </View>
                    <View style={styles.buttonContainer3}>
                        <TouchableOpacity onPress={()=>{Actions.ViewData({data:name})}}>
                                    <Text style={{color:"#acd385"}}>Details</Text>
                        </TouchableOpacity>
                    </View>
                </View>
                )
        })
    }
    componentWillMount(){}
    render(){
        return(
            <View>
                <View style={styles.sensorV}>
                    <View style={styles.sensorVC}>
                        <Text style={styles.SensorTextStyle}>
                        Machine Type
                        </Text>
                        {this.createMachineType(this.state.machines)}
                    </View>
                    <View style={styles.sensorVC}>
                        <Text style={styles.SensorTextStyle}>
                        Machine ID
                        </Text>
                        {this.createMachineId(this.state.machines)}
                    </View>
                    <View style={styles.sensorVC}>
                        <Text style={styles.SensorTextStyle}>
                        Actions
                        </Text>
                        {this.createActions(this.state.machines)}
                    </View>
                </View>
            </View>
            
        )
    }
}

export default class viewMachine extends Component {
    handleAgri(){
        Actions.views();
    }
    handleLog(){
        Alert.alert(
            'logging out..',
            'Are you sure you want to log out?',
            [
                {text:'No',onPress:()=>console.log('NO Pressed'),style:'cancel'},
                {text:'Yes',onPress:()=>Actions.Login()},
            ],
        );
    }
    render(){
        return(    
               <View style={styles.container}>
                    <View style={styles.inner_container1}>
                            
                            <TouchableOpacity onPress={this.handleAgri} style={styles.buttonContainer}>
                            <Image style={styles.imagec}
                            source = {require('../assets/plant2.png')}/>
                        </TouchableOpacity>
                    <TouchableOpacity  style={styles.buttonContainer2}>
                        <Button onPress={this.handleLog} color="#982f07" title="Log Out" style={styles.logout}></Button>
                        </TouchableOpacity>
                            
                    </View>
                   <SensorTab/>
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
        padding: 33,
        fontSize: 15,
        color : '#356109',
        backgroundColor:'#acd385'
    },
    SensorTextStyle: {
        padding: 33,
        fontSize: 15,
        color : '#FFF',
        backgroundColor:'#1e2d0f'
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
        marginTop: 20,
        backgroundColor: 'green',
        color:'#acd385',
        height:20,
        width:80
    },
    agriButton:{
        
        color : '#345243',
        fontWeight:'500'
       
    },
    logout:{ 
    },
    imagec:{
        width:75,
        height:75
    }
    
});