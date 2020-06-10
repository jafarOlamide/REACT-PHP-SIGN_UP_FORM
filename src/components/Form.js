import React, { Component } from 'react'
import axios from 'axios';

class Form extends Component {

    state = {
        user_name: '',
        user_email: '',
        user_password: '',
        message: ''
    }

    handleUserName = (e) =>{
        this.setState({
            user_name: e.target.value
        })
    }

    handleEmail = (e) =>{
        this.setState({
            user_email: e.target.value
        })
    }

    handlePassword = (e) =>{
        this.setState({
            user_password: e.target.value
        })
    }

    handleSubmit = (e)=>{
        e.preventDefault();
        axios.post('http://localhost/series/react-contact-form/api/add_user.php', {user_data: this.state})
        .then(res=>{
            this.setState({
                message: res.data.message,
                user_name: '',
                user_email: '',
                user_password: ''
            })

        })
    }

    render() {
        return (
            <div className ="">
                <div className="">
                <div className="center">
                    <h3>A Sign Up Form with React and PHP</h3>
                    <br/>
                </div>
                <form className = "center" onSubmit={this.handleSubmit}>
                    <div>
                        <h5>{this.state.message}</h5>
                    </div>
                    <div>
                        <label htmlFor="user_name" className="blue-text flow-text">Username: </label>
                        <input type= "text" onChange={this.handleUserName} value={this.state.user_name}/>
                    </div>
                    <div>
                        <label className="blue-text flow-text">Email: </label>
                        <input type= "email" onChange={this.handleEmail} value={this.state.user_email} />
                    </div>
                    <div>
                        <label className="blue-text flow-text">Password: </label>
                        <input type= "password" onChange={this.handlePassword} value={this.state.user_password}/>
                    </div>
                    <div>
                        <button className="waves-light btn-large">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        )
    }
}

export default Form