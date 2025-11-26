<?php
include 'header.php';
$jid = $_GET['id'];
?>

<style>
    .onhoja {
        display: block !important;
    }

    .offhoja {
        display: none !important;
    }

    .don {
        display: block;
    }

    .doff {
        display: none;
    }

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

    .wrapper {
        width: 496px;
        background: #fff;
        border-radius: 10px;
        padding: 18px 25px 20px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.06);
    }

    .wrapper :where(.title, li, li i, .details) {
        display: flex;
        align-items: center;
    }

    .title img {
        max-width: 21px;
    }

    .title h2 {
        font-size: 21px;
        font-weight: 600;
        margin-left: 8px;
    }

    .wrapper .content {
        margin: 10px 0;
    }

    .content p {
        font-size: 15px;
    }

    .content ul {
        display: flex;
        flex-wrap: wrap;
        padding: 7px;
        margin: 12px 0;
        border-radius: 5px;
        border: 1px solid #a6a6a6;
    }

    .content ul li {
        color: #333;
        margin: 4px 3px;
        list-style: none;
        border-radius: 5px;
        background: #F2F2F2;
        padding: 5px 8px 5px 10px;
        border: 1px solid #e3e1e1;
    }

    .content ul li i {
        height: 20px;
        width: 20px;
        color: #808080;
        margin-left: 8px;
        font-size: 12px;
        cursor: pointer;
        border-radius: 50%;
        background: #dfdfdf;
        justify-content: center;
    }

    .content ul input {
        flex: 1;
        padding: 5px;
        border: none;
        outline: none;
        font-size: 16px;
    }

    .wrapper .details {
        justify-content: space-between;
    }

    .details button {
        border: none;
        outline: none;
        color: #fff;
        font-size: 14px;
        cursor: pointer;
        padding: 9px 15px;
        border-radius: 5px;
        background: #5372F0;
        transition: background 0.3s ease;
    }

    .details button:hover {
        background: #2c52ed;
    }
