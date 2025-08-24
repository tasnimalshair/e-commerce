<?php

namespace App\Http\Controllers\Cart;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\StoreCartRequest;
use App\Http\Requests\Cart\UpdateCartRequest;
use App\Http\Resources\CartItemResource;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use ApiResponse;

    public function show(Request $request)
    {
        $service = new CartService();
        $cart = $service->getCart($request);
        return $this->success('Retrieved Successfully', new CartResource($cart->load('cart_items')), 200);
    }

    public function store()
    {
        $cart = Cart::create();
        return $this->success('Added Successfully', new CartResource($cart), 201);
    }

    public function destroy(Request $request)
    {
        $cart = $request->user()->cart;
        if (!$cart) {
            return $this->error('Cart not found', 404);
        }
        $cart->cart_items->delete();
        return $this->successMessage('Deleted Successfully', 200);
    }

   
}
