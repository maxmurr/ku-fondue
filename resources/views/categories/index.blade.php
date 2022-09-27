@extends('layouts.main')
@section('content')
    <section class="mx-8">
        <h1 class="text-3xl mx-4 mt-6 font-semibold">
            หมวดหมู่ทั้งหมด
        </h1>
        <div class="my-1 px-8 py-2 flex flex-wrap justify-between space-y-6">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', ['category' => $category->name]) }}"
                    class="block p-6 bg-white rounded-lg border border-[#383838] shadow-md hover:bg-[#F2F2F2]  ">
                    <h5 class="mb-2 mt-2 text-2xl tracking-tight text-gray-900 max-w-full w-[170px] h-[70px] rounded-lg">
                        {{ $category->name }}
                    </h5>
                </a>
            @endforeach
        </div>
    </section>
@endsection
