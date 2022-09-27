@extends('layouts.main')

@section('content')
    <section class="xl:mx-96 sm:mx-16 mx-8">
        <h1 class="text-3xl mb-6 mt-6 items-center">
            แก้ไขปัญหา
        </h1>

        <form action="{{ route('problems.update', ['problem' => $problem->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="relative z-0 mb-6 w-full group">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                    ปัญหา
                </label>
                <input type="text" name="title" id="title"
                    class="bg-white border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    value="{{ $problem->title }}" required autocomplete="off">
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
                    <option value="การเดินทางภายในมหาวิทยาลัย" @if($problem->type) selected = 'selected' @endif>การเดินทางภายในมหาวิทยาลัย</option>
                    <option value="อุบัติเหตุ" @if($problem->type) selected = 'selected' @endif>อุบัติเหตุ</option>
                    <option value="ภัยพิบัติ" @if($problem->type) selected = 'selected' @endif>ภัยพิบัติ</option>
                    <option value="กองทุนเงินให้กู้ยืมเพื่อการศึกษา(กยศ.)" @if($problem->type) selected = 'selected' @endif>กองทุนเงินให้กู้ยืมเพื่อการศึกษา(กยศ.)</option>
                    <option value="เหตุขัดข้องภายในมหาวิทยาลัย" @if($problem->type) selected = 'selected' @endif>เหตุขัดข้องภายในมหาวิทยาลัย</option>
                    <option value="อื่นๆ" @if($problem->type) selected = 'selected' @endif>อื่นๆ</option>
                </select>
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="location" class="block mb-2 text-sm font-medium text-gray-900">
                    สถานที่
                </label>
                <input type="text" name="location" id="location"
                    class="bg-white border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    value="{{ $problem->location }}" required autocomplete="off">
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <label for="department" class="block mb-2 text-sm font-medium text-gray-900">
                    หน่วยงาน
                </label>
                @if ($errors->has('department'))
                    <p class="text-red-500">
                        {{ $errors->first('department') }}
                    </p>
                @endif
                <select name="department" id="department" class="">
                    @foreach(\App\Models\Department::all() as $department)
                        <option value="{{$department->id}}">{{ $department->name }}</option>
                    @endforeach
                  </select>
            </div>


            <div class="relative z-0 mb-6 w-full group">
                <label for="detail" class="block mb-2 text-sm font-medium text-gray-900">
                    รายระเอียด
                </label>
                <textarea rows="4" type="text" name="detail" id="detail"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                    required autocomplete="off">{{ $problem->detail }}</textarea>
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
                       value="{{ $problem->phone_number }}" autocomplete="off">
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
                    class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300
                cursor-pointer focus:outline-none"
                    aria-describedby="user_problem" id="picture_path" name="picture_path" type="file"
                    accept="image/png, image/jpeg" value="localhost/{{ $problem->picture_path }}">
            </div>

            <div>
                <button class="bg-teal-800 hover:bg-teal-900 text-white font-bold py-2 px-4 rounded"
                    type="submit">แก้ไข</button>
            </div>
        </form>
    </section>
    <section class="xl:mx-96 sm:mx-16 mx-8 my-4">
        <hr class="my-4" />
        <div class="relative pb-4">
            <div class="flex items-center bg-[#CDBE78] text-white text-sm font-bold px-4 py-3" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p class="text-white">Danger Zone</p>
            </div>
        </div>

        <div>
            <h3 class="text-red-600 mb-4 text-2xl">
                ลบปัญหา
                <p class="text-gray-800 text-xl">
                    เมื่อลบแล้วจะไม่สามารถกลับมาแก้ไขได้
                </p>
            </h3>

            <form action="{{ route('problems.destroy', ['problem' => $problem->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <div class="relative z-0 mb-6 w-full group">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">
                        ปัญหาที่ต้องการจะลบ
                    </label>
                    <input type="text" name="title" id="title"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="" required>
                </div>
                <button class="app-button red" type="submit">ลบ</button>
            </form>
        </div>
    </section>
@endsection