</style>
<?php
$sql = "SELECT * FROM jobs where jobs_id =  $jid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        // echo $row['jobtype'];
?>
        <div class="container mt-5">
            <div class="outerdive">
                <form class="  " id="jobdataform">
                    <div class="row my-5">
                        <h1 class="h3 mb-3 font-weight-normal">Edit Job Details</h1>

                        <div class="col-md-6">

                            <label class="">Title</label>
                            <input value="<?php echo $row['jobs_title'] ?>" type="text" id="Title" class="form-control" name="Title" placeholder="Title">

                            <label class="">Recruiter Name</label>
                            <input value="<?php echo $row['jobs_recruterName'] ?>" type="text" id="Recruiter" class="form-control" name="Recruiter" placeholder="Recruiter Name">

                            <label class="">Company Name</label>
                            <input value="<?php echo $row['cname'] ?>" type="text" id="cname" class="form-control" name="cname" placeholder="Company Name">



                            <input type="hidden" value="" id="tagsValue" />
                            <input type="hidden" value="<?php echo $jid ?>" name="jid" />

                            <div class="dropdown">

                                <label class="">Required Services</label>
                                <select name="jobtypedd" id="jobtypedd" class="form-control">
                                    <!-- <option selected disabled hidden style='display: none' value=''></option> -->
                                    <option <?php if ($row['jobtype'] == 'Resume Parsing') {
                                                echo 'selected';
                                            } ?> value="Resume Parsing">Resume Parsing</option>
                                    <option <?php if ($row['jobtype'] == 'Resume Matching') {
                                                echo 'selected';
                                            } ?> value="Resume Matching">Resume Matching</option>
                                    <option <?php if ($row['jobtype'] == 'Both Parsing and Matching') {
                                                echo 'selected';
                                            } ?> value="Both Parsing and Matching">Both Parsing and Matching</option>
                                </select>
                            </div>




                            <div class="candidates_data doff mt-4 " id="candidatesSection">
                                <div class="form-check mb-5">
                                    <input <?php if ($row['fname'] == "Yes") {
                                                echo 'checked';
                                            } ?> class="form-check-input" type="checkbox" name="isfname" value="Yes" id="flexCheckIndeterminate">
                                    <label class="form-check-label">
                                        First Name
                                    </label>
                                </div>
                                <div class="form-check mb-5">
                                    <input <?php if ($row['lname'] == "Yes") {
                                                echo 'checked';
                                            } ?> class="form-check-input" type="checkbox" name="islname" value="Yes" id="flexCheckIndeterminate">
                                    <label class="form-check-label">
                                        Last Name
                                    </label>
                                </div>
                                <div class="form-check mb-5">
                                    <input <?php if ($row['email'] == "Yes") {
                                                echo 'checked';
                                            } ?> class="form-check-input" type="checkbox" name="isemail" value="Yes" id="flexCheckIndeterminate">
                                    <label class="form-check-label">
                                        Email
                                    </label>
                                </div>
                                <div class="form-check mb-5">
                                    <input <?php if ($row['phone'] == "Yes") {
                                                echo 'checked';
                                            } ?> class="form-check-input" type="checkbox" name="isphone" value="Yes" id="flexCheckIndeterminate">
                                    <label class="form-check-label">
                                        Phone
                                    </label>
                                </div>
                                <div class="form-check mb-5">
                                    <input <?php if ($row['addresss'] == "Yes") {
                                                echo 'checked';
                                            } ?> class="form-check-input" type="checkbox" name="isaddress" value="Yes" id="flexCheckIndeterminate">
                                    <label class="form-check-label">
                                        Date Of Birth
                                    </label>
                                </div>


                            </div>
                        </div>

                    </div>

                </form>

                <input type="hidden" id="tagval" name="tagval" value="<?php echo $row['jobs_matchingKeywords'] ?>">

                <div class="tags_generator doff">
                    <div class="wrapper">
                        <div class="title">
                            <h2>Matching Keywords </h2>
                        </div>
                        <div class="content">
                            <p>Press enter or add a comma after each tag</p>
                            <ul id="tagsArea"><input id="tag" type="text" spellcheck="false"></ul>
                        </div>
                        <div class="details">
                            <p><span>10</span> tags are remaining</p>
                            <button>Remove All</button>
                        </div>
                    </div>
                </div>
        <?php

    }
}
        ?>

        <button class="btn btn-lg btn-primary btn-block" id="submiteditJob" type="submit">+ Update Job</button>

            </div>
            <div class="col-md-6">

            </div>
            <h5 id="success" class="text-success text-left animated fadeInUp"></h5>
            <h5 id="error" class="text-danger text-left"></h5>
        </div>

        </div>
        </div>
        <?php
        include 'footer.php';

        ?>



        <script>
            // var selectedScheme = 'Default';

            var e = document.getElementById("jobtypedd");

            function onChange() {
                var text = e.options[e.selectedIndex].text;
                console.log(text);
                if (text == "Resume Parsing") {
                    $("#candidatesSection").addClass("onhoja");
                    $("#candidatesSection").removeClass("doff");
                    $(".tags_generator").addClass("doff");
                    $(".tags_generator").removeClass("onhoja");
                }
                if (text == "Resume Matching") {
                    $(".tags_generator").addClass("onhoja");
                    $(".tags_generator").removeClass("doff");
                    $("#candidatesSection").addClass("doff");
                    $("#candidatesSection").removeClass("onhoja");
                }
                if (text == "Both Parsing and Matching") {
                    $("#candidatesSection").removeClass("doff");
                    $(".tags_generator").removeClass("doff");

                    $(".tags_generator").addClass("onhoja");
                    $("#candidatesSection").addClass("onhoja");
                }
                if (text == "default") {

                }
            }
            e.onchange = onChange;
            onChange();

            $(".dashboard").removeClass("active");
            $(".staff").removeClass("active");
            $(".jobs").addClass("active");
        </script>


        <script>
            const tagnames = $('#tagval').val();

            console.log(tagnames);

            const ul = document.querySelector("#tagsArea"),
                input = document.querySelector("#tag"),
                tagNumb = document.querySelector(".details span");

            const tagsInputt = $("#tagsValue");
            let tags = tagnames.split(',');
            tagsInputt.val(tags);
            let maxTags = 10;


            countTags();
            createTag();

            function countTags() {
                input.focus();
                tagNumb.innerText = maxTags - tags.length;
            }

            function createTag() {
                ul.querySelectorAll("li").forEach(li => li.remove());
                tags.slice().reverse().forEach(tag => {
                    let liTag = `<li>${tag} <i class="" onclick="remove(this, '${tag}')">x</i></li>`;
                    ul.insertAdjacentHTML("afterbegin", liTag);
                });
                countTags();
            }

            function remove(element, tag) {
                let index = tags.indexOf(tag);
                tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
                element.parentElement.remove();
                countTags();
                tagsInputt.val(tags);
            }

            function addTag(e) {
                if (e.key == "Enter") {
                    let tag = e.target.value.replace(/\s+/g, ' ');
                    if (tag.length > 1 && !tags.includes(tag)) {
                        if (tags.length < 10) {
                            tag.split(',').forEach(tag => {
                                tags.push(tag);
                                createTag();
                            });
                        }
                    }
                    e.target.value = "";
                    tagsInputt.val(tags);
                }

            }
            // input.addEventListener(addTag);
            input.addEventListener("keyup", addTag);

            const removeBtn = document.querySelector(".details button");
            removeBtn.addEventListener("click", () => {
                tags.length = 0;
                ul.querySelectorAll("li").forEach(li => li.remove());
                countTags();
            });

            // tagsInputt.value = tags;
        </script>