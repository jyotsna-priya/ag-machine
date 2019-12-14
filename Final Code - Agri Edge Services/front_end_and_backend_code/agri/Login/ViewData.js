import React, {Component} from 'react'
import {StyleSheet, View, Image, Text,Button} from 'react-native'
import {TouchableOpacity,SafeAreaView,Platform,StatusBar} from 'react-native'
import {Actions} from 'react-native-router-flux'
import {CheckBox} from 'react-native-elements'
import {MapView,Permissions} from 'react-native-maps';
class SensorAD extends Component{
    constructor(props){
        super(props)
        this.state={
            isChecked:true,
            isChecked2:false,
        }
    }
    onChecked(){
    }
    onChecked2(){
    }
    render(){
        return(
            <View style={styles.sensorV}>
                
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                    Sensor Type
                    </Text>
                    <Text style={styles.SensorDesStyle}>
                    Rainfall
                    </Text>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                    Sensor ID
                    </Text>
                    <Text style={styles.SensorDesStyle}>
                    1038412
                    </Text>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                    Active
                    </Text>
                    <CheckBox 
                    checked = {this.state.isChecked}
                    value = {this.state.isChecked}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="delete" 
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                    Inactive
                    </Text>
                    <CheckBox 
                    checked = {this.state.isChecked2}
                    value = {this.state.isChecked2}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="delete" 
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle}>
                    Maintainence
                    </Text>
                    <CheckBox ></CheckBox>
                </View>                
                
                
                
            </View>
        )
    }
}

class SensorAD2 extends Component{
    constructor(props){
        super(props)
        this.state={
            isChecked:true,
            isChecked2:false,
        }
    }
    onChecked(){
    }
    onChecked2(){
    }
    render(){
        return(
            <View style={styles.sensorV}>
                
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Sensor Type
                    </Text>
                    <Text style={styles.SensorDesStyle}>
                    Humidity
                    </Text>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Sensor ID
                    </Text>
                    <Text style={styles.SensorDesStyle}>
                    1038414
                    </Text>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Active
                    </Text>
                    <CheckBox 
                    checked = {this.state.isChecked}
                    value = {this.state.isChecked}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="delete" 
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Inactive
                    </Text>
                    <CheckBox 
                    checked = {this.state.isChecked2}
                    value = {this.state.isChecked2}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="delete" 
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Maintainence
                    </Text>
                    <CheckBox ></CheckBox>
                </View>                
                
                
                
            </View>
        )
    }
}

class SensorAD3 extends Component{
    constructor(props){
        super(props)
        this.state={
            isChecked:true,
            isChecked2:false,
        }
    }
    onChecked(){
    }
    onChecked2(){
    }
    render(){
        return(
            <View style={styles.sensorV}>
                
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Sensor Type
                    </Text>
                    <Text style={styles.SensorDesStyle}>
                    Temperature
                    </Text>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Sensor ID
                    </Text>
                    <Text style={styles.SensorDesStyle}>
                    1038413
                    </Text>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Active
                    </Text>
                    <CheckBox 
                    checked = {this.state.isChecked}
                    value = {this.state.isChecked}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="delete" 
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Inactive
                    </Text>
                    <CheckBox 
                    checked = {this.state.isChecked2}
                    value = {this.state.isChecked2}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="delete" 
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                <View style={styles.sensorVC}>
                    <Text style={styles.SensorTextStyle2}>
                    Maintainence
                    </Text>
                    <CheckBox ></CheckBox>
                </View>                
                
                
                
            </View>
        )
    }
}

export default class ViewData extends Component {
    handleLog(){
        Actions.Login();
    }
    handleAgri(){
        Actions.views();
    }
    state={
        latitude:null,
        longitude:null}

    async componentDidMount(){
        const{status} = await Permissions.getAsync(Permissions.LOCATION)
        if(status!= 'granted'){
            const response = await Permissions.askAsync(Permissions.LOCATION)
        }
    }

    render(){
        return(    
               <View style={styles.container}>
                    <View style={styles.inner_container1}>
                            
                            <TouchableOpacity onPress={this.handleAgri} style={styles.buttonContainer}>
                            <Image style={styles.imagec}
                            source = {require('../assets/plant2.png')}/>
                        </TouchableOpacity>
                    
                        <TouchableOpacity onPress={this.handleLog} style={styles.buttonContainer2}>
                        <Button color="green" title="Log Out" style={styles.logout}></Button>
                        </TouchableOpacity>
                            
                    </View>
                    <SensorAD/>
                    <SensorAD2/>
                    <SensorAD3/>
                    <View style={styles.imagem}>
                    <Image style={styles.imagem}
                            source = {require('../assets/farm.jpg')}/>
                    </View>
                    
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
        padding: 20,
        fontSize: 12,
        color : '#FFF',
        backgroundColor:'black'
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
        padding: 15,
        fontSize: 15,
        color : '#FFF'
    },
    SensorTextStyle2: {
        paddingLeft: 15,
        paddingRight: 15,
        fontSize: 15,
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
        
    }
    
    
})