@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <section class="mx-8">
            <div class="flex flex-wrap justify-between">
                <div>
                    <h1 class="text-3xl font-semibold mx-4 mt-6">
                        หน่วยงานทั้งหมด
                    </h1>
                </div>
                <div class="text-xl text-white hover:bg-teal-800 mx-4 mt-3 border bg-teal-700 rounded py-2 px-4">
                    <a href="{{ route('departments.create') }}">
                        เพิ่มหน่วยงาน
                    </a>
                </div>
            </div>
            <div class="my-1 px-8 py-2 flex flex-wrap justify-between space-y-6">
                @foreach ($departments as $department)
                    <div
                        class="block p-6 w-full bg-white rounded-lg border border-[#383838] shadow-md hover:bg-[#F2F2F2] flex flex-row justify-between">
                        <div class="relative">
                            <h5 class="mb-2 text-2xl font-medium tracking-tight text-gray-900">
                                {{ $department->name }}
                            </h5>
                        </div>
                        <div class="bg-blue-500 hover-bg-blue-600 text-white py-2 px-6 rounded border">
                            <a href=" {{ route('departments.edit', ['department' => $department]) }}">
                                <p class="text-lg">แก้ไข</p>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    </section>
@endsection
