<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Product;
use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Models\ProductManual;
use App\Models\ProductAssociated;
use App\Models\ProductDescription;
use App\Models\ProjectorMakeModel;
use App\Http\Controllers\Controller;
use SebastianBergmann\Type\TrueType;

class AllProductsController extends Controller
{

    public function getProjectorModels(Request $request)
{
    $make = $request->make;
    $models = ProjectorMakeModel::where('make', $make)->pluck('model')->unique(); // Get models based on selected brand

    return response()->json($models);
}
public function getCenterChannelModels(Request $request)
{
    $brand = $request->brand;
    $models = Speaker::where('brand', $brand)->pluck('model')->unique();
    return response()->json($models);
}
    public function getSpeakerDimensions(Request $request)
{

    $brand = $request->query('brand');
    $model = $request->query('model');
    $speaker = Speaker::where('brand', $brand)->where('model', $model)->first();

    if (!$speaker) {
        return response()->json([]);
    }

    return response()->json([
        'height' => $speaker->height,
        'length' => $speaker->width,
        'depth' => $speaker->depth
    ]);
}
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('product_name', 'LIKE', "%{$query}%")
                         ->orWhere('product_id', 'LIKE', "%{$query}%");
        })
        ->where('product_type', '!=', 'Parent Product')
        ->get();

        return response()->json($products);
}


public function index(Request $request)
{
    $query = Product::where('product_type', '!=', 'Parent Product')
        ->whereRaw('LOWER(product_type) != ?', ['parent product']);

    // Handle sorting
    if ($request->has('sort_by')) {
        switch ($request->sort_by) {
            case '1': // Relevance (Default)
                $query->orderBy('created_at', 'desc');
                break;
            case '2': // Name, A to Z
                $query->orderBy('product_name', 'asc');
                break;
            case '3': // Name, Z to A
                $query->orderBy('product_name', 'desc');
                break;
            case '4': // Price, low to high
                $query->orderBy('selling_price', 'asc');
                break;
            case '5': // Price, high to low
                $query->orderBy('selling_price', 'desc');
                break;
        }
    }

    $products = $query->paginate(6);

    if ($request->ajax()) {
        return view('frontend.products.product_data', compact('products'))->render();
    }

    // Fetch projector brands from the database
    $projectorBrands = ProjectorMakeModel::select('make')->distinct()->get()->toArray();
    $projectorBrands = array_map(function ($brand) {
        return [
            'name' => $brand['make'],
            'type' => 'projector_brand',
            'value' => $brand['make'],
            'checked' => false,
        ];
    }, $projectorBrands);

    $ceilingHeights = [
        ['id' => 1, 'name' => '7 Feet', 'value' => '7', 'checked' => false, 'type' => 'ceiling_height'],
        ['id' => 2, 'name' => 'Between 7 to 8 Feet', 'value' => '7-8', 'checked' => false, 'type' => 'ceiling_height'],
        ['id' => 3, 'name' => '8 Feet', 'value' => '8', 'checked' => false, 'type' => 'ceiling_height'],
        ['id' => 4, 'name' => 'Between 8 to 9 Feet', 'value' => '8-9', 'checked' => false, 'type' => 'ceiling_height'],

        ['id' => 5, 'name' => '9 Feet', 'value' => '9', 'checked' => false, 'type' => 'ceiling_height'],
        ['id' => 6, 'name' => '10 Feet', 'value' => '10', 'checked' => false, 'type' => 'ceiling_height'],
    ];


    $screenSizes = [
        ['id' => 1, 'name' => '100 inches', 'value' => '100', 'checked' => false, 'type' => 'screen_size'],
        ['id' => 2, 'name' => '120 inches', 'value' => '120', 'checked' => false, 'type' => 'screen_size'],
        ['id' => 3, 'name' => '132 inches', 'value' => '132', 'checked' => false, 'type' => 'screen_size'],
        ['id' => 4, 'name' => '150 inches', 'value' => '150', 'checked' => false, 'type' => 'screen_size'],
        ['id' => 5, 'name' => 'custom', 'value' => 'custom', 'checked' => false, 'type' => 'screen_size'],
    ];

    $screenTypes = [
        ['id' => 1, 'name' => 'Fixed Screen', 'value' => 'fixed_screen', 'checked' => false, 'type' => 'screen_type'],
        ['id' => 2, 'name' => 'Floor Raising', 'value' => 'floor_raising', 'checked' => false, 'type' => 'screen_type'],
    ];

    return view('products', compact('projectorBrands', 'screenSizes', 'ceilingHeights', 'products', 'screenTypes'));
}

    public function show($slug,$id)
    {
        $product_manual=ProductManual::where('product_id',$id)->first();
        $product_description_manual=ProductDescription::where('product_id',$id)->first();

        $faqs = Faq::where('type', 'product')->orWhere('type', 'common')->get();
        $product = Product::with('associatedProduct')->where('product_id', $id)->first();
        $associatedProducts = ProductAssociated::where('parent_product_id', $product->parent_product_id)->get();
        $speakers = Speaker::all();
$related_products = Product::with('associatedProduct')->where('parent_product_id', $product->parent_product_id)->get();
        return view('product_detail',compact('product','related_products','associatedProducts','speakers','faqs','product_manual','product_description_manual'));
    }
}
