<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;

use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $customers = Customer::with('addresses', 'projects')->get();
        // return view('customers.index', compact('customers'));
        // return CustomerResource::collection($customers);
        // return CustomerResource::collection(Customer::all());

        // $customers = Customer::all();
        $customers = Customer::with('addresses')->get();
        return view('customers.index', compact('customers'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
        // return "This is the create page.";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:15',
            'email' => 'required|email|unique:customers,email|max:255',
            'country' => 'nullable|string|max:255',
            'addresses.*.address_number' => 'required|string|max:255',
            'addresses.*.address_street' => 'required|string|max:255',
            'addresses.*.address_city' => 'required|string|max:255',
        ]);

        // Start a database transaction
        DB::beginTransaction();
        
        try {
            // Create a new customer
            $customer = Customer::create([
                'name' => $validated['name'],
                'company' => $validated['company'],
                'contact_phone' => $validated['contact_phone'],
                'email' => $validated['email'],
                'country' => $validated['country'],
            ]);

            // Save address details for the customer only if address fields are provided
            if (isset($validated['addresses']) && !empty($validated['addresses'])) {
                foreach ($validated['addresses'] as $addressData) {
                    $customer->addresses()->create([
                        'address_number' => $addressData['address_number'],
                        'address_street' => $addressData['address_street'],
                        'address_city' => $addressData['address_city'],
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            // Redirect to index with success message
            return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollback();
            
            // Log the error
            Log::error('Error storing customer: ' . $e->getMessage());
            
            // Redirect back with error message
            return redirect()->back()->with('error', 'Failed to create customer. Please try again.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $customer = Customer::with('addresses')->findOrFail($id);
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'addresses' => 'required|array',
            'addresses.*' => 'required|string',
        ]);

        // Find the customer by ID
        $customer = Customer::findOrFail($id);

        // Update the customer's name
        $customer->name = $validatedData['name'];
        $customer->save();

        // Remove existing addresses
        $customer->addresses()->delete();

        // Add the new addresses
        foreach ($validatedData['addresses'] as $address) {
            $customer->addresses()->create(['address' => $address]);
        }

        // Redirect to the customer list with a success message
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
