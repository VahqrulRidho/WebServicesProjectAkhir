<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::orderBy('id', 'DESC')->get();
        return view('admin.student.index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'nim' => 'required',
            'prodi' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        $email = $request->input('email');
        $nama_lengkap = $request->input('nama_lengkap');
        $nim = $request->input('nim');
        $prodi = $request->input('prodi');
        $jenis_kelamin = $request->input('jenis_kelamin');

        $user = User::create([
            'name' => $username,
            'email' => $email,
            'role' => 'mahasiswa',
            'password' => Hash::make($password),
        ]);

        Student::create([
            'id_user' => $user->id,
            'nama_lengkap' => $nama_lengkap,
            'nim' => $nim,
            'prodi' => $prodi,
            'jenis_kelamin' => $jenis_kelamin,
            'status' => '1',
        ]);

        return redirect()->route('student.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Student::where('id', $id)->first();
        return view('admin.student.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'nama_lengkap' => 'required',
            'nim' => 'required',
            'prodi' => 'required',
            'jenis_kelamin' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status,
        ];

        Student::where('id', $id)->update($data);

        return redirect()->route('student.index')
            ->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::where('id', $id)->first();

        $user = User::where('id', $student->id_user)->first();

        $user->delete();
        $student->delete();

        return redirect()->route('student.index')
            ->with('success', 'Student deleted successfully');
    }
}
