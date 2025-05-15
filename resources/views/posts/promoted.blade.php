@extends('layouts.app')

@section('content')
  <div class="bg-white py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-semibold tracking-tight text-gray-900 sm:text-5xl">Promoted Posts</h2>
      </div>
      <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:grid-cols-3">
        @forelse($posts as $post)
          <x-blog.post :post="$post" />
        @empty
          <p class="text-lg text-gray-500">No promoted posts found.</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection
