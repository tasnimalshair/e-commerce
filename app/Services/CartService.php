<?php

namespace App\Services;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\CartItem;

class CartService
{
    public function getCart(Request $request)
    {
        if ($request->user()) {
            $cart = Cart::firstOrCreate(['user_id' => $request->user()->id]);
            return $cart;
        }

        if ($request->hasHeader('X-Cart-Token')) {
            $uuid = $request->header('X-Cart-Token');
            $cart = Cart::firstOrCreate(['uuid' => $uuid]);
            return $cart;
        }

        $newCart = Cart::create();
        return $newCart;
    }

    public function itemIsExistsInCart(Request $request, CartItem $cartItem)
    {
        $cart = $this->getCart($request);
        return $cart && $cart->id === $cartItem->cart_id;
    }




    public function mergeCarts(Request $request)
    {
        $user = $request->user();

        if ($request->hasHeader('X-Cart-Token')) {
            $uuid = $request->header('X-Cart-Token');
            $guestCart = Cart::where('uuid', $uuid)->first();

            if ($guestCart) {
                // البحث عن عربة المستخدم إذا كانت موجودة
                $userCart = Cart::where('user_id', $user->id)->first();

                if ($userCart) {
                    // دمج عناصر العربتين
                    $this->mergeCartItems($guestCart, $userCart);
                    // حذف العربة القديمة
                    $guestCart->delete();
                } else {
                    // ربط عربة الزائر بالمستخدم
                    $guestCart->update([
                        'user_id' => $user->id,
                        'uuid' => null // إزالة UUID لأنها أصبحت مرتبطة بمستخدم
                    ]);
                }
            }
        }

        return Cart::where('user_id', $user->id)->first();
    }

    private function mergeCartItems($sourceCart, $targetCart)
    {
        // دمج العناصر من العربة المصدر إلى العربة الهدف
        foreach ($sourceCart->cart_items as $item) {
            $existingItem = $targetCart->cart_items()
                ->where('product_id', $item->product_id)
                ->first();

            if ($existingItem) {
                $existingItem->update([
                    'quantity' => $existingItem->quantity + $item->quantity
                ]);
            } else {
                $targetCart->cart_items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity
                ]);
            }
        }
    }
}
