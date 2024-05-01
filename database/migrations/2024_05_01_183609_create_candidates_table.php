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
        Schema::create('candidates', function (Blueprint $table) {

            $table->id();
            $table->string('lastName');
            $table->string('firstName');
            $table->string('email')->unique();
            $table->string('mobile')->nullable();
            $table->unsignedBigInteger('degree_id');
            $table->foreign('degree_id')->references('id')->on('degrees');
            $table->string('resume')->nullable();
            $table->enum('jobAppliedFor', ['PHP Developer', 'JAVA Developer', 'PYTHON Developer', 'ERP Support', 'Sales', 'Technician']);
            $table->dateTime('applicationDate')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
