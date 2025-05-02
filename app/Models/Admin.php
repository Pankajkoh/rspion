<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\AdminRole;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function deleteStaff($staff_id){
        // check the current user authorization to make this action
       // @TODO
        // Gate::authorize('delete', $this);

        $staff = $this->find($staff_id);
        if($staff){
            if($staff->is_admin === 1){
                return ['status'=>'error', 'message' => 'Admin user can not be deleted.'];
            } else {
                try {
                    $staff->delete();
                    return ['status'=>'success', 'message' => 'Staff '.$staff->first_name .' '.$staff->last_name.' has been deleted successfully.'];
                } catch (Exception $e) {
                    //return ['message'=>$e->getMessage()];
                    return ['status'=>'success', 'message' => 'Something went wrong, please try again. Message: '.$e->getMessage()];
                }
            }
        }
    }

    public function adminRole(){
        return $this->hasOne(AdminRole::class);
    }
}
