<?php
    include './includes/header.php';
?>
<?php
    include './includes/navigation-2.php';
?>

<div class='page-wrapper'>


    <?php
      $arg = array(
        'url' => './contact',
        'url_text' => 'Contact',
        'title' => 'Contact Us'
      );
      banner_section($arg);
    ?>
    <!--==========================
      Contact Section
    ============================-->
    <section id="contact-section">
        <div class="container">
          <!-- <div class='map'>
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9854.858457663762!2d-10.174317212920313!3d51.86616692353502!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x484f8c6f2b2a35a7%3A0xd4eaf0604be80317!2sFarranahown%2C%20Co.%20Kerry%2C%20V23%20KD62%2C%20Ireland!5e0!3m2!1sen!2sbd!4v1656753973819!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div> -->
        <div class="row">
          <div class="col-12 mb-5 position-relative">
            <!-- <h2 class="section-title text-center mb-4">Send a Message</h2> -->
          </div>
        </div>
        <div class="row justify-content-between">
          <div class="col-lg-6 mb-50">
            <form action="#" class="form contact-form" onsubmit='return validateContact(event)'>
              
              <div class="row mb-4">
                <div class="form-group col-6">
                  <input type="text" class="form-control" name='fname' id='fname' placeholder="First name">
                  <div class='error' id='fnameError'></div>
                </div>
                <div class="form-group col-6">
                  <input type="text" class="form-control" name='lname' id='lname' placeholder="Last name">
                  <div class='error' id='lnameError'></div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="form-group col-12">
                  <input type="email" class="form-control" name='email' id='email' placeholder="Email address">
                  <div class='error' id='emailError'></div>
                </div>
              </div>
              <div class="row mb-4">
                <div class="form-group col-12">
                  <input type="number" class="form-control" name='phone' id='phone' placeholder="Phone">
                  <div class='error' id='phoneError'></div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="form-group col-12">
                  <input type="text" class="form-control" name='subject' id='subject' placeholder="Subject of the message">
                  <div class='error' id='subjectError'></div>
                </div>
              </div>

              <div class="row mb-4">
                <div class="form-group col-12">
                  <textarea name="msg" id="msg" cols="30" rows="10" class="form-control" placeholder="Type your message here.."></textarea>
                  <div class='error' id='msgError'></div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <input type="submit" class="btn btn-primary" value="Send Message">
                </div>
              </div>
              
              <div id='msg-response'></div>

            </form>
          </div>
          <?php
            $coninfo = new ContactInfo;
            echo $coninfo->contact_info();
          ?>
          <!-- <div class="col-lg-5">
            <div class='contact-info-heading'>Contact Information</div>
            <ul class="list-unstyled mb-5">
              <li class="mb-3">
                <strong class="d-block mb-1">Address</strong>
                <span>203 Fake St. Mountain View, San Francisco, California, USA</span>
              </li>
              <li class="mb-3">
                <strong class="d-block mb-1">Phone</strong>
                <span>+1 232 3235 324</span>
              </li>
              <li class="mb-3">
                <strong class="d-block mb-1">Email</strong>
                <span>youremail@domain.com</span>
              </li>
            </ul>

          </div> -->
        </div>
      </div>
    </section>


</div>




<?php
    include './includes/footer.php';
?>