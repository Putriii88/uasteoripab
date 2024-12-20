<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RajaOngkirService;

class ShippingController extends Controller
{
    protected $rajaOngkir;

    public function __construct(RajaOngkirService $rajaOngkir)
    {
        $this->rajaOngkir = $rajaOngkir;
    }

    public function getProvinces()
    {
        return response()->json($this->rajaOngkir->getProvinces());
    }

    public function getShippingCost(Request $request)
    {
        $validated = $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required|integer',
            'courier' => 'required',
        ]);

        $cost = $this->rajaOngkir->getShippingCost(
            $validated['origin'],
            $validated['destination'],
            $validated['weight'],
            $validated['courier']
        );

        return response()->json($cost);
    }
    public function calculateShipping(Request $request, RajaOngkirService $rajaOngkirService)
{
    $request->validate([
        'origin' => 'required|integer',
        'destination' => 'required|integer',
        'weight' => 'required|integer',
        'courier' => 'required|string',
    ]);

    $cost = $rajaOngkirService->getShippingCost(
        $request->origin,
        $request->destination,
        $request->weight,
        $request->courier
    );

    return response()->json($cost, 200);
}

}
