<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$students = Student::all();
        //return view('student.index', compact('students'));
        return view('student.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        $student = Student::create($storeData);
        return redirect('/students')->with('completed', 'Student has been saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /*$data = DB::connection('odbc')->table('AVSREG.VIEWSTUDENTPROFILE')
            ->where('STUDENT_ID', $id)
            ->count();*/

        $data = DB::connection('odbc')->table('AVSREG.VIEWSTUDENTPROFILE')->where('STUDENT_ID', $id)->get();
        $data = $data[0];
        foreach ($data as $key => $value) {
            $tis_arr[$key] = iconv("tis-620", "utf-8", $value);
        }
        /*if ($data != 0) {
            $data = DB::connection('odbc')->table('AVSREG.VIEWSTUDENTPROFILE')->where('STUDENT_ID', $id)->get();
            $data = $data[0];
            foreach ($data as $key => $value) {
                $tis_arr[$key] = iconv("tis-620", "utf-8", $value);

            }
            return \Response::json(['data' => $tis_arr]);

        }else{
            return ['data' => 0];
        }*/

        /*$data = DB::connection('odbc')->table('AVSREG.VIEWAPPLICANTSTUDENT')
            ->where('CITIZENID','=', $request->CITIZENID)
            ->count();
        if ($data != 0) {
            $data = DB::connection('odbc')->table('AVSREG.VIEWAPPLICANTSTUDENT')
                ->where('CITIZENID','=', $request->CITIZENID)
                ->get();
            foreach ($data as $d){
                foreach (collect($d) as $key => $value) {
                    $tis_arr[$key] = iconv("tis-620", "utf-8", $value);
                }
                $resule[] = $tis_arr;
            }
            return collect($resule);
        }else{
            return null;
        }*/

        return view('student.view', ['data' => $tis_arr]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('edit', compact('student'));
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
        $updateData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|numeric',
            'password' => 'required|max:255',
        ]);
        Student::whereId($id)->update($updateData);
        return redirect('/students')->with('completed', 'Student has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect('/students')->with('completed', 'Student has been deleted');
    }
}
