<style>
    .form-input-upload-image {
        width: 350px;
        padding: 20px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .form-input-upload-image input {
        display: none;

    }

    .form-input-upload-image label {
        display: block;
        width: 45%;
        height: 45px;
        /* margin-left: 25%; */
        line-height: 50px;
        text-align: center;
        background: #1172c2;

        color: #fff;
        font-size: 15px;
        font-family: "Open Sans", sans-serif;
        text-transform: Uppercase;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .form-input-upload-image .preview {

        display: flex;
        justify-content: center;
        align-items: center;
        width: 5rem;
        height: 5rem;

    }

    .form-input-upload-image .preview img {
        width: 100%;
        height: 100%;
        display: none;

        margin-bottom: 30px;
    }
</style>


<section class="row mt-4 p-2 border rounded shadow-sm">
    <div class="col-md-6 border-end d-flex justify-content-center align-items-center">
        @if (Auth::user()->avatar !== null)
            <img src="{{ asset('img/animal_avatar/' . Auth::user()->avatar . '.png') }}"
                alt="{{ asset('img/animal_avatar/' . Auth::user()->avatar . '.png') }}" width="200" height="200">
        @else
            <div class="form-input-upload-image">
                <div class="preview">
                    <img id="file-ip-1-preview">
                </div>
                <label for="file-ip-1">Upload Image</label>
                <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);">
            </div>
        @endif

    </div>
    <div class="col-md-6">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Profile Information') }}
            </h2>


        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <input id="name" name="name" type="text" class="form-control"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                {{-- <x-input-error class="mt-2" :messages="$errors->get('name')" /> --}}
                @if ($errors->get('name'))
                    <ul class="text-danger mt-2">
                        @foreach ((array) $errors->get('name') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <input id="email" name="email" type="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required autocomplete="username" />
                {{-- <x-input-error class="mt-2" :messages="$errors->get('email')" /> --}}
                @if ($errors->get('email'))
                    <ul class="text-danger mt-2">
                        @foreach ((array) $errors->get('email') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                <div>
                    <x-input-label for="date" :value="__('Date')" />
                    <input id="date" name="birthday" type="date" class="form-control"
                        value="{{ old('date', $user->birthday) }}" required autofocus />
                    {{-- <x-input-error class="mt-2" :messages="$errors->get('name')" /> --}}
                    @if ($errors->get('date'))
                        <ul class="text-danger mt-2">
                            @foreach ((array) $errors->get('date') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                </div>
                <div>
                    <x-input-label for="address" :value="__('Address')" />
                    <input id="address" name="address" type="text" class="form-control"
                        value="{{ old('address', $user->address) }}" required autofocus autocomplete="name"
                        placeholder="address.." />
                    {{-- <x-input-error class="mt-2" :messages="$errors->get('name')" /> --}}
                    @if ($errors->get('address'))
                        <ul class="text-danger mt-2">
                            @foreach ((array) $errors->get('address') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                </div>

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <button class="btn btn-primary my-2">{{ __('Save') }}</button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>
<script type="text/javascript">
    function showPreview(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    }
</script>
