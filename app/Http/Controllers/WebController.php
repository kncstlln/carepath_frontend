<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{

    public function main()
    {
  
        return view('main');
    }
    
    public function index()
    {
  
        return view('dashboard');
    }

    public function barangay()
    {
        return view('web_barangay/barangay');
    }

    public function addBarangay()
    {
        return view('web_barangay/addBarangay');
    }

    public function addHistory()
    {
        return view('web_history/addHistory');
    }

    public function editHistory()
    {
        return view('web_history/editHistory');
    }

    public function history()
    {
        return view('web_history/history');
    }

    public function viewHistory()
    {
        return view('web_history/viewHistory');
    }

    public function addInfant()
    {
        return view('web_infant/addInfant');
    }

    public function editInfant()
    {
        return view('web_infant/editInfant');
    }

    public function infant()
    {
        return view('web_infant/infant');
    }

    public function viewInfant()
    {
        return view('web_infant/viewInfant');
    }

    public function addUser()
    {
        return view('web_user/addUser');
    }

    public function editUser()
    {
        return view('web_user/editUser');
    }

    public function user()
    {
        return view('web_user/user');
    }

    public function addVaccine()
    {
        return view('web_vaccine/addVaccine');
    }

    public function editVaccine()
    {
        return view('web_vaccine/editVaccine');
    }

    public function vaccine()
    {
        return view('web_vaccine/vaccine');
    }

    public function viewVaccine()
    {
        return view('web_vaccine/viewVaccine');
    }

    public function upcoming()
    {
        return view('upcoming');
    }

    public function missed()
    {
        return view('missed');
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
