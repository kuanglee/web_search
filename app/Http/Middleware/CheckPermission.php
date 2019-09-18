<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permisson = null)
    {
        $listRoleUser = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('users.id', auth()->id())->select('roles.*')->get()->pluck('id')->toArray();
//        dd($listRoleUser);

        $listRoleOfUser = DB::table('roles')
            ->join('role_permission' , 'role_permission.role_id' , '=' , 'roles.id')
            ->join('permissions' , 'permissions.id' , '=' , 'role_permission.permission_id')
            ->whereIn('roles.id' , $listRoleUser)
            ->get()->pluck('id')->unique();
        $checkPermission = Permission::where('name' , $permisson)->value('id');
        if ($listRoleOfUser->contains($checkPermission)){
            return $next($request);
        }
        return abort(403);

        dd($checkPermission);
        dd($listRoleOfUser);

    }
}
