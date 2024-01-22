<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function main()
    {
  
        return view('main');
    }
    
    public function indexUser()
    {
  
        return view('user.dashboard');
    }

    public function addHistoryUser()
    {
        return view('user.web_history.addHistory');
    }

    public function editHistoryUser()
    {
        return view('user.web_history.editHistory');
    }

    public function historyUser()
    {
        return view('user.web_history.history');
    }

    public function viewHistoryUser()
    {
        return view('user.web_history.viewHistory');
    }

    public function addInfantUser()
    {
        return view('user.web_infant.addInfant');
    }

    public function editInfantUser()
    {
        return view('user.web_infant.editInfant');
    }

    public function infantUser()
    {
        return view('user.web_infant.infant');
    }

    public function viewInfantUser()
    {
        return view('user.web_infant.viewInfant');
    }


    public function upcomingUser()
    {
        return view('user.upcoming');
    }

    public function missedUser()
    {
        return view('user.missed');
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
