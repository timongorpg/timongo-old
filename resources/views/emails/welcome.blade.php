@component('mail::message')
# Seja bem vindo(a) {{ $user->name }}

A guarda está montada. Vamos precisar convocar todos de Timongo para a guerra. Para começarmos:

- Diga-nos seu nome de guerra.
- Prove suas habilidades de combate
- Escolha uma especialidade
- Combata inimigos mais poderosos
- Prove sua dedicação de combate na arena

Estamos todos aguardando você em nossa comunidade de RPG. :heart:

@component('mail::button', ['url' => 'https://timongo.com'])
Estou preparado(a)!
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
