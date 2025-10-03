<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->string('event'); // page_view, view_details
            $table->unsignedBigInteger('job_id')->nullable();
            $table->string('path')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
            $table->index(['event', 'job_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metrics');
    }
};
