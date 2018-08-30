<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\HyperUser;
use App\HyperOrganization;
use App\HyperOrganizationUser;


class HyperUserController extends Controller
{
    //

    public function getIndex()
    {
        if (Auth::check()) {
        	$hyperusers = HyperUser::
            ecorate(function (RawDynamoDbQuery $raw) {
        // desc order
            $raw->query['ScanIndexForward'] = false;
        })->all();

            //return $hyperusers;

            return view('users')
            ->with('hyperusers', $hyperusers);

        }else{
            return "Cannot View";
        } 
    }

    public function new()
    {
        if (Auth::check()) {

            $hyperorganizations = HyperOrganization::sortByDesc('name')->get();

            return view('user.create-user')
                ->with('hyperorganizations', $hyperorganizations);

        }else{
            return "Cannot View";
        }
        
    }


    public function create(Request $request)
    {

        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'password.required' => 'Password is required'
        ]);


        $input = $request->all();

        if (Auth::check()) {
 
            //return $input;

            $organizationuser = new HyperOrganizationUser;
            $user = new HyperUser;

            date_default_timezone_set("America/Los_Angeles");
            $datetime = date("Y-m-d H:i:s");

            $id = $this->uuid(); // generate user uuid

        // Save data to IAM_organizations table in DynamoDB (Which is a pivot table)
            $organizationuser->userId = $id;
            $organizationuser->organizationId = $request->organization;
            $organizationuser->role = $request->role;
            $organizationuser->createdAt = date(DATE_ISO8601, strtotime($datetime));
            
            $organizationuser->save();


        // Save data to IAM_users table in DynamoDB
            $user->id = $id;
            $user->authProvider = 'hyper';
            $user->createdAt = date(DATE_ISO8601, strtotime($datetime));
            $user->email = $request->email;
            $user->name = $request->name;
            $user->passwordHash = $request->password;
            $user->photoUrl = $request->photourl;
            $user->googleAuthCode = $request->googleauthcode;
            $user->googleId = $request->googleid;
            $user->familyName = $request->familyname;
            $user->givenName = $request->givenname;
            
            $user->save();

            redirect()->route('hyper-users')->send()
                ->with('message', 'Success! Added new user');


        }else{
            return "Cannot View";
        }
        
    }

    public function get(Request $request)
    {
        if (Auth::check()) {

            $hyperuser = HyperUser::where('id', $request->id)->first();

            if ($hyperuser->count()) { 

                $hyperorganizationuser = HyperOrganizationUser::where('userId', $request->id)->first();
                //$organization = HyperOrganizationUser::where('id', $organizationuser->organizationId)->first();

                    return view('user.get-user')
                        ->with('hyperuser', $hyperuser)
                        ->with('hyperorganizationuser', $hyperorganizationuser)
                        ->with('status', 'Profile updated!');
                        //->with('hyperorganization', $hyperorganization);

            }else{

                    return view('users')
                        ->with('hyperuser', $hyperuser)
                        ->with('hyperorganizationuser', $hyperorganizationuser);
                        //->with('hyperorganization', $hyperorganization);


            }


        }else{
            return "Cannot View";
        } 
    }


    public function edit(Request $request)
    {

        if (Auth::check()) {

            $hyperuser = HyperUser::where('id', $request->id)->first();
            $hyperorganizations = HyperOrganization::all();
            $hyperorganizationuser = HyperOrganizationUser::where('userId', $request->id)->first();

            return view('user.edit-user')
                ->with('hyperuser', $hyperuser)
                ->with('hyperorganizations', $hyperorganizations)
                ->with('hyperorganizationuser', $hyperorganizationuser);

        }else{
            return "Cannot View";
        }

    }


    public function update(Request $request)
    {

        $validator = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
            ], [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required'
            ]);

        $input = $request->all();
        $user = HyperUser::where('id', $request->id)->first();

        if (Auth::check()) {

            $user->find($request->id);

        // Update data to IAM_users table in DynamoDB 
            $user->authProvider = 'hyper';
            $user->email = $request->email;
            $user->name = $request->name;
            $user->photoUrl = $request->photourl;
            $user->googleAuthCode = $request->googleauthcode;
            $user->googleId = $request->googleid;
            $user->familyName = $request->familyname;
            $user->givenName = $request->givenname;
            
            $user->save();

            redirect()->route('hyper-users')->send()
                ->with('message', 'Success! Added new user');


        }else{
            return "Cannot View";
        }

    }

    public function delete(Request $request)
    {
        $hyperuser = HyperUser::where('id', $request->id)->first();

            if (Auth::check()) {
                if ($hyperuser->count()) { 

                    //$hyperorganizationuser = HyperOrganizationUser::where('userId', $request->id)->first();
                    //$hyperorganizationuser->delete();

                    $hyperuser->find($request->id);
                    $hyperuser->delete();

                    redirect()->route('hyper-users')->send()
                    ->with('message', 'Success! Deleted' . $request->name );

                }else{

                    redirect()->route('hyper-users')->send()
                    ->with('message', 'Cant Delete User' );
                }

            }else{
                
                return "Cannot View";
            }

    }

    public function editPassword(Request $request)
    {

        if (Auth::check()) {

            $hyperuser = HyperUser::where('id', $request->id)->first();

            return view('user.edit-user-password')
                ->with('hyperuser', $hyperuser);

        }else{
            return "Cannot View";
        }

    }


    public function updatePassword(Request $request)
    {

        $validator = $request->validate([
            'password' => 'required|confirmed|',
        ], [
            'password.required' => 'Password is required'
        ]);

        $input = $request->all();
        $user = HyperUser::where('id', $request->id)->first();

        if (Auth::check()) {

            $user->find($request->id);
            $user->passwordHash = $request->password;
            $user->save();

            redirect()->route('hyper-users')->send()
                ->with('message', 'Success! Updated User Password');


        }else{
            return "Cannot View";
        }

    }





    function uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }



}
