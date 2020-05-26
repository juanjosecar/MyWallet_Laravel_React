<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Wallet;
use App\Transfer;

class WalletTest extends TestCase
{
   use  RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function testGetWallet()//Cuando se quieran obtener una wallet
    {
         $wallet = factory(Wallet::class,)->create();
         $transfers = factory(Transfer::class, 3)->create([ //El faker de transfer nesecita 
            //un wallet id por ello vamos a sobreescribir el fake con el id de $wallet que se crea en la linea de arriba.
             'wallet_id' => $wallet->id
         ]);

        $response = $this->json('GET','/api/wallet');

        $response->assertStatus(200) //aqui digo que esperamos un status 200  
        ->assertJsonStructure([      //Aqui valido la estructura de como quiero que llegue esos datos 
            'id', 'money','transfers' =>[
                '*' => [ // '*' puedo recibir cualquier cosa pero los elementos seran los sgts
                    'id', 'amount', 'description', 'wallet_id'
                ]
            ]

        ]);


    //Aqui podemos probar cuantos transfers son los que se me estan retornando , ('esperamos N elementos de response) , esto es en el primer parametro de abajo
       $this->assertCount(3,$response->json()['transfers']);  //Con esto decimos que en ese response debe existir la llave  transfer
    }
}
