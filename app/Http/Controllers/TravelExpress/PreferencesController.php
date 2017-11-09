<?php

namespace App\Http\Controllers\TravelExpress;

use App\Model\Preference;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Auth;

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

        $preference = Preference::findOrFail($id);

        if (! $preference->user_id === Auth::user()->id) {
            return redirect('/preferences');
        }

        $fields = ['smoker_accepted', 'pet_accepted', 'radio_accepted', 'chat_accepted'];
        
        // Since the checkboxes unchecked are not sent via post, we add them into the inputs with value 0
        $inputs = $request->only($fields);
        foreach ($fields as $field) {
            if (empty($inputs[$field])) {
                $inputs[$field] = 0;
            }
        }

        $preference->fill($inputs)->save();

        $request->session()->flash('status_success', Lang::get('messages.flash_preferences_updated'));

        return redirect('/preferences');
    }
}
