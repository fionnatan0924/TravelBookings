@extends('app')

@section('content')
<div class="container" style="margin: 60px auto;">
    <h1 style="font-size: 36px; font-weight: 500; margin-bottom: 32px;">All destinations</h1>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px,1fr)); gap: 24px;">
        @foreach($destinations as $dest)
        <a href="{{ route('destinations.show', $dest->id) }}" style="text-decoration: none; color: inherit;">
            <div style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                <div style="height: 160px; background: url('{{ $dest->image_url ?? 'https://via.placeholder.com/280x160?text=No+Image' }}') center/cover;"></div>
                <div style="padding: 20px;">
                    <h3>{{ $dest->name }}</h3>
                    <p style="color: #666;">{{ $dest->packages_count }} packages</p>
                    <p style="margin-top: 12px; font-weight: 500;">from RM {{ number_format($dest->starting_price) }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection