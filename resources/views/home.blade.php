@extends('layouts.app')
@section('content')
<h1>Novedades</h1>
<div>
  @foreach($latest as $p)
    <article>
      <a href="{{ route('product.show',$p->slug) }}">{{ $p->name }}</a>
      @if($p->display_price) <div>Desde ${{ number_format($p->display_price,2) }}</div> @endif
    </article>
  @endforeach
</div>
@endsection
