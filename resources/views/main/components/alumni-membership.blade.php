<section id="alumni-member-sec">
    <div class="alumni-member-wrapper">
        @if(Auth::user()->alumni_mem_applied)
            <main class="already_applied">
                <div class="content">
                    <i class="fas fa-check-circle"></i>
                    <span>You have already applied for an Alumni Membership</span>
                </div>
            </main>
        @else
        <h2>Application for Alumni Membership</h2>
        <p>Please write the information legibly</p>
        <hr style="">
        <form action="/home-alumni-membership-post" enctype="multipart/form-data" id="alumni_mem_form" method="post">
        @csrf
        <div class="group">
            <div class="fields">
                <label for="message-text" class="">Name: <span class="sub-name">(ex: CERO, JOSENITO A.)</span> </label>
                <input type="text" class="" id="name" name="name" placeholder="Enter your name" value="{{ Auth::user()->last_name }}, {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}"></input>
                <span class="error-text" id="error_name">@error('name') {{$message}} @enderror</span>
            </div>

            <div class="fields">
                <label for="message-text" class="">Address: <span></span> </label>
                <input type="text" class="" id="address" name="address" placeholder="Enter your address" value="{{ Auth::user()->address }}"></input>
                <span class="error-text" id="error_add">@error('address') {{$message}} @enderror</span>
            </div>
        </div>

        <div class="group">
            
            <div class="fields">
                <label for="message-text" class="">Birthday: <span></span> </label>
                <input type="date" class="" id="bday" name="bday" value ="{{ old('bday') }}" placeholder="Enter your Birthday"></input>
                <span class="error-text" id="error_bday">@error('bday') {{$message}} @enderror</span>
            </div>

            <div class="fields">
                <label for="message-text" class="">Contact No. : <span></span> </label>
                <input type="number" class="" id="con_num" name="con_num" value ="{{ old('con_num') }}" placeholder="Enter your number"></input>
                <span class="error-text" id="error_num">@error('con_num') {{$message}} @enderror</span>
            </div>
            
        </div>

        <div class="pay_med_wrapper">

            <span class="pay_med_title">Payment Method</span>
            <span class="pay_med_price">Amount( ₱ {{ $payment->alumni_mem_price}}.00)</span>
            <div class="group pay_med">

                <div class="radio-field">
                    <input type="radio" name="pay_med" id="opt1" value="Pay Cash"checked>
                    <label for="opt1">
                        Pay Using Cash
                    </label>
                </div>
                <div class="radio-field">
                    <input type="radio" name="pay_med" id="opt2" value="Pay G-Cash">
                    <label for="opt2">
                        Pay Using G-Cash
                    </label>
                </div>
            </div>

            <div class="pay_med_content">
                <span class="error-text" id="errorradio"></span>
                <div id="radio1-content">
                    <span>If you are paying cash proceed to Alumni Office in BISU-Bilar for payment.</span>
                </div>

                <div id="radio2-content" style="display: none;">
                    <div>
                        @if($payment->gcash_qr)
                            <img src="{{ asset('images/qr/' . $payment->gcash_qr) }}"  style="object-fit: cover;">
                        @else
                            <img src="images/LOGO.png" style="object-fit: cover;">
                        @endif
                    </div>

                    <div>
                        <div class="pay_med_text">
                            <!-- <span><strong>Scan QR</strong></span> -->
                            <span><strong>Scan QR</strong> or <strong>{{ $payment->gcash_no}} ({{ $payment->reciever_name}})</strong></span>
                        </div>

                        <div class="pay_med_input">
                            <label for="message-text" class="">Enter Reference #: <span></span> </label>
                            <input type="number" class="" id="ref" name="reference_no" placeholder="Enter G-Cash reference no."></input>
                            <span class="error-text" id="error_ref"></span>
                        </div>

                        <div class="price_input" hidden>
                            <input type="number" class="" id="price" name="price" placeholder="Enter G-Cash reference no." value="{{ $payment->alumni_mem_price}}"></input>
                        </div>
                    </div>

                </div>
            </div>

            </div>
        
        <button type="submit" onclick="this.disabled=true;this.form.submit();" id="submit_membership">SUBMIT</button>
    </div>
    </form>

    @endif
</section>