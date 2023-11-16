@extends('components.provider.layout')

@section('content')
    <div>
        <x-card class="shadow-md">
            <div class="w-full">
                <h1 class="text-3xl font-bold text-gray-900">
                    Milk Donor Prescreen
                </h1>

                <p class="text-sm text-gray-700 mt-4">
                    There is no greater gift to a family of a fragile baby than donor milk. Milk donations are
                    more
                    than just
                    nutrition, they are life-saving medicine!
                </p>

                <p class="text-sm text-gray-700 mt-4">
                    To become a milk donor, you must meet specific safety requirements before milk can
                    be accepted. This includes:
                </p>

                <ul class="list-disc ml-8 mt-2">
                    <li class="text-sm text-gray-700">
                        In good health and not using tobacco products, marijuana, or recreational drugs.
                    </li>
                    <li class="text-sm text-gray-700">
                        At low risk, along with their sexual partner(s), for communicable diseases (i.e.
                        HIV/AIDS,
                        Hepatitis B
                        or C, or Syphilis).
                    </li>
                    <li class="text-sm text-gray-700">
                        Collecting extra breastmilk beyond what your baby needs or milk that cannot be used by
                        your
                        baby.
                    </li>
                </ul>
            </div>

            <form id="submitForm" action="{{ route('provider.donate-milk.store') }}" method="POST"
                  class="space-y-4">
                @csrf

                <div>
                    <label for="question_1">
                        Why are you interested in donating milk?
                    </label>
                    <input type="text" name="question_1" id="question_1" value="{{ old('question_1') }}"
                           class="border rounded-lg shadow">
                    @error('question_1')
                    <span class="text-red-600 text-sm">This field is required</span>
                    @enderror
                </div>

                <div>
                    <p class="text-sm text-gray-600 font-semibold"> (Answering “YES” to any question does not
                        necessarily exclude you as a donor.)</p>
                </div>

                <div>
                    <label for="question_2">
                        Have you ever had brain surgery that included receiving a human cadveric (allogenic) dura
                        mater (brain covering) graft?
                    </label>
                    <div class="space-x-4">
                        <span><input type="radio" name="question_2" id="question_2" value="Yes" {{ old('question_2') == 'Yes' ? 'checked' : '' }}> Yes</span>
                        <span><input type="radio" name="question_2" id="question_2" value="No" {{ old('question_2') == 'No' ? 'checked' : '' }}> No</span>
                        @error('question_2')
                        <span class="text-red-600 text-sm">This field is required</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="question_3">
                        Do you use any nicotine/tobacco or cannabis/marijuana products on an ongoing basis?
                    </label>
                    <div class="space-x-4">
                        <span><input type="radio" name="question_3" id="question_3" value="Yes" {{ old('question_3') == 'Yes' ? 'checked' : '' }}> Yes</span>
                        <span><input type="radio" name="question_3" id="question_3" value="No" {{ old('question_3') == 'No' ? 'checked' : '' }}> No</span>
                        @error('question_3')
                        <span class="text-red-600 text-sm">This field is required</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="question_4">
                        In the past 12 months, have you used any recreational/illegal drugs such as, cocaine,
                        ecstasy, LSD, Dexedrine, or injectables?
                    </label>
                    <div class="space-x-4">
                        <span><input type="radio" name="question_4" id="question_4" value="Yes" {{ old('question_4') == 'Yes' ? 'checked' : '' }}> Yes</span>
                        <span><input type="radio" name="question_4" id="question_4" value="No" {{ old('question_4') == 'No' ? 'checked' : '' }}> No</span>
                        @error('question_4')
                        <span class="text-red-600 text-sm">This field is required</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="question_5">
                        Do you have a history of cancer, leukemia, lymphoma (including Hodgkin’s disease), or Kaposi
                        sarcoma?
                    </label>
                    <div class="space-x-4">
                        <span><input type="radio" name="question_5" id="question_5" value="Yes" {{ old('question_5') == 'Yes' ? 'checked' : '' }}> Yes</span>
                        <span><input type="radio" name="question_5" id="question_5" value="No" {{ old('question_5') == 'No' ? 'checked' : '' }}> No</span>
                        @error('question_5')
                        <span class="text-red-600 text-sm">This field is required</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="question_6">
                        Have you ever had HIV, Hepatitis B or C, or HTLV?
                    </label>
                    <div class="space-x-4">
                        <span><input type="radio" name="question_6" id="question_6" value="Yes" {{ old('question_6') == 'Yes' ? 'checked' : '' }}> Yes</span>
                        <span><input type="radio" name="question_6" id="question_6" value="No" {{ old('question_6') == 'No' ? 'checked' : '' }}> No</span>
                        @error('question_6')
                        <span class="text-red-600 text-sm">This field is required</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="question_7">
                        Please list any ongoing medications you took or plan to take for the majority of the time
                        you were/will be pumping for donation:
                    </label>
                    <textarea name="question_7" id="question_7" cols="40" rows="6"
                              class="mt-1 rounded-lg border border-gray-500">{{ old('question_7') }}</textarea>
                    <br>
                    @error('question_7')
                    <span class="text-red-600 text-sm">This field is required</span>
                    @enderror
                </div>

                <x-slot name="footer">
                    <div class="flex justify-end items-center">
                        <x-button type="submit" form="submitForm" label="Submit" primary/>
                    </div>
                </x-slot>
            </form>
        </x-card>
    </div>
@endsection
