<?php

namespace App\Http\Controllers\backend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackUpcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disk= Storage::disk(config('backup.backup.destination.disks')[0]);//local disk
        $files=$disk->files(config('backup.backup.name')); //env('APP_NAME)

        $backups=[];
        foreach($files as $key =>$file){
            if(substr($file, -4)=='.zip' && $disk->exists($file)){
                $filename=str_replace(config("backup.backup.name").'/','',$file);
                $backups[]=[
                    'file_path'=>$file,
                    'file_name'=>$filename,
                    'file_size'=>$this->byteToHuman($disk->size($file)),
                    'created_at'=>Carbon::parse($disk->lastModified($file))->diffForHumans(),
                    'download_link'=>'#',
                ];
            }
        }
        //reverse the backup so that latest one would come first
        $backups=array_reverse($backups);
        return view('admin.pages.backups.index',compact('backups'));
    }


    public function byteToHuman($bytes){
        $units=['B','KB','MB','GB','TB','PB'];
        for($i=0;$bytes>1024;$i++){
            $bytes/=1024;
        }

        return round($bytes,2).' '.$units[$i];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Artisan::call('backup:run');
        // dd(Artisan::output());
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $file_name)
    {

        $disk= Storage::disk(config('backup.backup.destination.disks')[0]);
        $files=$disk->files(config('backup.backup.name'));

        if($disk->exists(config('backup.backup.name').'/'.$file_name)){
            $disk->delete(config('backup.backup.name').'/'.$file_name);

            Toastr::success('Backup Delete Successfully!!');
            return back();
        }
    }


    public function download($file_name){
        $file=config('backup.backup.name').'/'.$file_name;
        $disk= Storage::disk(config('backup.backup.destination.disks')[0]);

        if($disk->exists($file)){
            $fs=Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream=$fs->readStream($file);


            return \Response::stream(function()use($stream){
                fpassthru($stream);
            },200,[
                "Content-Type"=>'.zip',
                "Content-Length"=>$fs->size($file),
                "Content-disposition"=>"attachment; filename=\"".basename($file)."\"",
            ]);

        }
    }
}
