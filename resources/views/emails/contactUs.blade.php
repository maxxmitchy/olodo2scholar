<x-mail::message>
# Contact Us Message

A message has been sent to you through the contact us form on your website:

Name: {{ $name }}

Email: {{ $email }}

Message:

{{ $infor }}

Thanks,<br>
{{ config('app.name') }}

</x-mail::message>
