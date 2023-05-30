
<section class="all-payment-section" style="width: 100%;">

    @if (session('status'))
    <h6 class="alert alert-success my-0" id="myAlert" style="font-size: 14px;">{{ session('status') }}</h6>
    @endif


    <div class="pb-3 d-flex justify-content-between px-3 pt-4">
    <h5 class="title">Payment Settings</h5>
    </div>

    <div class="payment-settings-wrapper px-3 py-2" style="width: 100%;">
        <form action="/update_payment" enctype="multipart/form-data" method="post">
            @csrf
            @method('put')
            <div class="group1">
                <div class="form-group pb-2" hidden>
                    <label for="exampleFormControlInput1">ID</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="payment_id" placeholder="Enter Name" value="{{ $payment->id}}">
                </div>

                <div class="form-group pb-2">
                    <label for="exampleFormControlInput1">Reciever Name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="reciever_name" placeholder="Enter Name" value="{{ $payment->reciever_name}}">
                </div>

                <div class="form-group pb-2">
                    <label for="exampleFormControlInput1">Gcash No</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="gcash_no" placeholder="Enter No." value="{{ $payment->gcash_no}}">
                </div>

                <label for="exampleFormControlInput1">Alumni ID price</label>
                <div class="input-group pb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">₱</span>
                    </div>
                    <input type="number" class="form-control" id="exampleFormControlInput1" name="alumni_id_price" placeholder="Enter price" value="{{ $payment->alumni_id_price}}.00">
                </div>

                <label for="exampleFormControlInput1">Alumi Membership price</label>
                <div class="input-group pb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">₱</span>
                    </div>
                    <input type="number" class="form-control" id="exampleFormControlInput1" name="alumni_mem_price" placeholder="Enter price" value="{{ $payment->alumni_mem_price}}.00">
                </div>


            </div>

            <div class="group2">

                <div class="addphoto">

                    @if($payment->gcash_qr)
                        <img src="{{ asset('images/qr/' . $payment->gcash_qr) }}"  id="change-img-add" style="object-fit: cover;">
                    @else
                        <img src="images/LOGO.png" id="change-img-add" style="object-fit: cover;">
                    @endif
                </div>

                <div class="img-button mt-3">
                    <input type="file" name="gcash_qr" id="addphotoBtn" accept="image/jpg, image/jpeg, image/png" hidden>
                    <button onclick ="addPhoto()" type="button" class="addphoto-btn btn btn-primary" id="addphotoBtn">Choose Image</button>
                </div>
            </div>

            <button class="btn btn-success mt-2" type="submit">Update</button>
        </form>
    </div>






</section>

