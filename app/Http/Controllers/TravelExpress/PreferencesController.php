<?php

namespace App\Http\Controllers\TravelExpress;

use App\Model\Preference;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PreferencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->indexUser(Auth::user());
    }

    public function indexUser(User $user) {
        $preference = $user->getPreference();
        return View('pages.preferences.index', compact('user', 'preference'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $preference = $user->getPreference();
        return View('pages.preferences.edit', compact('user', 'preference'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
                'smoker_accepted' => 'boolean',
                'pet_accepted' => 'boolean',
                'radio_accepted' => 'boolean',
                'chat_accepted' => 'boolean',
            ]);

        $input = $request->all();

        $preference = Preference::findOrFail($id);

        $preference->fill($input)->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_preferences_updated'));
        return redirect('/preferences');
    }
}
