@extends('layouts.admin')

@section('content')
    <div class="container col-md-6">
        <h4>User Details</h4>
        <hr>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
        <table
            class="table table-striped table-bordered table-hover table-condensed">
            <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Mobile Number</td>
                <td>
                    <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ $user->mobile_number }}" required autocomplete="mobile_number">
                    @error('mobile_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Referral Mobile Number</td>
                <td>{{ $user->ref_mobile_number }}</td>
            </tr>
            <tr>
                <td>Referral Name</td>
                <td>
                        <span id="referral_name"></span>
                </td>
            </tr>
            <tr>
                <td>User Role</td>
                <td>
                        <select id="user_role" class="form-control @error('user_role') is-invalid @enderror" name="user_role" required>
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
                </td>
            </tr>
            <tr>
                <td>City</td>
                <td>
                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $user->city }}" required autocomplete="city">
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>GST Number</td>
                <td>
                    <input id="gst_no" type="text" class="form-control @error('gst_no') is-invalid @enderror" name="gst_no" value="{{ $user->gst_no }}" autocomplete="gst_no">
                    @error('gst_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>With us from</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>User Role & Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0</td>
                    <td>Customer</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Admin</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Store</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Warehouse</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Sub-Warehouse</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Employee</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Merchant</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Transporter</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Delivery Partner</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Business Promoter</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById('ref_mobile_number').addEventListener('blur', function() {
                // Get the referral mobile number
                var referralMobileNumber = document.getElementById('ref_mobile_number').value;

                // Make an AJAX request to get the referral name
                fetch(`/getReferralName?referralMobileNumber=${referralMobileNumber}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update the Referral Name field
                        document.getElementById('referral_name').innerText = data.name;
                    })
                    .catch(error => {
                        console.error('Error fetching Referral Name:', error);
                    });
            });
    </script>
@endsection