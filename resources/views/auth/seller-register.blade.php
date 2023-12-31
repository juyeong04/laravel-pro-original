<link rel="stylesheet" href="{{ asset('check.css') }}">
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="header">
            {{ __('Seller Register') }}
        </x-slot>
        <x-slot name="logo">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-100" style="margin-top: 10%">
                {{ __('Seller Register') }}
            </h1>
        </x-slot>
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mt-4">
                <x-label for="name" value="{{ __('Name') }}" class="dark:text-white" />
                <x-input id="name" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="text"
                    name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" class="dark:text-white" />
                <x-input id="email" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="email"
                    name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="u_id" value="{{ __('User_ID') }}" class="dark:text-white" />
                <x-input id="u_id" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="text"
                    name="u_id" :value="old('u_id')" required autocomplete="u_id" />
            </div>

            <div class="mt-4" id="check">
                <p style="color:red">id 중복여부 검사를 해주세요</p>
                <x-button type="button" id="check_button" value="ID 중복 검사" onclick="checkid();"
                    class="dark:bg-gray-600">아이디 중복검사</x-button>
            </div>

            <div class="mt-4">
                <x-label for="phone_no" value="{{ __('Phone Number') }}" class="dark:text-white" />
                <x-input id="phone_no" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="tel"
                    name="phone_no" :value="old('phone_no')" required autocomplete="phone_no" />
            </div>

            <div class="mt-4">
                <label for="u_addr">address</label>
                <br>
                <x-input type="text" id="sample6_address" name="u_addr"
                    class="block mt-1 w-full dark:bg-gray-700 dark:text-white" placeholder="대구 지역 내 도로명 주소" readonly />
                <br>
                <x-button type="button" onclick="sample6_execDaumPostcode()">우편번호 찾기</x-button>
                <br>
                @if (session()->has('addr_err'))
                    <div>{{ session()->get('addr_err') }}</div>
                @endif
                @if (session()->has('gu_err'))
                    <div>{{ session()->get('gu_err') }}</div>
                @endif
                <input type="hidden" name="s_lat" id="s_lat">
                <input type="hidden" name="s_log" id="s_log">
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" class="dark:text-white" />
                <x-input id="password" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="password"
                    name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="dark:text-white" />
                <x-input id="password_confirmation" class="block mt-1 w-full dark:bg-gray-700 dark:text-white"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="seller_license" value="{{ __('seller_license') }}" class="dark:text-white" />
                <x-input id="seller_license" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="text"
                    name="seller_license" :value="old('seller_license')" required autocomplete="seller_license" />
            </div>

            <div class="mt-4" id="check_license">
                <p style="color:red">라이센스 번호 확인</p>
                <x-button type="button" id="check_license_button" value="라이센스 확인" onclick="checkli();"
                    class="dark:bg-gray-600">라이센스 확인</x-button>
            </div>

            <div class="mt-4">
                <x-label for="b_name" value="{{ __('Brand_Name') }}" class="dark:text-white" />
                <x-input id="b_name" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="text"
                    name="b_name" :value="old('b_name')" required autocomplete="b_name" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Selete your PSQ') }}" class="dark:text-white" />
                <div class="dropdown">
                    <button class="dropdown-toggle" onclick="toggleDropdown()" type="button" style="width: 400px">
                        비밀번호 질문
                        <span class="arrow">&#9662;</span>
                    </button>
                    <ul class="dropdown-menu" id="dropdownMenu">
                        <li onclick="selectOption('0', '나의 어릴적 꿈은?')">나의 어릴적 꿈은?</li>
                        <li onclick="selectOption('1', '나의 가장 소중한 보물은?')">나의 가장 소중한 보물은?</li>
                        <li onclick="selectOption('2', '내가 가장 슬펐던 기억은?')">내가 가장 슬펐던 기억은?</li>
                        <li onclick="selectOption('3', '나와 가장 친한 친구는?')">나와 가장 친한 친구는?</li>
                        <li onclick="selectOption('4', '나의 첫번째 직장의 이름은?')">나의 첫번째 직장의 이름은?</li>
                    </ul>
                    <input type="hidden" id="selectedOption" name="pw_question" value="">
                </div>
            </div>

            <div class="mt-4">
                <x-label for="pw_answer" value="{{ __('Password_Answer') }}" class="dark:text-white" />
                <x-input id="pw_answer" class="block mt-1 w-full dark:bg-gray-700 dark:text-white" type="text"
                    name="pw_answer" :value="old('pw_answer')" required autocomplete="pw_answer" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required class="dark:bg-gray-700" />

                            <div class="ml-2 dark:text-white">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" class="dark:text-red underline" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" class="dark:text-red underline"  href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:text-white"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4 dark:bg-gray-600">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
        <script type="text/javascript"
            src="//dapi.kakao.com/v2/maps/sdk.js?appkey=1def08893c26998733c374c40b12ac42&libraries=services,clusterer,drawing">
        </script>
        <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
        <script src="{{ asset('addr.js') }}"></script>
    </x-authentication-card>
</x-guest-layout>
@include('layouts.footer')

<script>
    function checkli() {
        var userli = document.getElementById('seller_license').value; // Corrected spelling
        if (userli) {
            url = "{{ route('checkLicense') }}" + "?seller_license=" + userli;;
            window.open(url, "chkid", "width=700,height=500");
        } else {
            alert('라이센스 번호를 입력하세요');
        }
    }

    function checkid() {
        var userid = document.getElementById('u_id').value;
        if (userid) {
            url = "{{ route('check-id') }}" + "?u_id=" + userid;
            window.open(url, "chkid", "width=700,height=500");
        } else {
            alert('아이디를 입력하세요');
        }
    }

    function toggleDropdown() {
        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('show');
    }

    function selectOption(value, label) {
        document.getElementById('selectedOption').value = value;
        document.querySelector('.dropdown-toggle').innerHTML = label + '<span class="arrow">&#9662;</span>';

        var dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.remove('show');

        var pwQuestionInput = document.querySelector('input[name="pw_question"]');
        pwQuestionInput.value = value;
    }
</script>
