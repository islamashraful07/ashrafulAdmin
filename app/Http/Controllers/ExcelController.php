<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class ExcelController extends Controller
{
   
    function excel()
    {
        /*$user_data=DB::table('users')->get()->toArray();
        //return $user_data;
        $user_array[]=array('id','name','email','type','photo','remember_token','created_at','updated_at');
        foreach($user_data as $user)
        {
            $user_array[]=array(
                'id'=>$user->id,
                'name'=>$user->name,
                'email'=>$user->email,
                
                'type'=>$user->type,
                'photo'=>$user->photo,
                'remember_token'=>$user->remember_token,
                'created_at'=>$user->created_at,
                'updated_at'=>$user->updated_at
            );
        }
        Excel::download('user data',function($excel)use($user_array)
        {
            $excel->setTitle('user data');
            $excel->sheet('user data',function($sheet)use($user_array)
                {
                    $sheet->fromArray($user_array,null,'A1',false,false);
            });
            return Excel::download(new PdfExport, 'user data.xlsx');
        });*/
        return Excel::download(new UsersExport, 'users.xlsx');
        
    }
    public function import(Request $request)
    {
        return response($request);
        //$uploadFile=$request->file;
        //return response(['fileextension'=>$uploadFile->extenstion]);
    }
  



}
