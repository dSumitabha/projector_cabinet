<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductManual;
use App\Models\ProductArtical;
use App\Models\ProductDescription;
use App\Models\ProductArticalVideo;
use App\Http\Controllers\Controller;

class ManageTabsController extends Controller
{
    public function index()
    {
        $products = Product::where('parent_product_id', '!=', null)->get();
        return view('admin.pages.products.tab.tab_index', compact('products'));
    }

    public function description($id)
    {
        //dd($id);
        $product = Product::where('product_id', $id)->first();
        $product_description=ProductDescription::where('product_id',$id)->first();

        return view('admin.pages.products.tab.description', compact('product','product_description'));
    }

    public function description_submit(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|mimes:pdf',
        ]);

        $product = Product::where('product_id', $id)->firstOrFail();
        $description_pdf = ProductDescription::firstOrNew(['product_id' => $product->product_id]);

        if ($description_pdf->exists && !empty($description_pdf->pdf) && file_exists(public_path($description_pdf->pdf))) {
            unlink(public_path($description_pdf->pdf));
        }

        if ($request->hasFile('image')) {
            $pdf = $request->file('image');
            $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
            $pdfPath = 'admin/upload/images/product/description_pdf/' . $pdfName;

            $pdf->move(public_path('admin/upload/images/product/description_pdf'), $pdfName);
            $description_pdf->pdf = $pdfPath;
        }

        $description_pdf->save();

        return back()->with('success', 'PDF uploaded successfully.');
    }


    public function manual($id)
    {
        $product = Product::where('product_id', $id)->first();
        $product_manual=ProductManual::where('product_id',$id)->first();
        // dd($product_manual);
        return view('admin.pages.products.tab.manual', compact('product','product_manual'));
    }

    public function manual_submit(Request $request, $id)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $product = Product::where('product_id', $id)->firstOrFail();
        $description_pdf = ProductManual::firstOrNew(['product_id' => $product->product_id]);

        if ($description_pdf->exists && !empty($description_pdf->pdf) && file_exists(public_path($description_pdf->pdf))) {
            unlink(public_path($description_pdf->pdf));
        }

        if ($request->hasFile('image')) {
            $pdf = $request->file('image');
            $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
            $pdfPath = 'admin/upload/images/product/manual_pdf/' . $pdfName;

            $pdf->move(public_path('admin/upload/images/product/manual_pdf'), $pdfName);
            $description_pdf->pdf = $pdfPath;
        }

        $description_pdf->save();

        return back()->with('success', 'PDF uploaded successfully.');
    }


    public function artical($id)
    {
        //dd($id);
        $product = Product::where('product_id', $id)->first();
        
         return view('admin.pages.products.tab.artical', compact('product'));
    }



    public function articalSubmit(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'description' => 'nullable|string',
            'urls' => 'nullable|array',
            'urls.*' => 'nullable|url'
        ]);

        // Update or Create the product description
        ProductArtical::updateOrCreate(
            ['product_id' => $id],  // Find by product_id
            ['description' => $request->description]  // Update description
        );

        // Delete existing URLs before inserting new ones
        ProductArticalVideo::where('product_id', $id)->delete();

        // Insert new URLs
        if (!empty($request->urls)) {
            foreach ($request->urls as $url) {
                if (!empty($url)) {
                    ProductArticalVideo::create([
                        'product_id' => $id,
                        'video_link' => $url
                    ]);
                }
            }
        }

        return back()->with('success', 'Article and URLs updated successfully.');
    }


    public function deleteUrl(Request $request)
    {
        $video = \App\Models\ProductArticalVideo::find($request->id);

        if ($video) {
            $video->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
