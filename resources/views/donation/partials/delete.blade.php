<div class="row new-donation-form primary-1">
    <div class="col">
        <x-larastrap::form method="DELETE" :action="route('celo.show', $donation->id)" :buttons="[]">
            <input type="hidden" name="reason" value="user-deleted">

            <p class="text-center">
                (HAI CAMBIATO IDEA?)
            </p>

            <div>
                <button class="danger-button" type="submit">
                    <span>Clicca qui per eliminare questa donazione</span>
                </button>
            </div>
        </x-larastrap::form>
    </div>
</div>
