<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    /**
     * Filter that has less than 50 units
     * An array $products is initialized with 5 products, each represented as an associative array with keys id, name, price, and quantity.
     * $productList = []; initializes an empty array $productList which will store products that meet the filter criteria (quantity less than 50).
     * foreach ($products as $product) { ... } iterates through each product in the $products array.
     * Inside the loop, if ($product['quantity'] < 50) { ... } checks if the quantity of the current product is less than 50.
     * If the condition is true, $productList[] = $product; adds the current product to the $productList array.
     * After iterating through all products and filtering those with quantity less than 50, return $productList; returns the array $productList containing only the filtered products.
     * @return [type]
     */
    public function filterProduct()
    {
        $products = [
            ['id' => 1, 'name' => 'Keyboard', 'price' => 29.99, 'quantity' => 100],
            ['id' => 2, 'name' => 'Mouse', 'price' => 19.99, 'quantity' => 150],
            ['id' => 3, 'name' => 'Monitor', 'price' => 199.99, 'quantity' => 80],
            ['id' => 4, 'name' => 'Pc', 'price' => 749.99, 'quantity' => 30],
            ['id' => 5, 'name' => 'Headset', 'price' => 49.99, 'quantity' => 60],
        ];

        $productList = [];
        foreach ($products as $product) {
            if ($product['quantity'] < 50) {
                $productList[] = $product;
            }
        }

        return $productList;
    }

    /**
     * Sum of product
     * An array $products is initialized with 5 products, each represented as an associative array with keys id, name, price, and quantity.
     * $total = 0; initializes a variable $total to store the cumulative sum of product values.
     * foreach ($products as $product) { ... } iterates through each product in the $products array.
     * Inside the loop, $product['price'] * $product['quantity'] calculates the total value of each product based on its price multiplied by its quantity.
     * $total += $product['price'] * $product['quantity']; accumulates the calculated value of each product into the variable $total.
     * After iterating through all products and summing their values, return $total; returns the total sum of all product values.
     * @return [type]
     */
    public function sumOfProduct()
    {
        $products = [
            ['id' => 1, 'name' => 'Keyboard', 'price' => 29.99, 'quantity' => 100],
            ['id' => 2, 'name' => 'Mouse', 'price' => 19.99, 'quantity' => 150],
            ['id' => 3, 'name' => 'Monitor', 'price' => 199.99, 'quantity' => 80],
            ['id' => 4, 'name' => 'Pc', 'price' => 749.99, 'quantity' => 30],
            ['id' => 5, 'name' => 'Headset', 'price' => 49.99, 'quantity' => 60],
        ];
        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'] * $product['quantity'];
        }
        return $total;
    }

    /**
     * Sort product
     * An array $products is initialized with 5 products, each represented as an associative array with keys id, name, price, and quantity.
     * $n = count($products); calculates the number of products in the array. In this case, $n will be 5.
     * The function uses a simple bubble sort algorithm to sort the $products array based on the price of each product in ascending order.
     * Outer Loop ($i loop): Iterates from 0 to $n - 1. Each iteration of $i places the $i-th smallest element in its correct position.
     * Inner Loop ($j loop): For each iteration of the outer loop, iterates from 0 to $n - $i - 1. This loop compares adjacent elements and swaps them if they are in the wrong order (higher price before lower price).
     * @return [type]
     */
    public function sortProduct()
    {
        $products = [
            ['id' => 1, 'name' => 'Keyboard', 'price' => 29.99, 'quantity' => 100],
            ['id' => 2, 'name' => 'Mouse', 'price' => 19.99, 'quantity' => 150],
            ['id' => 3, 'name' => 'Monitor', 'price' => 199.99, 'quantity' => 80],
            ['id' => 4, 'name' => 'Pc', 'price' => 749.99, 'quantity' => 30],
            ['id' => 5, 'name' => 'Headset', 'price' => 49.99, 'quantity' => 60],
        ];

        $n = count($products);

        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($products[$j]['price'] > $products[$j + 1]['price']) {
                    $temp = $products[$j];
                    $products[$j] = $products[$j + 1];
                    $products[$j + 1] = $temp;
                }
            }
        }

        return $products;
    }

    /**
     * @return [type]
     *
     * Using Product::all() fetches all products into memory, which can be inefficient for large datasets. This can lead to high memory usage and slow response times.
     * The script queries the database every time the method is called, leading to potential performance issues if the method is called frequently.
     */
    public function showTotalStockValue()
    {
        $products = Product::all();
        $totalValue = 0;

        foreach ($products as $product) {
            $totalValue += $product->price * $product->quantity;
        }

        return "Total stock value: $" . number_format($totalValue, 2);
    }

    /**
     * @return [type]
     * Reduces server load by minimizing database queries.
     * Provides faster response times by using cached data.
     * Lowers resource consumption by calculating the total stock value in the database.
     */
    public function showTotalStockValueOptimized()
    {
        $totalStockValue = Cache::remember('total_stock_value', 60, function () {
            return Product::selectRaw('SUM(price * quantity) as total_value')->value('total_value');
        });
        return "Total stock value: $" . number_format($totalStockValue, 2);
    }
}
