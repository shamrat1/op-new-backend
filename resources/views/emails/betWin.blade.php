@component('mail::message')
<p> Dear {{ $data['name'] }} </p>
 <p>Congratulations! You have won {{ $data['amount'] }} for placing on the right bet.</p>
 <p> Here is the breakdown of Bet Win distribution.</p>

@component('mail::table')
| User       | Role         | Amount  |
| ------------- |:-------------:| --------:|
| {{ $data['name'] }}      | Winner      | {{ $data['amount'] }}      |
| {{ $data['sponser'] }}      | Sponser | {{ $data['sponserAmount'] }}      |
| {{ $data['club'] }}      | Club | {{ $data['clubAmount'] }}      |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
{{ config('mail.appEmail') }}
{{ config('support.appMobile') }}
@endcomponent