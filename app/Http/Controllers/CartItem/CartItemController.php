<?php

namespace App\Http\Controllers\CartItem;

use App\ApiResponse;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartItem\StoreCartItemRequest;
use App\Http\Requests\CartItem\UpdateCartItemQuantityRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    use ApiResponse;

    //Doneeeeeeeeee
    public function index(Request $request)
    {
        $service = new CartService();
        $cart = $service->getCart($request);
        $cart->load('cart_items.product');

        return $this->success('Cart items retrieved', CartItemResource::collection($cart->cart_items), 200);
    }

    //Doneeeeeeeeee
    public function store(StoreCartItemRequest $request)
    {
        $service = new CartService();
        $cart = $service->getCart($request);
        $cartItem = CartItem::where('product_id', $request->product_id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $data = $request->validated();
            $data['cart_id'] = $cart->id;
            $cartItem = CartItem::create($data);
        }

        return $this->success('Added Successfully', new CartItemResource($cartItem), 201);
    }

    public function update(UpdateCartItemQuantityRequest $request, CartItem $cartItem)
    {
        $service = new CartService();
        $cart = $service->getCart($request);
        $isExists = $service->itemIsExistsInCart($request, $cartItem);

        if (!$isExists) {
            return $this->error('Forbidden User', 403);
        }
        $cartItem->update([
            'quantity' => $request->quantity
        ]);
        return $this->success('Updated Successfully', $cartItem, 200);
    }

    // public function isItemInCart(Request $request, CartItem $cartItem)
    // {
    //     $service = new CartService();
    //     $cart = $service->getCart($request);

    //     return [
    //         'cart'=> $cart && $cart->id,
    //         'cart_from_item'=> $cartItem->id,
    //         'status'=> $cart && $cart->id === $cartItem->cart_id];
    // }



    public function destroy(Request $request, CartItem $cartItem)
    {
        $service = new CartService();
        $isExists = $service->itemIsExistsInCart($request, $cartItem);

        if (!$isExists) {
            return $this->error('Forbidden User', 403);
        }
        $cartItem->delete();
        return $this->success('Deleted Successfully', null, 200);
    }

    public function clear(Request $request)
    {
        $service = new CartService();
        $cart = $service->getCart($request);

        $cart->cart_items()->delete();
        return $this->successMessage('Cart cleared', 200);
    }
}
