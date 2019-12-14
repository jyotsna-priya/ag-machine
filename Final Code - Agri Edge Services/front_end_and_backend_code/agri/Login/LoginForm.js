import React, {Component} from 'react'
import {StyleSheet, View, TouchableOpacity, TextInput,Text} from 'react-native'
import {Actions} from 'react-native-router-flux'

export default class LoginForm extends Component {
    login(){
        Actions.views()
    }
    render(){
       
        return(
            <View style = {styles.container}>
                <TextInput style = {styles.input} placeholder="Username" placeholderTextColor= "black" returnKeyType="next" onSubmitEditing={()=>this.passwordInput.focus()}/>
                <TextInput style = {styles.input} placeholder="Password" placeholderTextColor= "black" secureTextEntry returnKeyType="go" ref={(input)=> this.passwordInput = input}/>
                <TouchableOpacity onPress={this.login} style = {styles.buttonContainer}>
                    <Text style = {styles.buttonText}>Login</Text>
                </TouchableOpacity>
            </View>
        )
    }
   
}

const styles = StyleSheet.create({
    container: {
        padding: 20
    },
    input:{
        height:40,
        backgroundColor:'rgba(255,255,255,0.7)',
        marginBottom: 20,
        color: 'black',
        paddingHorizontal: 10
    },
    buttonContainer:{
        backgroundColor:'#283437',
        paddingVertical: 15
    },
    buttonText:{
        textAlign: 'center',
        color : '#FFF',
        fontWeight:'500'
    }
});