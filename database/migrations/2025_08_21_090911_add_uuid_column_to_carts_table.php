<?php

use App\Models\Cart;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->uuid('uuid')->nullable()->after('id');
        });

        // 2️⃣ ملأ السجلات القديمة بـ UUID
        Cart::whereNull('uuid')->orWhere('uuid', '')->get()->each(function ($cart) {
            $cart->uuid = Str::uuid();
            $cart->save();
        });

        // 3️⃣ أضف الـ UNIQUE constraint
        Schema::table('carts', function (Blueprint $table) {
            $table->unique('uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropUnique('carts_uuid_unique');
            $table->dropColumn('uuid');
        });
    }
};
