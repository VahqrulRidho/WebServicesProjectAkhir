<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::orderBy('id', 'DESC')->get();
        return view('admin.module.index', [
            'modules' => $modules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chapters = Chapter::all();
        return view('admin.module.create', [
            'chapters' => $chapters,
        ]);
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
            'modul'      => [
                'required',
                'file',
                'mimes:pdf',
                'max:25048',
                Rule::unique('modules', 'modul'),
            ],
            'judul'     => 'required',
            'id_chapter'     => 'required',
            'deskripsi'     => 'required',
            'video'     => 'required',
        ]);

        $judul = $request->input('judul');
        $chapter = $request->input('id_chapter');
        $deskripsi = $request->input('deskripsi');
        $modul = $request->file('modul');
        $video = $request->input('video');

        if (Module::where('modul', $modul->getClientOriginalName())->exists()) {
            return redirect('/module/create')->withErrors(['Nama modul sudah ada. Pilih nama modul lain.']);
        } else {
            $modul->storeAs('/modul', $modul->getClientOriginalName());

            Module::create([
                'judul' => $judul,
                'id_chapter' => $chapter,
                'deskripsi' => $deskripsi,
                'modul' => $modul->getClientOriginalName(),
                'video' => $video,
            ]);
        }
        return redirect()->route('module.index')
            ->with('success', 'Module created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Module::where('id', $id)->first();
        return view('admin.module.show', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chapters = Chapter::all();
        $data = Module::where('id', $id)->first();
        return view('admin.module.edit', [
            'data' => $data,
            'chapters' => $chapters,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $module = Module::where('id', $id)->first();
        $this->validate($request, [
            'modul'      => [
                'file',
                'mimes:pdf',
                'max:25048',
                Rule::unique('modules', 'modul'),
            ],
            'judul'     => 'required',
            'id_chapter'     => 'required',
            'deskripsi'     => 'required',
            'video'     => 'required',
        ]);

        $judul = $request->input('judul');
        $chapter = $request->input('id_chapter');
        $deskripsi = $request->input('deskripsi');
        $modul = $request->file('modul');
        $video = $request->input('video');


        if ($modul) {
            if (Module::where('modul', $modul->getClientOriginalName())->exists()) {
                return redirect('/module/create')->withErrors(['Nama modul sudah ada. Pilih nama modul lain.']);
            } else {

                // Hapus File Lama
                Storage::delete("modul/{$module->modul}");

                // Simpan File Baru
                $modul->storeAs('/modul', $modul->getClientOriginalName());

                $module->update([
                    'judul' => $judul,
                    'id_chapter' => $chapter,
                    'deskripsi' => $deskripsi,
                    'modul' => $modul->getClientOriginalName(),
                    'video' => $video,
                ]);
            }
        } else {
            $module->update([
                'judul' => $judul,
                'id_chapter' => $chapter,
                'deskripsi' => $deskripsi,
                'video' => $video,
            ]);
        }

        return redirect()->route('module.index')
            ->with('success', 'Module updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modul = Module::find($id);

        // Hapus file dari storage jika ada
        Storage::delete("modul/{$modul->modul}");

        // Hapus modul dari database
        $modul->delete();

        return redirect()->route('module.index')
            ->with('success', 'Module deleted successfully');
    }
}
