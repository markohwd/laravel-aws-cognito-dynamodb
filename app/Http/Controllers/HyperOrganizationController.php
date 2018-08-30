<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;

use App\HyperOrganization;
use App\HyperOrganizationUser;
use App\HyperCategory;
use App\HyperUser;

class HyperOrganizationController extends Controller
{
    public function getIndex()
    {
        if (Auth::check()) {
        	$hyperorganizations = HyperOrganization::orderBy('name')->get();

            return view('organizations')
            	->with('hyperorganizations', $hyperorganizations);
        }else{
            return "Cannot View";
        } 
    }

    public function new()
    {
        if (Auth::check()) {

            $hypercategories = HyperCategory::all();

            return view('organization.create-organization')
                ->with('hypercategories', $hypercategories);

        }else{
            return "Cannot View";
        }
        
    }


    public function create(Request $request)
    {

        $validator = $request->validate([
                'name' => 'required',
                'email' => 'required|email'
            ], [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required'
            ]);

        $input = $request->all();
        $organization = new HyperOrganization;

        date_default_timezone_set("America/Los_Angeles");
        $datetime = date("Y-m-d H:i:s");

        $id = $this->uuid(); // generate user uuid

        if (Auth::check()) {

            $organization->id = $id;
            $organization->logoUrl = $request->logourl;
            $organization->name = $request->name;
            $organization->plan = $request->plan;
            $organization->type = $request->type;
            $organization->createdAt = date(DATE_ISO8601, strtotime($datetime));
            $organization->slug = str_slug($request->name);
            $organization->email = $request->email;
            $organization->location = $request->location;
            $organization->photoUrl = $request->photourl;
            $organization->bucket = $request->type . ".iamhyper.net";
            $organization->categoryId = $request->category;


            $organization->save();

            redirect()->route('hyper-organizations')->send()
                ->with('message', 'Success! Added new organization');

        }else{
            return "Cannot View";
        }
        
    }

    public function get(Request $request)
    {
        if (Auth::check()) {

            $hyperorganization = HyperOrganization::where('id', $request->id)->first();


            if ($hyperorganization->count()) { 

                $hyperorganizationusers = HyperOrganizationUser::where('organizationId', $request->id)->get();
                $hyperusers = HyperUser::all();
                $hypercategories = HyperCategory::all();

                
                    return view('organization.get-organization')
                        ->with('hyperorganization', $hyperorganization)
                        ->with('hyperorganizationusers', $hyperorganizationusers)
                        ->with('hyperusers', $hyperusers)
                        ->with('hypercategories', $hypercategories)
                        ->with('status', 'Profile updated!');

            }else{

                    redirect()->route('hyper-organizations')->send()
                        ->with('message', 'Organization Not Found' );
                        
            }


        }else{
            return "Cannot View";
        } 
    }


    public function edit(Request $request)
    {

        if (Auth::check()) {

            $hypercategories = HyperCategory::all();
            $hyperorganization = HyperOrganization::where('id', $request->id)->first();

            return view('organization.edit-organization')
                ->with('hypercategories', $hypercategories)
                ->with('hyperorganization', $hyperorganization);

        }else{
            return "Cannot View";
        }

    }


    public function update(Request $request)
    {
        date_default_timezone_set("America/Los_Angeles");

        $validator = $request->validate([
                'name' => 'required',
                'email' => 'required|email'
            ], [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required'
            ]);

        $input = $request->all();
        $organization = HyperOrganization::where('id', $request->id)->first();




        if (Auth::check()) {

            $organization->find($request->id);

            $organization->logoUrl = $request->logourl;
            $organization->name = $request->name;
            $organization->plan = $request->plan;
            $organization->type = $request->type;
            $organization->slug = str_slug($request->name);
            $organization->email = $request->email;
            $organization->location = $request->location;
            $organization->photoUrl = $request->photourl;
            $organization->bucket = $request->type . ".iamhyper.net";
            $organization->categoryId = $request->category;


            $organization->save();



            redirect()->route('hyper-organizations')->send()
                ->with('message', 'Success! Updated ' . $request->name );

        }else{
            return "Cannot View";
        }

    }

    public function delete(Request $request)
    {
        $hyperorganization = HyperOrganization::where('id', $request->id)->first();

            if (Auth::check()) {
                if ($hyperorganization->count()) { 

                    $hyperorganization->find($request->id);
                    $hyperorganization->delete();

                    redirect()->route('hyper-organizations')->send()
                    ->with('message', 'Success! Deleted' . $request->name );

                }else{

                    redirect()->route('hyper-organizations')->send()
                    ->with('message', 'Cant Delete Organization' );
                }

            }else{
                
                return "Cannot View";
            }

    }


    public function uuid()
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