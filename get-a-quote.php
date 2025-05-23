<?php
    include './includes/header.php';
?>
    <?php
        include './includes/navigation-2.php';
    ?>

<div class='page-wrapper'>
    <?php
      $arg = array(
        'url' => './get-a-quote',
        'url_text' => 'Get a Quote',
        'title' => 'Get a Quote'
      );
      banner_section($arg);
    ?>

    <div id="project-section">
        <div class="container">
            <div class="theme-title">
                <h2>Request a Quote</h2>
                <p>Hi there! I'm so excited to get started working with you. To keep this project on track and accomplish all our 
                goals, please help me get to know you, your business, and the project more thoroughly</p>
            </div>
        </div>
        <div class='form-cards'>
            <div class='form-card' id='form-card-1'>
                <div class='form-card-head'>
                    <div class='form-card-title'>
                        YOUR WORK
                    </div>
                </div>
                <div class='form-card-body'>
                    <div class='form-card-body-inner'>
                        <input type='hidden' name='create_quote' id='create_quote' value='true'>
                        <div class='form-card-textarea-group'>
                            <label for="pitch">1. Describe your business. What's your elevator pitch?</label>
                            <textarea name="pitch" id="pitch" rows="2"></textarea>
                            <div class='error' id='pitchError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="key_val">2. What are your key values?</label>
                            <textarea name="key_val" id="key_val" rows="2"></textarea>
                            <div class='error' id='keyvalError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="future">3. What does your future look like?</label>
                            <textarea name="future" id="future" rows="2"></textarea>
                            <div class='error' id='futureError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="competitors">4. Who are your main competitors?</label>
                            <textarea name="competitors" id="competitors" rows="2"></textarea>
                            <div class='error' id='competitorsError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="diff">5. What makes you different from your competitors?</label>
                            <textarea name="diff" id="diff" rows="2"></textarea>
                            <div class='error' id='diffError'></div>
                        </div>
                        <div class='btns-wrapper admin-form-btns'>
                            <span class='cancel'></span>
                            <span class='btn' onclick='nextCard(2)'>Next</span>
                        </div>
                        <!-- <div id='msg-response'></div> -->
                    </div>
                </div>
            </div>
            <div class='form-card' id='form-card-2'>
                <div class='form-card-head'>
                    <div class='form-card-title'>
                        YOUR GOALS
                    </div>
                </div>
                
                
                <div class='form-card-body'>
                    <div class='form-card-body-inner'>
                        <div class='form-card-textarea-group'>
                            <label for="goals">1. What are your top 3 goals for this project? Describe your business. What's your elevator pitch?</label>
                            <textarea name="goals" id="goals" rows="2"></textarea>
                            <div id='goalsError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="defsuccess">2. What will define this project as successful?</label>
                            <textarea name="defsuccess" id="defsuccess" rows="2"></textarea>
                            <div id='defsuccessError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="avoidfail">3. How can we avoid failure?</label>
                            <textarea name="avoidfail" id="avoidfail" rows="2"></textarea>
                            <div id='avoidfailError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="leastfavsites">4. Do you have any least favorite websites?</label>
                            <textarea name="leastfavsites" id="leastfavsites" rows="2"></textarea>
                            <div id='leastfavsitesError'></div>
                        </div>
                        <div class='btns-wrapper admin-form-btns'>
                            <span class='cancel'>
                                <span class='cancel' onclick='prevCard(1)'>Back</span>
                            </span>
                            <span class='btn' onclick='nextCard(3)'>Next</span>
                        </div>
                        <!-- <div id='msg-response'></div> -->
                    </div>
                </div>
            </div>
            <div class='form-card' id='form-card-3'>
                <div class='form-card-head'>
                    <div class='form-card-title'>
                        YOUR AUDIENCE
                    </div>
                </div>
                <div class='form-card-body'>
                    <div class='form-card-body-inner'>
                        <div class='form-card-textarea-group'>
                            <label for="audience">1. Who is your target audience?</label>
                            <textarea name="audience" id="audience" rows="2"></textarea>
                            <div class='error' id='audienceError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="curaudience">2. Is this your current audience? If not, how can we bridge the gap?</label>
                            <textarea name="curaudience" id="curaudience" rows="2"></textarea>
                            <div class='error' id='curaudienceError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="information">3. What information does your audience need to know from your website?</label>
                            <textarea name="information" id="information" rows="2"></textarea>
                            <div class='error' id='informationError'></div>
                        </div>
                        <div class='btns-wrapper admin-form-btns'>
                            <span class='cancel'>
                                <span class='cancel' onclick='prevCard(2)'>Back</span>
                            </span>
                            <span class='btn' onclick='nextCard(4)'>Next</span>
                        </div>
                        <!-- <div id='msg-response'></div> -->
                    </div>
                </div>
            </div>
            <div class='form-card' id='form-card-4'>
                <div class='form-card-head'>
                    <div class='form-card-title'>
                        YOUR WEBSITE
                    </div>
                </div>
                <div class='form-card-body'>
                    <div class='form-card-body-inner'>
                        <div class='form-card-textarea-group'>
                            <label for="website_url">1. Do you currently have a website? If so, please provide the URL.</label>
                            <textarea name="website_url" id="website_url" rows="2"></textarea>
                            <div class='error' id='websiteurlError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="qualities">2. What are 3 things your site does well?</label>
                            <textarea name="qualities" id="qualities" rows="2"></textarea>
                            <div class='error' id='qualitiesError'></div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="tochange">3. What are 3 things you would like to change about your site?</label>
                            <textarea name="tochange" id="tochange" rows="2"></textarea>
                            <div class='error' id='tochangeError'></div>
                        </div>  
                        <div class='form-card-textarea-group'>
                            <label for='features'>4. Is there anything in particular you want on your site?</label>
                            <div class='checkbox-row'>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="menu" id="menu" value='1'>
                                    <span class="checkbox-text">menu</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="responsive" id="responsive" value='1'>
                                    <span class="checkbox-text">separate mobile/responsive site</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="booking" id="booking" value='1'>
                                    <span class="checkbox-text">book an appointment</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="blog" id="blog" value='1'>
                                    <span class="checkbox-text">blog</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="video" id="video" value='1'>
                                    <span class="checkbox-text">video integration</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="chat" id="chat" value='1'>
                                    <span class="checkbox-text">website chat</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="social_media" id="social_media" value='1'>
                                    <span class="checkbox-text">social media integration</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="contact_form" id="contact_form" value='1'>
                                    <span class="checkbox-text">contact form</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="other" id="other" value='1'>
                                    <span class="checkbox-text">other:</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="photo_galleries" id="photo_galleries" value='1'>
                                    <span class="checkbox-text">photo galleries</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="checkbox" name="open_hours" id="open_hours" value='1'>
                                    <span class="checkbox-text">open hours</span>
                                </div>
                            </div>
                        </div>

                        <div class='form-card-textarea-group'>
                            <label for="deadline_budget">5. What's your deadline and budget? How flexible are they?</label>
                            <textarea name="deadline_budget" id="deadline_budget" rows="2"></textarea>
                            <div class='error' id='deadlinebudgetError'></div>
                        </div>

                        <div class='btns-wrapper admin-form-btns'>
                            <span class='cancel'>
                                <span class='cancel' onclick='prevCard(3)'>Back</span>
                            </span>
                            <span class='btn' onclick='nextCard(5);'>Next</span>
                        </div>
                        <!-- <div id='msg-response'></div> -->
                    </div>
                </div>
            </div>
            <div class='form-card' id='form-card-5'>
                <div class='form-card-head'>
                    <div class='form-card-title'>
                        Contact Information
                    </div>
                </div>
                <div class='form-card-body'>
                    <div class='form-card-body-inner'>
                        <div class='form-card-group'>
                            <div class='form-card-textarea-group'>
                                <label for="fname">First Name</label>
                                <input name="fname" id="fname" type="text">
                                <div class='error' id='fnameError'></div>
                            </div>
                            <div class='form-card-textarea-group'>
                                <label for="lname">Last Name</label>
                                <input name="lname" id="lname" type="text">
                                <div class='error' id='lnameError'></div>
                            </div>
                        </div>
                        <div class='form-card-textarea-group'>
                            <label for="email">Email</label>
                            <input name="email" id="email" type="email">
                            <div class='error' id='emailError'></div>
                        </div>     
                        <div class='form-card-textarea-group'>
                            <label for="phone">Phone</label>
                            <input name="phone" id="phone" type="text">
                            <div class='error' id='phoneError'></div>
                        </div>

                        <div class='btns-wrapper admin-form-btns'>
                            <span class='cancel'>
                                <span class='cancel' onclick='prevCard(4)'>Back</span>
                            </span>
                            <span class='btn' onclick='get_a_quote(event);'>Finish</span>
                        </div>
                        <!-- <div id='msg-response'></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>




<?php
    include './includes/footer.php';
?>