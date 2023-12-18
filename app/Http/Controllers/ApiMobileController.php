<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Information;
use App\Models\Module;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiMobileController extends Controller
{
    // api registrasi
    public function register(Request $request)
    {
        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $nama_lengkap = $request->input('nama_lengkap');
        $nim = $request->input('nim');
        $prodi = $request->input('prodi');
        // $jenis_kelamin = $request->input('jenis_kelamin');

        $cekEmail = User::where('email', $email)->first();
        if ($cekEmail) {
            return response()->json([
                'status' => 400,
                'message' => 'Email Sudah digunakan'
            ],);
        }
        $cekName = User::where('name', $username)->first();
        if ($cekName) {
            return response()->json([
                'status' => 400,
                'message' => 'Username Sudah digunakan'
            ],);
        }

        $cekNamaLengkap = Student::where('nama_lengkap', $nama_lengkap)->first();
        if ($cekNamaLengkap) {
            return response()->json([
                'status' => 400,
                'message' => 'Nama Sudah digunakan'
            ],);
        }

        $cekNim = Student::where('nim', $nim)->first();
        if ($cekNim) {
            return response()->json([
                'status' => 400,
                'message' => 'NIM Sudah digunakan'
            ],);
        }

        $user = User::create([
            'name' => $username,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'mahasiswa',
        ]);

        $student = Student::create([
            'id_user' => $user->id,
            'nama_lengkap' => $nama_lengkap,
            'nim' => $nim,
            'prodi' => $prodi,
            // 'jenis_kelamin' => $jenis_kelamin,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Registrasi Berhasil'
        ],);
    }

    //api login 
    public function login(Request $request)
    {
        $token = '25d55ad283aa400af464c76d713c07ad';

        // dd($token);
        $headerValue = $request->header('token');

        $email = strip_tags($request->input('email'));
        $password = strip_tags($request->input('password'));

        $user = User::where('email', $email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            $user = Auth::user();
            if ($user) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Login Berhasil',
                    'data' => $user,
                ]);
            } else {
                return response()->json([
                    'status' => 400,
                    'message' => 'Login Gagal, Silahkan Perikasa kembali username dan password anda',
                ]);
            }
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Login Gagal, Silahkan Perikasa kembali username dan password anda',
            ]);
        }
    }

    public function logout(Request $request)
    {

        $token = '25d55ad283aa400af464c76d713c07ad';
        $headerValue = $request->header('token');

        $user = auth()->user();
        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User is not logged in'
            ],);
        }

        if ($headerValue == $token) {
            Auth::logout();
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Logout',
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }


    public function user(Request $request)
    {
        $token = '25d55ad283aa400af464c76d713c07ad';
        $headerValue = $request->header('token');

        if ($headerValue == $token) {

            $user = User::all();

            return response()->json([
                'status' => 200,
                'message' => 'berhasil',
                'data' => $user,
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }

    public function informasi(Request $request)
    {
        $token = '25d55ad283aa400af464c76d713c07ad';
        $headerValue = $request->header('token');

        if ($headerValue == $token) {

            $informasi = Information::orderBy('updated_at', 'ASC')->get();

            $resultData = array();
            foreach ($informasi as $data) {
                $resultData[] = [
                    'id' => $data->id,
                    'judul' => $data->judul,
                    'deskripsi' => $data->deskripsi,
                    'created_at' => $data->created_at,
                    'updated_at' => $data->updated_at,
                ];
            }

            return response()->json([
                'status' => 200,
                'message' => 'berhasil',
                'data' => $resultData,
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }

    public function chapter(Request $request)
    {
        $token = '25d55ad283aa400af464c76d713c07ad';
        $headerValue = $request->header('token');

        if ($headerValue == $token) {

            $chapter = Chapter::orderBy('id', 'DESC')->get();

            return response()->json([
                'status' => 200,
                'message' => 'berhasil',
                'data' => $chapter,
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
    }

    public function modul(Request $request, $id)
    {
        $token = '25d55ad283aa400af464c76d713c07ad';
        $headerValue = $request->header('token');

        if ($headerValue == $token) {
            // $chapter = Chapter::find($id);
            $modul = Module::where('id_chapter', $id)->orderBy('id', 'DESC')->get();

            return response()->json([
                'status' => 200,
                'message' => 'berhasil',
                'data' => $modul,
            ]);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Token Salah',
            ];
            return response()->json(['data' => $data]);
        }
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
