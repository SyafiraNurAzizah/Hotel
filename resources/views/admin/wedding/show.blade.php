@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @forelse ($weddings as $wedding)
                    <div class="card-header">{{ $wedding->judul }}</div>
                    <div class="card-body">
                        <div>{{ $wedding->gambar }}</div>
                        <p>{{ $wedding->harga }}</p>
                        <p>{{ $wedding->kapasitas }}</p>
                        <p>{{ $wedding->paket1 }}</p>
                        <p>{{ $wedding->judul_paket1 }}</p>
                        <p>{{ $wedding->paket2 }}</p>
                        <p>{{ $wedding->judul_paket2 }}</p>
                        <p>{{ $wedding->paket3 }}</p>
                        <p>{{ $wedding->judul_paket3 }}</p>
                        
                    </div>

                @empty
                    
                @endforelse
                
            </div>
        </div>
    </div>
</div>
@endsection