

<div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">

                <div class="card-body">
                    <strong><h3>{!! $data['subject'] !!}</h3></strong>
                    <p>Date: <strong>{!! date('F j, Y', strtotime(date('Y-m-d', strtotime($data['date'])))) !!}</strong></p>
                    <br>
                    <hr>
                    <br>
                    <strong><h3>Message:</h3></strong>
                    <p>{!! $data['description'] !!}</p>

                </div>
            </div>
        </div>
    </div>
</div>