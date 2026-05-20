<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // SERVICES
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('icone')->nullable();
            $table->string('couleur')->nullable();
            $table->json('features')->nullable();
            $table->string('prix_depuis')->nullable();
            $table->string('delai')->nullable();
            $table->unsignedSmallInteger('ordre')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
        //Projets
          Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->enum('categorie', ['Vitrine', 'E-commerce', 'App Web', 'ERP/CRM'])->default('Vitrine');
            $table->json('technologies')->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->string('emoji', 10)->nullable();
            $table->smallInteger('annee')->nullable();
            $table->unsignedSmallInteger('ordre')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });

        // FAQS
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question', 500);
            $table->text('reponse');
            $table->string('categorie', 100)->nullable();
            $table->unsignedSmallInteger('ordre')->default(0);
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });

        // MESSAGES
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('email');
            $table->string('telephone', 30)->nullable();
            $table->string('entreprise')->nullable();
            $table->string('service', 100)->nullable();
            $table->string('budget', 100)->nullable();
            $table->text('message');
            $table->boolean('lu')->default(false);
            $table->timestamps();
        });

        // TEMOIGNAGES
        Schema::create('temoignages', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('entreprise')->nullable();
            $table->text('message');
            $table->unsignedTinyInteger('note')->default(5);
            $table->string('avatar')->nullable();
            $table->boolean('valide')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temoignages');
        Schema::dropIfExists('messages');
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('services');
        Schema::dropIfExists('projets');
    }
};