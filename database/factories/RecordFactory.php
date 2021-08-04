<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Record;
use Faker\Generator as Faker;

$factory->define(Record::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'dealer_id' => $faker->numberBetween(3,15),
        'client_phone' => $faker->phoneNumber,
        'client_email' => $faker->safeEmail,
        'client_name' => $faker->name,
        'city' => $faker->city,
        'company' => $faker->company,
        'received_at' => $faker->dateTimeBetween('-10 days', '-1 days'),
        'web_form' => $faker->randomElement(['contact', 'test_drive', 'car_configurator', 'tbglc_leasing', 'tdio_test_drive', 'tdio_offer', 'tdio_brochure', 'contact_request', 'used_car', 'test_drive_appointment_request', 'online_reservation']),
        'content' => $faker->realText(200,2),
        'contact_validation' => $faker->randomElement(['call', 'email', 'not_validated']),
        'operator_comment' => $faker->realText(200,2),
        'car' => $faker->randomElement(['aygo', 'yaris', 'corolla_hatchback', 'corolla_touring_sports', 'corolla_sedan', 'camry', 'yaris_cross', 'c-hr', 'rav4', 'highlander', 'land_cruiser', 'hilux', 'proace', 'proace_verso', 'proace_city', 'proace_city_verso', 'other']),
        'approved_gdpr_messages' => $faker->boolean(),
        'approved_gdpr_marketing' => $faker->boolean(),
        'approved_gdpr_no' => $faker->boolean(),
        'status' => $faker->randomElement(['new', 'reminded', 'late', 'accepted', 'in_process', 'completed']),
        'dealer_info' => $faker->randomElement(['order', 'test_drive_success', 'test_drive_set', 'will_visit_showroom', 'sent_offer', 'sent_borchure', 'sent_leasing_sim', 'second_hand', 'not_serious_interest', 'waiting', 'gave_up', 'no_feedback', 'wrong_contact']),
        'dealer_progress_status' => $faker->randomElement(['client', 'hot', 'warm', 'cold', 'lost']),
        'dealer_merchant' => $faker->name,
        'dealer_comment' => $faker->realText(10,1),
    ];
});
