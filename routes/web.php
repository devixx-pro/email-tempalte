<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\LeadImportController;
use App\Http\Controllers\SendController;
use App\Mail\BulkLeadMail;
use App\Models\EmailCampaign;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

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
    return view('welcome');
});

Route::get('/imports', [LeadImportController::class, 'index'])->name('imports.index');
Route::post('/imports', [LeadImportController::class, 'store'])->name('imports.store');
Route::get('/imports/{import}', [LeadImportController::class, 'show'])->name('imports.show');
Route::get('/imports/{import}/progress', [LeadImportController::class, 'progress'])->name('imports.progress');

Route::get('/leads-admin', function (Request $r) {
    $s = trim((string)$r->get('s', ''));
    $q = Lead::query()->select('id', 'first_name', 'last_name', 'email1', 'business_email')
        ->orderByDesc('id'); // uses PK index

    if ($s !== '') {
        $q->where(function ($x) use ($s) {
            $x->where('email1', 'like', "%$s%")
                ->orWhere('business_email', 'like', "%$s%")
                ->orWhere('email2', 'like', "%$s%")
                ->orWhere('first_name', 'like', "%$s%")
                ->orWhere('last_name', 'like', "%$s%");
        });
    }

    // SIMPLE paginate avoids COUNT(*)
    $leads = $q->simplePaginate(1000);
    return view('leads.admin', compact('leads', 's'));
})->name('leads.admin');

Route::post('/imports/{import}/send-by-time', [SendController::class, 'sendByTime'])
    ->name('imports.sendByTime');


Route::get('/mail-test', function () {
    Mail::raw('SendGrid test OK', function ($m) {
        $m->to('diwakar.orion@gmail.com')->subject('SendGrid SMTP test');
    });
    return 'Sent.';
});


// routes/web.php (add)
Route::get('/campaigns', function () {
    $campaigns = EmailCampaign::latest()->withCount([
        'sends as sent'   => fn($q)=>$q->where('status','sent'),
        'sends as failed' => fn($q)=>$q->where('status','failed'),
    ])->paginate(20);
    return view('campaign.index', compact('campaigns'));
})->name('campaigns.index');

// routes/web.php
Route::get('/preview-bulk', function () {
    $lead = Lead::first();
    return new BulkLeadMail('Preview Subject', '<p>Preview body</p>', $lead);
});


Route::get('/send-email', [EmailController::class, 'index']);
Route::post('/send-email', [EmailController::class, 'sendTestEmail'])->name('send.test.email');

Route::get('/send-preview', [EmailController::class, 'preview']);