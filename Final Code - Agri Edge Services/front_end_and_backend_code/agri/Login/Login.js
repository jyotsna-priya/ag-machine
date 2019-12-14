import React, {Component} from 'react'
import {StyleSheet, View, Image, Text,KeyboardAvoidingView} from 'react-native'
import LoginForm from './LoginForm'
export default class Login extends Component {
    render(){
        return(
            <KeyboardAvoidingView behavior="padding" style = {styles.container}>
                <View style = {styles.logoContainer}>
                    <Image 
                    style= {styles.logo}
                    source = {require('../assets/plant2.png')}></Image>
                    <Text style = {styles.title}>Agriculture made easy</Text>
                </View>
                <View style = {styles.formContainer}>
                        <LoginForm/>
                </View>
            </KeyboardAvoidingView>
        )
    }
   
}

const styles = StyleSheet.create({
    container: {
        flex :1,
        backgroundColor: '#345243'
    },
    logoContainer:{
        alignItems: 'center',
        flexGrow:1,
        justifyContent: 'center'
    },
    logo:{
        width:150,
        height:150
    },
    title:{
        color: '#FFF',
        marginTop:10,
        width: 160,
        textAlign: 'center',
        opacity: 0.9
    }
})