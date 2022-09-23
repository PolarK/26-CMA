<?php

$err_msgs = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (in_array('.', $err_msgs) == FALSE) {
        // temporary redirect
        echo ('success');
    }
}

?>
<div id="content" class="container-fluid p-5">

    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center text-center h-100">
        <div class="card-body">
            <h1 class="display-4">Submit Your New Finding!</h1>
            <p class="lead">We would love to see what you've come up with! So why not submit your paper here and well review it ASAP!</p>
            <div style="margin: auto; width: 36rem;">
                <br>
                <!--Start Event Register Form-->
                <form id="SubmitPaperForm" action="#" method="post">
                    <div class="form-group mb-2 mr-2">
                        <div class="row">
                            <!-- Submit Paper -->
                            <div class="col">
                                <div class="form-group">
                                    <input id="SubmitPaper" name="SubmitPaper" type="file" required class="form-control flex-column" accept="application/pdf,application/msword,
  application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    <label for="SubmitPaper"> Attach a .doc, .docx, or .pdf file </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-check">
                            <div class="col">
                                <input class="form-check-input" type="checkbox" name="submitCheck" id="submitCheck" type="checkbox" required>
                                <label class="form-check-label" for="submitCheck">
                                    By submitting, you are agreeing to to our <a href="">Privacy Policies</a>
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="checkbox" name="uRemember" id="TermsConditions" type="checkbox" required>
                                <label class="form-check-label" for="TermsConditions">
                                    By submitting, you are agreeing to our <a href="">Terms & Conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group btn-group-lg d-grid gap-2">
                        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <!--End Register Appointment Form-->
            </div>
        </div>
    </div>
</div>