const uploadButton = document.getElementById("fileUploadButton");
const generateButton = document.getElementById("generateButton");

function checkUploads() {
    var xhr = new XMLHttpRequest();
    var command = 'command=checkUploads';
    xhr.open("POST", "control.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Directory is not empty, enable the generateButton
                generateButton.disabled = false;
            } else {
                // Directory is empty, disable the generateButton
                generateButton.disabled = true;
            }
        }
    };
    xhr.send(command);
}

document.getElementById("fileUploadForm").addEventListener("submit", function() {
    setTimeout(checkUploads, 1000); // Delay to allow time for file upload to complete
});