<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'clientName' => 'required|string|max:255',
            'clientProfession' => 'required|string|max:255',
            'testimonialText' => 'required|string',
            'image' => 'nullable|image|max:2048', // Validation pour l'image
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = public_path('storage/testimonials');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $imageName = str_replace(' ', '_', strtolower($request->clientName)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'testimonials/' . $imageName;
        }

        Testimonial::create($validated);

        return redirect()->route('sev')->with('success', 'Testimonial added successfully!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'editClientName' => 'required|string|max:255',
            'editClientProfession' => 'required|string|max:255',
            'editTestimonialText' => 'required|string',
            'editImage' => 'nullable|image|max:2048',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        if ($request->hasFile('editImage')) {
            $image = $request->file('editImage');
            $destinationPath = public_path('storage/testimonials');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $imageName = str_replace(' ', '_', strtolower($request->editClientName)) . '_' . time() . '.' . $image->getClientOriginalExtension();
            if ($testimonial->image && File::exists(public_path('storage/' . $testimonial->image))) {
                File::delete(public_path('storage/' . $testimonial->image));
            }
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'testimonials/' . $imageName;
        }

        $testimonial->update([
            'clientName' => $validated['editClientName'],
            'clientProfession' => $validated['editClientProfession'],
            'testimonialText' => $validated['editTestimonialText'],
            'image' => $validated['image'] ?? $testimonial->image,
        ]);

        return redirect()->route('sev')->with('success', 'Testimonial updated successfully!');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->image && File::exists(public_path('storage/' . $testimonial->image))) {
            File::delete(public_path('storage/' . $testimonial->image));
        }

        $testimonial->delete();

        return redirect()->route('sev')->with('success', 'Testimonial deleted successfully!');
    }
}
