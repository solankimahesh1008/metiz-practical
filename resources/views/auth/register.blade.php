<div>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="employee_name">{{ __('Employee Name') }}</label>
            <input id="employee_name" type="text" name="employee_name" value="{{ old('employee_name') }}" required
                autofocus>
        </div>

        <div>
            <label for="employee_code">{{ __('Employee Code') }}</label>
            <input id="employee_code" type="text" name="employee_code" value="{{ old('employee_code') }}" required>
        </div>

        <div>
            <label for="first_name">{{ __('First Name') }}</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" required>
        </div>

        <div>
            <label for="last_name">{{ __('Last Name') }}</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" required>
        </div>

        <div>
            <label for="username">{{ __('User Name') }}</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required>
        </div>

        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="phone">{{ __('Phone') }}</label>
            <input id="phone" type="number" name="phone" value="{{ old('phone') }}" required>
        </div>

        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required>
        </div>

        <div>
            <label for="address">{{ __('Address') }}</label>
            <input id="address" type="text" name="address" value="{{ old('address') }}" required>
        </div>

            <label for="county_id">{{ __('Country') }}</label>
            <div>
                <select name="country_id" id="country-dropdown" class="form-control">
                    <option value="">-- Select Country --</option>
                    @foreach ($countries as $id => $name)
                        <option value="{{ $id }}">
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

             <label for="state_id">{{ __('State') }}</label>
            <div class="form-group mb-3">
                <select name="state_id" id="state-dropdown" class="form-control">
                </select>
            </div>

            <label for="city_id">{{ __('City') }}</label>
            <div class="form-group">
                <select name="city_id" id="city-dropdown" class="form-control">
                </select>
            </div>
            <div>
            <label for="zip">{{ __('Zip Code') }}</label>
            <input id="zip" type="text" name="zip" value="{{ old('zip') }}" required>
        </div>
  
            <div>
                <button type="submit">{{ __('Register') }}</button>
            </div>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('#country-dropdown').on('change', function() {
            var idCountry = this.value;
            $("#state-dropdown").html('');
            $.ajax({
                url: "{{ url('api/fetch-states') }}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#state-dropdown').html(
                        '<option value="">-- Select State --</option>');
                    $.each(result.states, function(key, value) {
                        $("#state-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                }
            });
        });

        $('#state-dropdown').on('change', function() {
            var idState = this.value;
            $("#city-dropdown").html('');
            $.ajax({
                url: "{{ url('api/fetch-cities') }}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    $.each(res.cities, function(key, value) {
                        $("#city-dropdown").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        });

    });
</script>
