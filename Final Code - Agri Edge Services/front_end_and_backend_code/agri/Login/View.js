import React, {Component} from 'react'
import {StyleSheet, Text, View,Image,Button} from 'react-native'
import {Header} from 'react-native-elements'
import {TouchableOpacity,SafeAreaView,Platform,StatusBar} from 'react-native'
import {Actions} from 'react-native-router-flux'

class SensorTab extends Component{
    handleConfigure(){
        Actions.Configure();
    }
    handleView(){
        Actions.ViewData();
    }
    render(){
        return(
            <View style={styles.sensorV}>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle}>
                Machine Type
                </Text>
                <Text style={styles.SensorDesStyle}>
                Drone 1
                </Text>
                </View>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle}>
                Machine ID
                </Text>
                <Text style={styles.SensorDesStyle}>
                104499316
                </Text>
                </View>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle}>
                Status
                </Text>
                <Text style={styles.SensorDesStyle}>
                Active
                </Text>
                </View>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle}>
                Actions
                </Text>
                <View style={styles.buttonContainer3}>
                <TouchableOpacity onPress={this.handleConfigure} >
                            <Text>Configure</Text>
                </TouchableOpacity>
                </View>
                <View style={styles.buttonContainer3}>
                <TouchableOpacity onPress={this.handleView}>
                            <Text>Details</Text>
                </TouchableOpacity>
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
        Actions.Login();
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
                        <Button onPress={this.handleLog} color="green" title="Log Out" style={styles.logout}></Button>
                        </TouchableOpacity>
                    
                       
                            
                    </View>
                   <SensorTab/>
                </View>
        )
    }
   
}



const styles = StyleSheet.create({
    container: {
        backgroundColor:'#345243',
        flex:1
    },
    SensorDesStyle: {
        padding: 25,
        fontSize: 12,
        color : '#FFF',
        backgroundColor:'black'
    },
    SensorTextStyle: {
        padding: 25,
        fontSize: 15,
        color : '#FFF'
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
    imagec:{
        width:75,
        height:75
    }
    
});