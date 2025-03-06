<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Speaker;
use Illuminate\Http\Request;
use App\Models\ProductAssociated;
use App\Models\ProjectorMakeModel;
use App\Mail\ProjectorMakeNotFound;
use App\Http\Controllers\Controller;
use App\Mail\ProjectorModelNotFound;
use Illuminate\Support\Facades\Mail;

class AllProductsFilterController extends Controller
{
    public function getProjectorData()
    {
        $projectorData = ProjectorMakeModel::select('make', 'model')->get();


        return response()->json($projectorData);
    }
    public function getSpeakerData()
    {
        $speakerData = Speaker::select('brand', 'model')->get();


        return response()->json($speakerData);
    }

    public function filterProducts(Request $request)
    {
        $filters = $request->input('filters');

        $query = ProductAssociated::query();

        // Handle projector brand filtering
        if (!empty($filters['projector_brand'])) {
            $projectorBrands = $filters['projector_brand'];
            $query->whereIn('projector_make', $projectorBrands);
        }

        // Handle ceiling height filtering
        if (!empty($filters['ceiling_height'])) {
            $ceilingHeights = $filters['ceiling_height'];

            $query->where(function ($q) use ($ceilingHeights) {
                foreach ($ceilingHeights as $ceilingHeight) {
                    if ($ceilingHeight == '7') {
                        $q->where('ceiling_height', '7')
                        ;
                    }

                    if ($ceilingHeight == '8') {
                        $q->where('ceiling_height', '8')

                        ;
                    }
                    if ($ceilingHeight == '7-8') {
                        $q->where('ceiling_height', '7')
                          ->orWhere('ceiling_height', '8')
                        ;
                    }
                    if ($ceilingHeight == '8-9') {
                        $q->where('ceiling_height', '8')
                          ->orWhere('ceiling_height', '9')
                        ;
                    }
                    if ($ceilingHeight == '9') {
                        $q->where('ceiling_height', '9')


                        ;
                    }
                    if ($ceilingHeight == '10') {
                        $q->where('ceiling_height', '10')


                        ;
                    }
                    
                }
            });
        }

        // Handle screen size filtering
        if (!empty($filters['screen_size'])) {
            $screenSizes = $filters['screen_size'];

            $query->where(function ($q) use ($screenSizes) {
                foreach ($screenSizes as $size) {
                    if ($size == '100') {
                        $q->orWhere('screen_size', '100');
                    } elseif ($size == '120') {
                        $q->orWhere('screen_size', '120');
                    } elseif ($size == '132') {
                        $q->orWhere('screen_size', '132');
                    } elseif ($size == '150') {
                        $q->orWhere('screen_size', '150');
                    }
                }
            });
        }

        $parentProductIds = $query
            ->distinct()
            ->pluck('parent_product_id');

        $productsQuery = Product::whereIn('parent_product_id', $parentProductIds)
            ->where('product_type', '!=', 'Parent Product');

        // Check for both screen types
        if (!empty($filters['screen_type'])) {
            $screenTypeConditions = [];

            // If "floor_raising" screen type is selected, apply the corresponding filter
            if (in_array('floor_raising', $filters['screen_type'])) {
                $screenTypeConditions[] = ['LOWER(floor_raising_screen)', '=', 'yes'];
            }

            // If "fixed_screen" screen type is selected, apply the corresponding filter
            if (in_array('fixed_screen', $filters['screen_type'])) {
                $screenTypeConditions[] = function ($query) {
                    $query->whereNull('floor_raising_screen')  // Include NULL values
                        ->orWhereRaw("LOWER(floor_raising_screen) != 'yes'"); // Exclude "yes"
                };
            }

            // Apply the combined conditions using an OR logic
            if (!empty($screenTypeConditions)) {
                $productsQuery->where(function ($query) use ($screenTypeConditions) {
                    foreach ($screenTypeConditions as $condition) {
                        if (is_array($condition)) {
                            $query->orWhereRaw("LOWER(floor_raising_screen) = ?", [$condition[2]]);
                        } else {
                            $query->orWhere($condition);
                        }
                    }
                });
            }
        }

        $products = $productsQuery->paginate(6);


        return view('frontend.products.product_data', compact('products'));
    }
    public function search(Request $request)
    {


        if (collect($request->all())->except('_token')->filter()->isEmpty()) {
            return response()->json([
                'status' => 'no_filters',
                'message' => 'No input provided.',
                'products' => 0
            ]);
        }


        $projectorMake = $request->input('projector_make');
        if ($request->has('projector_make')) {
            session(['projector_make' => $request->input('projector_make')]);
        } else {
            session()->forget('projector_make'); // Remove projector_make from session
        }
        $projectorMakeName = session('projector_make', '');
        $projectorModel = $request->input('projector_model');
        $channelBrand = $request->input('channel_brand');
        $channel_model = $request->input('channel_model');
        $length = $request->input('length');
        $depth = $request->input('depth');
        $height = $request->input('height');

        $screen_size = $request->input('screen_size');
        $ceilingHeight = $request->input('ceiling_height');
        $radio_group = $request->input('radio-group');

        $products = [];
        // Query to find parent product IDs based on projector_make and projector_model
        $query = ProductAssociated::query();


        if ($projectorMake) {

            $isProjectorMakeExists = ProductAssociated::where('projector_make', 'LIKE', '%' . $projectorMake . '%')->exists();

            if (!$isProjectorMakeExists) {
                // Send an email to the admin
                 Mail::to('praveen.matsa@ustprojectorcabinets.com')->send(new ProjectorMakeNotFound($projectorMake));
                return response()->json([
                    'status' => 'projector_not_found',
                    'message' => 'Your Projector brand is not yet simulated by us. We will consider simulating this brand. Kindly check the site after a few days.You will be redirected to FREE QUOTE page to make an enquiry about your customized product',
                    'redirect_url' => route('free_quote')
                ]);
            }
            $query->where('projector_make', 'LIKE', '%' . $projectorMake . '%');
        }



        if ($projectorModel && !$projectorMake) {
            return response()->json([
                'status' => 'projector_make_required',
                'message' => 'Please choose your projector brand first.'

            ]);
        }

        if ($projectorModel && $projectorMake) {
            // Check if the projector make exists with 'All' as the projector model
            $isProjectorMakeExists = ProductAssociated::where('projector_make', 'LIKE', '%' . $projectorMake . '%')
                ->whereRaw('LOWER(projector_model) LIKE ?', ['%' . strtolower('All') . '%'])
                ->exists();

            if ($isProjectorMakeExists) {
                // Now check if the requested projector model exists under the projector make in ProjectorMakeModel
                $isModelExists = ProjectorMakeModel::where('make', 'LIKE', '%' . $projectorMake . '%')
                    ->where('model', 'LIKE', '%' . $projectorModel . '%')
                    ->exists();

                if ($isModelExists) {
                    $query->where('projector_make', 'LIKE', '%' . $projectorMake . '%');

                } else {
                     Mail::to('praveen.matsa@ustprojectorcabinets.com')->send(new ProjectorModelNotFound($projectorMake, $projectorModel));
                    return response()->json([
                        'status' => 'projector_model_not_found',
                        'message' => 'Your Projector Model is not yet simulated by us. We will consider simulating this brand. Kindly check the site after a few days. You will be redirected to FREE QUOTE page to make an enquiry about your customized product.',
                        'redirect_url' => route('free_quote'),
                    ]);
                }
            }
        }
        if ($channel_model && !$channelBrand) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please select a channel brand before choosing a channel model.'
            ]);
        }
        if ($channel_model && $channelBrand) {
            $speaker = Speaker::where('brand', 'LIKE', '%' . $channelBrand . '%')
                ->where('model', 'LIKE', '%' . $channel_model . '%')
                ->first();

            if ($speaker) {
                $speakerHeight = $speaker->height;
                $speakerWidth = $speaker->width;
                $speakerDepth = $speaker->depth;

                // Fetch all product constraints
                $validProductIds = ProductAssociated::where(function ($query) use ($speakerHeight, $speakerWidth, $speakerDepth) {
                    $query->whereNull('max_center_channel_height') // Pass if null
                          ->orWhere('max_center_channel_height', '>=', $speakerHeight);
                })
                ->where(function ($query) use ($speakerWidth) {
                    $query->whereNull('max_center_channel_length') // Pass if null
                          ->orWhere('max_center_channel_length', '>=', $speakerWidth);
                })
                ->where(function ($query) use ($speakerDepth) {
                    $query->whereNull('max_allowed_center_channel_depth') // Pass if null
                          ->orWhere('max_allowed_center_channel_depth', '>=', $speakerDepth);
                })
                ->pluck('id');

                $query->whereIn('id', $validProductIds);
            }
        }




        if ($length && $length === '>45 inches') {

            return response()->json([
                'status' => 'length_exceeded',
                'message' => 'For This center channel length, Please request a free quote.',
                'redirect_url' => route('free_quote')
            ]);
        }
        if ($length && $length === '<45 inches') {
            // Fetch all max_center_channel_length values that are less than 45
            $validLengths = ProductAssociated::where('max_center_channel_length', '<=', 45)
                ->pluck('max_center_channel_length')
                ->toArray();

            // Apply the condition to your query
            $query->whereIn('max_center_channel_length', $validLengths);

        }
        if ($depth) {
            // Convert the selected depth value to a number
            $selectedDepth = (int) filter_var($depth, FILTER_SANITIZE_NUMBER_INT);

            // Fetch all max_allowed_center_channel_depth values that are greater than or equal to the selected depth
            $validDepths = ProductAssociated::where('max_allowed_center_channel_depth', '>=', $selectedDepth)
                ->pluck('max_allowed_center_channel_depth')
                ->toArray();

            // Apply condition to filter products
            $query->whereIn('max_allowed_center_channel_depth', $validDepths);
        }
        if ($height) {
            // Extract numeric value from height (e.g., "4 inches", "5''", "6r" → 4, 5, 6)
            preg_match('/\d+/', $height, $matches);
            $heightValue = isset($matches[0]) ? (int) $matches[0] : null;

            if ($heightValue) {
                // Query where center_channel_height (e.g., "4''", "5''") falls between the extracted value and the next inch
                $query->whereRaw("CAST(REGEXP_REPLACE(center_channel_height, '[^0-9]', '') AS SIGNED) BETWEEN ? AND ?", [$heightValue, $heightValue + 1]);
            }
        }

        if ($screen_size) {
            $query->where('screen_size', $screen_size);
        }

        if ($ceilingHeight) {

            if ($ceilingHeight == '7') {
                $query->where('ceiling_height', '7')
                ;
            }
            if ($ceilingHeight == '7-8') {
                $query->where('ceiling_height', '7')
                    ->orWhere('ceiling_height', '8');
            }

            if ($ceilingHeight == '8') {
                $query
                    ->where('ceiling_height', '7')
                    ->orWhere('ceiling_height', '8')
                ;
            }
            if ($ceilingHeight == '8-9') {
                $query
                    ->where('ceiling_height', '7')
                    ->orWhere('ceiling_height', '8')
                    ->orWhere('ceiling_height', '9');
            }
            if ($ceilingHeight == '9') {
                $query->where('ceiling_height', '7')
                    ->orWhere('ceiling_height', '8')
                    ->orWhere('ceiling_height', '9');
            }
            if ($ceilingHeight == '10') {
                $query->where('ceiling_height', '7')
                    ->orWhere('ceiling_height', '8')
                    ->orWhere('ceiling_height', '9')
                    ->orWhere('ceiling_height', '10');
            }
        }
        // Check if radio_group filter is applied
        if ($radio_group == 'floor_raising') {
            // Step 1: Fetch parent_product_ids from products where floor_raising_screen is 'yes'
            $parentProductIds = Product::whereRaw('LOWER(floor_raising_screen) = ?', ['yes'])
                ->pluck('parent_product_id')
                ->unique();
                $query = ProductAssociated::whereIn('parent_product_id', $parentProductIds);
        } elseif ($radio_group == 'fixed_screen') {
            // Step 1: Fetch parent_product_ids where floor_raising_screen is NULL or NOT 'yes'
            $parentProductIds = Product::where(function ($query) {
                    $query->whereNull('floor_raising_screen')
                          ->orWhereRaw('LOWER(floor_raising_screen) != ?', ['yes']);
                })
                ->where('product_type', 'Child Product')
                ->pluck('parent_product_id')
                ->unique();
                $query = ProductAssociated::whereIn('parent_product_id', $parentProductIds);
        }

        // Find the unique parent_product_id from ProductAssociated model
        $parentProductIds = $query->pluck('product_associateds.parent_product_id')->unique();
       // Debugging the parent_product_id retrieval

        // Find all products under those parent_product_id except those with product_type as coreproduct
        $products = Product::whereIn('parent_product_id', $parentProductIds)
            ->where('product_type', '!=', 'Parent Product')
            ->paginate(6); // Use pagination if necessary

           // dd($products->count());
        if ($products->count() === 0) {

            return response()->json([
                'status' => 'no_products',
                'message' => 'No products found.',
                'redirect_url' => route('free_quote')
            ]);
        }
        // Return partial view with the results
        if (request()->ajax()) {
            return view('frontend.products.product_data', compact('products'))->render();
        }
        return view('frontend.products.product_data', compact('products'));
    }

    public function getCeilingHeight(Request $request)
    {
        $ceilingHeights = ProductAssociated::where('projector_make', $request->projector_make)
            ->pluck('ceiling_height')
            ->unique()
            ->values();

        return response()->json($ceilingHeights);
    }

    public function getScreenSize(Request $request)
    {
        $screenSize = ProductAssociated::where('projector_make', $request->projector_make)
            ->pluck('screen_size')
            ->unique()
            ->values();

        return response()->json($screenSize);
    }
}
