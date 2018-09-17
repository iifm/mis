<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ImportExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExport()
    {
        return view('inventory_management.importExport');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request)
    {
            if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['title'] = $row['title'];
                    $data['description'] = $row['description'];

                    if(!empty($data)) {
                        DB::table('post')->insert($data);
                    }
                }
            });
        }

        Session::put('success', 'Youe file successfully import in database!!!');

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
