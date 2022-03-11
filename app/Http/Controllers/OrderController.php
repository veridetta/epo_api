<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Book;
use Carbon\Carbon;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Order::all();
 
        return response()->json([
            'success' => true,
            'data' => $orders
        ]);
    }
 
    public function show($id)
    {
        $order = Order::findById($id);
 
        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found '
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $order->toArray()
        ], 400);
    }
  public function list(Request $request)
    {
        $token = Order::where('user_id', '=', $request->user_id)->get();
        return response()->json($token, 200);
    }
    public function create()
    {
        $users = User::where('role','=','user')->orderBy('id', 'DESC')->get();
        $books = Book::all();
        return view('orders.create',['users'=>$users,'books'=>$books]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'book_id' => 'required',
        ]);
 
        $order = new Order();
        $order->book_id = $request->book_id;
        $order->user_id = $request->user_id;
        $order->status = 'Submitted';
        $order->jam = $request->jam;
        
        $order->tanggal = Carbon::parse($request->id)->format('y/m/d');
        //$tok=User::where('id','=',$request->user_id)->first();
        //self::sendGCM("Order Submitted","Permintaan booking peminjaman buku telah dikirim", $tok->token);
        if ($order->save()) {
            return redirect()->route('orders.submitted')
                        ->with('success','Order berhasil dibuat');
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);
        }
            
    }
    public function storeApp(Request $request)
    {
        $this->validate($request, [
            'book_id' => 'required',
        ]);
 
        $order = new Order();
        $order->book_id = $request->book_id;
        $order->user_id = $request->user_id;
        $order->status = 'Submitted';
        $order->jam = $request->jam;
        $order->tanggal = $request->tanggal;
        $tok=User::where('id','=',$request->user_id)->first();
        self::sendGCM("Order Submitted","Permintaan booking peminjaman buku telah dikirim", $tok->token);
        if ($order->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post not added'
            ], 500);
        }
            
    }
  public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required',
            
        ]);
        $id=$request->user_id;
        $tok=User::where('id','=',$request->user_id)->first();
        self::sendGCM("Order Update","Permintaan booking peminjaman buku telah ".$request->status,$tok->token);
        $order->update($request->all());
        return redirect()->route('orders.submitted')
                        ->with('success','Order berhasil disetujui');

    }
    public function destroy($id)
    {
        // $post = auth()->user()->posts()->find($id);
 
        // if (!$post) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post not found'
        //     ], 400);
        // }
 
        // if ($post->delete()) {
        //     return response()->json([
        //         'success' => true
        //     ]);
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Post can not be deleted'
        //     ], 500);
        // }
    }

    public function listSubmitted(){
        $orders = Order::where('status','=','Submitted')->latest()->paginate(5);
 
        return view('orders.index',compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function submitted(){
        $orders = Order::where('status','=','Submitted')->latest()->paginate(5);
 
        return view('orders.index',compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function proccess()
    {
        $orders = Order::where('status','=','Approved')->latest()->paginate(5);
 
        return view('orders.proccess',compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function finish()
    {
        $orders = Order::whereIn('status', ['Selesai', 'Rejected'])->latest()->paginate(5);
        return view('orders.finish',compact('orders'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    function firebase(){
        self::sendGCM("JUDUL","Haalloo","e07g2zpKQGi3GIYeen9mw5:APA91bFTAF-zO6OJvN6Js7XiTCd0244sKdS1X3eVbIuFAwS348L0IT4KCnrSX9JM_tpg12n1UfnYkjphp2ryQIA_qmoMDwxjUBVbzze5irJZn7VvEUwC6FOD-cFWVx4NB3Ols7_wfNNx");
    }
    function sendGCM($title,$message, $id) {
$url = 'https://fcm.googleapis.com/fcm/send';
        $FcmToken = $id;
          
        $serverKey = 'AAAAzZB-u6Y:APA91bFVDeGU-SHcTSsmpaawhkPXcaLREtJ8hqL_szo1KrxxWdMVrevpnz5S7zVTpIZZYwBt9VlYoNthgKAWC_QQ8TMfUz8tYsF_p-wKn7I_vttozBTjJ11gmCXK8EjK5ZFeDO2lfFux';
  
        $data = [
            "to" => $FcmToken,
            "notification" => [
                "title" => $title,
                "body" => $message,  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        

        // Close connection
        curl_close($ch);

        // FCM response
        //dd($result);        
}

}
