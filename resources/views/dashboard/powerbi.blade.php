@extends('layouts.app')
@section('content')
<h2 class="text-xl font-bold mb-4">🔍 Power BI Insights</h2>
<!-- Embed Power BI iframe -->
<div class="aspect-w-16 aspect-h-9">
    <iframe class="w-full h-full rounded-lg" src="YOUR_POWER_BI_EMBED_URL" frameborder="0" allowFullScreen></iframe>
</div>
@endsection