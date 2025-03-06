use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('parent_product_id');
            $table->string('parent_product_name');
            $table->string('product_id');
            $table->string('product_name');
            $table->string('product_type');
            $table->string('gs1')->nullable();
            $table->string('gs1_type')->nullable();
            $table->string('length');
            $table->string('height');
            $table->string('depth');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
Controller Code
php
Copy code
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'parent_product_id' => 'required|string|unique:products,parent_product_id',
            'parent_product_name' => 'required|string',
            'product_id' => 'required|string|unique:products,product_id',
            'product_name' => 'required|string',
            'product_type' => 'required|string',
            'length' => 'required|string',
            'height' => 'required|string',
            'depth' => 'required|string',
        ]);

        Product::create($request->all());

        return response()->json(['message' => 'Product added successfully!'], 200);
    }
}
