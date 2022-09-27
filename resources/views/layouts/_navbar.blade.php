<nav class="p-3 bg-neutral-700 border-gray-200">
    <div class="container flex flex-wrap justify-between items-center mx-auto">
        <a href="{{ url('/problems') }}" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap text-white">KU Fondue</span>
        </a>
        <button data-collapse-toggle="navbar-solid-bg" type="button"
            class="inline-flex justify-center items-center ml-3 text-gray-400 rounded-lg md:hidden hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-500"
            aria-controls="navbar-solid-bg" aria-expanded="true">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
            <ul
                class="flex flex-col mt-4 bg-[#636363] rounded-lg md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-transparent">
                @auth
                    <li>
                        <p class="text-white font-semibold">Welcome {{ Auth::user()->name }}!</p>
                    </li>
                    <li>
                        <a href="{{ route('problems.index') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('problems.index') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('problems.create') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('problems.create') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">แจ้งปัญหา
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('categories.index') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">
                            หมวดหมู่
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('problems.dashboard') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('problems.dashboard') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">สถิติ
                        </a>
                    </li>
                    @if (Auth::user()->isAdmin())
                        <li>
                            <a href="{{ route('departments.index') }}"
                                class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('departments.index') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">
                                หน่วยงาน
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}"
                                class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('users.index') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">
                                ผู้ใช้งาน
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('your_problems') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('your_problems') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">
                            ปัญหาที่คุณแจ้ง
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('logout') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                class="text-white block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#A62349] md:p-0">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('problems.index') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('problems.index') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('problems.create') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('problems.create') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">แจ้งปัญหา
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categories.index') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('categories.index') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">
                            หมวดหมู่
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('problems.dashboard') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('problems.dashboard') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">สถิติ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('login') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">Login
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}"
                            class="block py-2 pr-4 pl-3 rounded md:bg-transparent md:hover:bg-transparent md:hover:text-[#CDBE78] md:p-0 {{ Request::url() == route('register') ? 'bg-[#CDBE78] text-black md:text-[#CDBE78]' : 'bg-[#636363] text-white md:text-white hover:bg-[#bababa]' }}">Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
