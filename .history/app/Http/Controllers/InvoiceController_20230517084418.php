<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Models\Invoices;
use App\Models\InvoiceProducts;
use App\Models\Companies;
use App\Models\Products;

class InvoiceController extends Controller
{

    private ApprovalFacadeInterface $approvalFacade;

    public function __construct(ApprovalFacadeInterface $approvalFacade)
    {
        $this->approvalFacade = $approvalFacade;
    }

    public function validate($id)
    {

        $

        // Use the $approvalFacade instance to call the approve method
        $dto = new ApprovalDto($entityId, $status, 'entity_name');
        $result = $this->approvalFacade->approve($dto);

        // Handle the result accordingly
        if ($result) {
            return response()->json(['success' => 'Invoice approved.'], 200);
        } else {
            return response()->json(['error' => 'Invoice not approved.'], 404);
        }
    }

    public function list()
    {
        //Return the last 100 invoices ordered by date
        return response()->json(
            Invoices::orderBy('date', 'desc')
            ->take(100)
            ->get()
        );

    }

    public function listByStatus($status)
    {
        //Fordib the use of special characters
        $sanitized_status = filter_var($status, FILTER_SANITIZE_STRING);
        $sanitized_status = trim($sanitized_status);

        //Check if $status has an invalid length
        if (strlen($sanitized_status) === 0) {
            //Return error if $status is not valid
            return response()->json(['error' => 'Invoice Status length not valid.'], 404);
        }

        //Return Product(s)
        return response()->json(
            Invoices::where('status', 'like', $sanitized_status)
            ->take(100)
            ->get()
        );
        
    }

    public function getInvoice($id)
    {

        //Fordib the use of special characters
        $sanitized_id = filter_var($id, FILTER_SANITIZE_STRING);
        $sanitized_id = trim($sanitized_id);

        //Check if $id has a valid UUID length
        if (strlen($sanitized_id) !== 36) {
            //Return error if $id is not valid
            return response()->json(['error' => 'Invoice Id length not valid.'], 404);            
        }

        //Return Invoice
        $invoice = Invoices::find($id);

        if ($invoice) {
            $invoice['company'] = Companies::find($invoice->company_id);
            $invoiceProducts = [];
            $invoiceTotal = 0.00;
            $products = InvoiceProducts::where('invoice_id', $invoice->id)->get();
            foreach ($products as $product) {
                $item = Products::find($product->product_id);
                $item['quantity'] = $product->quantity;
                $subtotal = $item->price * $product->quantity;
                $invoiceTotal += $subtotal;
                $item['total'] = number_format($subtotal/100, 2, '.', '');
                $invoiceProducts[] = $item;
            }  
            $invoice['products'] = $invoiceProducts;
            $invoice['total'] = number_format($invoiceTotal/100, 2, '.', '');
        }
 
        return response()->json($invoice);
        
    }
}
