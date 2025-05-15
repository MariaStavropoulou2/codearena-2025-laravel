@extends('layouts.app')

@section('content')
  <div class="bg-white py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">

      <div class="mx-auto max-w-2xl text-center">
        <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">Blog page</h2>
      </div>

      {{-- Blog Posts --}}
      <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        @if($posts->isEmpty())
          <p class="text-lg text-gray-500">No posts found.</p>
        @else
          @foreach($posts as $post)
            <x-blog.post :post="$post" />
          @endforeach
        @endif
      </div>

      <div class="mt-16">
        {{ $posts->links() }}
      </div>

           {{-- Authors Section --}}
      <section id="authors" class="mx-auto mt-12 max-w-2xl text-center">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4">Authors</h3>
        <ul class="flex justify-center flex-wrap gap-4 text-lg text-gray-700">
          @foreach ($authors as $author)
            <li>{{ $author->name }}</li>
          @endforeach
        </ul>
      </section>

    </div>
  </div>
@endsection
