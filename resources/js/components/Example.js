import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import TransferForm from './TransferForm';
import TransferList from './TransferList';
import url from '../url'
/**
 * Importamos componentes
 */
export class Example extends Component{
 constructor(props ){
     super(props)

     this.state = {
         money : 0.0,
         transfers: [],
         error: null,
         form:{
            description : '',
             amount:'',
             wallet_id:1
         }
     }
   this.handleChange = this.handleChange.bind(this)
   this.handleSubmit = this.handleSubmit.bind(this)
 }

 //Metodo que controla los evento Submit del formulario
 async handleSubmit(e){
    e.preventDefault()
    // console.log('Sendin...')
    try{
        let config = {
            method : 'POST',
            headers : {
                'Accept':'application/json',
                'Content-Type':'application/json'
            },
          
            body: JSON.stringify(this.state.form)
        }
                    // hacemos la peticion por get
        let res= await fetch(`${url}/api/transfer`,config)
          // almacenamos la respeusta en data
        let data = await res.json()


        //Aqui actualizamos nuestra cartera de acuerdo a la nueva transferencia que se realizo
        this.setState({
            transfers : this.state.transfers.concat(data),
            money : this.state.money + (parseInt(data.amount))

        })


    } catch (error){
this.setState({
    error
})

    }
}
 //Metodo que controla los eventos del formulario

    // Actualizamos el state del form
    handleChange(e){
        console.log(e.target.value)
        this.setState({
            form:{
                ...this.state.form,
                [e.target.name]: e.target.value
            }
        })
    }
 
 //Fin metodo



 async componentDidMount() {
     try{
  let res= await fetch(`${url}/api/wallet`)
  let data = await res.json()
  this.setState({
      money: data.money,
      transfers: data.transfers
  })
     }catch(error){
       this.setState({
           error
       })

     }
     
   
 }

 

    render(){
    return (
        <div className="container">
           <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">Example Component</div>

                        <div className="card-body">I'm an example component!</div>
                <div className="col-md-12-m-t-md">
                    <p className="title"> $ {this.state.money} </p>
                </div>
                <div className="col-md-12">
                
                <TransferForm 
                form={this.state.form} 
                onChange= {this.handleChange} 
                onSubmit={this.handleSubmit}
                />
                </div>
        
            <div className="m-t-md">
               <TransferList transfers={this.state.transfers}/>
            </div>
            </div>
        </div>
        </div>
        </div>
    );
}
}

//  export default Example;

  if (document.getElementById('example')) {
     ReactDOM.render(<Example />, document.getElementById('example'));
 }
