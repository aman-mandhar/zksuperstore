@extends('layouts.admin')
@section('content')
<div class="container">
    <h2>Create New Customer</h2>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="col-md-6">
            <select id="city" class="form-control @error('city') is-invalid @enderror" name="city" required>
                <option value="">Select nearest City</option>
                @foreach ($cities as $city)
                <option value="{{ $city }}" {{ old('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                @endforeach
            </select>
    
            @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
        
            <div class="col-md-6">
                <input id="name" type="text" hidden class="form-control @error('name') is-invalid @enderror" name="name" value="Not Set" placeholder="Name of User" default="Not set" required>
                <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" placeholder="Mobile Number" oninput="updateEmail()" required autocomplete="mobile_number" value={{ $search }}>
                <input id="ref_mobile_number" type="text" class="form-control @error('ref_mobile_number') is-invalid @enderror" name="ref_mobile_number" placeholder="Refferal Mobile Number" value="{{ old('ref_mobile_number', '0000000000') }}" required autocomplete="ref_mobile_number">
                <input id="gst_no" placeholder="GST No." class="form-control @error('gst_no') is-invalid @enderror" name="gst_no" value="{{ old('gst_no') }}" autocomplete="gst_no">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" placeholder="Customer Email" value="{{ $search }}@zksuperstore.com">
                <input id="password" type="password" hidden class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', '12345678') }}" required autocomplete="new-password">
                <input id="password-confirm" type="password" hidden class="form-control" name="password_confirmation" value="{{ old('password', '12345678') }}" required autocomplete="new-password">
            </div>
            <div class="col-md-6">
                <select id="user_role" hidden class="form-control @error('user_role') is-invalid @enderror" name="user_role" required>
                    <option value="0" {{ old('user_role') == '0' ? 'selected' : '' }}>Customer</option>
                    <option value="1" {{ old('user_role') == '1' ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ old('user_role') == '2' ? 'selected' : '' }}>Store</option>
                    <option value="3" {{ old('user_role') == '3' ? 'selected' : '' }}>Warehouse</option>
                    <option value="4" {{ old('user_role') == '4' ? 'selected' : '' }}>Sub-Warehouse</option>
                    <option value="5" {{ old('user_role') == '5' ? 'selected' : '' }}>Employee</option>
                    <option value="6" {{ old('user_role') == '6' ? 'selected' : '' }}>Merchant</option>
                    <option value="7" {{ old('user_role') == '7' ? 'selected' : '' }}>Transporter</option>
                    <option value="8" {{ old('user_role') == '8' ? 'selected' : '' }}>Delivery Partner</option>
                    <option value="9" {{ old('user_role') == '9' ? 'selected' : '' }}>Business Promoter</option>
                    <!-- Add more options for different user roles if needed -->
                </select>

                @error('user_role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    // Function to update the email field based on mobile_number
    function updateEmail() {
        var mobileNumberInput = document.getElementById('mobile_number');
        var emailInput = document.getElementById('email');

        if (mobileNumberInput && emailInput) {
            var mobileNumberValue = mobileNumberInput.value;
            var domain = '@zksuperstore.com';

            // Update the email input value
            emailInput.value = mobileNumberValue + domain;
        }
    }

    // Attach the event listener to the mobile_number input
    document.getElementById('mobile_number').addEventListener('input', updateEmail);
</script>
@endsection