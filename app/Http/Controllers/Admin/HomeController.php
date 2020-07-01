<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Symfony\Component\HttpFoundation\Response;

use App\Reclamation;
use App\User;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        abort_if(Gate::denies('dashboard_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $totalReclamations = Reclamation::count();
        $user=User::count();
       
        $openReclamations = Reclamation::whereHas('status', function($query) {
            $query->whereName('Open');
        })->count();
        $closedReclamations = Reclamation::whereHas('status', function($query) {
            $query->whereName('Closed');
        })->count();

        $admin=User::whereHas('roles',function($query){
            $query->whereTitle('admin');
        })->count();
        $customer=User::whereHas('roles',function($query){
            $query->whereTitle('customer');
        })->count();

        $responsible=User::whereHas('roles',function($query){
            $query->whereTitle('responsible');
        })->count();
        $jan = User::whereMonth(
            'created_at',
            Carbon::now()->format(1)
        )->count();
        $fev = User::whereMonth(
            'created_at',
            Carbon::now()->format(2)
        )->count();
        $mar = User::whereMonth(
            'created_at',
            Carbon::now()->format(3)
        )->count();
        $apr = User::whereMonth(
            'created_at',
            Carbon::now()->format(4)
        )->count();
        $mai= User::whereMonth(
            'created_at',
            Carbon::now()->format(5)
        )->count();
        $jui = User::whereMonth(
            'created_at',
            Carbon::now()->format(6)
        )->count();
        $juie = User::whereMonth(
            'created_at',
            Carbon::now()->format(7)
        )->count();
        $aou = User::whereMonth(
            'created_at',
            Carbon::now()->format(8)
        )->count();
        $sep = User::whereMonth(
            'created_at',
            Carbon::now()->format(9)
        )->count();
        $oct = User::whereMonth(
            'created_at',
            Carbon::now()->format(10)
        )->count();
        $nou = User::whereMonth(
            'created_at',
            Carbon::now()->format(11)
        )->count();
        $dec = User::whereMonth(
            'created_at',
            Carbon::now()->format(12)
        )->count();


       
    
 
   $users=DB::table('users')->select(DB::raw('COUNT(*) as number'))->get();
     



        return view('home',compact('totalReclamations','user','openReclamations', 'closedReclamations','users','customer','responsible','admin','jan','fev','mar','apr','mai','jui','juie','aou','sep','oct','nou','dec')); 
    }
}
