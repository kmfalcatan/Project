function openModal() {
    var Modal = document.getElementById("Modal");
    Modal.style.display = "flex";
}

function closeModal() {
    var modal = document.getElementById("Modal");
    modal.style.display = "none";
}

function copyText(containerId, copyMessageId) {
    var container = document.getElementById(containerId);
    var range = document.createRange();
    range.selectNode(container);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
    document.execCommand("copy");
    window.getSelection().removeAllRanges();
    
    var copyMessage = document.getElementById(copyMessageId);
    copyMessage.textContent = "Copied to clipboard!";
    setTimeout(function() {
        copyMessage.textContent = "";
    }, 2000); 
}