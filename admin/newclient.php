<?php

include 'header.php';
?>

<style>
input {
    margin-top: -2px;
    margin-bottom: 20px;

}

.formdiv {
    background-color: white;
    border-radius: 5px;
    padding: 2%;
    box-shadow: rgba(17, 17, 26, 0.05) 0px 4px 16px, rgba(17, 17, 26, 0.05) 0px 8px 32px;

}
</style>
<div class="container">
    <form class="form-signin formdiv mt-5" id="clientdataform" enctype="multipart/form-data">
        <div class="row my-5">
            <h1 class="h3 mb-3 font-weight-normal">Add a new client</h1>

            <div class="col-md-6">


                <label class="">Company Name</label>
                <input type="text" id="companyName" class="form-control" name="cname" placeholder="Company Name"
                    autofocus>

                <label class=""> Email</label>
                <input type="text" id="Email" class="form-control" name="cemail" placeholder="Email" autofocus>


                <label class="">Phone</label>
                <input type="text" id="Phone" class="form-control" name="cphone" placeholder="Phone" autofocus>


                <label class="">Website</label>
                <input type="text" id="Website" class="form-control" name="cwebsite" placeholder="Website" autofocus>

                <label class=""> Address</label>
                <input type="text" id="Address" class="form-control" name="caddress" placeholder="Address" autofocus>



            </div>
            <div class="col-md-6">



                <label class=""> State</label>
                <input type="text" id="State" class="form-control" name="cstate" placeholder="State" autofocus>

                <label class=""> City/Suburb</label>
                <input type="text" id="City" class="form-control" name="ccity" placeholder="City" autofocus>

                <label class=""> postal Code</label>
                <input type="text" id="postal" class="form-control" name="cpostal" placeholder="postal Code" autofocus>

                <label class="">Country</label>
                <input type="text" id="Country" class="form-control" name="ccountry" placeholder="Country" autofocus>
                <div class="form-group">
                    <label class="">Upload Logo</label>

                    <input class="form-control" type="file" name="uploadfile" accept="image/*" id="logofile" value=""
                        required />
                </div>




            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">+ Add a new client</button>
            <h5 id="success" class="text-success text-left animated fadeInUp"></h5>
            <h5 id="error" class="text-danger text-left"></h5>
        </div>
    </form>

</div>

<?php
include 'footer.php';

?>
<script>
$(".dashboard").removeClass("active");
$(".staff").removeClass("active");
$(".clients").addClass("active");
</script>