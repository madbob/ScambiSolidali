<div class="my-5">
    <div class="row new-donation-form primary-1">
        <div class="col">
            <x-larastrap::form method="DELETE" :action="route('celo.show', $donation->id)" :buttons="[]">
                <input type="hidden" name="reason" value="user-deleted">

                <div>
                    <button class="danger-button" type="submit">
                        <span>Hai cambiato idea? Clicca qui per eliminare questa donazione</span>
                    </button>
                </div>
            </x-larastrap::form>
        </div>
    </div>

    @if($donation->renewable())
        <div class="row new-donation-form primary-1 my-3">
            <div class="col">
                <a class="button" href="{{ route('celo.renew', ['token' => $donation->renewToken()]) }}">
                    <span>Clicca qui per rinnovare questa donazione</span>
                </a>
            </div>
        </div>
    @endif
</div>
