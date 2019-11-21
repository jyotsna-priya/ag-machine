import React, {Component} from 'react'
import {StyleSheet} from 'react-native'
import {Router, Stack,Scene} from 'react-native-router-flux'
import Login from "./Login"
import viewMachine from './View'
import ViewData from './ViewData'
import Configure from './Configure'

export default class Routes extends Component {
    render(){
        return(
            <Router>
                <Stack key = "root">
                    <Scene key = "Login" component = {Login} title = "Log in"/>
                    <Scene key = "views" component = {viewMachine} title = "View"/>
                    <Scene key = "Configure" component = {Configure} title = "Configure"/>
                    <Scene key = "ViewData" component = {ViewData} title = "View Sensor Data"/>
                </Stack>
            </Router>
            
        )
    }
   
}

const styles = StyleSheet.create({
    container: {
        
    },
})