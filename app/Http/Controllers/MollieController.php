<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Reservation;
use Mollie\Laravel\Facades\Mollie;
use Ramsey\Uuid\Uuid;

class MollieController extends Controller
{

    public function mollie(Request $request, int $reservation)
    {
        $getRese = Reservation::findOrFail($reservation);
        $event_name = $getRese->event->name;

        $totalDHS = $getRese->number * $getRese->event->price;

        $event = $getRese->event_id;

        $exchangeRate = 10;

        // Convert total amount to USD
        $totalUSD = number_format($totalDHS / $exchangeRate, 2, '.', '');

        // Ensure the converted amount meets the minimum requirements of Mollie
        $minAmountUSD = 1.00;

        if ($totalUSD < $minAmountUSD) {

            $totalUSD = $minAmountUSD;
        }

        // Format the amount as a string with the correct number of decimals
        $formattedAmount = number_format($totalUSD, 2, '.', '');

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "USD",
                "value" => $formattedAmount,
            ],
            "description" => $event_name, // Use the event name as the description
            "redirectUrl" => route('success'),
            // "webhookUrl" => route('webhooks.mollie'),
            "metadata" => [
                "order_id" => time(),
                "reservation_id" => $getRese->id, // Pass reservation ID in metadata
            ],
        ]);

        //dd($payment);

        session()->put('paymentId', $payment->id);
        session()->put('quantity', $getRese->number);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $request)
    {

        $ticketCode = Uuid::uuid4()->toString();
        $paymentId = session()->get('paymentId');
        $payment = Mollie::api()->payments->get($paymentId);

        if ($payment->isPaid()) {
            $obj = new Payment();
            $obj->payment_id = $paymentId;
            $obj->reservation_id = $payment->metadata->reservation_id;
            $obj->description = $payment->description;
            $obj->quantity = session()->get('quantity');
            $obj->currency = $payment->amount->currency;
            $obj->payment_status = "Completed";
            $obj->payment_method = "Mollie";
            $obj->user_id = auth()->id();

            // Check if the user has made a payment, if not, apply a 10% discount
            $userMadePayment = Payment::where('user_id', auth()->id())->exists();
            $price = 0;

            if (!$userMadePayment) {
                $discount = $payment->amount->value * 0.10;
                $price = $payment->amount->value - $discount;
            } else {
                $price = $payment->amount->value;
            }

            $obj->price = $price;
            $obj->ticket_code = $ticketCode;
            $obj->save();
            return redirect()->route('ticket.show', ['ticketCode' => $ticketCode]);
        } else {
            return redirect()->route('cancel');
        }
    }

    public function cancel()
    {
        echo "Payment is cancelled.";
    }
}
