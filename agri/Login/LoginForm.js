import React, {Component} from 'react'
import {StyleSheet, View, TouchableOpacity, TextInput,Text} from 'react-native'
import {Actions} from 'react-native-router-flux'
import axios from 'axios'

export default class LoginForm extends Component {
    constructor(props)
    {
        super(props)
        this.state={
            username: '',
            password:''
        }
    }
    login(){
        axios({
            method:'post',
            url:'http://10.250.10.12:3000/auth',
            headers:{username:this.state.username,
                    password:this.state.password}
        })
        .then(res=>{
            console.log(res.data)
            if(res.data[0]=="I"||res.data[0]=="P")
            {
                alert(res.data)
            }
            else{
                alert("Welcome!")
                Actions.views()
            }
            
        })
        .catch(err=>{
            console.log(err)
        })
         //Actions.views()
    }

    handleUserChange (e){
        this.setState({
            username: e
        })
        console.log(this.state.username)
    }

    handlePassChange (e){
        this.setState({
            password: e
        })
        console.log(this.state.password)
    }
    render(){
       
        return(
            <View style = {styles.container}>
                <TextInput style = {styles.input} onChangeText={this.handleUserChange.bind(this)} placeholder="Username" placeholderTextColor= "black" returnKeyType="next" onSubmitEditing={()=>this.passwordInput.focus()}/>
                <TextInput style = {styles.input}  onChangeText={this.handlePassChange.bind(this)} placeholder="Password" placeholderTextColor= "black" secureTextEntry returnKeyType="go" ref={(input)=> this.passwordInput = input}/>
                <TouchableOpacity onPress={this.login.bind(this)} style = {styles.buttonContainer}>
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