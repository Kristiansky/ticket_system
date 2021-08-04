<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index();
            $table->foreignId('dealer_id')->unsigned()->nullable()->index();
            $table->string('client_phone')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_name')->nullable();
            $table->string('city')->nullable();
            $table->string('company')->nullable();
            $table->dateTime('received_at')->nullable();
            $table->enum('web_form', ['contact', 'test_drive', 'car_configurator', 'tbglc_leasing', 'tdio_test_drive', 'tdio_offer', 'tdio_brochure', 'contact_request', 'used_car', 'test_drive_appointment_request', 'online_reservation'])->nullable();
            $table->text('content')->nullable();
            $table->enum('contact_validation', ['call', 'email', 'not_validated'])->nullable();
            $table->text('operator_comment')->nullable();
            $table->enum('car', ['aygo', 'yaris', 'corolla_hatchback', 'corolla_touring_sports', 'corolla_sedan', 'camry', 'yaris_cross', 'c-hr', 'rav4', 'highlander', 'land_cruiser', 'hilux', 'proace', 'proace_verso', 'proace_city', 'proace_city_verso', 'other'])->nullable();
            $table->boolean('approved_gdpr_messages')->default(false);
            $table->boolean('approved_gdpr_marketing')->default(false);
            $table->boolean('approved_gdpr_no')->default(false);
            $table->enum('status', ['new', 'reminded', 'late', 'accepted', 'in_process', 'completed'])->nullable();
            $table->enum('dealer_info', ['order', 'test_drive_success', 'test_drive_set', 'will_visit_showroom', 'sent_offer', 'sent_borchure', 'sent_leasing_sim', 'second_hand', 'not_serious_interest', 'waiting', 'gave_up', 'no_feedback', 'wrong_contact'])->nullable();
            $table->enum('dealer_progress_status', ['client', 'hot', 'warm', 'cold', 'lost'])->nullable();
            $table->string('dealer_merchant')->nullable();
            $table->text('dealer_comment')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
