@extends('layouts.admin')

@section('title', 'Ricerca Donazioni')

@section('acontent')

<div class="row">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#map" aria-controls="map" role="tab" data-toggle="tab">Mappa</a></li>
        <li role="presentation"><a href="#list" aria-controls="list" role="tab" data-toggle="tab">Elenco</a></li>
    </ul>

    <div class="tab-content">
        <br/>
        <div role="tabpanel" class="tab-pane active" id="map">
            <div class="row">
                <div class="col-md-9">
                    <div id="mapid"></div>
                </div>
                <div class="col-md-3">
                    <div class="page-header">
                        <h4>Filtra</h4>
                    </div>
                    @include('category.chooser', ['orientation' => 'vertical'])
                </div>
            </div>

            <script>
            var geoJson = {
                "type": "FeatureCollection",
                "features": [
                    @foreach($donations as $donation)
                        {
                            type: 'Feature',
                            geometry: {
                                type: 'Point',
                                coordinates: [{{ $donation->lng }}, {{ $donation->lat }}]
                            },
                            properties: {
                                'title': 'Marker Two',
                                'id': {{ $donation->id }},
                                'category': '{{ $donation->category->id }}'
                            }
                        },
                    @endforeach
                ]
            };
            </script>
        </div>

        <div role="tabpanel" class="tab-pane" id="list">
            <div class="row">
                <div class="col-md-12">
                    @if($donations->isEmpty())
                        <div class="alert alert-info">
                            <p>
                                Non ci sono donazioni in attesa.
                            </p>
                        </div>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Oggetto</th>
                                    <th>Utente</th>
                                    <th>Ritiro</th>

                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tbody>
    							@foreach($donations as $donation)
    	                            <tr data-donation-id="{{ $donation->id }}">
    	                                <td class="category">{{ $donation->category->name }}</td>
    	                                <td>{{ $donation->title }}</td>
    	                                <td>
    										{{ $donation->user->printableName() }}
    										@include('user.rating', ['user' => $donation->user])
    	                                </td>
    	                                <td>{{ $donation->printableAddress() }}</td>
    	                                <td>
    	                                    <button class="btn btn-default show-details" data-endpoint="donazione" data-item-id="{{ $donation->id }}"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
    	                                </td>
    	                            </tr>
    							@endforeach
                            </tbody>
                        </table>

                        <div class="text-center">
                            {{ $donations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
