<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Order Summary
     *
     * @return [type]
     */
    public function getOrderSummary()
    {
        $orders = Order::select(
            'id',
            'order_date',
            'status',
            DB::raw("
                CASE
                    WHEN status = 'Pending' AND DATEDIFF(CURDATE(), order_date) <= 7 THEN 'Pending Review'
                    WHEN status = 'Pending' AND DATEDIFF(CURDATE(), order_date) > 7 THEN 'Urgent Review'
                    WHEN status = 'Processing' AND DATEDIFF(CURDATE(), order_date) > 10 THEN 'Delayed'
                    WHEN status = 'Processing' THEN 'Processing'
                    WHEN status = 'Shipped' THEN 'Shipped'
                    WHEN status = 'Cancelled' THEN 'Cancelled'
                END AS order_status_category
            ")
        )->get();

        return $orders;
    }
}
