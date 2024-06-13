<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/06/11
 * Time: 19:34:04
 * Description: ApiManageController.php
 */

namespace App\Http\Controllers\Api;

use App\Models\Lead;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

class ApiManageController extends Controller
{
    /**
     * @param array $data
     * @param string $message
     * @param bool $status
     *
     * @return [type]
     */
    protected function sendResponse($data = [], $message = '', $status = true)
    {
        $response = [
            'status' => $status,
            'data'    => $data,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * Send error response
     *
     * @param $message
     * @param array $errorTrace
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendError($message, $errorTrace = [], $code = 200)
    {
        $response = [
            'status' => false,
            'message' => $message,
        ];

        if (!empty($errorTrace)) {
            $response['data'] = $errorTrace;
            $errorMessage = [];
            foreach ($errorTrace as $error) {
                $errorMessage[] = $error[0] ?? '';
            }
            $response['message'] = implode(', ', $errorMessage);
        }

        return response()->json($response, $code);
    }

    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function uploadLead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|integer',
            'lead_name' => 'required|string',
            'company_name' => 'required|string',
            'contact_number' => 'required|string|unique:leads',
            'email' => 'required|email',
            'description' => 'required|string',
            'status' => 'required|integer|in:0,1,2',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Invalid data', $validator->errors()->toArray());
        } else {
            $lead = Lead::create($request->all());
        }
        return $this->sendResponse(['lead' => $lead], 'Lead created successfully');
    }


    /**
     * @param Request $request
     *
     * @return [type]
     */
    public function getProducts(Request $request)
    {
        try {
            $products = [
                ["id" => 1, "name" => "Item 1"],
                ["id" => 2, "name" => "Item 2"],
                ["id" => 3, "name" => "Item 3"]
            ];
            return $this->sendResponse(['products' => $products], 'Products');
        } catch (\Exception $e) {
            return $this->sendError('Invalid data', ['error' => $e->getMessage()]);
        }
    }
}
