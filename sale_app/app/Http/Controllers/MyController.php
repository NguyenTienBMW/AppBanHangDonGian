<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class mycontroller extends Controller
{
    public function getsanpham(){
        $data = DB::table('sanpham')->orderBy('id','desc')
        ->limit(10)->get();
        if($data){
            return $data;
        }
    }
  
    
    public function getloaisanpham(){
        $data = DB::table('loaisanpham')->get();
        if($data){
            return $data;
        }
    }
    public function getlaptop(Request $request){
        $id = $request->id;

        $data = DB::table('sanpham')->where('idsanpham',$id)->get();
        if($data){
            return $data;
        }
    }
   
    public function donhang(Request $request){
       $array = $request->json;
       $decoded = json_decode($array,true);
       $mahoadon = DB::table('donhang')->orderBy('id','desc')->first();
       $madonhang = $mahoadon->id;
       foreach ($decoded as $value) {
        $masanpham = $value['masanpham'];
        $tensanpham = $value['tensanpham'];
        $giasanpham = $value['giasanpham'];
        $soluongsanpham = $value['soluongsanpham'];
        $data = DB::table('chitietdonhang')->insert([
            ['madonhang'=>$madonhang,'masanpham'=>$masanpham,'tensanpham'=>$tensanpham,'soluongsanpham'=>$soluongsanpham,'giasanpham'=>$giasanpham]
        ]);
    }

    return response([
        'status'=>true
    ]);

}
     public function thongtinkhachhang(Request $request)
     {
         $tenkhachhang = $request->tenkhachhang;
         $sodienthoai = $request->sodienthoai;
         $email = $request->email;
        //  $diachi = $request->diachi; 
         if(strlen($tenkhachhang)>0 && strlen($sodienthoai)>0 && strlen($email)>0)
         {
             $data = DB::table('donhang')->insert([
                 ['tenkhachhang'=>$tenkhachhang,'sodienthoai'=>$sodienthoai,'email'=>$email]
             ]);
         }
     }
    
    public function register(Request $request){
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $address = $request->address;

        $data = DB::table('users')->insert([
            ['username'=>$username, 'email'=>$email, 'password'=>$password, 'address'=>$address]
            ]);

            return response([
                'status' =>true
            ]);
    }
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        // $email = "nvantien222@gmail.com";
        // $password = "123";
        $data = DB::table('users')->where('email', $email)->where('password', $password)->get();
        if(strlen($data) > 2) {
            return response()->json([
                'status' =>true,
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'status' =>false
            ]);
        }
    }
    public function search(Request $request){
        $search = $request->search;
        // $search = "Vivo";
        $data = DB::table('sanpham')->where('tensanpham','like','%'.$search.'%')->get();
        if(count($data) > 0){
            return response()->json([
                'status' =>true,
                'data' =>$data
            ]);
        }else{
            return response()->json([
                'status'=>false
            ]);
        }
        
    }
    public function getthongtin(Request $request)
    {
        $ten = $request->ten;
        $sodienthoai = $request->sodienthoai;
        $email = $request->email;
        $noidung = $request->noidung;
       //  $diachi = $request->diachi; 
        if(strlen($ten)>0 && strlen($sodienthoai)>0 && strlen($email)>0 && strlen($noidung)>0)
        {
            $data = DB::table('lienhe')->insert([
                ['ten'=>$ten,'sodienthoai'=>$sodienthoai,'email'=>$email,'noidung'=>$noidung]
            ]);
        }
    }

}