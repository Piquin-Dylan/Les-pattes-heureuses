<?php

use App\Enums\MembershipRequestStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('membership_requests', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email');
            $table->string('phone', 30);
            $table->string('message')->nullable();
            $table->json('availabilities')->nullable();
            $table->enum('status', MembershipRequestStatus::cases())->default(MembershipRequestStatus::Pending->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_requests');
    }
};
