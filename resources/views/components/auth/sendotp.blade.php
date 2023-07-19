<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                    <h3 class="text-center font-weight-light my-4">Send OTP</h3>
                </div>

                <div class="card">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.
                        </p>

                        <form action="recover-password.html" method="post">
                            <div class="input-group mb-3">
                                <input id="emailForOtp" type="email" class="form-control" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button onclick="SendOTP()" type="submit" class="btn btn-primary btn-block">Next
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
        async function SendOTP() {
            let email = document.getElementById('emailForOtp').value;
            if (email.length === 0) {
                errorToast('Email is required')
            } else {
                showLoader();
                const res = await axios.post('/send-otp', {
                    email: email,
                    
                });
                hideLoader();
                if (res.status === 200 && res.data['status'] == 'success') {
                    successToast(res.data['message']);
                    setTimeout(() => {
                        window.location.href = '/verify-otp';
                    }, 2000);

                } else {
                    errorToast(res.data['message']);
                }
            }
        }
    </script>
