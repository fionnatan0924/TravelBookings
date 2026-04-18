<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Process attraction booking checkout
     */
    public function attractionCheckout(Request $request)
    {
        $validated = $request->validate([
            'attraction_id' => 'required|exists:attractions,id',
            'number_of_people' => 'required|integer|min:1|max:50',
        ]);

        $attraction = Attraction::findOrFail($validated['attraction_id']);
        
        // Calculate total price
        $totalPrice = $attraction->price * $validated['number_of_people'];

        // Store booking data in session for payment processing
        session([
            'booking' => [
                'type' => 'attraction',
                'attraction_id' => $attraction->id,
                'attraction_name' => $attraction->name,
                'destination_id' => $attraction->destination_id,
                'destination_name' => $attraction->destination->name,
                'price_per_person' => $attraction->price,
                'number_of_people' => $validated['number_of_people'],
                'total_price' => $totalPrice,
                'image_url' => $attraction->image_url,
            ]
        ]);

        // Redirect to payment page
        return redirect()->route('payment');
    }
}
