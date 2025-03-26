<?php
    include './includes/header.php';
?>
    <?php
        include './includes/navigation-2.php';
    ?>

<div class='page-wrapper'>
    <?php
      $arg = array(
        'url' => './quick-quote',
        'url_text' => 'Quick Quote',
        'title' => 'Quick Quote'
      );
      banner_section($arg);
    ?>

    <div id="project-section">
        <div class="container">
            <div class="theme-title">
                <h2>Quick Quote</h2>
                <p>Hi there! I'm so excited to get started working with you. To keep this project on track and accomplish all our 
                goals, please help me get to know you, your business, and the project more thoroughly</p>
            </div>
        </div>
        <div class='form-cards'>
            <div class='form-card' id='form-card-1'>
                <div class='form-card-head'>
                    <div class='form-card-title'>
                        Get a Quick Quote
                    </div>
                </div>
                <div class='form-card-body'>
                    <div class='form-card-body-inner'>
                        <input type='hidden' name='create_quote' id='create_quote' value='true'>
                        <div class='form-card-input-group' id='form-card-input-group-1'>
                            <label for="pitch">1. Do you Need a new site or a current one redesigned?</label>
                            <!-- <div class='info'>(Redesign = €80 New = €100)</div> -->
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input name="radio-1" type="radio" class="form-check-input" id='radio-1a'>
                                    <span class="form-check-label">Redesign</span>
                                </div>
                                <div class="form-check">
                                    <input name="radio-1" type="radio" class="form-check-input" id='radio-1b'>
                                    <span class="form-check-label">New</span>
                                </div>
                            </div>
                            <div class='error' id='radio1-error'></div>
                        </div>
                        <div class='form-card-input-group' id='form-card-input-group-2'>
                            <label for="pages">2. How many pages do you need?</label>
                            <input type="number" name='pages' id='pages' class="form-control" placeholder="1">
                            <div class='error' id='pageError'></div>
                            <div class='error' id='pages-error'></div>
                        </div>
                        <div class='form-card-input-group' id='form-card-input-group-3'>
                            <label for="future">3. Do you have a Logo?</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input name="radio-2" type="radio" class="form-check-input" id='radio-2a'>
                                    <span class="form-check-label">I have a logo I am happy to use</span>
                                </div>
                                <div class="form-check">
                                    <input name="radio-2" type="radio" class="form-check-input" id='radio-2b'>
                                    <span class="form-check-label">I have a logo that needs to be modernised</span>
                                </div>
                                <div class="form-check">
                                    <input name="radio-2" type="radio" class="form-check-input" id='radio-2c'>
                                    <span class="form-check-label">I need a logo</span>
                                </div>
                            </div>
                            <div class='error' id='radio2-error'></div>
                            <!-- <div class='radio-row' id='radio-row-3'>
                                <div class="input-group input-group-checkbox">
                                    <input type="radio" name="redesign" id="redesign" value='1'>
                                    <span class="checkbox-text">I have a logo I am happy to use</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="radio" name="new" id="new" value='1'>
                                    <span class="checkbox-text">I have a logo that needs to be modernised</span>
                                </div>
                                <div class="input-group input-group-checkbox">
                                    <input type="radio" name="new" id="new" value='1'>
                                    <span class="checkbox-text">I need a logo</span>
                                </div>
                            </div> -->
                        </div>
                        <div class='form-card-input-group' id='form-card-input-group-4'>
                            <label for="content">4. Do you need content written?</label>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input name="radio-3" type="radio" class="form-check-input" name='content' id='radio-3a'>
                                    <span class="form-check-label">No i will supply written content</span>
                                </div>
                                <div class="form-check">
                                    <input name="radio-3" type="radio" class="form-check-input" name='content' id='radio-3b'>
                                    <span class="form-check-label">Yes I need written content</span>
                                </div>
                            </div>
                            <div class='error' id='radio3-error'></div>
                        </div>
                        <div id='msg-response'></div>
                        <div class='btns-wrapper admin-form-btns'>
                            <span class='cancel'>
                                <span class='cancel'>Back</span>
                            </span>
                            <span class='btn' onclick='quick_quote(event)'>Next</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>





<?php
    include './includes/footer.php';
?>