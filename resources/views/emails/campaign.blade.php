<!doctype html>
<html>
  <body style="font-family:Arial,Helvetica,sans-serif;line-height:1.5">
    <p>Hi {{ $lead->first_name ?: 'there' }},</p>
    {!! nl2br(e($campaign->body)) !!}
    <p style="margin-top:24px;font-size:12px;color:#666">
      If you prefer not to hear from us, you can
      <a href="{{ url('/unsubscribe/'.$lead->id) }}">unsubscribe</a>.
    </p>
  </body>
</html>