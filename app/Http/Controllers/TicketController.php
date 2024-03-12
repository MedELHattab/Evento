<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Picqer\Barcode\BarcodeGeneratorHTML;

class TicketController extends Controller
{
    public function show($ticketCode)
    {
        // Set a custom error handler
        set_error_handler([$this, 'customErrorHandler']);

        try {
            $reservation = Payment::where('ticket_code', $ticketCode)->first();

            if (!$reservation) {
                abort(404); // Handle case where the ticket code is not found
            }

            // Pass data to the view
            $data = ['reservation' => $reservation];

            // Generate barcode
            $barcode = $this->generateBarcode($reservation->ticket_code);

            // Add barcode data to the view data
            $data['barcode'] = $barcode;

            // Generate PDF
            $pdf = PDF::loadView('ticket-pdf', $data);

            // Download the PDF file
            $pdf->download('test.pdf');
            
        } finally {
            
            restore_error_handler();
        }
    }


    private function generateBarcode($data)
    {
        $generator = new BarcodeGeneratorHTML();
        return 'data:image/png;base64,' . $generator->getBarcode($data, $generator::TYPE_CODE_128);
    }
}
