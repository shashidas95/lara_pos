<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Verify OTP</h3>
                </div>

                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">Verify OTP
                        </p>

                        <form>
                            <div class="input-group mb-3">
                                <input id="otp" type="text" class="form-control" placeholder="otp">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button onclick="VerifyOTP()" type="submit" class="btn btn-primary btn-block">Next
                                    </button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <p class="mt-3 mb-1">
                            <a href="{{ url('userLogin') }}">Login</a>
                        </p>
                        <p class="mb-0">
                            <a href="{{ url('userRegistration') }}" class="text-center">Register a new membership</a>
                        </p>
                    </div>
                    <!-- /.login-card-body -->
                </div>
            </div>
        </div>
    </div>
    <script>
        async function VerifyOTP() {
            let otp = document.getElementById('otp').value;
            if (otp.length !== 4) {
                errorToast('Invalid OTP ')
            } else {
                showLoader();
                const res = await axios.post('/verify-otp', {
                    otp: otp,
                    email: sessionStorage.getItem('email')
                });
                hideLoader();
                if (res.status === 200 && res.data['status'] == 'success') {
                    successToast(res.data['message']);
                    sessionStorage.clear()
                    setTimeout(() => {
                        window.location.href = '/resetPassword';
                    }, 2000);

                } else {
                    errorToast(res.data['message']);
                }
            }
        }
    </script>
