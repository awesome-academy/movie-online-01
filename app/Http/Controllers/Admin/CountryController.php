<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CountryRepository;
use App\Http\Requests\CountryFormRequest;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryReposity = $countryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = $this->countryReposity->getAll();

        return view('backend.country.showcountry', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.country.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryFormRequest $request)
    {
        try {
            $slug = Str::slug($request->get('name'), '-');
            $input = $request->only('name');
            $input['slug'] = $slug;
            $this->countryReposity->create($input);

        } catch (Exception $e) {
            Log::debug($e);
        }

        return redirect()->back()->with('status', trans('message.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = $this->countryReposity->getById($id);

        return view('backend.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CountryFormRequest $request, $id)
    {
        try {
            $dataUpdate = $request->only('name');
            $dataUpdate['slug'] = Str::slug($request->get('name'), '-');
            $result = $this->countryReposity->update($id, $dataUpdate);

            if ($result) {
                return redirect()->back()->with('status', trans('message.edit'));
            }
            
        } catch (Exception $e) {
            Log::error($e);

            return back()->withErrors(__('Fail!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->countryReposity->delete($id);

        return redirect()->back()->with('status', trans('message.delete'));
    }
}
