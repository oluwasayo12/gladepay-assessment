<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAdminRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{    
    /**
     * createAdminAndAssignRole
     *
     * @param  mixed $request
     * @return void
     */
    public function createAdmin(CreateAdminRequest $request)
    {
        try{
           return DB::transaction(function () use($request) {
                $create_admin_record = User::create($request->all());
                if($create_admin_record)
                {
                    //assign user created to only admin role
                    $role_details = Role::where('name', '=', User::DEFAULT_ADMIN_ROLE)->firstOrFail();
                    $create_admin_record->assignRole($role_details);
                }
                DB::commit();
                return $this->successResponse('Admin user created.');
            });
        }catch(Exception $e)
        {
            DB::rollBack();
            return $this->badRequestAlert("Unable to create User.");
        }
    }
    
    /**
     * listAllAdmin
     *
     * @return void
     */
    public function listAllAdmin()
    {
        $all_users_with_all_their_roles = User::with('roles')->get();
        return $this->successResponse('Admin users.', $all_users_with_all_their_roles);
    }  


    public function deleteAdminAccount(int $adminAccount)
    {
        $adminRecord = User::find($adminAccount);

        if(!$adminRecord)
        {
            return $this->badRequestAlert('Invalid account id provided');
        }

        if($adminRecord->email == User::DEFAULT_SUPER_USER_EMAIL)
        {
            return $this->badRequestAlert('You cannot delete a super user');
        }

        if(!$adminRecord->delete())
        {
            return $this->badRequestAlert('Unable to delete admin record');
        }

        return $this->successResponse('Admin record deleted successfully'); 
    }


    public static function assignRoles($role, $user) {
        $role_details = Role::where('name', '=', $role)->firstOrFail();
        $user->assignRole($role_details);
    }

}
