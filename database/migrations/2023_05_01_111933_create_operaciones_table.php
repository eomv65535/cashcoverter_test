<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_number')->constrained('loans');
            $table->unsignedBigInteger('client_id');
            $table->decimal('ingress_paid', 10, 2)->default(0);
            $table->string('ingress_bank')->nullable();
            $table->string('ingress_comment')->nullable();
            $table->string('ingress_type')->nullable();
            $table->timestamps();         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operacion');
    }
};
