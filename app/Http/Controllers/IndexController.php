<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterClass;

use App\Models\Category;

use App\Models\Users;

use App\Models\Leader;

use App\Models\User_MC;


use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function enter() 
    {
        return view('entry',['err'=>'','access'=>'']);
    }
    public function login(Request $request){
        $this->validate($request,['login'=>'required', 'password' => 'required',]);
        $data=$request->all();
        $countu=count(Users::select('Users.email_user')->where('Users.email_user','=', $data['login'])->get());
        $countl=count(Leader::select('Leader.login_leader')->where('Leader.login_leader','=', $data['login'])->get());
        if ($countl!=0) {
            $countlp=count(Leader::select('Leader.login_leader')->where('Leader.login_leader','=', $data['login'])->where('Leader.password_leader','=', $data['password'])->get());
            if ($countlp!=0) {    
                $admin=1;
                request()->session()->put('admin_status', $admin);
                $id_user=Leader::select('Leader.id_leader')->where('Leader.login_leader','=', $data['login'])->first();
                $id_user=$id_user->id_leader;
                request()->session()->put('id_user', $id_user);
                $leader=Leader::select('Leader.id_leader', 'id_leader',	'first_name_leader','second_name_leader','patronymic_leader','foto_leader')->where('Leader.login_leader','=', $data['login'])->first();
                $masterclass=MasterClass::select('id_MC','name_MC','description_MC','date_MC', 'time_MC', 'count_people_MC','cost_MC','id_category','id_leader')->where('id_leader','=',$id_user)->get();
                $part=User_MC::select('Users.id_user','FIO_user','email_user','telephone_user','id_MC')->join('Users','Users.id_user','=','User_MC.id_user')->get();
                $categories=Category::select('id_category','name_category')->get();
                return view('cabinet',compact('masterclass','leader','categories','admin','id_user','part'));
            }
            else return view('entry', ['err'=>'Вы ввели неверный пароль','access'=>'']);
        }
        elseif ($countu!=0) {
            $countlp=count(Users::select('Users.email_user')->where('Users.email_user','=', $data['login'])->where('Users.password_user','=', $data['password'])->get());
            if ($countlp!=0) {    
                $admin=0;
                request()->session()->put('admin_status', $admin);
                $id_user=Users::select('Users.id_user')->where('Users.email_user','=', $data['login'])->first();
                $id_user=$id_user->id_user;
                request()->session()->put('id_user', $id_user);
                $categories=Category::select('id_category','name_category')->get();
                return view('category',compact('categories','admin','id_user'));
            }
            else return view('entry', ['err'=>'Вы ввели неверный пароль','access'=>'']);
        }
        else return view('entry', ['err'=>'Вы ввели неверный логин','access'=>'']);
    }
    
    public function exit() {
        request()->session()->forget('id_user');
        request()->session()->forget('admin_status');
        return view('entry',['err'=>'','access'=>'']);

    }

    public function registration()
    {
        return view('form__reg',['err'=>'','access'=>'']);
    }
    public function reg(Request $request)
    {
        $data=$request->all();
        $user=new Users;
        $userl=count(Users::select('Users.email_user')->where('Users.email_user','=', $data['email_user'])->get());
        $userm=count(Users::select('Users.telephone_user')->where('Users.telephone_user','=', $data['telephone_user'])->get());
		$rules=
		[
			'FIO' => 'required|regex:/[^А-я]/u|max:100',
			'email_user' => 'required|unique:users|regex:/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i', 
			'telephone_user' => 'required|unique:users',
			'password_user' => 'required',
		];

		$messages=
		[
			'required' => 'Данное поле является обязательным',
			'regex'=>'Введите данные в нужном формате',
			'login.unique'=>'Пользователь с таким логином уже существует',

		];
		$this->validate($request, $rules,$messages);		     
        	$data=$request->all();
           	 	$user->FIO_user=$data['FIO'];
				$user->email_user=$data['email_user'];
				$user->telephone_user=$data['telephone_user'];
           		$user->password_user=$data['password_user'];
            	$user->save();
        return view('entry',['err'=>'','access'=>'Регистрация прошла успешно'] );
    }
    public function show_category() 
    {   
        if (request()->session()->has('admin_status')) {
            $admin=intval(request()->session()->get('admin_status'));
            $id_user=(request()->session()->get('id_user'));
            $categories=Category::select('id_category','name_category')->get();
            return view('category',compact('categories','id_user','admin'));
        }
        else {   
            $categories=Category::select('id_category','name_category')->get();
            return view('category',compact('categories'));
        }
    }
    public function show_info_category($id) 
    {
        if (request()->session()->has('admin_status')) {
            $admin=intval(request()->session()->get('admin_status'));
            $id_user=(request()->session()->get('id_user'));
            $masterclass=MasterClass::select('first_name_leader','second_name_leader','patronymic_leader','foto_leader','id_MC','name_MC','description_MC','date_MC', 'time_MC', 'count_people_MC','cost_MC','id_category','Leader.id_leader')->join('Leader','MasterClass.id_leader','=','Leader.id_leader')->where('id_category','=',$id)->get();
            $categories=Category::select('id_category','name_category')->get();
            $content=Category::select('id_category','name_category','description1','description2','description3','description4','foto_category')->where('id_category','=',$id)->first();
            return view('category',compact('masterclass','categories','content','admin','id_user'));
        }
        else {   
            $masterclass=MasterClass::select('first_name_leader','second_name_leader','patronymic_leader','foto_leader','id_MC','name_MC','description_MC','date_MC', 'time_MC', 'count_people_MC','cost_MC','id_category','Leader.id_leader')->join('Leader','MasterClass.id_leader','=','Leader.id_leader')->where('id_category','=',$id)->get();
            $categories=Category::select('id_category','name_category')->get();
            $content=Category::select('id_category','name_category','description1','description2','description3','description4','foto_category')->where('id_category','=',$id)->first();
            return view('category',compact('masterclass','categories','content'));
        }
    }
    public function add() {
        if (request()->session()->get('admin_status')==1) {
            $categories=Category::select('id_category','name_category')->get();
            return view('form__master-class',compact('categories'));
        }
    }
    public function add_content(Request $request){
        
        $this->validate($request,['id_category' => 'required',
        'name_MC' => 'required', 'description_MC' => 'required',
        'date_MC' => 'required', 'time_MC' => 'required',
        'count_people_MC' => 'required','cost_MC' => 'required']);
        $admin=intval(request()->session()->get('admin_status'));
        $id_user=(request()->session()->get('id_user'));
        $data=$request->all();
        $check=count(MasterClass::select('id_MC')->where('date_MC','=',$data['date_MC'])->where('time_MC','=',$data['time_MC'])->get());
        if ($check==0) {
        $MC=new MasterClass;
        $MC->id_category=$data['id_category'];
        $MC->name_MC=$data['name_MC'];
        $MC->description_MC=$data['description_MC'];
        $MC->count_people_MC=$data['count_people_MC'];
        $MC->date_MC=$data['date_MC'];
        $MC->time_MC=$data['time_MC'];
        $MC->cost_MC=$data['cost_MC'];
        $MC->id_leader=$id_user;
        $MC->save();
        $part=User_MC::select('Users.id_user','FIO_user','email_user','telephone_user','id_MC')->join('Users','Users.id_user','=','User_MC.id_user')->get();
        $leader=Leader::select('Leader.id_leader', 'id_leader',	'first_name_leader','second_name_leader','patronymic_leader','foto_leader')->where('Leader.id_leader','=', $id_user)->first();
        $masterclass=MasterClass::select('id_MC','name_MC','description_MC','date_MC', 'time_MC', 'count_people_MC','cost_MC','id_category','id_leader')->where('id_leader','=',$id_user)->get();
        $categories=Category::select('id_category','name_category')->get();
        return view('cabinet',compact('masterclass','leader','categories','part','admin','id_user'));
        }
        else {
            $message='Данное время/дата заняты.';
            $categories=Category::select('id_category','name_category')->get();
            return view('form__master-class',compact('categories','message'));
        }
    }
    public function show_cabinet() {
        if (request()->session()->get('admin_status')==1) {
            $admin=intval(request()->session()->get('admin_status'));
        $id_user=(request()->session()->get('id_user'));
            $leader=Leader::select('Leader.id_leader', 'id_leader',	'first_name_leader','second_name_leader','patronymic_leader','foto_leader')->where('Leader.id_leader','=', $id_user)->first();
            $masterclass=MasterClass::select('id_MC','name_MC','description_MC','date_MC', 'time_MC', 'count_people_MC','cost_MC','id_category','id_leader')->where('id_leader','=',$id_user)->get();
            $part=User_MC::select('Users.id_user','FIO_user','email_user','telephone_user','id_MC')->join('Users','Users.id_user','=','User_MC.id_user')->get();
            $categories=Category::select('id_category','name_category')->get();
            return view('cabinet',compact('masterclass','leader','categories','admin','id_user','part'));
        }
        elseif (request()->session()->get('admin_status')==0) {
            $admin=intval(request()->session()->get('admin_status'));
            $id_user=(request()->session()->get('id_user'));
            $user=Users::select('Users.id_user', 'FIO_user')->where('Users.id_user','=', $id_user)->first();
            $masterclass=MasterClass::select('MasterClass.id_MC','name_MC','description_MC','date_MC', 'time_MC', 'count_people_MC','cost_MC','id_category','id_leader')->join('User_MC','User_MC.id_MC','=','MasterClass.id_MC')->where('id_user','=',$id_user)->get();
            $categories=Category::select('id_category','name_category')->get();
            return view('cabinet',compact('masterclass','user','categories','admin','id_user'));
        }
    }
    public function change($id){
        if (request()->session()->get('admin_status')==1) {
            $admin=intval(request()->session()->get('admin_status'));
            $id_user=(request()->session()->get('id_user'));
            $mc=MasterClass::select('id_MC','name_MC','description_MC','date_MC', 'time_MC', 'count_people_MC','cost_MC','id_category','id_leader')->where('id_MC','=',$id)->first();
            return view('change-form',compact('mc','admin','id_user'));
        }
    }
    
    public function change_content(Request $request){
        $this->validate($request,[
        'description_MC' => 'required', 'cost_MC' => 'required']);
        $data=$request->all();
        $admin=intval(request()->session()->get('admin_status'));
        $id_user=(request()->session()->get('id_user'));
            DB::table('MasterClass')
            ->where('id_MC', $data['id_MC'])
            ->update(['description_MC' => $data['description_MC'],
            'cost_MC' => $data['cost_MC']]);
            $admin=intval(request()->session()->get('admin_status'));
            $id_user=(request()->session()->get('id_user'));
                $leader=Leader::select('Leader.id_leader', 'id_leader',	'first_name_leader','second_name_leader','patronymic_leader','foto_leader')->where('Leader.id_leader','=', $id_user)->first();
                $masterclass=MasterClass::select('id_MC','name_MC','description_MC','date_MC', 'time_MC', 'count_people_MC','cost_MC','id_category','id_leader')->where('id_leader','=',$id_user)->get();
                $categories=Category::select('id_category','name_category')->get();
                return view('cabinet',compact('masterclass','leader','categories','admin','id_user'));
    }
    public function confirmation($id){
        if (request()->session()->get('admin_status')==0) {
            $admin=intval(request()->session()->get('admin_status'));
            $id_user=(request()->session()->get('id_user'));
            $check=count(User_MC::select('id_user_mc')->where('id_user','=',$id_user)->where('id_MC','=',$id)->get());
            if ($check==0) {
            $user=Users::select('FIO_user')->where('id_user','=',$id_user)->first();
            $mc=MasterClass::select('first_name_leader','second_name_leader','patronymic_leader','id_MC','name_MC','description_MC','date_MC', 'time_MC', 'count_people_MC','cost_MC','MasterClass.id_category','name_category','MasterClass.id_leader')->join('Category','MasterClass.id_category','=','Category.id_category')->join('Leader','MasterClass.id_leader','=','Leader.id_leader')->where('id_MC','=',$id)->first();
            $kolvo=count(User_MC::select('id_user_mc')->where('id_MC','=',$id)->get());
            $count_people=(MasterClass::select('count_people_MC')->where('id_MC','=',$id)->first())->count_people_MC;
            if ($kolvo<$count_people){
                return view('confirmation',compact('mc','user','admin','id_user'));
            }
            else {
                $message='Свободных мест на данный мастер-класс нет!';
                $categories=Category::select('id_category','name_category')->get();
                return view('category',compact('categories','id_user','admin','message'));
            }
            }
            else {
                $message='Вы уже записаны на данный мастер-класс!';
                $categories=Category::select('id_category','name_category')->get();
                return view('category',compact('categories','id_user','admin','message'));
            }
        }
    }
    public function confirmation_content(Request $request){
        $data=$request->all();
        $admin=intval(request()->session()->get('admin_status'));
        $id_user=(request()->session()->get('id_user'));
        $UMC=new User_MC;
        $UMC->id_MC=$data['id_MC'];
        $UMC->id_user=$id_user;
        $UMC->save();
        $message='Вы успешно записаны на мастер класс!';
        $categories=Category::select('id_category','name_category')->get();
        return view('category',compact('categories','id_user','admin','message'));
    }
}
