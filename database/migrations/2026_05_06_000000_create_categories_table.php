<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     public function up(): void
//     {
//         Schema::create('categories', function (Blueprint $table) {
//             $table->id();

//             $table->string('name');
//             $table->string('slug')->unique();

//             $table->text('description')->nullable();

//             $table->boolean('status')->default(1);
//             // 1 = active, 0 = inactive

//             $table->timestamps();
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('categories');
//     }
// };


//  use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     public function up(): void
//     {
//         Schema::table('categories', function (Blueprint $table) {
//             $table->foreignId('parent_id')
//                 ->nullable()
//                 ->constrained('categories')
//                 ->onDelete('cascade');
//         });
//     }

//     public function down(): void
//     {
//         Schema::table('categories', function (Blueprint $table) {
//             $table->dropForeign(['parent_id']);
//             $table->dropColumn('parent_id');
//         });
//     }
// };


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();

            // self-referencing parent category
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('categories')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};