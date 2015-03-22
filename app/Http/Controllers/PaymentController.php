<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

use App\Repositories\OrderRepository;
use App\Order, Auth, Config, Session;

class PaymentController extends Controller {

	private $_api_context;

	public function __construct(OrderRepository $order)
	{
		$this->middleware('auth');
		$this->order = $order;
		$paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function payment($order_id)
	{	
		$user_id = Auth::user()->id;
		$order = $this->order->GetOrderById($order_id);
		if ($order['order_status'] != 1 || $user_id != $order['user_id']) return redirect('/home')->with('message.error', 'Order can not be payed');
		
		$payer = new Payer();
		$amount = new Amount();
		$transaction = new Transaction();
		$payment = new Payment();

		$payer->setPaymentMethod('paypal');
    	$redirect_urls = new RedirectUrls();
    	$redirect_urls->setReturnUrl(url('/payment/status?order='.$order_id))
        	->setCancelUrl(url('/payment/status?order='.$order_id));

        $item = new Item();
	    $item->setName('Номер заказа: #'.$order['id'].' at '.$order['created_at']) // item name
	        ->setCurrency('RUB')
	        ->setQuantity(1)
	        ->setPrice($order['order_price']); // unit price		
	    $item_list = new ItemList();
	    $item_list->setItems(array($item));
	    
	    $amount->setCurrency('RUB')
		    ->setTotal($order['order_price']);

	    $transaction->setAmount($amount)
	    	->setItemList($item_list)
	        ->setDescription('Print online poster order')
	        ->setInvoiceNumber(uniqid());
	    
	    $payment->setIntent('Sale')
	        ->setPayer($payer)
	        ->setRedirectUrls($redirect_urls)
	        ->setTransactions(array($transaction));
	    
	    try {
	        $payment->create($this->_api_context);
	    } catch (\PayPal\Exception\PPConnectionException $ex) {
	        if (Config::get('app.debug')) {
	            echo "Exception: " . $ex->getMessage() . PHP_EOL;
	            //dd($payment);
	            $err_data = json_decode($ex->getData(), true);
	            dd($err_data);
	            exit;
	        } else {
	            die('Some error occur, sorry for inconvenient');
	        }
	    }

	    $approvalUrl = $payment->getApprovalLink();
	    if(isset($approvalUrl)) {
	    	Session::put('paypal_payment_id', $payment->getId());
	    	return redirect($approvalUrl);
	    }
	    return redirect('/home')->with('message.error', 'Payment failed');
	}

	public function paymentStatus(Request $request)
	{
		$payment_id = Session::pull('paypal_payment_id');
		if (empty($request['token'])) return redirect('/home')->with('message.error', 'Payment failed');
	    if (empty($request['PayerID'])) return redirect('/home')->with('message.success', 'Payment canceled');

	    $payment = Payment::get($payment_id, $this->_api_context);
	    // PaymentExecution object includes information necessary 
	    // to execute a PayPal account payment. 
	    // The payer_id is added to the request query parameters
	    // when the user is redirected from paypal back to your site
	    $execution = new PaymentExecution();
	    $execution->setPayerId($request['PayerID']);

	    //Execute the payment
	    $result = $payment->execute($execution, $this->_api_context);
		if ($result->getState() == 'approved') {
			if($this->order->OrderPaymentApproved($request['order'])) return redirect('/home')->with('message.success', 'Payment success');
		}
	    return redirect('/home')->with('message.error', 'Payment failed');

	}


}
