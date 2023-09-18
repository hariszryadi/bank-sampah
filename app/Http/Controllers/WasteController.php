<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\Waste;

class WasteController extends Controller
{
    /**
     * Folder views
     */
    protected $_view = 'waste.';

    /**
     * Route index
     */
    protected $_route = 'waste.index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(Waste::with('category')->orderBy('id')->get())
                ->addColumn('action', function($data){
                    return '<div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="'.route('waste.edit', $data->id).'" class="dropdown-item"><i class="icon-pencil5 text-primary"></i> Edit</a>
                                        <a href="javascript:void(0)" id="delete" data-id="'.$data->id.'" class="dropdown-item"><i class="icon-bin text-danger"></i> Hapus</a>
                                    </div>
                                </div>
                            </div>';
                })
                ->make(true);
        }

        return view($this->_view.'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('id')->get();
        return view($this->_view.'form', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'name' => 'required|max:50',
            'description' => 'required',
            'photo' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required|numeric|gt:0'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('waste', ['disk' => 'public']);
        }

        Waste::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'photo' => $path
        ]);

        return redirect()->route($this->_route)->with('success', 'Data sampah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $waste = Waste::find($id);
        $category = Category::orderBy('id')->get();
        return view($this->_view.'form', compact('waste', 'category'));
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
            'name' => 'required|max:50',
        ]);

        $waste = Waste::find($id);
        if ($request->hasFile('photo')) {
            $path = \storage_path('app/public/' . $waste->photo);
            File::delete($path);

            $path = $request->file('photo')->store('waste', ['disk' => 'public']);
            $data['photo'] = $path;
        }
        $data['category_id'] = $request->category;
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $data['price'] = $request->price;
        $waste->update($data);

        return redirect()->route($this->_route)->with('success', 'Data sampah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $waste = Waste::findOrFail($id);
        $path = \storage_path('app/public/' . $waste->photo);
        File::delete($path);
        $waste->delete();

        return response()->json(['success' => 'Data sampah berhasil dihapus']);
    }
}
