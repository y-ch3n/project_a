<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{

    public function update() {
        /* @var User $user */
        $user = auth()->user();
        $intent = $user->createSetupIntent();
        $payment_methods = $user->paymentMethods();
        return view('payment-methods.update', compact('intent', 'payment_methods'));
    }

    public function updateToken(Request $request) {
        $user = auth()->user();
        $user->deletePaymentMethods();
        $user->addPaymentMethod($request->payment_method_token);
        return response("Payment Method is added successfully");
    }

    public function destroy($id) {
        $user = auth()->user();
        if ($payment_method = $user->findPaymentMethod($id)) {
            $payment_method->delete();
            return redirect()->back()->with('success', "Successfully deleted payment method");
        }
        return redirect()->back()->with('error', "Could not find the payment method");
    }
}
