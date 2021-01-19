function openPopup(postID, baseUrl) {
    feather.replace();
    // AJAX request
    $.ajax({
        url: baseUrl+'/ajax/postmodal.php',
        type: 'post',
        data: {postID: postID},
        success: function (response) {
            // Add response in Modal body
            $('.modal-body').html(response);

            // Display Modal
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("btn-close")[0];

            // When the user clicks the button, open the modal
            modal.style.display = "block";

            // When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                $('#myModal').slideUp('900');
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    $('#myModal').slideUp('900');
                }
            }
            $('.branding-bar-toggle').change(function () {
                if ($('.branding-bar-toggle').is(":checked"))
                    $(".branding-bar-preview").addClass('visible');
                else
                    $(".branding-bar-preview").removeClass('visible');
            });
            $('.copy-comment-btn').click(function () {
                $('.info-comment').fadeIn('slow');
                $('.info-comment').css('visibility','visible');
                var suggestedComment = $('#suggested-comment').text();
                copyToClipboard(suggestedComment);
                setTimeout(function(){
                    $('.info-comment').fadeOut('slow');
                    $('.info-comment').css('visibility','hidden');
                    }, 3000);
            });
            $('.copy-tags-btn').click(function () {
                $('.info-tags').fadeIn('slow');
                $('.info-tags').css('visibility','visible');
                var suggestedTags = $('#suggested-tags').text();
                copyToClipboard(suggestedTags);
                setTimeout(function(){
                    $('.info-tags').fadeOut('slow');
                    $('.info-tags').css('visibility','hidden');
                }, 3000);
            });
            $('.copy-all-btn').click(function () {
                $('.info-both').fadeIn('slow');
                $('.info-both').css('visibility','visible');
                var both = $('#suggested-comment').text() + "\r\n\r\n\r\n" + $('#suggested-tags').text();
                copyToClipboard(both);
                setTimeout(function(){
                    $('.info-both').fadeOut('slow');
                    $('.info-both').css('visibility','hidden');
                }, 3000);
            });
            // Download btn in modal popup
            $('.popup-download-btn').click(function () {
                var node = document.getElementById('downloadPreviewContainer');
                const scale = 1500 / node.offsetWidth;
                domtoimage.toPng(node, {
                    height: node.offsetHeight * scale,
                    width: node.offsetWidth * scale,
                    style: {
                        transform: "scale(" + scale + ")",
                        transformOrigin: "top left",
                        width: node.offsetWidth + "px",
                        height: node.offsetHeight + "px"
                    }
                })
                    .then(dataUrl => {
                        this.baseData = dataUrl;
                        var imageMime = base64MimeType(this.baseData);
                        var postSlug = $('#postmodal-slug').val();
                        var getMimeType = imageMime.split("/");
                        download(dataUrl, postSlug+"."+getMimeType[1], imageMime);
                    })
                    .catch(error => {
                        console.error("oops, something went wrong!", error);
                    });
            })
        }
    });
}

function base64MimeType(encoded) {
    var result = null;
    if (typeof encoded !== 'string') {
        return result;
    }
    var mime = encoded.match(/data:([a-zA-Z0-9]+\/[a-zA-Z0-9-.+]+).*,.*/);
    if (mime && mime.length) {
        result = mime[1];
    }
    return result;
}

function copyToClipboard(element) {
    var i = document.getElementsByTagName("body")[0],
        t = document.createElement("textarea");
    i.appendChild(t);
    t.innerHTML = element;
    t.select();
    document.execCommand("copy");
    i.removeChild(t);
}
