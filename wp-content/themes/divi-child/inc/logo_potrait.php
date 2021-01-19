<!--<dd class="accordion-content accordionItem is-collapsed" id="accordion1" aria-hidden="true">-->
    <div class="card-body py-5 text-center">
        <div class="row justify-content-around">
            <div class="col-auto">
                <label class="h3 mb-2">Portrait Photo</label>
                <div class="demo-wrap upload-demo mb-2">
                        <div class="grid">
                            <div class="col-1-2">
                                <div class="actions">
                                    <a class="btn file-btn">
                                        <span>Select Photo</span>
                                        <input type="file" id="upload" value="Choose a file"
                                               accept="image/*"/>
                                    </a>
                                </div>
                            </div>
                            <div class="col-1-2">
                                <div class="upload-demo-wrap">
                                    <div id="upload-demo"></div>
                                </div>
                            </div>
                        </div>
                </div>
                <div data-bind="hidden:showPortraitCropper">
                    <div class="img-thumbnail bg-white d-flex align-items-center justify-content-center"
                         id="pot-preview" style="width: 300px; height: 300px;">
                        <span class="text-muted small">No portrait selected</span>
                    </div>
                </div>
            </div>
            <div class="col-auto logo-div">
                <label class="h3 mb-2">Logo</label>
                <div class="demo-upload-wrap upload-logo-demo mb-2">
                    <div class="grid">
                        <div class="col-1-2">
                            <div class="actions">
                                <a class="btn file-btn">
                                    <span>Select Logo</span>
                                    <input type="file" onchange="preview_image(event)" id="upload-logo" value="Choose a file"
                                           accept="image/*"/>
                                </a>
                            </div>
                        </div>
                        <div class="col-1-2">
                            <div class="upload-demo-logo-wrap my-2 p-2 mt-3 border-5 border-light bg-light">
                                <img id="upload-logo-demo"></img>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-bind="hidden:showLogo">
                    <div class="img-thumbnail bg-white d-flex align-items-center justify-content-center" id="logo-preview"
                         style="width: 300px; height: 300px;">
                        <span class="text-muted small">No logo selected</span>
                    </div>
                </div>
                <div class="col has_solid_toggle">
                    <div class="custom-control custom-switch d-inline-block align-top">
                        <input type="checkbox" class="custom-control-input has-solid-toggle" id="has_solid">
                        <label class="custom-control-label" for="has_solid">Convert to solid white</label>
                    </div>
                    <span class="fe fe-help-circle text-info ml-1" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top" title="" data-content="Selecting this option adds your personalized branding bar to the bottom of the post graphic" data-original-title="Branding Bar"></span>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <button class="btn btn-sm btn-info px-4" onclick="tabSwitch('ui-id-3')"
                    role="button" aria-expanded="false" aria-controls="step2">
                Continue
            </button>
        </div>
    </div>
<!--</dd>-->
