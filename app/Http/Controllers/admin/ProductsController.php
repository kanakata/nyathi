<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductsModel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private int $per_page = 30;

    public function pass_products()
    {
        $offset = 0;
        $data = ProductsModel::fetch_products($this->per_page, $offset);
        $products = $data['data'];
        $total = $data['count'];
        $current_page = (int) ($_GET['page'] ?? 1);
        $product_cumulative = $current_page * $this->per_page > $total ? $total : $current_page * $this->per_page;
        $total_pages = (int) ceil($total / $this->per_page);

        return view('admin.pages.products', [
            'products' => $products,
            'total' => $total,
            'current_page' => $current_page,
            'per_page' => $this->per_page,
            'total_pages' => $total_pages,
            'product_cumulative' => $product_cumulative,
            'categories' => $this->pass_categories_count(),
        ]);
    }

    public function save_product(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'product_name' => ['required', 'max:255', 'string'],
            'product_brand' => ['required', 'max:255', 'string'],
            'product_description' => ['required', 'max:255', 'string'],
            'product_price' => ['required', 'numeric'],
            'product_discount' => ['nullable', 'numeric'],
            'product_count' => ['required', 'numeric'],
            'product_category' => ['required', 'max:255', 'string'],
            // 'product_color' => ['required', 'max:255', 'array'],
            // 'product_sizes' => ['nullable', 'max:255', 'array'],
            'product_cupon' => ['nullable', 'max:255', 'string'],
            // 'product_image' => ['required', 'max:255', 'string'],
            // 'product_images' => ['nullable', 'max:255', 'array'],
            'product_reviews' => ['nullable', 'numeric'],
            'product_badge' => ['nullable', 'max:255', 'string'],
            'product_meta_title' => ['nullable', 'max:255', 'string'],
            'product_meta_description' => ['nullable', 'max:255', 'string'],
        ]);

        // handle failed validation


        if ($request->file('product_image')->isValid()) {
            $file_name = $request->input('product_name') . '.' . $request->file('product_image')->extension();
            $request->file('product_image')->storeAs('product-images',$file_name, "public");
        }

        foreach ($request->file('product_images') as $key => $value) {
            if ($value->isValid()) {
                $file_name = $request->input('product_name') . '_' . $key . '.' . $value->extension();
                $value->storeAs('product-images', $file_name, "public");
            }
        }

        // Save the validated data to the database
        $product = new ProductsModel;
        $product->save_product([
            'product_name' => $validated['product_name'],
            'product_brand' => $validated['product_brand'],
            'product_description' => $validated['product_description'],
            'product_price' => $validated['product_price'],
            'product_discount' => $validated['product_discount'] ?? null,
            'product_count' => $validated['product_count'],
            'product_category' => $validated['product_category'],
            'product_color' => implode(',', $validated['product_color'] ?? []),
            'product_sizes' => implode(',', $validated['product_sizes'] ?? []),
            'product_cupon' => $validated['product_cupon'] ?? null,
            'product_image' => $request->input('product_name').'.'.$request->file('product_image')->extension(),
            'product_images' => implode(',', array_map(function ($key, $value) use ($request) {
                return $request->input('product_name') . '_' . $key . '.' . $value->extension();
            }, array_keys($request->file('product_images')), $request->file('product_images'))),
            'product_reviews' => $validated['product_reviews'] ?? null,
            'product_badge' => $validated['product_badge'] ?? null,
            'product_meta_title' => $validated['product_meta_title'] ?? null,
            'product_meta_description' => $validated['product_meta_description'] ?? null,
        ]);

        return redirect('/admin/products');
    }

    public function delete_product($id)
    {
        $product = ProductsModel::find($id);
        if ($product) {
            $product->delete();
            return redirect('/admin/products')->with('success', 'Product deleted successfully.');
        } else {
            return redirect('/admin/products')->with('error', 'Product not found.');
        }
    }
}
