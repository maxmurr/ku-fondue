@extends('layouts.main')

@section('content')
    <section class="mx-8">
        <h1 class="text-3xl mb-6 mt-6 items-center">
            เพิ่มหน่วยงาน
        </h1>

        <form action="{{ route('departments.store') }}" method="post">
            @csrf

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                    ชื่อหน่วยงานของคุณ
                </label>
                <input type="text" name="name" id="name"
                       class="bg-white border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                       required autocomplete="off">
                @if ($errors->has('name')) <div class="text-sm text-red-600">ชื่อของหน่วยงานต้องมีความยาว 8-32 ตัวอักษร</div> @endif
            </div>
            <div>
                <button class="bg-teal-800 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded" type="submit">ยืนยัน</button>
            </div>
        </form>
    </section>

@endsection
