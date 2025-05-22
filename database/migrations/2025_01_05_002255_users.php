<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['admin', 'seller', 'user']);
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address');
            $table->string('photo_path')->nullable();
            $table->string('signature_path')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->string('phone')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
        DB::table('users')->insert([
            'role' => 'admin',
            'name' => 'Admin',
            'lastname' => '.',
            'photo_path' => 'photos/images.jpg',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'address' => 'nowhere',
            'gender' => 'male',
            'status'=> true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
