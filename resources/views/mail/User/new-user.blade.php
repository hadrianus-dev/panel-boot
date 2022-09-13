@component('mail::message')
# {{ $object->first_name }} Acabou de se juntar a Thronus

Obrigado.

@component('mail::button', ['url' => ''])
Esse Botão é link cego
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
