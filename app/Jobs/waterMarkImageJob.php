<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

//use Intervention\Image\Image;

class waterMarkImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
//    private $image;
    private $name;

    public function __construct(
//        $image,
        $name
    )
    {
//        $this->image=$image;
        $this->name = $name;

        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        sleep(10);

//        File::get(('postPics/2Z86a9diniqigGcAJn8MAzarakhsh-AP29 (1) (1).jpg');
//        $image = File::get(public_path('postPics/'.$this->name));
        $image = \Intervention\Image\Facades\Image::make(public_path('postPics/'.$this->name));

        $image->text('tesssst', 120, 100, function ($font) {
            $font->size(120);
            $font->color('#ffffff');
            $font->align('center');
            $font->valign('bottom');
            $font->angle(90);
        })->save(public_path('/postPics' . '/' . $this->name));
//        Cache::forget('imageFile');
        var_dump(' this operation is successfully');


    }
}
