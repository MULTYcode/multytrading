<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\dt_auth;

class settingCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function userlist()
    {
        $res = DB::connection('mysql')->select("select id,name,email, info, 
        case when activated = 1 then 'ACTIVE' else 'PENDING' end as activated, 
        case when verified = 1 then 'YES' else 'NO' end as verified 
        from users");
        return view('userlist', ['res' => $res]);
    }

    public function deactivateuser($jenis, $email)
    {
        if ($jenis == 1) {
            User::where('email', '=', $email)->update(['activated' => 1]);
        } else {
            User::where('email', '=', $email)->update(['activated' => 0]);
        }
        return redirect(route('userlist'));
        //return redirect()->back();
        //return redirect()->action('Auth\settingCtrl@userlist');

    }

    public function usermodule()
    {
        $res = DB::connection('mysql')->select("select * from dt_routes");
        return view('usermodule', ['res' => $res]);
    }

    public function userrole($email, $userid)
    {
        $res = DB::connection('mysql')->select("select id, main as menu, description,rt.route_id as ada
                                                from dt_routes 
                                                left join dt_auth rt on dt_routes.id = rt.route_id and rt.user_id=68
                                                order by id");

        $role = DB::connection('mysql')->select("select users.id, dt_routes.id, dt_routes.main as menu, dt_routes.description from dt_routes
                                                left join dt_auth on dt_auth.route_id = dt_routes.id
                                                join users on dt_auth.user_id = users.id 
                                                where users.email = '" . $email . "'");

        return view('userrole', ['res' => $res, 'role' => $role, 'email' => $email, 'userid' => $userid]);
    }

    public function addmodule($email, $roleid, $userid)
    {
        $dtauth = new dt_auth;
        $dtauth->user_id = $userid;
        $dtauth->route_id = $roleid;
        $dtauth->save();

        return redirect(route('userrole', ['email' => $email, 'userid' => $userid]));
    }

    public function removemodule($email, $userid, $roleid)
    {
        //$hapus = dt_auth::find($userid);
        //$hapus->delete();
        dt_auth::where('user_id', $userid)->where('route_id', $roleid)->delete();
        return redirect(route('userrole', ['email' => $email, 'userid' => $userid]));
    }
}