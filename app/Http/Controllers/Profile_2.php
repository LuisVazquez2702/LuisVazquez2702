<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Profile_2 extends Controller
{
    //
    public function nameEmail(Request $request){
        //auth()->user()->id == 1
        if(auth()->user()->id==1){
            return 'Tu no puedes modificar estos datos por ser usuario root';
        }else{
            try {
            $userModify = User::find(auth()->user()->id);
            $userModify->name = $request->name;
            $userModify->email = $request->email;
            $userModify->save();
            return 'La información ha sido actualizada';
            }catch(Exception $e){
                return 'Lo sieto! Algo ha fallado:'.$e;
            }
        }
    }

    public function foto(Request $request){
        try {
            $userModify = User::find(auth()->user()->id);
            $userModify->foto = $request->file('foto')->store('users','public');       
            $userModify->save();
            return 'La información ha sido actualizada';
        }catch(Exception $e){
                return 'Lo sieto! Algo ha fallado:'.$e;
        }
    }
    public function password(Request $request){
        if(auth()->user()->id==1){
            return 'Tu no puedes modificar estos datos por ser usuario root';
        }else{
            $userModify = User::find(auth()->user()->id);
            
            if(Hash::check($request->passwordOld, $request->user()->password)){
                $aux = Hash::make($request->passwordOld);
                try {
                    $userModify->password = $aux;
                    $userModify->save();
                    return 'La información ha sido actualizada';
                }catch(Exception $e){
                        return 'Lo sieto! Algo ha fallado:'.$e;
                }
            }else{
                return 'La Contraseña Actual no coincide ';
            }
        }
    }
}
