<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\Transfer;

class TransferController extends Controller
{


    public function store(Request $request)
    {
        //En este fragmento de codigo, lo que hacemoses actualizar dicha cartera sumando o 
        //restando lo que viaja en el request en su propiedad amount(monto)
        $Wallet = Wallet::find($request->wallet_id);
        $Wallet->money = $Wallet->money + $request->amount;
        $Wallet->update();

        //En este fragmento de codigo, lo que hacemoses crear una nueva transferencia tomando como registro, los datos que viajan
        // a traves de request
        $transfer = new Transfer();
        $transfer->description = $request->description;
        $transfer->amount = $request->amount;
        $transfer->wallet_id = $request->wallet_id;
        $transfer->save();

        // return response()->json($transfer, 201); //Aqui estamos retornando lo que estamos validando en nuestra prueba
        return response()->json([
            'id' => $transfer->id, 
            'description' => $request->description, 
            'amount' => $transfer->amount, 
            'wallet_id'=>$transfer->wallet_id 
        ], 201);
        
    }
    //
}
