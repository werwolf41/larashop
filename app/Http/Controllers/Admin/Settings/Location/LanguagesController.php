<?php

namespace App\Http\Controllers\Admin\Settings\Location;

use App\Models\Languages;
use App\Http\Requests\CreateLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = Input::get('perPage') ? Input::get('perPage') : 10;
        $search = Input::get('search') ? Input::get('search') : null;
        $sort = Input::get('sort') ? Input::get('sort') : 'name';
        $order = Input::get('order') ? Input::get('order') : 'ask';
        $q = Languages::query();

        if ($search) {
            $q->where('name', 'like', "%{$search}%");
        }

        $q->orderBy($sort, $order);

        $languages = $q->paginate($perPage);

        if ($request->ajax()){
            return Response($languages);
        }
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLanguageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateLanguageRequest $request)
    {
        if ($request->input('primary') && $request->input('active')) {
            $this->setPrimary();
        }

        $language = new Languages();
        $language->fill($request->toArray());

        if (!Languages::where('primary', '=', 1)->count('*') && !$language->primary) {
            $language->primary = 1;
        }

        $language->save();

        return redirect(route('admin.language.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Languages::find($id)->first();
        return view('admin.languages.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language = Languages::find($id);
        return view('admin.languages.update', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLanguageRequest $request, $id)
    {
        $language = Languages::find($id);
        if (is_object($language)) {

            if ($request->input('primary') && $request->input('active')) {
                $this->setPrimary($id);
            }

            $language->fill($request->toArray());

            if (!Languages::where('primary', '=', 1)->count('*') && !$language->primary) {
                $language->primary = 1;
            }

            $language->save();
            return redirect(route('admin.language.index'));
        }

        return false;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Languages::destroy($id);
        return redirect(route('admin.language.index'));
    }

    private function setPrimary($id = '')
    {
        $where = [
            ['primary', '=', 1]
        ];
        if ($id) {
            $where[] = [
                'id', '!=', $id
            ];
        }
        if (Languages::select()->where($where)->count()) {
            $primary = Languages::select()->where($where)->first();
            $primary->primary = 0;
            $primary->save();
        }


        return true;
    }
}
