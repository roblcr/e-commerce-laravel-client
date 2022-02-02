<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function addslider()
    {
        return view('admin.addslider');
    }

    public function saveslider(Request $request)
    {
        $this->validate($request, [
            'description_one' => 'required',
            'description_two' => 'required',
            'slider_image' => 'image|nullable|max:1999']);

        if ($request->hasFile('slider_image')) {
            $fileNameWithExtension = $request->file('slider_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'. time() .'.'. $extension;

            // upload de l'image

            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $slider = new Slider();
        $slider->description_one = $request->input('description_one');
        $slider->description_two = $request->input('description_two');
        $slider->slider_image = $fileNameToStore;
        $slider->status = 1;

        $slider->save();

        return redirect('/ajouterslider')->with('status', 'le slider a été inséré avec succés');
    }

    public function sliders()
    {
        $sliders = Slider::get();
        return view('admin.sliders')->with('sliders', $sliders);
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('admin.editslider')->with('slider', $slider);
    }

    public function editslider(Request $request)
    {
        $this->validate($request, [
            'description_one' => 'required',
            'description_two' => 'required',
            'slider_image' => 'image|nullable|max:1999'
        ]);

        $slider = Slider::find($request->input('id'));
        $slider->description_one = $request->input('description_one');
        $slider->description_two = $request->input('description_two');

        if($request->hasFile('slider_image'))
        {
            $fileNameWithExtension = $request->file('slider_image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            $fileNameToStore = $fileName. '_' .time(). '.' .$extension;

            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

            if($slider->slider_image != 'noimage.jpg')
            {
                Storage::delete('public/slider_images/'.$slider->slider_image);
            }

            $slider->slider_image = $fileNameToStore;

        }

        $slider->update();

        return redirect('/sliders')->with('status', 'le slider a été modifié avec succés');
    }

    public function delete($id)
    {
        $slider = Slider::find($id);

        if($slider->slider_image != 'noimage.jpg'){
            Storage::delete('public/slider_images/' .$slider->slider_image);
        }

        $slider->delete();

        return redirect('/sliders')->with('status', 'Le slider a bien été suprimée');
    }

    public function activate($id)
    {
        $slider = Slider::find($id);

        $slider->status = 1;

        $slider->update();

        return redirect('/sliders')->with('status', 'Le slider a bien été activée');
    }

    public function deactivate($id)
    {
        $slider = Slider::find($id);

        $slider->status = 0;

        $slider->update();

        return redirect('/sliders')->with('status', 'Le slider a bien été désactivée');
    }
}
