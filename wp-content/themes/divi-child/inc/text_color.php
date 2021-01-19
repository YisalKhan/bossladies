<!--<dd class="accordion-content accordionItem is-collapsed" id="accordion2" aria-hidden="true">-->
    <div class="container-fluid" style="padding-top: 20px;">
        <div class="card-body py-5">
            <div class="text-center">
                <div class="row no-gutters justify-content-center">
                    <div class="col-auto mr-2">
                        <div class="small text-secondary">Background</div>
                        <input type='text' id="BgColorSelect"
                               class="border border-secondary color-selection"/>
                    </div>
                    <div class="col-auto mr-2">
                        <div class="small text-secondary">Accent</div>
                        <input type='text' id="AccentColorSelect"
                               class="border border-secondary color-selection"/>
                    </div>
                    <div class="col-auto">
                        <div class="small text-secondary">Text</div>
                        <input type='text' id="TextColorSelect"
                               class="border border-secondary color-selection"/>
                    </div>
                </div>
                <div class="mt-2 text-secondary font-italic small">
                    Note: The Accent color it not used on all bar styles
                </div>
            </div>
            <div class="mt-5 mx-auto" style="max-width: 800px;">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Line 1</div>
                    </div>
                    <input type="text" class="form-control" placeholder="Your Name"
                           value="Scarlett Russell" id="line1keyup">
                </div>
                <div class="input-group mt-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Line 2</div>
                    </div>
                    <input type="text" class="form-control"
                           placeholder="Title and/or designations" id="line2-input" data-bind="line1b" value="Associate Broker License #BR12345678">
                </div>
                <div class="input-group mt-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Line 3</div>
                    </div>
                    <input type="text" class="form-control" placeholder="(602) 124-4321" value="(602) 124-4321"
                           id="line3-input" data-bind="line2">
                </div>
                <div class="input-group mt-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Line 4</div>
                    </div>
                    <input type="text" class="form-control"
                           placeholder="www.yourwebsite.com"
                           value="www.yourwebsite.com" id="line4-input" data-bind="line3">
                </div>
            </div>
            <div class="mt-5 mx-auto text-center">
                <div class="row no-gutters justify-content-center align-items-center">
                    <div class="col-auto mr-2 small-text">
                        Line 1 Font Style
                    </div>
                    <div class="col-auto">
                        <select class="form-control d-inline-block w-auto px-3" id="linetext-font">
                            <option value="font-set-1">Standard</option>
                            <option value="font-set-2">Modern</option>
                            <option value="font-set-3">Classic</option>
                            <option value="font-set-4">Narrow</option>
                            <option value="font-set-5">Hand</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <button class="btn btn-sm btn-light collapsed" role="button" aria-expanded="false"
                        aria-controls="step1" onclick="tabSwitch('ui-id-1')">
                    Previous
                </button>
                <button class="btn btn-sm btn-info px-4 collapsed" onclick="tabSwitch('ui-id-5')" role="button" aria-expanded="false"
                        aria-controls="step3">
                    Continue
                </button>
            </div>
        </div>
    </div>
<!--</dd>-->
<script>
    $(document).ready(function () {
        $('#line1keyup').keyup(function () {
            $('.post-branding-line1').text($(this).val());
            localStorage.setItem('line1text', $(this).val());
        });
        $('#line2-input').keyup(function () {
            $('.post-branding-line1b').text($(this).val());
            localStorage.setItem('line2text', $(this).val());
        });
        $('#line3-input').keyup(function () {
            $('.post-branding-line2').text($(this).val());
            localStorage.setItem('line3text', $(this).val());
        });
        $('#line4-input').keyup(function () {
            $('.post-branding-line3').text($(this).val());
            localStorage.setItem('line4text', $(this).val());
        });
    });
</script>
