<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/06/12
 * Time: 16:18:13
 * Description: DiscountCalculateController.php
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountCalculateController extends Controller
{

    public function discountView()
    {
        return view('pages.discount');
    }
    /**
     * Calculate discount
     *
     * @param Request $request
     *
     * @return [type]
     */

    //Explanation: The script now correctly calculates discounts only for valid customer types and positive amounts, avoiding potential miscalculations.By validating inputs, the script prevents invalid data from affecting the output, making it more reliable and user-friendly.These improvements ensure that the function behaves predictably and provides helpful feedback to users or developers when incorrect data is passed, which is crucial for real-world applications where data integrity and user guidance are important.

    public function calculateDiscount(Request $request)
    {
        $request->validate([
            'customerType' => 'required|string',
            'amount' => 'required|numeric|min:0.01'
        ]);

        $customerType = $request->input('customerType');
        $amount = $request->input('amount');
        $validCustomerTypes = ["regular", "vip"];

        if (!in_array($customerType, $validCustomerTypes)) {
            return response()->json(['error' => 'Invalid customer type. Valid types are "regular" and "vip".'], 400);
        }

        $discount = 0;
        if ($customerType == "regular") {
            $discount = 0.10;
        } elseif ($customerType == "vip") {
            $discount = 0.20;
        }

        $discountedAmount = $amount - ($amount * $discount);
        $savings = $amount * $discount;

        return response()->json([
            'originalAmount' => $amount,
            'discountedAmount' => $discountedAmount,
            'savings' => $savings
        ]);
    }
}
