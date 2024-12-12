@if ($donation->type == 'object')
    <x-larastrap::check name="shipping" label="Richiedi Trasporto" triggers_collapse="address_details" :help="sprintf('Selezionando questa opzione, l\'amministrazione di %s riceverà una mail di richiesta e sarai ricontattato per maggiori accordi.', env('APP_NAME'))" />

    <x-larastrap::collapse id="address_details">
        <x-larastrap::text name="shipping_name" label="Nome e cognome destinatario" />
        <x-larastrap::text name="shipping_address" label="Indirizzo di Consegna" help="(via, numero civico, città...)" />
        <x-larastrap::text name="shipping_floor" label="Piano di Consegna" help="(terra, primo, secondo...)" />
        <x-larastrap::text name="shipping_phone" label="Telefono destinatario" />
        <x-larastrap::check inline name="shipping_elevator" label="C'è l'ascensore" />
    </x-larastrap::collapse>
@endif
