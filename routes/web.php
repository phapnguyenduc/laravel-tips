<?php

use App\Http\Controllers\DbModelEloquentController;
use Illuminate\Support\Facades\Route;
use Aws\SesV2\SesV2Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
//    return view('welcome');
//    \Illuminate\Support\Facades\Mail::to('phap.nguyenduc@vti.com.vn')->send(new \App\Mail\TestMail());
    $sesClient = new SesV2Client([
        'version' => 'latest',
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        'credentials' => [
            'key' => env('AWS_ACCESS_KEY_ID', ''),
            'secret' => env('AWS_SECRET_ACCESS_KEY', ''),
        ],
    ]);
    $senderEmail = 'phap.nguyenduc@vti.com.vn';
    $recipientEmail = 'nguyenducphap2000@gmail.com';

    $subject = 'Hello from SES';
    $body = 'This is the body of the email.';
    $html = '<p>Hello Im Phap</p>';
//    dd($sesClient->listContacts([
//        'ContactListName' => 'list-2024',
////        'EmailAddress' => 'nguyenducphap2000@gmail.com',
////        'UnsubscribeAll' => false
//    ]));

//    $sesClient->createContactList([
//        'ContactListName' => 'list-2024'
//    ]);

    $sesClient->sendEmail([
        'Content' => [ // REQUIRED
//            'Raw' => [
//                'Data' => 'asdasjdjklj'
//            ],
            'Simple' => [
                'Body' => [ // REQUIRED
                    'Html' => [
                        'Charset' => 'UTF-8',
                        'Data' => $html, // REQUIRED
                    ],
                    'Text' => [
                        'Data' => $body, // REQUIRED
                    ],
                ],
                'Subject' => [ // REQUIRED
                    'Data' => $subject, // REQUIRED
                ],
            ],
    ],
    'Destination' => [
        'ToAddresses' => [$recipientEmail],
    ],
    'ListManagementOptions' => [
        'ContactListName' => 'list-2024', // REQUIRED
    ],
    'FromEmailAddress' => $senderEmail
    ]);
});

Route::prefix('db-model-eloquent')->group(function () {
    Route::get('clone', [DbModelEloquentController::class, 'cloneIntro']);
    Route::get('merge-collection', [DbModelEloquentController::class, 'mergeCollectionIntro']);
    Route::get('load-data-faster', [DbModelEloquentController::class, 'loadDataFaster']);
    Route::get('multiple-scope', [DbModelEloquentController::class, 'multipleScope']);
    Route::get('hide-column', [DbModelEloquentController::class, 'hideColumn']);
    Route::get('copy-model', [DbModelEloquentController::class, 'copyModel']);
    Route::get('reduce-mem', [DbModelEloquentController::class, 'reduceMem']);
    Route::get('sole', [DbModelEloquentController::class, 'sole']);
    Route::get('with-aggregate', [DbModelEloquentController::class, 'withAggregateEx']);
    Route::get('multiple-upsert', [DbModelEloquentController::class, 'multipleUpsert']);
    Route::get('retrieve-query-builder', [DbModelEloquentController::class, 'retrieveQueryBuilder']);
    Route::get('custom-cast', [DbModelEloquentController::class, 'customCast']);
    Route::get('human-date', [DbModelEloquentController::class, 'humanDate']);
});
