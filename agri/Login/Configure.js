import React, {Component} from 'react'
import {StyleSheet, View, Image, Button,Text} from 'react-native'
import {TouchableOpacity,SafeAreaView,Platform,StatusBar} from 'react-native'
import {Actions} from 'react-native-router-flux'
import {CheckBox} from 'react-native-elements'

class SensorAD extends Component{
    constructor(props){
        super(props)
        this.state={
            isChecked:true,
            isChecked2:false,
        }
    }
    onChecked(){
        this.setState({isChecked:!this.state.isChecked})
        this.setState({isChecked2:!this.state.isChecked2})
    }
    onChecked2(){
        this.setState({isChecked2:!this.state.isChecked2})
        this.setState({isChecked:!this.state.isChecked})
    }
    render(){
        return(
            <View style={styles.sensorV}>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle}>
                #
                </Text>
                <Text style={styles.SensorDesStyle}>
                1
                </Text>
                </View>
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
                10384123145
                </Text>
                </View>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle}>
                Add
                </Text>
                <CheckBox 
                    checked = {this.state.isChecked}
                    value = {this.state.isChecked}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="add" 
                    onPress={this.onChecked.bind(this)} 
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle}>
                Delete
                </Text>
                <CheckBox 
                    checked = {this.state.isChecked2}
                    value = {this.state.isChecked2}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="delete" 
                    onPress={this.onChecked2.bind(this)}
                    center 
                    style={styles.SensorDesStyle}/>
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
        this.setState({isChecked:!this.state.isChecked})
        this.setState({isChecked2:!this.state.isChecked2})
    }
    onChecked2(){
        this.setState({isChecked2:!this.state.isChecked2})
        this.setState({isChecked:!this.state.isChecked})
    }
    render(){
        return(
            <View style={styles.sensorV}>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle2}>
                #
                </Text>
                <Text style={styles.SensorDesStyle}>
                2
                </Text>
                </View>
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
                1weqrtty145
                </Text>
                </View>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle2}>
                Add
                </Text>
                <CheckBox 
                    checked = {this.state.isChecked}
                    value = {this.state.isChecked}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="add" 
                    onPress={this.onChecked.bind(this)} 
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle2}>
               Delete
                </Text>
                <CheckBox 
                    checked = {this.state.isChecked2}
                    value = {this.state.isChecked2}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="delete" 
                    onPress={this.onChecked2.bind(this)}
                    center 
                    style={styles.SensorDesStyle}/>
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
        this.setState({isChecked:!this.state.isChecked})
        this.setState({isChecked2:!this.state.isChecked2})
    }
    onChecked2(){
        this.setState({isChecked2:!this.state.isChecked2})
        this.setState({isChecked:!this.state.isChecked})
    }
    render(){
        return(
            <View style={styles.sensorV}>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle2}>
                #
                </Text>
                <Text style={styles.SensorDesStyle}>
                3
                </Text>
                </View>
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
                10384123145
                </Text>
                </View>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle2}>
                Add
                </Text>
                <CheckBox 
                    checked = {this.state.isChecked}
                    value = {this.state.isChecked}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="add" 
                    onPress={this.onChecked.bind(this)} 
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                <View style={styles.sensorVC}>
                <Text style={styles.SensorTextStyle2}>
                Delete
                </Text>
                <CheckBox 
                    checked = {this.state.isChecked2}
                    value = {this.state.isChecked2}
                    uncheckedIcon='circle-o' 
                    checkedIcon='dot-circle-o' 
                    className="delete" 
                    onPress={this.onChecked2.bind(this)}
                    center 
                    style={styles.SensorDesStyle}/>
                </View>
                
                
                
                
            </View>
        )
    }
}


export default class Configure extends Component {
    handleLog(){
        Actions.Login();
    }
    handleAgri(){
        Actions.views();
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
    SensorTextStyle: {
        padding: 27,
        fontSize: 15,
        color : '#FFF'
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
        backgroundColor: 'green',
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