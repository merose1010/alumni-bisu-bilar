<section id="alumni-id-sec">
    <div class="overlay">
        <div class="alumni-id-wrapper">
            @if(Auth::user()->alumni_id_applied)
                <main class="already_applied">
                    <div class="content">
                        <i class="fas fa-check-circle"></i>
                        <span>You have already applied for an Alumni ID</span>
                    </div>
                </main>
            @else

            <h2>Application for Alumni ID</h2>
            <p>Please write the information legibly</p>
            <hr style="">
            <form action="/home-alumni-id-post" enctype="multipart/form-data" id="alumni_id_form" method="post">
                @csrf
                <div class="fields">
                    <div class="group">
                        <div class="input-field" style="display: none;">
                            <label for="message-text" class="">Alumni ID No. : <span class="sub-name">(leave it blank)</span> </label>
                            <input type="text" class="" id="a_no" name="a_no" placeholder=""></input>
                        </div>


                        <div class="input-field">
                            <label for="message-text" class="">Name: <span class="sub-name">(ex: CERO, JOSENITO A.)</span> </label>
                            <input type="text" class="" id="name" name="name"placeholder="Enter your name" value="{{ Auth::user()->last_name }}, {{ Auth::user()->first_name }} {{ Auth::user()->middle_name }}"></input>
                            <span class="error-text" id="error_name">@error('name') {{$message}} @enderror</span>
                        </div>
                        
                        
                        <div class="input-field">
                            <label for="message-text" class="">Citizenship: <span class="sub-name">(ex: Filipino)</span> </label>
                            <input type="text" class="" id="citizenship" name="citizenship" placeholder="Enter your Citizenship" value="{{ old('citizenship') }}"></input>
                            <span class="error-text" id="error_name">@error('name') {{$message}} @enderror</span>
                        </div>
                    </div>

                    <div class="group">
                        <div class="input-field">
                            <label for="id_no" class="">ID No. : <span class="sub-name">(Year Grauduated)</span> </label>
                            <select id="id_no" name="id_no" value="{{ old('id_no') }}">
                                <option value="" disabled>Select a year</option>
                                <?php
                                for ($i = 2010; $i <= 2050; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                            <span class="error-text" id="error_id_no">@error('id_no') {{$message}} @enderror</span>
                        </div>
                            <div class="input-field">
                                <label for="id_no" class="">Month : <span class="sub-name">(Month Graduated)</span> </label>
                                <select id="month_grad" name="month_grad" value="{{ old('month_grad') }}">
                                    <option value="" disabled>Select a month</option>
                                    <?php
                                    $months = [
                                        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
                                    ];
                                    foreach ($months as $month) {
                                        echo "<option value='$month'>$month</option>";
                                    }
                                    ?>
                                </select>
                                <span class="error-text" id="error_id_no">@error('id_no') {{$message}} @enderror</span>
                            </div>

                    </div>


                    <div class="group">
                        <div class="input-field">
                            <label for="message-text" class="">Birthday: <span></span> </label>
                            <input type="date" class="" id="bday" name="bday" placeholder="Enter your Birthday" value="{{ old('bday') }}"></input>
                            <span class="error-text" id="error_bday">@error('bday') {{$message}} @enderror</span>

                        </div>

                        <div class="input-field">
                            <label for="message-text" class="">Course: <span></span> </label>
                            <input type="text" class="" id="course" name="course" placeholder="Enter your course" value="{{ Auth::user()->course }}"></input>
                            <span class="error-text" id="error_course">@error('course') {{$message}} @enderror</span>
                        </div>
                    </div>

                    
                    <div class="group">

                        <div class="input-field">
                            <label for="message-text" class="">Address: <span></span> </label>
                            <input type="text" class="" id="address" name="address" placeholder="Enter your address" value="{{ Auth::user()->address }}"></input>
                            <span class="error-text" id="error_add">@error('address') {{$message}} @enderror</span>
                        </div>
                    </div>


                    <div class="pay_med_wrapper">

                        <span class="pay_med_title">Payment Method</span>
                        <span class="pay_med_price">Amount( ₱ {{ $payment->alumni_id_price}}.00)</span>
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
                                        <input type="number" class="" id="price" name="price" placeholder="Enter G-Cash reference no." value="{{ $payment->alumni_id_price}}"></input>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="addphoto">
                    <img src="images/signature.png"
                    id="change-img-add" style="object-fit: cover;">
                    <p>Add your Signature <span class="error-text" id="error_sig">@error('signature') {{$message}} @enderror</span></p>
                </div>

                <div class="img-button mt-3">
                    <input type="file" name="signature" class="signature" id="addphotoBtn" accept="image/jpg, image/jpeg, image/png" value="{{ old('signature') }}" hidden>
                    <button onclick ="addPhoto()" type="button" class="addphoto-btn" id="addphotoBtn">Choose Image</button>
                </div>

                <button type="submit"  onclick="this.disabled=true;this.form.submit();" id="submit_alumni_id">SUBMIT</button>
            </div>
        </form>

        @endif
    </div>
</section>