<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailSend;
use App\Jobs\SendLeadEmail;
use App\Models\EmailCampaign;
use App\Models\EmailSend;
use App\Models\Lead;
use App\Models\LeadImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;




class SendController extends Controller
{
    // public function sendByTime(Request $request, LeadImport $import)
    // {
    //     try {
    //         $data = $request->validate([
    //             'subject' => ['required', 'string', 'max:150'],
    //             'body'    => ['required', 'string'],
    //             'limit'   => ['nullable', 'integer', 'min:1'],
    //         ]);

    //         // Use the import's own window
    //         $start = $import->created_at;                     // when import started
    //         $end   = ($import->updated_at ?? now())->addSecond(); // when it finished (add 1s guard)

    //         $queued    = 0;
    //         $limit     = (int)($data['limit'] ?? 0);
    //         $errors    = [];
    //         $stopEarly = false;
    //         $importId  = $import->id;

    //         Lead::query()
    //             ->whereBetween('updated_at', [$start, $end])   // <-- key change
    //             ->where('unsubscribed', false)
    //             ->where(function ($q) {
    //                 $q->whereNotNull('email1')
    //                     ->orWhereNotNull('business_email')
    //                     ->orWhereNotNull('email2');
    //             })
    //             ->orderBy('id')
    //             ->chunk(1000, function ($leads) use (&$queued, $limit, $data, &$errors, &$stopEarly, $importId) {
    //                 if ($stopEarly) return false;
    //                 try {
    //                     $batch = [];
    //                     foreach ($leads as $lead) {
    //                         if ($limit && $queued >= $limit) {
    //                             $stopEarly = true;
    //                             break;
    //                         }
    //                         $batch[] = new SendLeadEmail($lead->id, [
    //                             'subject' => $data['subject'],
    //                             'body'    => $data['body'],
    //                             'category' => 'import-campaign',
    //                         ]);
    //                         $queued++;
    //                     }
    //                     if ($batch) Bus::batch($batch)->onQueue('emails')->dispatch();
    //                     if ($stopEarly) return false;
    //                 } catch (\Throwable $e) {
    //                     $msg = $e->getMessage();
    //                     $errors[] = $msg;
    //                     Log::error('Chunk dispatch failed in sendByTime', [
    //                         'import_id' => $importId,
    //                         'error'     => $msg,
    //                     ]);
    //                 }
    //             });

    //         $message = "Queued {$queued} emails for Import #{$import->id}";
    //         if ($errors) {
    //             return back()
    //                 ->with('status', $message . ' (with warnings)')
    //                 ->withErrors(['send' => implode("\n", array_slice($errors, 0, 3))]);
    //         }
    //         return back()->with('status', $message);
    //     } catch (\Throwable $e) {
    //         Log::error('sendByTime failed', [
    //             'import_id' => $import->id ?? null,
    //             'error'     => $e->getMessage(),
    //         ]);
    //         return back()->withErrors(['send' => 'Failed to queue emails: ' . $e->getMessage()]);
    //     }
    // }

    // public function sendByTime(Request $request, LeadImport $import)
    // {
    //     try {
    //         $data = $request->validate([
    //             'subject' => ['required', 'string', 'max:150'],
    //             'body'    => ['required', 'string'],
    //             'limit'   => ['nullable', 'integer', 'min:1'],
    //         ]);

    //         $limit = (int)($data['limit'] ?? 0);

    //         // 1) Create a campaign
    //         $campaign = EmailCampaign::create([
    //             'name'    => 'Import ' . $import->id . ' Campaign',
    //             'subject' => $data['subject'],
    //             'body'    => $data['body'],
    //             'status'  => 'queued',
    //         ]);

    //         // Use the import’s own window (includes upserts)
    //         $start = $import->created_at;
    //         $end   = ($import->updated_at ?? now())->addSecond();
    //         $campaignId = $campaign->id;

    //         $totalTargets = 0;
    //         $queued = 0;
    //         $stopEarly = false;

    //         Log::info('sendByTime selecting leads', [
    //             'import_id' => $import->id,
    //             'start' => $start,
    //             'end' => $end,
    //             'limit' => $limit,
    //         ]);

    //         Lead::query()
    //             ->whereBetween('updated_at', [$start, $end])
    //             ->where('unsubscribed', false)
    //             ->where(function ($q) {
    //                 $q->whereNotNull('email1')
    //                     ->orWhereNotNull('business_email')
    //                     ->orWhereNotNull('email2');
    //             })
    //             ->orderBy('id')
    //             ->chunk(2000, function ($leads) use (&$totalTargets, &$queued, $limit, $campaignId, &$stopEarly) {

    //                 if ($stopEarly) return false;

    //                 $now  = now();
    //                 $rows = [];
    //                 $jobs = [];

    //                 try {
    //                     foreach ($leads as $lead) {
    //                         $to = $lead->email1 ?? $lead->business_email ?? $lead->email2;
    //                         if (!$to) continue;

    //                         $key = (string) Str::uuid();

    //                         $rows[] = [
    //                             'email_campaign_id' => $campaignId,
    //                             'lead_id'           => $lead->id,
    //                             'send_key'          => $key,
    //                             'to_email'          => $to,
    //                             'status'            => 'queued',
    //                             'queued_at'         => $now,
    //                             'created_at'        => $now,
    //                             'updated_at'        => $now,
    //                         ];
    //                         $jobs[] = new SendEmailSend($key);

