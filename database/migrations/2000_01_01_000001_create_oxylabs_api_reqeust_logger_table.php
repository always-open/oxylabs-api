<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oxylabs_api_request_logger', function (Blueprint $table) {
            $table->id();
            // Will store the relative path of the request (e.g. /addresses/validate)
            $table->string('path', 191)
                ->index();
            // What parameters were passed in (e.g. ?status=new)
            $table->string('params', 512)
                ->nullable()
                ->fulltext();
            // HTTP method (e.g. POST/PUT/DELETE)
            $table->string('http_method', 10)
                ->index();
            // Status code (e.g. 200, 204, 429)
            $table->smallInteger('response_code', autoIncrement: false, unsigned: true)
                ->nullable()
                ->index();
            // The entire JSON encoded payload of the request
            $table->json('body')
                ->nullable();
            // The headers that were part of the request
            $table->json('request_headers')
                ->nullable();
            // The entire JSON encoded responses
            $table->json('response')
                ->nullable();
            // The headers that were part of the response
            $table->json('response_headers')
                ->nullable();
            // Internal exceptions that occurred during the request
            $table->string('exception', 512)
                ->nullable();
            // When the request was resolved to the millisecond
            $table->timestamp('occurred_at', 3)->index();
            $table->timestamps(precision: 3);
            $table->processIds();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oxylabs_api_request_logger');
    }
};
