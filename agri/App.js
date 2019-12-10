import React, {Component} from 'react';
import { StyleSheet, Text, View } from 'react-native';
import Login from './Login/Login'
import Routes from './Login/Routes'




export default class App extends Component{
  render(){
    return(
      <Routes/>
    );
  }
}




const styles = StyleSheet.create({
  container: {
   
  },
});
