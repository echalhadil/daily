{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            
            <div 
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="username" value="{{ __('Username') }}" />
                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="firstname" value="{{ __('Firstname') }}" />
                <x-jet-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="lastname" value="{{ __('Lastname') }}" />
                <x-jet-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <x-jet-input id="gender" class="block mt-1 w-full" type="text" name="gender" :value="old('gender')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>


 --}}








<x-guest-layout >

    <div class=" uk-width-1-1 uk-flex uk-height-viewport ">

        <div class="uk-width-1-2@m uk-visible@m uk-height-viewport">
            left
        </div>
    
        <div class="uk-width-1-2@m  uk-height-viewport">
            <div class=" uk-padding-small uk-margin-large-top uk-border-rounded  uk-width-3-5@m uk-box-shadow-small " style="background: white;" >

                <div class=" uk-text-center" >
                    <p class=" uk-margin-small uk-text-capitalize uk-text-bold uk-h2 " > {{ __('register') }} </p>
                </div>
                
                
                <form method="POST" action="{{ route('register') }}" class="uk-form-stacked ">
                    @csrf
                    {{-- email --}}
                    <div>
                        <label class="uk-form-label uk-text-bold uk-text-capitalize " value="{{ __('Email') }}" for="email">email</label>
                        <div class="uk-form-controls">
                            <input class="uk-input  @error('email') uk-form-danger @enderror  " type="email" name="email" :value="old('email')" autocomplete="current-email" required autofocus placeholder="name@exemple.com">
                        </div>
                        @error('email')
                            <span class=" uk-text-capitalize uk-text-danger uk-text-small " > wrong email or password</span>
                        @enderror
                    </div>

                    {{-- username --}}
                    <div>
                        <label class="uk-form-label uk-text-bold uk-text-capitalize " value="{{ __('Username') }}" for="username">Username</label>
                        <div class="uk-form-controls">
                            <input class="uk-input  @error('username') uk-form-danger @enderror  " type="text" name="username" :value="old('username')" autocomplete="current-email" required autofocus placeholder="heisenberg">
                        </div>
                        @error('username')
                            <span class=" uk-text-capitalize uk-text-danger uk-text-small " > wrong email or password</span>
                        @enderror
                    </div>

                    
                    {{-- firstname --}}
                    <div>
                        <label class="uk-form-label uk-text-bold uk-text-capitalize " value="{{ __('Firstname') }}" for="firstname">first name</label>
                        <div class="uk-form-controls">
                            <input class="uk-input  @error('firstname') uk-form-danger @enderror  " type="text" name="firstname" :value="old('firstname')" autocomplete="current-email" required autofocus placeholder="walter">
                        </div>
                        @error('firstname')
                            <span class=" uk-text-capitalize uk-text-danger uk-text-small " > wrong email or password</span>
                        @enderror
                    </div>

                    
                    {{-- lastname --}}
                    <div>
                        <label class="uk-form-label uk-text-bold uk-text-capitalize " value="{{ __('Lastname') }}" for="lastname">last name</label>
                        <div class="uk-form-controls">
                            <input class="uk-input  @error('lastname') uk-form-danger @enderror  " type="text" name="lastname" :value="old('lastname')" autocomplete="current-email" required autofocus placeholder="white">
                        </div>
                        @error('lastname')
                            <span class=" uk-text-capitalize uk-text-danger uk-text-small " > wrong email or password</span>
                        @enderror
                    </div>

                    
                    {{-- gender --}}
                    <div>
                        <label class="uk-form-label uk-text-bold uk-text-capitalize " value="{{ __('Gender') }}" for="gender">gender</label>
                        <div class="uk-form-controls">
                            <select class="uk-select" name="gender" :value="old('gender')">
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>
                    </div>

                    {{-- password --}}
                    <div class="uk-margin-small-top">
                        <label class="uk-form-label uk-text-bold uk-text-capitalize " value="{{ __('Password') }}" for="password"> password</label>
                        <div class="uk-form-controls">
                            <input type="password" class="uk-input" name="password" required autocomplete="current-password" placeholder="********">
                        </div>
                    </div>

                    {{--Confirm password --}}
                    <div class="uk-margin-small-top">
                        <label class="uk-form-label uk-text-bold uk-text-capitalize " value="{{ __('Confirm Password') }}" for="password_confirmation">confirm password</label>
                        <div class="uk-form-controls">
                            <input type="password" class="uk-input" name="password_confirmation" required autocomplete="new_confirmation" placeholder="********">
                        </div>
                    </div>


                    {{-- button --}}
                    <div class="uk-margin-small">
                        <button type="submit" class="uk-button uk-button-primary" style=" color:white; background: #4A7FF3;">{{ __('Register') }}</button>
                    </div>
                </form>
    
            </div>
          
        </div>
    
    </div>


</x-guest-layout>