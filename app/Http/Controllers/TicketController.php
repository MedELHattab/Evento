<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Picqer\Barcode\BarcodeGeneratorHTML;

class TicketController extends Controller
{
    private function generateBarcode($data)
    {
        $generator = new BarcodeGeneratorHTML();
        return 'data:image/png;base64,' . $generator->getBarcode($data, $generator::TYPE_CODE_128);
    }

    public function show($ticketCode)
    {
        // Set a custom error handler
        set_error_handler([$this, 'customErrorHandler']);

        try {
            $reservations = Payment::where('ticket_code', $ticketCode)->get();

            if ($reservations->isEmpty()) {
                abort(404); // Handle case where no reservations are found for the given ticket code
            }

            // Prepare data for the view
            $data = [];

            foreach ($reservations as $reservation) {
                // Add reservation data
                $data[] = ['reservation' => $reservation];

                // Generate barcode for each reservation
                $barcode = $this->generateBarcode($reservation->ticket_code);

                // Add barcode data
                $data[count($data) - 1]['barcode'] = $barcode;
            }

            // Generate PDF
            $pdf = PDF::loadView('ticket-pdf', compact('data'));

            // Download the PDF file
            return $pdf->download('test.pdf');
        } finally {
            restore_error_handler();
        }
    }
}