    //                         $totalTargets++;
    //                         $queued++;

    //                         if ($limit && $queued >= $limit) {
    //                             $stopEarly = true;
    //                             break;
    //                         }
    //                     }

    //                     if ($rows) {
    //                         EmailSend::insert($rows); // outbox rows
    //                         // dispatch each job to "emails" queue
    //                         foreach ($jobs as $job) {
    //                             dispatch($job)->onQueue('emails');
    //                         }
    //                         Log::info('sendByTime dispatched chunk', [
    //                             'campaign_id' => $campaignId,
    //                             'rows' => count($rows),
    //                             'queued_so_far' => $queued,
    //                         ]);
    //                     } else {
    //                         Log::warning('sendByTime chunk had no rows to queue', ['campaign_id' => $campaignId]);
    //                     }

    //                     if ($stopEarly) return false;
    //                 } catch (\Throwable $e) {
    //                     Log::error('sendByTime chunk failed', [
    //                         'campaign_id' => $campaignId,
    //                         'error' => $e->getMessage(),
    //                     ]);
    //                     // continue to next chunk
    //                 }
    //             });

    //         $campaign->update(['total_targets' => $totalTargets, 'status' => 'sending']);

    //         Log::info('sendByTime completed selection', [
    //             'campaign_id' => $campaignId,
    //             'queued' => $queued,
    //             'total_targets' => $totalTargets,
    //         ]);

    //         return back()->with('status', "Campaign #{$campaign->id}: queued {$queued} emails.");
    //     } catch (\Throwable $e) {
    //         Log::error('sendByTime fatal', [
    //             'import_id' => $import->id ?? null,
    //             'error'     => $e->getMessage(),
    //         ]);
    //         return back()->withErrors(['send' => 'Failed to queue emails: ' . $e->getMessage()]);
    //     }
    // }

    public function sendByTime(Request $request, LeadImport $import)
    {
        try {
            $data = $request->validate([
                'subject' => ['required', 'string', 'max:150'],
                'body'    => ['required', 'string'],
                'limit'   => ['nullable', 'integer', 'min:1'],
            ]);
            $limit = (int)($data['limit'] ?? 0);

            $campaign = EmailCampaign::create([
                'name'    => 'Import ' . $import->id . ' Campaign',
                'subject' => $data['subject'],
                'body'    => $data['body'],
                'status'  => 'queued',
            ]);

            $start = $import->created_at;
            $end   = ($import->updated_at ?? now())->addSecond();
            $campaignId = $campaign->id;

            $totalTargets = 0;
            $queued = 0;
            $stopEarly = false;

            Log::info('sendByTime starting', compact('campaignId', 'start', 'end', 'limit'));

            Lead::query()
                ->whereBetween('updated_at', [$start, $end])
                // ✅ treat NULL as not unsubscribed
                ->where(function ($q) {
                    $q->where('unsubscribed', false)->orWhereNull('unsubscribed');
                })
                ->where(function ($q) {
                    $q->whereNotNull('email1')
                        ->orWhereNotNull('business_email')
                        ->orWhereNotNull('email2');
                })
                ->orderBy('id')
                ->chunk(2000, function ($leads) use (&$totalTargets, &$queued, $limit, $campaignId, &$stopEarly) {

                    if ($stopEarly) return false;

                    $now  = now();
                    $rows = [];
                    $jobs = [];

                    foreach ($leads as $lead) {
                        $to = $lead->email1 ?? $lead->business_email ?? $lead->email2;
                        if (!$to) continue;

                        $key = (string) Str::uuid();

                        $rows[] = [
                            'email_campaign_id' => $campaignId,
                            'lead_id'           => $lead->id,
                            'send_key'          => $key,
                            'to_email'          => $to,
                            'status'            => 'queued',
                            'queued_at'         => $now,
                            'created_at'        => $now,
                            'updated_at'        => $now,
                        ];
                        $jobs[] = new SendEmailSend($key);

                        $totalTargets++;
                        $queued++;

                        if ($limit && $queued >= $limit) {
                            $stopEarly = true;
                            break;
                        }
                    }

                    if ($rows) {
                        EmailSend::insert($rows);
                        foreach ($jobs as $job) {
                            dispatch($job)->onQueue('emails');  // queue = emails
                        }
                        Log::info('sendByTime dispatched chunk', [
                            'campaignId' => $campaignId,
                            'rows' => count($rows),
                            'queuedSoFar' => $queued,
                        ]);
                    }

                    if ($stopEarly) return false;
                });

            $campaign->update(['total_targets' => $totalTargets, 'status' => 'sending']);

            Log::info('sendByTime finished', compact('campaignId', 'queued', 'totalTargets'));

            if ($queued === 0) {
                return back()->withErrors([
                    'send' => "No recipients matched the window. Try removing the time window or fix filters."
                ]);
            }

            return back()->with('status', "Campaign #{$campaign->id}: queued {$queued} emails.");
        } catch (\Throwable $e) {
            Log::error('sendByTime fatal', ['import_id' => $import->id ?? null, 'error' => $e->getMessage()]);
            return back()->withErrors(['send' => 'Failed to queue emails: ' . $e->getMessage()]);
        }
    }
}
