<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompanionsModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController

{

    public function getInviteeData($rsvp_id){

        $google_map_key = "https://www.google.com/maps/embed/v1/place?q=place_id:ChIJKdlbGeTBlzMRbQxZm8-_ZKQ&key=AIzaSyAc-QXWB4_dbvPDqQU3acosp8InF45vhVs";
        $userModel = model(UserModel::class);
        $getUserDetails = $userModel->where('invite_id', $rsvp_id)->first();
        

        $companionsModel = model(CompanionsModel::class);
        $allUsers = $companionsModel->where('user_id', $getUserDetails->id)->findAll();
        $countCompanions=count($allUsers);
        $data = [

            'google_map_key'=> $google_map_key,
            'companions' => $allUsers,
            'main_invitee' => $getUserDetails->name,
            'companions_count' => $countCompanions

        ];
    
        $dataObject = json_decode(json_encode($data));
        
        return view('pages/home', ['data' => $dataObject]);

    }

    public function confirmRSVP($rsvp_id)

    {  
        $google_map_key = "https://www.google.com/maps/embed/v1/place?q=place_id:ChIJKdlbGeTBlzMRbQxZm8-_ZKQ&key=AIzaSyAc-QXWB4_dbvPDqQU3acosp8InF45vhVs";
        $confirm = null;
        $userModel = model(UserModel::class);
        $allUsers = $userModel->where('invite_id', $rsvp_id)->first();
            
        if($allUsers){
            $dataUpdated = [
                'will_attend' => 'Yes',
            ];
        
            $userModel->update($allUsers->id, $dataUpdated);
            $confirm = 1;
        }else{
            $confirm = 0;
        }

        $data = [

            'google_map_key'=> $google_map_key,
            'confirm' => $confirm

        ];

        $dataObject = json_decode(json_encode($data));
        return view('pages/home', ['data' => $dataObject]);
    }

    public function inviteIDGenerator(){
        // Invite id auto generator
        // $randomNum = rand();
        // $userModel = model(UserModel::class);
        // $allUsers = $userModel->findAll();
    
        // foreach($allUsers as $row){
        //     $userModel->set('invite_id',$randomNum);
        //     $userModel->where('id',$row['id']);
        //     $userModel->update();
        // }

    }
}
