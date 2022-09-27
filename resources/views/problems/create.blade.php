@extends('layouts.main')

@section('content')
    <section class="xl:mx-96 sm:mx-16 mx-8">
        <h1 class="text-3xl mb-6 mt-6 items-center font-semibold">
            แจ้งปัญหา
        </h1>

        <form action="{{ route('problems.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                    ปัญหา
                </label>
                @if ($errors->has('title'))
                    <p class="text-red-500">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <input type="text" name="title" id="title"
                    class="bg-white border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required autocomplete="off">

            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900">
                    หัวข้อที่สอดคล้อง
                </label>
                @if ($errors->has('type'))
                    <p class="text-red-500">
                        {{ $errors->first('type') }}
                    </p>
                @endif
                <select name="type" id="type" class="">
                    <option value="การเดินทางภายในมหาวิทยาลัย">การเดินทางภายในมหาวิทยาลัย</option>
                    <option value="อุบัติเหตุ">อุบัติเหตุ</option>
                    <option value="ภัยพิบัติ">ภัยพิบัติ</option>
                    <option value="กองทุนเงินให้กู้ยืมเพื่อการศึกษา(กยศ.)">กองทุนเงินให้กู้ยืมเพื่อการศึกษา(กยศ.)</option>
                    <option value="เหตุขัดข้องภายในมหาวิทยาลัย">เหตุขัดข้องภายในมหาวิทยาลัย</option>
                    <option value="อื่นๆ">อื่นๆ</option>
                </select>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="location" class="block mb-2 text-sm font-medium text-gray-900">
                    สถานที่
                </label>
                @if ($errors->has('location'))
                    <p class="text-red-500">
                        {{ $errors->first('location') }}
                    </p>
                @endif
                <input type="text" name="location" id="location"
                    class="bg-white border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    required autocomplete="off">
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="department" class="block mb-2 text-sm font-medium text-gray-900">
                    หน่วยงาน
                </label>
                <select name="department" id="department" class="">
                    @foreach (\App\Models\Department::all() as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="relative z-0 mb-6 w-full group">
                <label for="detail" class="block mb-2 text-sm font-medium text-gray-900">
                    รายละเอียด
                </label>
                @if ($errors->has('detail'))
                    <p class="text-red-500">
                        {{ $errors->first('detail') }}
                    </p>
                @endif
                <textarea rows="4" type="text" name="detail" id="detail"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border focus:ring-blue-500 focus:border-blue-500"
                    required autocomplete="off"></textarea>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900">
                    เบอร์โทรศัพท์ (ไม่จำเป็นต้องกรอก)
                </label>
                @if ($errors->has('phone_number'))
                    <p class="text-red-500">
                        {{ $errors->first('phone_number') }}
                    </p>
                @endif
                <input type="text" name="phone_number" id="phone_number"
                    class="bg-white border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    autocomplete="off">
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="picture_path" class="block mb-2 text-sm font-medium text-gray-900">
                    เลือกรูปภาพ
                </label>

                @if ($errors->has('picture_path'))
                    <p class="text-red-500">
                        {{ $errors->first('picture_path') }}
                    </p>
                @endif
                <input
                    class="block w-full bg-white text-sm text-gray-900 rounded-lg border border-gray-300 cursor-pointer focus:outline-none"
                    id="file_input" type="file" name="picture_path" type="file" accept="image/png, image/jpeg">
            </div>

            <div>
                <button class="bg-teal-700 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded"
                    type="submit">ยืนยัน</button>
            </div>
        </form>
    </section>
@endsection
