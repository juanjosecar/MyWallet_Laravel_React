<?php

namespace Tests\Feature;

use App\Transfer;
use App\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransferTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPostTransfer()  //Ya que noss vamos a enfocar en enviar como peticion post una transfer y pues probar que esta se almacene de forma correcta
    
    {
        $wallet = factory(Wallet::class)->create();
        $transfer = factory(Transfer::class)->make(); //este make me guarda en memoria y no lo crea en la base de datos.

        $response = $this->json('POST','/api/transfer',[  //Esta ruta  es generada  manera  de test para que se pueda llevar a cabo el metodo post 
            //Aqui se crea una nueva transfer
            'description' => $transfer->description,
            'amount'=>$transfer->amount , 
            'wallet_id' => $wallet->id               
        ]);

        $response->assertJsonStructure([ // Aqui valido como quiero que se envie la informacion que estoy mandando
            'id','description','amount','wallet_id'
        ])->assertStatus(201); //este nos dice que se ha creado un un registro; eso es lo que esperamos del servidor.

      
        //Aqui abajo podemos ver si algo se realmente existe dentro de mi base de datos.
        //Entonces validamos de nuevo cada campo en la base de datos
        $this->assertDatabaseHas('transfers', [
           
            'description' => $transfer->description,
            'amount'=>$transfer->amount , 
            'wallet_id' => $wallet->id
        ]);

        //Por ultimo validamos la logica, en la que laravel actualizar la cantidad de dinero 
        //que yo tengo en mi cartera con respecto al ingreso o el gasto que me llegara desde react
        $this->assertDatabaseHas('wallets', [
           
            'id' => $wallet->id,
            'money'=>$wallet->money + $transfer->amount , //Aqui hacemos la logica, 
            //en la que sumamos o restamos(ley de signos)el monto de la transferencia con el dinero(money)que esta en la tabla wallet
            
        ]);


    }
}
