@extends('layouts.app')

@section('title', 'Archivio')

@section('content')
    <div class="celo primary-1">
    	<div class="row">
            <div class="col-md-12">
                @if($donations->isEmpty())
                    <div class="alert alert-info">
                        <p>
                            Non ci sono oggetti.
                        </p>
                    </div>
                @else
                    <table class="table">
                        <tbody>
            				@foreach($donations as $donation)
                                <tr>
                                    <td>{{ $donation->title }}</td>
                                    <td>{{ printableDate($donation->created_at) }}</td>
                                    <td>{{ $donation->printableStatus() }}</td>
                                </tr>
            				@endforeach
                        </tbody>
                    </table>

        			{{ $donations->links() }}
                @endif
    		</div>
    	</div>
    </div>
@endsection
