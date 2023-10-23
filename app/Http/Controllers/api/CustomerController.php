<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();

        if ($customers->isNotEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => 'Data fetched',
                'customers' => $customers
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No data found...',
            ], 404);
        }
    }


    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|digits:10'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }
        else
        {
            $customer = Customer::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone
            ]);

            if($customer)
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Customer added successfully!',
                ], 200);
            }
            else
            {
                return response()->json([
                    'status' => 500,
                    'message' => 'Opps something went wrong!',
                ], 500);
            }
        }
    }//end method here;

    public function show($id)
    {
        $customer = Customer::find($id);

        if($customer)
        {
            return response()->json([
                'status' => 200,
                'message' => 'Customer record is available!',
                'customer' => $customer
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Customer record not found!',
            ], 404);
        }
    }//end method here

    public function edit($id)
    {
        $customer = Customer::find($id);

        if($customer)
        {
            return response()->json([
                'status' => 200,
                'message' => 'Customer record is available!',
                'customer' => $customer
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Customer record not found!',
            ], 404);
        }
    }//end method here;

    public function update(Request $request, int $id)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|digits:10'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        }
        else
        {
            $customer = Customer::find($id);


            if($customer)
            {
                $customer->update([
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'Customer updated successfully!',
                ], 200);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => 'Customer record not found!',
                ], 404);
            }
        }
    }//end method here;

    public function destroy($id)
    {
        $customer = Customer::find($id);

        if($customer)
        {
            $customer->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Customer deleted successfully!',
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Customer record not found!',
            ], 404);
        }
    }//end method here;
}
