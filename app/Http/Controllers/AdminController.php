<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function main()
    {
  
        return view('main');
    }

    public function login()
    {
  
        return view('login');
    }
    
    public function index()
    {
  
        return view('admin/dashboard');
    }

    public function barangay()
    {
        return view('admin/web_barangay/barangay');
    }

    public function addBarangay()
    {
        return view('admin/web_barangay/addBarangay');
    }

    public function addHistory()
    {
        return view('admin/web_history/addHistory');
    }

    public function editHistory()
    {
        return view('admin/web_history/editHistory');
    }

    public function history()
    {
        return view('admin/web_history/history');
    }

    public function viewHistory()
    {
        return view('admin/web_history/viewHistory');
    }

    public function addInfant()
    {
        return view('admin/web_infant/addInfant');
    }

    public function editInfant()
    {
        return view('admin/web_infant/editInfant');
    }

    public function infant()
    {
        return view('admin/web_infant/infant');
    }

    public function viewInfant()
    {
        return view('admin/web_infant/viewInfant');
    }

    public function addUser()
    {
        return view('admin/web_user/addUser');
    }

    public function editUser()
    {
        return view('admin/web_user/editUser');
    }

    public function user()
    {
        return view('admin/web_user/user');
    }

    public function addVaccine()
    {
        return view('admin/web_vaccine/addVaccine');
    }

    public function editVaccine()
    {
        return view('admin/web_vaccine/editVaccine');
    }

    public function vaccine()
    {
        return view('admin/web_vaccine/vaccine');
    }

    public function viewVaccine()
    {
        return view('admin/web_vaccine/viewVaccine');
    }

    public function upcoming()
    {
        return view('admin/upcoming');
    }

    public function missed()
    {
        return view('admin/missed');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'animal_type' => 'required',
            'owner' => 'required',
            'address' => 'required'
        ]);
        
        Pet::create($request->all());
   
        return redirect()->route('pets.index')
                        ->with('success','Pet created successfully.');
    }

    public function show(Pet $pet)
    {
        return view('pets.show',compact('pet'));
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit',compact('pet'));
    }


    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => 'required',
            'animal_type' => 'required',
            'owner' => 'required',
            'address' => 'required'
        ]);
  
        $pet->update($request->all());

        return redirect()->route('pets.index')
                        ->with('success','Pet updated successfully');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();
  
        return redirect()->route('pets.index')
                        ->with('success','Pets deleted successfully');
    }
}
