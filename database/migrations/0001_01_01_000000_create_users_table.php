<?php
// ════════════════════════════════════════════════════════
//  MIGRATIONS — à créer dans database/migrations/
//  Les noms de fichiers suivent la convention Laravel:
//  YYYY_MM_DD_HHMMSS_nom_de_migration.php
// ════════════════════════════════════════════════════════

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ─── 2024_01_01_000001_create_users_table.php ──────────
return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('users'); }
};